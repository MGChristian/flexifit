<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $exercise_name = isset($_POST['exerciseName']) ? $_POST['exerciseName'] : '';
    $exercise_description = isset($_POST['exerciseDescription']) ? $_POST['exerciseDescription'] : '';
    $profile = $_FILES['exercisePic'] ?? null;
    $folder = "../images/exercises/";

    try {
        require_once "../../userpage/includes/config.php";
        require_once "../../userpage/includes/config_session.inc.php";

        // Error handlers
        $errors = [];

        if (is_input_empty($exercise_name, $exercise_description, $profile)) {
            $errors["empty_input"] = "Please fill in all the fields!";
        }

        $profile_url = handle_profile_pic($folder, $profile);
        if ($profile_url === "none") {
            $errors["problem_with_image"] = "There was a problem with the uploaded image.";
        }
        if ($errors) {
            $_SESSION['error_login'] = $errors;
            header("Location: ../exercises.php");
            exit();
        } else {
            create_exercise($conn, $exercise_name, $exercise_description, $profile_url);
            header("Location: ../exercises.php?status=success");
            exit();
        }
    } catch (\Throwable $th) {
        exit("Query failed: " . $th->getMessage());
    }
} else {
    header("Location: ../");
    exit();
}

//Validate and check inputs
function is_input_empty($exercise_name, $exercise_description, $profile)
{
    if (
        empty($exercise_name) ||
        empty($exercise_description) ||
        empty($profile['name'])
    ) {
        return true;
    } else {
        return false;
    }
}

function handle_profile_pic($folder, $profile)
{
    $_FILES['category-photo-url'];
    //check for errors
    $imageErrors = [];

    //image handler for inputs
    $image = $profile;
    $image_name = $profile['name'];
    $image_type = $profile['type'];
    $image_tmp = $profile['tmp_name'];
    $image_error = $profile['error'];
    $image_size = $profile['size'];

    // Explode file name and get the extension at the end
    $image_Ext = explode(".", $image_name);
    $image_ActualExt = strtolower(end($image_Ext));

    $allowedTypes = array("jpg", "jpeg", "png");

    if (!in_array($image_ActualExt, $allowedTypes)) {
        $imageErrors[] = "Uploaded File is not Supported";
    }

    if ($image_error !== 0) {
        $imageErrors[] = "There was an error uploading your file";
    }

    if ($image_size > 2000000) {
        $imageErrors[] = "Your file is too big!";
    }

    if (count($imageErrors) == 0) {
        $fileNameNew = uniqid("", true) . "." . $image_ActualExt;
        $fileDestination = $folder . "/" . $fileNameNew;
        move_uploaded_file($image_tmp, $fileDestination);
        return $fileNameNew;
    } else {
        return "none";
    }
}

function create_exercise($conn, $exercise_name, $exercise_description, $profile_url)
{
    $conn->begin_transaction();
    try {
        $stmt = $conn->prepare("INSERT INTO `exercise` (`exerciseName`, `description`, `exercisePicUrl`) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $exercise_name, $exercise_description, $profile_url);
        if (!$stmt->execute()) {
            exit("SQL Error: " . $stmt->error);
        }
        $conn->commit();
        $stmt->close();
    } catch (\Throwable $th) {
        exit("Query failed: " . $th->getMessage());
    }
}

<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require_once "./auth.php";
    $workout_name = isset($_POST['workoutName']) ? $_POST['workoutName'] : '';
    $workout_description = isset($_POST['workoutDescription']) ? $_POST['workoutDescription'] : '';
    $difficulty = isset($_POST['difficulty']) ? $_POST['difficulty'] : '';
    $profile = $_FILES['workoutPic'] ?? null;
    $folder = "../../admin/images/workouts/";
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    // exit();
    try {
        // Id of the user creating the workout
        $workout_creator = isset($_SESSION['id']) ? $_SESSION['id'] : '';

        // Error handlers
        $errors = [];

        if (empty($workout_creator)) {
            $errors["invalid_user"] = "Invalid User!";
        }

        if (is_input_empty($workout_name, $workout_description, $difficulty, $profile)) {
            $errors["empty_input"] = "Please fill in all the fields!";
        }

        $profile_url = handle_profile_pic($folder, $profile);
        if ($profile_url === "none") {
            $errors["problem_with_image"] = "There was a problem with the uploaded image.";
        }
        if ($errors) {
            $_SESSION['error_login'] = $errors;
            header("Location: ../table-workouts.php");
            exit();
        } else {
            create_workout($conn, $workout_creator, $workout_name, $workout_description, $difficulty, $profile_url);
            header("Location: ../table-workouts.php?status=success");
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
function is_input_empty($workout_name, $workout_description, $difficulty, $profile)
{
    if (
        empty($workout_name) ||
        empty($workout_description) ||
        empty($difficulty) ||
        empty($profile['name'])
    ) {
        return true;
    } else {
        return false;
    }
}

function handle_profile_pic($folder, $profile)
{
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

function create_workout($conn, $workout_creator, $workout_name, $workout_description, $difficulty, $profile_url)
{
    $conn->begin_transaction();
    try {
        $stmt = $conn->prepare("INSERT INTO `workout` (`userID`, `workoutName`, `workoutDescription`, `workoutPicUrl`, `difficulty`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $workout_creator, $workout_name, $workout_description, $profile_url, $difficulty);
        if (!$stmt->execute()) {
            exit("SQL Error: " . $stmt->error);
        }
        $conn->commit();
        $stmt->close();
    } catch (\Throwable $th) {
        exit("Query failed: " . $th->getMessage());
    }
}

<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require_once "./auth.php";

    $muscle_name = $_POST['muscleName'];
    $muscle_description = $_POST['muscleDescription'];
    $profile = $_FILES['profilePic'];
    $folder = "../images/muscles/";

    try {
        // Error handlers
        $errors = [];

        if (is_input_empty($muscle_name, $muscle_description, $profile)) {
            $errors["empty_input"] = "Please fill in all the fields!";
        }

        $profile_url = handle_profile_pic($folder, $profile);
        if ($profile_url === "none") {
            $errors["problem_with_image"] = "There was a problem with the uploaded image.";
        }
        if ($errors) {
            $_SESSION['error_login'] = $errors;
            header("Location: ../table-muscles.php");
            exit();
        } else {
            create_muscle($conn, $muscle_name, $muscle_description, $profile_url);
            header("Location: ../table-muscles.php?status=success");
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
function is_input_empty($muscle_name, $muscle_description, $profile)
{
    if (
        empty($muscle_name) ||
        empty($muscle_description) ||
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

function create_muscle($conn, $muscle_name, $muscle_description, $profile_url)
{
    $conn->begin_transaction();
    try {
        $stmt = $conn->prepare("INSERT INTO `muscle` (`muscle_name`, `muscle_description`, `muscle_pic_url`) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $muscle_name, $muscle_description, $profile_url);
        if (!$stmt->execute()) {
            exit("SQL Error: " . $stmt->error);
        }
        $conn->commit();
        $stmt->close();
    } catch (\Throwable $th) {
        exit("Query failed: " . $th->getMessage());
    }
}

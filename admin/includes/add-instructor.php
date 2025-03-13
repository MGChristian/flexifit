<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $birthdate = $_POST['birthdate'];
    $email = $_POST['email'];
    $phone = $_POST['contactNumber'];
    $gender = $_POST['gender'];
    $profile = $_FILES['profilePic'];
    $folder = "../../instructor/images/" . $first_name . "-" . $last_name;

    try {
        require_once "../../userpage/includes/config.php";
        require_once "../../userpage/includes/config_session.inc.php";

        // Error handlers
        $errors = [];

        if (is_input_empty($first_name, $last_name, $birthdate, $email, $phone, $gender, $profile)) {
            $errors["empty_input"] = "Please fill in all the fields!";
        }


        if (is_email_invalid($email)) {
            $errors["invalid_email"] = "Email is invalid";
        }


        if (is_email_taken($conn, $email)) {
            $errors["email_is_taken"] = "Email is Taken";
        }

        $username = create_username($first_name, $last_name);

        check_folder_exists($folder);

        $profile_url = handle_profile_pic($folder, $profile);
        if ($profile_url === "none") {
            $errors["problem_with_image"] = "There was a problem with the uploaded image.";
        }
        if ($errors) {
            $_SESSION['error_login'] = $errors;
            header("Location: ../instructors.php");
            exit();
        } else {
            $temp = "2025Flexifit";
            $temporaryPassword = password_hash($temp, PASSWORD_BCRYPT);
            create_instructor($conn, $username, $email, $temporaryPassword, $first_name, $last_name, $birthdate, $phone, $gender, $profile_url);
            $_SESSION['username'] = $username;
            $_SESSION['temp-pass'] = $temp;
            header("Location: ../instructors.php?status=success");
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
function is_input_empty($first_name, $last_name, $birthdate, $email, $phone, $gender, $profile)
{
    if (
        empty($first_name) ||
        empty($last_name) ||
        empty($birthdate) ||
        empty($email) ||
        empty($phone) ||
        empty($gender) ||
        empty($profile['name'])
    ) {
        return true;
    } else {
        return false;
    }
}

function is_email_invalid($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function is_email_taken($conn, $email)
{
    $stmt = $conn->prepare("SELECT `email` FROM `user` WHERE `email` = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function create_username($first_name, $last_name)
{
    $temporaryUsername = "FLEX-" . $first_name . $last_name;
    return $temporaryUsername;
}


// Check whether the user exists
function user_exists($conn, $username)
{
    $stmt = $conn->prepare("SELECT * FROM `user` WHERE `username` = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc() ?: false;
}

function check_folder_exists($folder)
{
    if (!file_exists($folder) || !is_dir($folder)) {
        mkdir($folder, 0777, true);
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
        return $fileDestination;
    } else {
        return "none";
    }
}

function create_instructor($conn, $username, $email, $temporaryPassword, $first_name, $last_name, $birthdate, $phone, $gender, $profile_url)
{
    $conn->begin_transaction();
    try {
        $role = 'instructor';
        $stmt = $conn->prepare("INSERT INTO `user` (`username`, `email`, `password`, `firstName`, `lastName`, `DOB`, `contactNo`, `gender`, `profilePicUrl`, `role`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssisss", $username, $email, $temporaryPassword, $first_name, $last_name, $birthdate, $phone, $gender, $profile_url, $role);
        if (!$stmt->execute()) {
            exit("SQL Error: " . $stmt->error);
        }
        $conn->commit();
        $stmt->close();
    } catch (\Throwable $th) {
        exit("Query failed: " . $th->getMessage());
    }
}

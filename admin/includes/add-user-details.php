<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require_once "./auth.php";

    // header("content-type:application/json");
    // echo (json_encode([$_POST, $_FILES]));
    // exit();
    // Exercise details
    $userID = isset($_POST['userID']) ? $_POST['userID'] : '';
    $userFirstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
    $userLastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $contactNumber = isset($_POST['contactNumber']) ? $_POST['contactNumber'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    $photo = isset($_FILES['profilePicUrl']) ? $_FILES['profilePicUrl'] : '';
    $folder = "../../images/users/";

    try {
        // Error handlers
        $errors = [];

        $conn->begin_transaction();

        if (!is_id_valid($conn, $userID)) {
            $errors['invalid_id'] = "This user does not exists";
        }

        $photoUrl = '';
        if (!empty($photo['name'])) {
            $photoUrl = handle_picture_file($folder, $photo);
        }

        update_user($conn, $userID, $userFirstName, $userLastName, $email, $contactNumber, $gender, $birthdate, $status);

        if (!empty($photoUrl)) {
            update_user_profile($conn, $photoUrl, $userID);
        }

        if ($errors) {
            $conn->rollback();
            $_SESSION['error_adding_user_details'] = $errors;
            header("Location: ../table-users.php");
            exit();
        } else {
            $conn->commit();
            header("Location: ../edit-user.php?id={$userID}&status=success");
            exit();
        }
    } catch (\Throwable $th) {
        $conn->rollback();
        exit("Query failed: " . $th->getMessage());
    }
} else {
    header("Location: ../");
    exit();
}

//Validate and check inputs
function is_id_valid($conn, $userID)
{
    $role = "user";
    $stmt = $conn->prepare("SELECT * FROM `user` WHERE `ID` = ? AND `role` = ?");
    $stmt->bind_param("is", $userID, $role);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function update_user($conn, $userID, $userFirstName, $userLastName, $email, $contactNumber, $gender, $birthdate, $status)
{
    $stmt = $conn->prepare("UPDATE `user` SET `firstName` = ?, `lastName` = ?, `email` = ?, `contactNo` = ?, `gender` = ?, `DOB` = ?, `status` = ? WHERE ID = ?");
    $stmt->bind_param("sssisssi", $userFirstName, $userLastName, $email, $contactNumber, $gender, $birthdate, $status, $userID);
    $stmt->execute();
    $stmt->close();
}

function update_user_profile($conn, $pictureUrl, $userID)
{
    $stmt = $conn->prepare("UPDATE `user` SET `profilePicUrl` = ? WHERE ID = ?");
    $stmt->bind_param("si", $pictureUrl, $userID);
    $stmt->execute();
    $stmt->close();
}

function handle_picture_file($folder, $picture)
{
    //check for errors
    $pictureErrors = [];

    //image handler for inputs
    $picture = $picture;
    $picture_name = $picture['name'];
    $picture_type = $picture['type'];
    $picture_tmp = $picture['tmp_name'];
    $picture_error = $picture['error'];
    $picture_size = $picture['size'];

    // Explode file name and get the extension at the end
    $picture_Ext = explode(".", $picture_name);
    $picture_ActualExt = strtolower(end($picture_Ext));

    $allowedTypes = array("jpg", "jpeg", "png");

    if (!in_array($picture_ActualExt, $allowedTypes)) {
        $pictureErrors[] = "Uploaded File is not Supported";
    }

    if ($picture_error !== 0) {
        $pictureErrors[] = "There was an error uploading your file";
    }

    // Check if picture is greater than 2MB
    if ($picture_size > 2000000) {
        $pictureErrors[] = "Your file is too big!";
    }

    if (count($pictureErrors) == 0) {
        $fileNameNew = uniqid("", true) . "." . $picture_ActualExt;
        $fileDestination = $folder . $fileNameNew;
        move_uploaded_file($picture_tmp, $fileDestination);
        return $fileNameNew;
    } else {
        return "";
    }
}

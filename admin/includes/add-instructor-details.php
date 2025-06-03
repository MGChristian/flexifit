<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // header("content-type:application/json");
    // echo (json_encode([$_POST, $_FILES]));
    // exit();
    // Exercise details
    $instructorID = isset($_POST['instructorID']) ? $_POST['instructorID'] : '';
    $instructorFirstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
    $instructorLastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $contactNumber = isset($_POST['contactNumber']) ? $_POST['contactNumber'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : '';
    $personalGoals = isset($_POST['personalGoals']) ? $_POST['personalGoals'] : '';
    $personalDescriptions = isset($_POST['personalDescription']) ? $_POST['personalDescription'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    $photo = isset($_FILES['profilePicUrl']) ? $_FILES['profilePicUrl'] : '';
    $folder = "../../instructor/images/" . $instructorFirstName . "-" . $instructorLastName . "/";

    try {
        require_once "../../includes/config.php";
        require_once "../../includes/config_session.inc.php";

        // Error handlers
        $errors = [];

        $conn->begin_transaction();

        if (!is_id_valid($conn, $instructorID)) {
            $errors['invalid_id'] = "This user does not exists";
        }

        if (!does_user_details_exists($conn, $instructorID)) {
            create_user_details($conn, $instructorID);
        }

        if (!empty($personalGoals) || !empty($personalDescriptions)) {
            update_personal_details($conn, $personalDescriptions, $personalGoals, $instructorID);
        }

        $photoUrl = '';
        if (!empty($photo)) {
            $photoUrl = handle_picture_file($folder, $photo);
        }

        update_instructor($conn, $instructorID, $instructorFirstName, $instructorLastName, $email, $contactNumber, $gender, $birthdate);

        if (!empty($photoUrl)) {
            update_instructor_profile($conn, $photoUrl, $instructorID);
        }

        if ($errors) {
            $conn->rollback();
            $_SESSION['error_adding_workout_details'] = $errors;
            header("Location: ../instructors.php");
            exit();
        } else {
            $conn->commit();
            header("Location: ../edit-instructor.php?id={$instructorID}&status=success");
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
function is_id_valid($conn, $instructorID)
{
    $role = "instructor";
    $stmt = $conn->prepare("SELECT * FROM `user` WHERE `ID` = ? AND `role` = ?");
    $stmt->bind_param("is", $instructorID, $role);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function does_user_details_exists($conn, $instructorID)
{
    $stmt = $conn->prepare("SELECT * FROM `instructor_details` WHERE `userID` = ?");
    $stmt->bind_param("i", $instructorID);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function create_user_details($conn, $instructorID)
{
    $stmt = $conn->prepare("INSERT INTO `instructor_details`(`userID`) VALUES (?)");
    $stmt->bind_param("i", $instructorID);
    $stmt->execute();
    $stmt->close();
}

function update_instructor($conn, $instructorID, $instructorFirstName, $instructorLastName, $email, $contactNumber, $gender, $birthdate)
{
    $stmt = $conn->prepare("UPDATE `user` SET `firstName` = ?, `lastName` = ?, `email` = ?, `contactNo` = ?, `gender` = ?, `DOB` = ? WHERE ID = ?");
    $stmt->bind_param("sssissi", $instructorFirstName, $instructorLastName, $email, $contactNumber, $gender, $birthdate, $instructorID);
    $stmt->execute();
    $stmt->close();
}

function update_personal_details($conn, $personalDescriptions, $personalGoals, $instructorID)
{
    $stmt = $conn->prepare("UPDATE `instructor_details` SET `goal` = ?, `personalDescription` = ? WHERE userID = ?");
    $stmt->bind_param("ssi", $personalDescriptions, $personalGoals, $instructorID);
    $stmt->execute();
    $stmt->close();
}

function update_instructor_profile($conn, $pictureUrl, $instructorID)
{
    $stmt = $conn->prepare("UPDATE `user` SET `profilePicUrl` = ? WHERE ID = ?");
    $stmt->bind_param("si", $pictureUrl, $instructorID);
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

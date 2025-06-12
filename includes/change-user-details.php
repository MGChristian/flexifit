<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require_once "config.php";
    require_once "config_session.inc.php";

    $id = $_SESSION['id'];

    $firstName = trim($_POST['firstName'] ?? '');
    $lastName = trim($_POST['lastName'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $contactNumber = trim($_POST['contactNumber'] ?? '');
    $birthdate = trim($_POST['birthdate'] ?? '');
    $gender = trim($_POST['gender'] ?? '');
    $username = trim($_POST['username'] ?? '');

    try {
        // Error handlers
        $errors = [];

        if (is_input_empty($firstName, $lastName, $email, $contactNumber, $birthdate, $gender, $username)) {
            $errors["empty_input"] = "Please fill in all the fields!";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["invalid_email"] = "Please enter a valid email address.";
        }

        if (is_username_taken($conn, $id, $username)) {
            $errors["username_taken"] = "Username is already in use.";
        }

        if ($errors) {
            $_SESSION['error_user_update'] = $errors;
            header("Location: ../profile.php");
            exit();
        }

        if (update_user_details($conn, $id, $firstName, $lastName, $email, $contactNumber, $birthdate, $gender, $username)) {
            unset($_SESSION['error_user_update']);
            header("Location: ../profile.php?status=user_updated");
            exit();
        } else {
            $errors["update_failed"] = "Failed to update profile details.";
            $_SESSION['error_user_update'] = $errors;
            header("Location: ../profile.php");
            exit();
        }
    } catch (\Throwable $th) {
        error_log("User detail update error: " . $th->getMessage());
        $errors["system_error"] = "A system error occurred. Please try again.";
        $_SESSION['error_user_update'] = $errors;
        header("Location: ../profile.php");
        exit();
    }
} else {
    header("Location: ../");
    exit();
}

// Helper functions

function is_input_empty(...$fields)
{
    foreach ($fields as $field) {
        if (empty($field)) {
            return true;
        }
    }
    return false;
}

function is_username_taken($conn, $currentId, $username)
{
    $stmt = $conn->prepare("SELECT ID FROM user WHERE username = ? AND ID != ?");
    $stmt->bind_param("si", $username, $currentId);
    $stmt->execute();
    $result = $stmt->get_result();
    $taken = $result->num_rows > 0;
    $stmt->close();

    return $taken;
}

function update_user_details($conn, $id, $firstName, $lastName, $email, $contactNumber, $birthdate, $gender, $username)
{
    try {
        $stmt = $conn->prepare("
            UPDATE user 
            SET firstName = ?, lastName = ?, email = ?, contactNo = ?, DOB = ?, gender = ?, username = ?
            WHERE ID = ?
        ");
        $stmt->bind_param("sssssssi", $firstName, $lastName, $email, $contactNumber, $birthdate, $gender, $username, $id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    } catch (\Throwable $th) {
        error_log("Update user details failed: " . $th->getMessage());
        return false;
    }
}

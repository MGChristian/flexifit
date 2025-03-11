<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $birthdate = $_POST['birthdate'];
    $email = $_POST['email'];
    $phone = $_POST['contactNumber'];
    $gender = $_POST['gender'];

    try {
        require_once "config.php";

        // Error handlers
        $errors = [];

        if (is_input_empty($first_name, $last_name, $birthdate, $email, $phone, $gender)) {
            $errors["empty_input"] = "Please fill in all the fields!";
        }
        if (is_email_invalid($email)) {
            $errors["invalid_email"] = "The email provided is invalid!";
        }
        if (is_email_taken($conn, $email)) {
            $errors["taken_email"] = "The email provided is already taken!";
        }

        require_once "config_session.inc.php";

        if ($errors) {
            $_SESSION['error_signup'] = $errors;
            header("Location: ../signup-page-info.php");
            exit();
        } else {
            $_SESSION['firstName'] = $first_name;
            $_SESSION['lastName'] = $last_name;
            $_SESSION['birthdate'] = $birthdate;
            $_SESSION['email'] = $email;
            $_SESSION['phone'] = $phone;
            $_SESSION['gender'] = $gender;
            header("Location: ../signup-page-account.php");
            exit();
        }
    } catch (\Throwable $th) {
        exit("Query failed: " . $th->getMessage());
    }
} else {
    header("Location: ../signup-page-info.php");
    exit();
}

//Validate and check inputs
function is_input_empty($first_name, $last_name, $birthdate, $email, $phone, $gender)
{
    if (
        empty($first_name) ||
        empty($last_name) ||
        empty($birthdate) ||
        empty($email) ||
        empty($phone) ||
        empty($gender)
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

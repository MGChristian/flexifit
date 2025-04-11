<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = $_POST['email'] || '';

    try {
        require_once "config.php";
        require_once "config_session.inc.php";
        require_once "sendmail.php";

        // Error handlers
        $errors = [];

        if (is_input_empty($email)) {
            $errors["empty_input"] = "Please fill in all the fields!";
        }

        $user = user_exists($conn, $email);

        if (!$user) {
            $errors["invalid_account"] = "Account does not exists!";
            $_SESSION['error_login'] = $errors;
            header("Location: login-page-forgot.php");
            exit();
        }

        if (!forgot_password($email)) {
            $errors["email_error"] = "Something went wrong sending the email. Please try again later.";
        }

        if ($errors) {
            $_SESSION['error_login'] = $errors;
            header("Location: ../login-page-forgot.php");
            exit();
        } else {
            header("location: ../login-page-email.php");
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
function is_input_empty($email)
{
    if (
        empty($email)
    ) {
        return true;
    } else {
        return false;
    }
}

// Check whether the user exists
function user_exists($conn, $email)
{
    $stmt = $conn->prepare("SELECT * FROM `user` WHERE `email` = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc() ?: false;
}

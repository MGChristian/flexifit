<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $url = "http://localhost/flexifit/userpage/login-page-reset.php";

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
            header("Location: ../login-page-forgot.php");
            exit();
        } else {
            $userID = $user['ID'];
        }

        //generate token and expiry for the forgot password link
        $token = bin2hex(random_bytes(32));
        $expiry = date("Y-m-d H:i:s", strtotime('+1 hour'));
        if (!add_token_expiry($conn, $token, $expiry, $userID)) {
            $errors["email_error"] = "Something went wrong. Please try again later.";
        }

        //send email
        if (!forgot_password($email, $url, $token, $expiry)) {
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

//add reset token expiry to user acc in db
function add_token_expiry($conn, $token, $expiry, $userID)
{
    try {
        $stmt = $conn->prepare("UPDATE user SET `reset_token` = ?, `reset_expiry` = ? WHERE ID = ?");
        $stmt->bind_param("ssi", $token, $expiry, $userID);
        return $stmt->execute() ?: true;
    } catch (\Throwable $th) {
        return false;
    }
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
    $stmt->close();
    return $result->fetch_assoc() ?: false;
}

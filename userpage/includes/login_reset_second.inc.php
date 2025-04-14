<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $token = isset($_POST['token']) ? $_POST['token'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirmPassword = isset($_POST['confirm-password']) ? $_POST['confirm-password'] : '';
    $url = "http://localhost/flexifit/userpage/login-page-reset.php";

    try {
        require_once "config.php";
        require_once "config_session.inc.php";

        // Error handlers
        $errors = [];

        if (is_input_empty($token, $password, $confirmPassword)) {
            $errors["empty_input"] = "Please fill in all the fields!";
        }

        if (is_password_not_matching($password, $confirmPassword)) {
            $errors["empty_input"] = "Password is not matching!";
        }

        if (token_not_exists($conn, $token)) {
            $errors["token_not_exists"] = "Invalid or expired token. Please request a new reset link.";
        }

        if ($errors) {
            $_SESSION['error_login'] = $errors;
            header("Location: ../login-page-reset.php?token=" . htmlspecialchars($token));
            exit();
        } else {
            $hashedPassword = hashedPwd($password);
            update_password($conn, $token, $hashedPassword);
            header("location: ../login-page-changed.php");
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
function is_input_empty($token, $confirmPassword, $password)
{
    if (
        empty($token) ||
        empty($confirmPassword) ||
        empty($password)
    ) {
        return true;
    } else {
        return false;
    }
}

// Check if the password sent is matching
function is_password_not_matching($password, $confirmPassword)
{
    if ($password !== $confirmPassword) {
        return true;
    } else {
        return false;
    }
}

//check account reset token
function token_not_exists($conn, $token)
{
    $stmt = $conn->prepare("SELECT ID FROM user WHERE reset_token = ? AND reset_expiry > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if ($result->num_rows <= 0) {
        return true;
    } else {
        return false;
    }
}

function update_password($conn, $token, $password)
{
    try {
        $stmt = $conn->prepare("UPDATE user SET `password` = ?, reset_token = NULL, reset_expiry = NULL WHERE reset_token = ?");
        $stmt->bind_param("ss", $password, $token);
        return $stmt->execute() ?: true;
    } catch (\Throwable $th) {
        return false;
    }
}


function hashedPwd($password)
{
    return password_hash($password, PASSWORD_BCRYPT);
}

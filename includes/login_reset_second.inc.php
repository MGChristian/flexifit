<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require_once "./auth.php";

    $token = isset($_POST['token']) ? $_POST['token'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirmPassword = isset($_POST['confirm-password']) ? $_POST['confirm-password'] : '';
    $url = "http://localhost/flexifit/userpage/login-reset-third.php";

    try {
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

        if (password_already_used($conn, $token, $password)) {
            $errors["password_already_used"] = "Your new password cannot be the same as your old password.";
        }

        if ($errors) {
            $_SESSION['error_login'] = $errors;
            header("Location: ../login-reset-third.php?token=" . htmlspecialchars($token));
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

function hashedPwd($password)
{
    //add options for hashing strength(?)
    return password_hash($password, PASSWORD_BCRYPT);
}

//Check if password is already used to prevent user for using the same password as before
function password_already_used($conn, $token, $password)
{
    $stmt = $conn->prepare("SELECT `password` FROM user WHERE `reset_token` = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $row = $result->fetch_assoc();
    $oldPassword = $row['password'] ? $row['password'] : '';
    if (password_verify($password, $oldPassword)) {
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

        //return true if password is successfuly updated
        return $stmt->execute() ?: true;
    } catch (\Throwable $th) {
        return false;
    }
}

<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require_once "./auth.php";

    $id = $_SESSION['id'];
    $currentPassword = $_POST['currentPassword'] ?? '';
    $password = $_POST['newPassword'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    try {
        // Error handlers
        $errors = [];

        if (is_input_empty($id, $currentPassword, $password, $confirmPassword)) {
            $errors["empty_input"] = "Please fill in all the fields!";
        }

        if (is_password_not_matching($password, $confirmPassword)) {
            $errors["password_mismatch"] = "New passwords don't match!";
        }

        if (!is_current_password_correct($conn, $id, $currentPassword)) {
            $errors["wrong_password"] = "Current password is incorrect!";
        }

        if (is_password_already_used($conn, $id, $password)) {
            $errors["password_reused"] = "New password cannot be the same as current password.";
        }

        // Password complexity validation
        $complexityErrors = validate_password_complexity($password);
        if (!empty($complexityErrors)) {
            $errors["password_complexity"] = implode("<br>", $complexityErrors);
        }

        if ($errors) {
            $_SESSION['error_login'] = $errors;
            header("Location: ../profile-user.php");
            exit();
        }

        $hashedPassword = hashedPwd($password);
        if (update_password($conn, $hashedPassword, $id)) {
            // Clear any existing password-related errors on success
            unset($_SESSION['error_login']);
            header("location: ../profile-user.php?status=success");
            exit();
        } else {
            $errors["update_failed"] = "Failed to update password";
            $_SESSION['error_login'] = $errors;
            header("Location: ../profile-user.php");
            exit();
        }
    } catch (\Throwable $th) {
        error_log("Password change error: " . $th->getMessage());
        $errors["system_error"] = "A system error occurred. Please try again.";
        $_SESSION['error_login'] = $errors;
        header("Location: ../profile-user.php");
        exit();
    }
} else {
    header("Location: ../");
    exit();
}

// Validate input fields
function is_input_empty($id, $currentPassword, $password, $confirmPassword)
{
    return empty($id) || empty($currentPassword) || empty($password) || empty($confirmPassword);
}

// Check if passwords match
function is_password_not_matching($password, $confirmPassword)
{
    return $password !== $confirmPassword;
}

// Password hashing function
function hashedPwd($password)
{
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
}

// Validate current password
function is_current_password_correct($conn, $id, $currentPassword)
{
    $stmt = $conn->prepare("SELECT `password` FROM user WHERE `ID` = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    return password_verify($currentPassword, $row['password'] ?? '');
}

// Check if new password is same as current
function is_password_already_used($conn, $id, $newPassword)
{
    $stmt = $conn->prepare("SELECT `password` FROM user WHERE `ID` = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    return password_verify($newPassword, $row['password'] ?? '');
}

// Update password in database
function update_password($conn, $hashedPassword, $id)
{
    try {
        $stmt = $conn->prepare("UPDATE user SET `password` = ? WHERE ID = ?");
        $stmt->bind_param("si", $hashedPassword, $id);
        return $stmt->execute();
    } catch (\Throwable $th) {
        error_log("Password update failed: " . $th->getMessage());
        return false;
    }
}

// Password complexity requirements
function validate_password_complexity($password)
{
    $errors = [];

    // Minimum length
    if (strlen($password) < 12) {
        $errors[] = "Password must be at least 12 characters long";
    }

    // Requires at least one uppercase letter
    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = "Password must contain at least one uppercase letter";
    }

    // Requires at least one lowercase letter
    if (!preg_match('/[a-z]/', $password)) {
        $errors[] = "Password must contain at least one lowercase letter";
    }

    // Requires at least one number
    if (!preg_match('/[0-9]/', $password)) {
        $errors[] = "Password must contain at least one number";
    }

    // Requires at least one special character
    if (!preg_match('/[\W_]/', $password)) {
        $errors[] = "Password must contain at least one special character";
    }

    // Check for common passwords (basic example)
    $commonPasswords = ['password', '123456', 'qwerty', 'letmein'];
    if (in_array(strtolower($password), $commonPasswords)) {
        $errors[] = "Password is too common and easily guessable";
    }

    return $errors;
}

<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        require_once "config.php";
        require_once "config_session.inc.php";

        // Error handlers
        $errors = [];

        if (is_input_empty($username, $password)) {
            $errors["empty_input"] = "Please fill in all the fields!";
        }

        $user = user_exists($conn, $username);

        if (!$user) {
            $errors["invalid_account"] = "Account does not exists!";
            $_SESSION['error_login'] = $errors;
            header("Location: ../login-page.php");
            exit();
        }

        if (is_password_wrong($password, $user['password'])) {
            $errors["password_wrong"] = "Password is not correct!";
        }


        if ($errors) {
            $_SESSION['error_login'] = $errors;
            header("Location: ../login-page.php");
            exit();
        } else {
            $_SESSION['id'] = $user['ID'];
            $_SESSION['role'] = $user['role'];
            switch ($user['role']) {
                case "user":
                    header("location: ../");
                    break;
                case "instructor":
                    header("location:  ../instructors/");
                    break;
                case "admin":
                    header("location: ../admin/");
                    break;
            }
        }

        require_once "config_session.inc.php";
    } catch (\Throwable $th) {
        exit("Query failed: " . $th->getMessage());
    }
} else {
    header("Location: ../");
    exit();
}

//Validate and check inputs
function is_input_empty($username, $password)
{
    if (
        empty($username) ||
        empty($password)
    ) {
        return true;
    } else {
        return false;
    }
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

function is_password_wrong($password, $dbpassword)
{
    if (!password_verify($password, $dbpassword)) {
        return true;
    } else {
        return false;
    }
}

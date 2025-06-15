<?php

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    require_once "./auth.php";

    $userId = $_GET['id'];

    try {
        // Error handlers
        $errors = [];

        if (is_input_empty($userId)) {
            $errors["empty_input"] = "Please fill in all the fields!";
        }


        if (check_if_not_admin()) {
            $errors["not_admin"] = "Unauthorized Access";
            header("Location: 404.php");
            exit();
        }

        if ($errors) {
            $_SESSION['archive_error'] = $errors;
            header("Location: ../table-users.php");
            exit();
        } else {
            archive_user($conn, $userId);
            header("Location: ../table-users.php?status=success");
            exit();
        }
    } catch (\Throwable $th) {
        exit("Query failed: " . $th->getMessage());
    }
} else {
    header("Location: ../");
    exit();
}

function is_input_empty($userId)
{
    if (empty($userId)) {
        return true;
    } else {
        return false;
    }
}


function check_if_not_admin()
{
    if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
        return true;
    } else {
        return false;
    }
}

function archive_user($conn, $userId)
{
    $stmt = $conn->prepare("UPDATE `user` SET `status` = 'archived' WHERE `ID` = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
}

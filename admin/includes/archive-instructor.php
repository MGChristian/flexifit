<?php

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $instructorId = $_GET['ID'];

    try {
        require_once "../../userpage/includes/config.php";
        require_once "../../userpage/includes/config_session.inc.php";

        // Error handlers
        $errors = [];

        if (is_input_empty($instructorId)) {
            $errors["empty_input"] = "Please fill in all the fields!";
        }


        if (check_if_not_admin()) {
            $errors["not_admin"] = "Unauthorized Access";
            header("Location: 404.php");
            exit();
        }

        if ($errors) {
            $_SESSION['archive_error'] = $errors;
            header("Location: ../instructors.php");
            exit();
        } else {
            archive_instructor($conn, $instructorId);
            header("Location: ../instructors.php?status=success");
            exit();
        }
    } catch (\Throwable $th) {
        exit("Query failed: " . $th->getMessage());
    }
} else {
    header("Location: ../");
    exit();
}

function is_input_empty($instructorId)
{
    if (empty($instructorId)) {
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

function archive_instructor($conn, $instructorId)
{
    $stmt = $conn->prepare("UPDATE `user` SET `status` = 'archived' WHERE `ID` = ?");
    $stmt->bind_param("i", $instructorId);
    $stmt->execute();
}

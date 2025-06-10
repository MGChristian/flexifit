<?php

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $categoryID = $_GET['id'];

    try {
        require_once "../../includes/config.php";
        require_once "../../includes/config_session.inc.php";

        // Error handlers
        $errors = [];

        if (is_input_empty($categoryID)) {
            $errors["empty_input"] = "Please fill in all the fields!";
        }


        if (check_if_not_admin()) {
            $errors["not_admin"] = "Unauthorized Access";
            header("Location: categories.php");
            exit();
        }

        if ($errors) {
            $_SESSION['archive_error'] = $errors;
            header("Location: ../categories.php");
            exit();
        } else {
            archive_instructor($conn, $instructorId);
            header("Location: ../categories.php?status=success");
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

function delete_category($conn, $categoryID)
{
    $stmt = $conn->prepare("DELETE FROM `category` WHERE ID = ?");
    $stmt->bind_param("i", $categoryID);
    $stmt->execute();
}

<?php

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    require_once "./auth.php";

    $muscleID = $_GET['id'];

    try {
        // Error handlers
        $errors = [];

        if (is_input_empty($muscleID)) {
            $errors["empty_input"] = "Please fill in all the fields!";
        }


        if (check_if_not_admin()) {
            $errors["not_admin"] = "Unauthorized Access";
            header("Location: table-muscles.php");
            exit();
        }

        if ($errors) {
            $_SESSION['archive_error'] = $errors;
            header("Location: ../table-muscles.php");
            exit();
        } else {
            archive_instructor($conn, $instructorId);
            header("Location: ../table-muscles.php?status=success");
            exit();
        }
    } catch (\Throwable $th) {
        exit("Query failed: " . $th->getMessage());
    }
} else {
    header("Location: ../");
    exit();
}

function is_input_empty($muscleID)
{
    if (empty($muscleID)) {
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

function delete_category($conn, $muscleID)
{
    $stmt = $conn->prepare("DELETE FROM `muscle` WHERE ID = ?");
    $stmt->bind_param("i", $muscleID);
    $stmt->execute();
}

<?php

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    require_once "./auth.php";

    $equipmentID = $_GET['id'];

    try {
        // Error handlers
        $errors = [];

        if (is_input_empty($equipmentID)) {
            $errors["empty_input"] = "Please fill in all the fields!";
        }


        if (check_if_not_admin()) {
            $errors["not_admin"] = "Unauthorized Access";
            header("Location: table-equipments.php");
            exit();
        }

        if ($errors) {
            $_SESSION['archive_error'] = $errors;
            header("Location: ../table-equipments.php");
            exit();
        } else {
            delete_equipment($conn, $equipmentID);
            header("Location: ../table-equipments.php?status=success");
            exit();
        }
    } catch (\Throwable $th) {
        exit("Query failed: " . $th->getMessage());
    }
} else {
    header("Location: ../");
    exit();
}

function is_input_empty($equipmentID)
{
    if (empty($equipmentID)) {
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

function delete_equipment($conn, $equipmentID)
{
    $stmt = $conn->prepare("DELETE FROM `equipment` WHERE ID = ?");
    $stmt->bind_param("i", $equipmentID);
    $stmt->execute();
}

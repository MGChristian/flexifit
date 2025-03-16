<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $exerciseId = $_POST['exerciseId'];
    $muscleGroup = $_POST['muscleGroup'];
    $equipmentList = $_POST['equipmentList'];
    $exerciseSteps = $_POST['exerciseSteps'];

    try {
        require_once "../../userpage/includes/config.php";
        require_once "../../userpage/includes/config_session.inc.php";

        // Error handlers
        $errors = [];

        if (is_input_empty($exerciseId, $muscleGroup, $equipmentList, $exerciseSteps)) {
            $errors["empty_input"] = "Please fill in all the fields!";
        }

        if ($errors) {
            $_SESSION['error_adding_exercise_details'] = $errors;
            header("Location: ../exercises.php");
            exit();
        } else {
            foreach ($muscleGroup as $muscle) {
                add_muscle_group($conn, $muscle, $exerciseId);
            }
            foreach ($equipmentList as $equipmentName) {
                add_equipments($conn, $equipmentName, $exerciseId);
            }
            foreach ($exerciseSteps as $exerciseStep) {
                add_exercise_steps($conn, $exerciseStep, $exerciseId);
            }
            header("Location: ../exercises.php?status=success");
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
function is_input_empty($exerciseId, $muscleGroup, $equipmentList, $exerciseSteps)
{
    if (
        empty($exerciseId) ||
        empty($muscleGroup) ||
        empty($equipmentList) ||
        empty($exerciseSteps)
    ) {
        return true;
    } else {
        return false;
    }
}

function add_muscle_group($conn, $muscleGroup, $exerciseId)
{
    $stmt = $conn->prepare("INSERT INTO `muscleGroup` (`exerciseID`, `muscleGroup`) VALUES (?, ?)");
    $stmt->bind_param("is", $exerciseId, $muscleGroup);
    if (!$stmt->execute()) {
        exit("SQL Error: " . $stmt->error);
    }
    $stmt->close();
}

function add_equipments($conn, $equipmentName, $exerciseId)
{
    $stmt = $conn->prepare("INSERT INTO `equipmentList` (`exerciseID`, `equipmentName`) VALUES (?, ?)");
    $stmt->bind_param("is", $exerciseId, $equipmentName);
    if (!$stmt->execute()) {
        exit("SQL Error: " . $stmt->error);
    }
    $stmt->close();
}

function add_exercise_steps($conn, $exerciseStep, $exerciseId)
{
    $stmt = $conn->prepare("INSERT INTO `exerciseSteps` (`exerciseID`, `exerciseStep`) VALUES (?, ?)");
    $stmt->bind_param("is", $exerciseId, $exerciseStep);
    if (!$stmt->execute()) {
        exit("SQL Error: " . $stmt->error);
    }
    $stmt->close();
}

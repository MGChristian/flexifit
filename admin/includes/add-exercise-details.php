<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    // Exercise details
    $exerciseId = $_POST['exerciseID'];
    $exerciseName = $_POST['exerciseName'];
    $exerciseDescription = $_POST['exerciseDescription'];
    $status = $_POST['status'];

    // Clickables
    $equipmentList = isset($_POST['equipments']) ? $_POST['equipments'] : [];
    $categories = isset($_POST['categories']) ? $_POST['categories'] : [];
    $muscleGroup = isset($_POST['muscleGroup']) ? $_POST['muscleGroup'] : [];

    // EXERCISE STEPS
    $addExerciseSteps = isset($_POST['addExerciseStep']) ? $_POST['addExerciseStep'] : [];
    $removeExerciseSteps = isset($_POST['removeExerciseStep']) ? $_POST['removeExerciseStep'] : [];
    $updateExerciseSteps = isset($_POST['updateExerciseStep']) ? $_POST['updateExerciseStep'] : [];

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    // exit();

    try {
        require_once "../../userpage/includes/config.php";
        require_once "../../userpage/includes/config_session.inc.php";

        // Error handlers
        $errors = [];

        $conn->begin_transaction();

        // foreach ($muscleGroup as $muscle) {
        //     add_muscle_group($conn, $muscle, $exerciseId);
        // }
        // foreach ($equipmentList as $equipmentName) {
        //     add_equipments($conn, $equipmentName, $exerciseId);
        // }

        // , $equipmentList, $categories, $muscleGroup, $exerciseSteps
        if (is_input_empty($exerciseId, $exerciseName, $exerciseDescription, $status)) {
            $errors["empty_input"] = "Inputs cannot be empty!";
        }

        //Check if new steps were added, if so, add it to the database
        if (!empty($addExerciseSteps)) {
            foreach ($addExerciseSteps as $addExerciseStep) {
                add_exercise_steps($conn, $addExerciseStep, $exerciseId);
            }
        }

        //Check if existing steps were updated, if so, update it in the database
        if (!empty($updateExerciseSteps)) {
            foreach ($updateExerciseSteps as $stepId => $updateExerciseStep) {
                update_exercise_steps($conn, $updateExerciseStep, $stepId);
            }
        }

        //Check if existing steps were removed, if so, remove it in the database
        if (!empty($removeExerciseSteps)) {
            foreach ($removeExerciseSteps as $stepId => $removeExerciseStep) {
                remove_exercise_steps($conn, $stepId);
            }
        }

        if ($errors) {
            $conn->rollback();
            $_SESSION['error_adding_exercise_details'] = $errors;
            header("Location: ../exercises.php");
            exit();
        } else {
            $conn->commit();
            header("Location: ../exercise-edit.php?id={$exerciseId}&status=success");
            exit();
        }
    } catch (\Throwable $th) {
        $conn->rollback();
        exit("Query failed: " . $th->getMessage());
    }
} else {
    header("Location: ../");
    exit();
}

//Validate and check inputs
function is_input_empty($exerciseId, $exerciseName, $exerciseDescription, $status)
{
    if (
        empty($exerciseId) ||
        empty($exerciseName) ||
        empty($exerciseDescription) ||
        empty($status)
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

// STEPS FUNCTIONS

function add_exercise_steps($conn, $addExerciseStep, $exerciseId)
{
    $stmt = $conn->prepare("INSERT INTO `exercise_steps` (`exerciseID`, `step_instruction`) VALUES (?, ?)");
    $stmt->bind_param("is", $exerciseId, $addExerciseStep);
    $stmt->execute();
    $stmt->close();
}

function update_exercise_steps($conn, $updateExerciseStep, $stepId)
{
    $stmt = $conn->prepare("UPDATE `exercise_steps` SET `step_instruction` = ? WHERE ID = ?");
    $stmt->bind_param("si", $updateExerciseStep, $stepId);
    $stmt->execute();
    $stmt->close();
}

function remove_exercise_steps($conn, $stepId)
{
    $stmt = $conn->prepare("DELETE FROM `exercise_steps` WHERE `ID` = ?");
    $stmt->bind_param("i", $stepId);
    $stmt->execute();
    $stmt->close();
}

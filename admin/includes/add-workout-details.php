<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    header("content-type:application/json");
    echo (json_encode($_POST));
    exit();
    // Exercise details
    $workoutID = isset($_POST['workoutID']) ? $_POST['workoutID'] : '';
    $workoutName = isset($_POST['workoutName']) ? $_POST['workoutName'] : '';
    $workoutDescription = isset($_POST['workoutDescription']) ? $_POST['workoutDescription'] : '';
    $difficulty = isset($_POST['difficulty']) ? $_POST['difficulty'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';

    // Sets
    $sets = $_POST['set'];

    try {
        require_once "../../includes/config.php";
        require_once "../../includes/config_session.inc.php";

        // Error handlers
        $errors = [];

        $conn->begin_transaction();

        foreach ($sets as $setNumber => $setContent) {
            foreach ($setContent as $setExerciseList => $setExerciseListContent) {
                foreach ($setExerciseListContent as $setExerciseNumber => $setExerciseContent) {
                    $exerciseID = $setExerciseContent['exerciseID'];
                    $reps = $setExerciseContent['reps'];
                    $duration = $setExerciseContent['time'];
                    $workoutSet = $setExerciseContent['workoutSet'];
                    add_exercise($conn, $workoutID, $exerciseID, $reps, $duration, $workoutSet);
                }
            }
        }

        // $equipmentList, $categories, $muscleGroup, $exerciseSteps
        if (is_input_empty($workoutID, $workoutName, $workoutDescription, $difficulty, $status)) {
            $errors["empty_input"] = "Inputs cannot be empty!";
        }

        update_workout_name($conn, $workoutName, $workoutID);
        update_workout_description($conn, $workoutDescription, $workoutID);
        update_workout_difficulty($conn, $difficulty, $workoutID);
        update_workout_status($conn, $status, $workoutID);

        if ($errors) {
            $conn->rollback();
            $_SESSION['error_adding_workout_details'] = $errors;
            header("Location: ../workouts.php");
            exit();
        } else {
            $conn->commit();
            header("Location: ../edit-workout.php?id={$workoutID}&status=success");
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
function is_input_empty($workoutID, $workoutName, $workoutDescription, $difficulty, $status)
{
    if (
        empty($workoutID) ||
        empty($workoutName) ||
        empty($workoutDescription) ||
        empty($difficulty)
    ) {
        return true;
    } else {
        return false;
    }
}

// Workout Details
function update_workout_name($conn, $workoutName, $workoutID)
{
    $stmt = $conn->prepare("UPDATE `workout` SET `workoutName` = ? WHERE ID = ?");
    $stmt->bind_param("si", $workoutName, $workoutID);
    $stmt->execute();
    $stmt->close();
}

function update_workout_description($conn, $workoutDescription, $workoutID)
{
    $stmt = $conn->prepare("UPDATE `workout` SET `workoutDescription` = ? WHERE ID = ?");
    $stmt->bind_param("si", $workoutDescription, $workoutID);
    $stmt->execute();
    $stmt->close();
}

function update_workout_difficulty($conn, $difficulty, $workoutID)
{
    $stmt = $conn->prepare("UPDATE `workout` SET `difficulty` = ? WHERE ID = ?");
    $stmt->bind_param("si", $difficulty, $workoutID);
    $stmt->execute();
    $stmt->close();
}

function update_workout_status($conn, $status, $workoutID)
{
    $stmt = $conn->prepare("UPDATE `workout` SET `status` = ? WHERE ID = ?");
    $stmt->bind_param("si", $status, $workoutID);
    $stmt->execute();
    $stmt->close();
}

// Exercises

function add_exercise($conn, $workoutID, $exerciseID, $reps, $duration, $workoutSet)
{
    $stmt = $conn->prepare("INSERT INTO `workout_exercises`(`workoutID`, `exerciseID`, `reps`, `duration`, `workoutSet`) VALUES(?, ?, ?, ?, ?)");
    $stmt->bind_param("iiisi", $workoutID, $exerciseID, $reps, $duration, $workoutSet);
    $stmt->execute();
    $stmt->close();
}

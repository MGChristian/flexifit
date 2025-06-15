<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require_once "./auth.php";

    // Id of the user creating the exercise
    $workout_id = isset($_POST['workoutID']) ? $_POST['workoutID'] : '';
    $collection_id = isset($_POST['collectionID']) ? $_POST['collectionID'] : '';

    try {
        // Error handlers
        $errors = [];

        if (is_input_empty($workout_id, $collection_id)) {
            $errors["empty_input"] = "Please fill in all the fields!";
        }

        if (workout_exists($conn, $workout_id, $collection_id)) {
            $errors['item_already_exist'] = "This workout already exists in this collection";
        }

        if ($errors) {
            $_SESSION['error_login'] = $errors;
            header("Location: ../view-workout.php?id=" . htmlspecialchars($workout_id));
            exit();
        } else {
            create_collection($conn, $workout_id, $collection_id);
            header("Location: ../view-workout.php?id=" . htmlspecialchars($workout_id) . "status=success");
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
function is_input_empty($workout_id, $collection_id)
{
    if (
        empty($workout_id) ||
        empty($collection_id)
    ) {
        return true;
    } else {
        return false;
    }
}

function workout_exists($conn, $workout_id, $collection_id)
{
    $stmt = $conn->prepare("SELECT * FROM `collection_workouts` WHERE `workoutID` = ? AND `collectionID` = ?");
    $stmt->bind_param("ii", $workout_id, $collection_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function create_collection($conn, $workout_id, $collection_id)
{
    $conn->begin_transaction();
    try {
        $stmt = $conn->prepare("INSERT INTO `collection_workouts` (`workoutID`, `collectionID`) VALUES (?, ?)");
        $stmt->bind_param("ii", $workout_id, $collection_id);
        if (!$stmt->execute()) {
            exit("SQL Error: " . $stmt->error);
        }
        $conn->commit();
        $stmt->close();
    } catch (\Throwable $th) {
        exit("Query failed: " . $th->getMessage());
    }
}

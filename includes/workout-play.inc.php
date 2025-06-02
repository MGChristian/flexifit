<?php

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    require_once("./config_session.inc.php");
    require_once("./config.php");
    header("content-type:application/json");

    $workoutID = $_GET['id'];
    $navigation = $_GET['navNumber'];

    $exercise = [];

    if (!empty(check_exercise_count($conn, $workoutID))) {
        $count = check_exercise_count($conn, $workoutID);
        $exercise['count'] = $count['exerciseCount'];
    }

    if (!empty(get_offset_exercise($conn, $workoutID, $navigation))) {
        $exerciseDetails = get_offset_exercise($conn, $workoutID, $navigation);
        $exercise['duration'] = isset($exerciseDetails['duration']) ? $exerciseDetails['duration'] : '';
        $exercise['reps'] = isset($exerciseDetails['reps']) ? $exerciseDetails['reps'] : '';
        $exercise['exerciseVidUrl'] = isset($exerciseDetails['exerciseVidUrl']) ? $exerciseDetails['exerciseVidUrl'] : '';
    }

    echo (json_encode($exercise));
}

function check_exercise_count($conn, $workoutID)
{
    $stmt = $conn->prepare("SELECT COUNT(`ID`) as `exerciseCount` FROM `workout_exercises` WHERE `workoutID` = ?");
    $stmt->bind_param("i", $workoutID);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return '';
    }
}

function get_offset_exercise($conn, $workoutID, $navigation)
{
    $stmt = $conn->prepare("SELECT * FROM `workout_exercises` WHERE `workoutID` = ? ORDER BY `ID` LIMIT 1  OFFSET ?");
    $stmt->bind_param("ii", $workoutID, $navigation);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return '';
    }
}

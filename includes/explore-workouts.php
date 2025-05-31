<?php

//Get the exercises from the database
function get_workouts($conn)
{
    $stmt = $conn->prepare("SELECT `workout`.`ID`, `workout`.`workoutName`, `workout`.`workoutPicUrl`, `workout`.`workoutDescription`, `workout`.`difficulty`, (SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(`duration`))) FROM `workout_exercises` WHERE `workout_exercises`.`workoutID` = `workout`.`ID`) AS `duration` FROM `workout` WHERE `status` = '1'");
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if ($result->num_rows > 0) {
        $exerciseRows = [];
        while ($rows = $result->fetch_assoc()) {
            if (isset($rows['duration'])) {
                $parts = explode(':', $rows['duration']);
                $durationFormatted = $parts[0] . 'h ' . $parts[1] . 'm ' . $parts[2] . 's';
                $rows['duration'] = $durationFormatted;
            } else {
                $rows['duration'] = 'No duration';
            }
            $exerciseRows[] = $rows;
        }
        return $exerciseRows;
    } else {
        return [];
    }
    $conn->close();
}

function get_muscles($conn) {}

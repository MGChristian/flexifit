<?php

//Get the exercises from the database
function get_exercises($conn)
{
    $stmt = $conn->prepare("SELECT `ID`, `exerciseName`, `exercisePicUrl`, `description` FROM `exercise` WHERE `status` = '1'");
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if ($result->num_rows > 0) {
        $exerciseRows = [];
        while ($rows = $result->fetch_assoc()) {
            $exerciseRows[] = $rows;
        }
        return $exerciseRows;
    } else {
        return [];
    }
}

function get_search_exercise($conn, $exerciseName)
{
    $query = "%" . $exerciseName;
    $stmt = $conn->prepare("SELECT * FROM `exercise` WHERE `status` = '1' AND `exerciseName` = ?");
    $stmt->bind_param("s", $query);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $exercises = [];
        while ($rows = $result->fetch_assoc()) {
            $exercises[] = $rows;
        }
        return $exercises;
    } else {
        return [];
    }
}

function get_muscles($conn) {}

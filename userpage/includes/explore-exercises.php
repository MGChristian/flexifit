<?php

function get_exercises($conn)
{
    $stmt = $conn->prepare("SELECT `exerciseName`, `exercisePicUrl`, `description` FROM `exercise`");
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if ($result->num_rows > 0) {
        $exerciseRows = [];
        while ($rows = $result->fetch_assoc()) {
            $exerciseRows[] = $rows;
        }
        return $exerciseRows;
    }
}

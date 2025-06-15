<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    header("Content-type: application/json");

    require_once "./auth.php";

    $stmt = $conn->prepare("SELECT `ID`, `exerciseName` FROM `exercise` ORDER BY `exerciseName`");
    $stmt->execute();
    $result = $stmt->get_result();
    $exercises = [];
    if ($result->num_rows > 0) {
        while ($rows = $result->fetch_assoc()) {
            $exercises[] = array(
                "ID" => $rows['ID'],
                "exerciseName" => $rows['exerciseName']
            );
        }
    } else {
        $exercises[] = array(
            "ID" => 'Empty Exercises',
            "exerciseName" => ''
        );
    }

    echo (json_encode($exercises));
}

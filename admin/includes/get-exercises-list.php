<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    header("Content-type: application/json");
    require_once "../../includes/config.php";

    $stmt = $conn->prepare("SELECT `ID`, `exerciseName` FROM `exercise` ORDER BY `exerciseName`");
    $stmt->execute();
    $result = $stmt->get_result();
    $exercises = [];
    while ($rows = $result->fetch_assoc()) {
        $exercises[] = array(
            "ID" => $rows['ID'],
            "exerciseName" => $rows['exerciseName']
        );
    }
    echo (json_encode($exercises));
}

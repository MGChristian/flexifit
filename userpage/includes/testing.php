<?php
require_once "./config.php";

$exerciseId = 1;
$stmt = $conn->prepare("SELECT `equipment`.`ID` FROM `equipment` INNER JOIN `exercise_equipment`  ON `equipment`.`ID` = `exercise_equipment`.`equipmentID`  WHERE exerciseID = ?");
$stmt->bind_param("i", $exerciseId);
$stmt->execute();
$result = $stmt->get_result();
$equipments = [];
while ($row = $result->fetch_assoc()) {
    $equipments[] = $row;
}
$stmt->close();
return $equipments;



$stmt = $conn->prepare("SELECT * FROM `equipment`");
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
if ($result->num_rows > 0) {
    $equipmentsa = [];
    while ($rows = $result->fetch_assoc()) {
        $equipmentsa[] = $rows;
    }
    return $equipmentsa;
} else {
    return [];
}

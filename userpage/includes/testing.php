<?php
require_once "./config.php";

$stmt = $conn->prepare("SELECT * FROM `exercise`");
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
if ($result->num_rows > 0) {
    $muscles = [];
    // print_r($result->fetch_assoc());
    // echo "<br>";
    while ($rows = $result->fetch_assoc()) {
        $muscles[] = $rows;
    }
    echo "<pre>";
    print_r($muscles);
    echo "</pre>";
} else {
    return [];
}

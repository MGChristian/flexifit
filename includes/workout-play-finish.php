<?php
require_once("./config_session.inc.php");
require_once("./config.php");
header("content-type:application/json");

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit();
}

// Get JSON input
$data = json_decode(file_get_contents('php://input'), true);

// Validate input
if (!isset($data['workoutID']) || !isset($data['userID'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit();
}

$workoutID = (int)$data['workoutID'];
$userID = (int)$data['userID'];

try {
    // Record workout completion
    $stmt = $conn->prepare("INSERT INTO workout_history (userID, workoutID) VALUES (?, ?)");
    $stmt->bind_param("ii", $userID, $workoutID);
    $stmt->execute();

    // You might also want to update user stats or other metrics here

    echo json_encode(['success' => true, 'message' => 'Workout completed successfully']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}

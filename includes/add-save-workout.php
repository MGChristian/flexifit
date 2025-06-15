<?php
require_once "./auth.php";

header("Content-Type: application/json");

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit();
}

// Get JSON body
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['workoutID']) || !isset($data['userID'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit();
}

$workoutID = (int)$data['workoutID'];
$userID = (int)$data['userID'];

try {
    // Check if workout is already saved
    $check = $conn->prepare("SELECT ID FROM saved_workouts WHERE userID = ? AND workoutID = ?");
    $check->bind_param("ii", $userID, $workoutID);
    $check->execute();
    $result = $check->get_result();
    $existing = $result->fetch_assoc();
    $check->close();

    if ($existing) {
        // If saved, delete it (unsave)
        $delete = $conn->prepare("DELETE FROM saved_workouts WHERE userID = ? AND workoutID = ?");
        $delete->bind_param("ii", $userID, $workoutID);
        $delete->execute();
        $delete->close();

        echo json_encode(['success' => true, 'action' => 'unsaved', 'message' => 'Workout removed from saved list']);
    } else {
        // If not saved, insert it
        $insert = $conn->prepare("INSERT INTO saved_workouts (userID, workoutID) VALUES (?, ?)");
        $insert->bind_param("ii", $userID, $workoutID);
        $insert->execute();
        $insert->close();

        echo json_encode(['success' => true, 'action' => 'saved', 'message' => 'Workout saved successfully']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}

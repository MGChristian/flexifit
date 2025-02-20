<?php

session_start();
include_once "../includes/config.php";


// might be useful if it is deployed
// header("Access-Control-Allow-Origin: https://yourfrontend.com");
// header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
// header("Access-Control-Allow-Headers: Content-Type");

$data = json_decode(file_get_contents('php://input'), true);
$email = $data["email"];
emailIsDuplicate($email, $conn);

// Check if email is already in used
function emailIsDuplicate($email, $conn)
{
    $stmt = $conn->prepare("SELECT `email` FROM user WHERE `email` = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
    }
}

<?php
require_once "./config.php";

$username = "ChrisCross";

$stmt = $conn->prepare("SELECT * FROM `user` WHERE `username` = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
print_r($user['password']);

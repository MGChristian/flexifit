<?php

$host = "localhost";
$user = "root";
$pass = "";
$db_name = "flexifit";

date_default_timezone_set("Asia/Manila");

$conn = new mysqli($host, $user, $pass, $db_name);

if ($conn->connect_errno) {
    die("Failed to connect to db" . $conn->error);
}

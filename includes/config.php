<?php

$dbhostname = "localhost";
$dbusername = "root";
$dbpassword = "";
$database = "flexifit";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli($dbhostname, $dbusername, $dbpassword, $database);

if ($conn->errno) {
    exit("Database connection failed: " . $conn->error);
}

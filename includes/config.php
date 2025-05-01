<?php

// $dbhostname = "localhost:3306";
// $dbusername = "mgchristian_admin";

// $database = "mgchristian_flexifit";

$dbhostname = "localhost";
$dbusername = "root";
$dbpassword = "";
$database = "flexifit";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli($dbhostname, $dbusername, $dbpassword, $database);

if ($conn->errno) {
    exit("Database connection failed: " . $conn->error);
}

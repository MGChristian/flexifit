<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// $dbhostname = "localhost:3306";
// $dbusername = "mgchristian_admin";

// $database = "mgchristian_flexifit";

$dbhostname = $_ENV['DB_HOST'];
$dbusername = $_ENV['DB_USER'];
$dbpassword = $_ENV['DB_PASS'] ?? '';
$database = $_ENV['DB_NAME'];

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli($dbhostname, $dbusername, $dbpassword, $database);

if ($conn->errno) {
    exit("Database connection failed: " . $conn->error);
}

<?php

//Start session and initialize database
require_once(__DIR__ . "/config-session.inc.php");
require_once(__DIR__ . "/config.php");

//Get private and public keys
$privateKey = file_get_contents(__DIR__ . "/../keys/private.pem");
$publicKey = file_get_contents(__DIR__ . "/../keys/public.pem");

//Secret Key
$secretKey = $_ENV['SYMMETRIC_KEY'];

//Check if user is logged in
if (!isset($isLoggedIn)) {
    //isset($_SESSION['id]) returns true if it is set, if not it will return false. indicating the log in status of the user
    $isLoggedIn = isset($_SESSION['id']);
}

//Check if user data is not yet set while user is logged in. if it is not, get the data of the user and then store it in userData variable
if (!isset($userData) && $isLoggedIn) {
    $user_id = $_SESSION['id'];
    $stmt = $conn->prepare("SELECT * FROM `user` WHERE `ID` = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $userData = $result->fetch_assoc();
    }
}

function check_if_correct_role()
{
    if (isset($_SESSION['id']) && isset($_SESSION['role'])) {

        $user_role = $_SESSION['role'];
        switch ($user_role) {
            case "user":
                break;
            case "instructor":
                header("location:  ./instructor/");
                exit();
                break;
            case "admin":
                header("location:  ./admin/");
                exit();
                break;
        }
    } else {
        header("location: ./");
        exit();
    }
}

function create_secure_log($conn, $userID, $action)
{
    $message = json_encode([
        "userID" => $userID,
        "action" => $action,
        "timestamp" => date('c')
    ]);


    $privateKey = file_get_contents(__DIR__ . "/../../user_keys/{$userID}_private.pem");
    openssl_sign($message, $signature, $privateKey, OPENSSL_ALGO_SHA256);
    $encodedSignature = base64_encode($signature);

    $stmt = $conn->prepare("INSERT INTO `secure_logs` (`userID`, `action`, `signed_data`, `signature`) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $userID, $action, $message, $encodedSignature);
    $stmt->execute();
}


function verify_secure_log($signedData, $signature)
{
    $publicKey = file_get_contents(__DIR__ . "/keys/public.pem");
    $decodedSignature = base64_decode($signature);
    $verification = openssl_verify($signedData, $decodedSignature, $publicKey, OPENSSL_ALGO_SHA256);
    return $verification;
}

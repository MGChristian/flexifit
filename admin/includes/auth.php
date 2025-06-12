<?php

//Start session and initialize database
require_once("../includes/config_session.inc.php");
require_once("../includes/config.php");

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
    check_if_correct_role();
}


function check_if_correct_role()
{
    if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
        $user_role = $_SESSION['role'];
        switch ($user_role) {
            case "user":
                header("location: ../");
                exit();
                break;
            case "instructor":
                header("location:  ../instructor/");
                exit();
                break;
            case "admin":
                break;
        }
    } else {
        header("location: ../");
        exit();
    }
}

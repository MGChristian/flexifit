<?php

require_once "../userpage/includes/config_session.inc.php";

check_if_correct_role();
require_once("../userpage/includes/config.php");

function check_if_correct_role()
{
    if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
        $user_role = $_SESSION['role'];
        switch ($user_role) {
            case "user":
                header("location: ../userpage/");
                exit();
                break;
            case "instructor":
                header("location:  ../instructors/");
                exit();
                break;
            case "admin":
                break;
        }
    } else {
        header("location: ../userpage/");
        exit();
    }
}

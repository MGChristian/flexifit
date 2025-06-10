<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $exerciseName = isset($_POST['exerciseName']) ? $_POST['exerciseName'] : '';
    print_r($_POST);
    exit();
    if (empty($exerciseName)) {
        $_SESSION['query_error'] = "No search data";
        header("location: ../explore-exercises.php");
    }
}

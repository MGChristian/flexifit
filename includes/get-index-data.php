<?php
function get_total_workouts($conn, $userID)
{
    $stmt = $conn->prepare("SELECT COUNT(`ID`) AS `countID` FROM `workout_history` WHERE userID = ?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if ($result->num_rows > 0) {
        $rows = $result->fetch_assoc();
        return $rows['countID'];
    } else {
        return 0;
    }
}

function get_total_instructors($conn)
{
    $stmt = $conn->prepare("SELECT COUNT(`ID`) AS `countID` FROM `user` WHERE `role` = 'instructor'");
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if ($result->num_rows > 0) {
        $rows = $result->fetch_assoc();
        return $rows['countID'];
    } else {
        echo 0;
    }
}

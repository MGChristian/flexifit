<?php
function get_total_users($conn)
{
    $stmt = $conn->prepare("SELECT COUNT(`ID`) AS `countID` FROM `user` WHERE `role` = 'user'");
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

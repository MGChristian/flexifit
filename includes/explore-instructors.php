<?php

//Get the exercises from the database
function get_instructors($conn)
{
    $stmt = $conn->prepare("SELECT `user`.`ID`, `user`.`firstName`, `user`.`lastName`, `user`.`profilePicUrl`, `instructor_details`.`goal`, `instructor_details`.`personalDescription` FROM `user` INNER JOIN `instructor_details` ON `user`.`ID` = `instructor_details`.`userID` WHERE `user`.`status` = 'active' AND `user`.`role` = 'instructor'");
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if ($result->num_rows > 0) {
        $instructorRows = [];
        while ($rows = $result->fetch_assoc()) {
            $instructorRows[] = $rows;
        }
        return $instructorRows;
    } else {
        return '';
    }
}

<?php

//Get the exercises from the database

class Instructor
{
    private $id;
    private $instructorId;
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function initialize_id($instructorId)
    {
        $this->instructorId = $instructorId;
    }

    //GET ALL INSTRUCTORS
    public function get_instructors()
    {
        $stmt = $this->conn->prepare("SELECT `user`.`ID`, `user`.`firstName`, `user`.`lastName`, `user`.`profilePicUrl`, `instructor_details`.`goal`, `instructor_details`.`personalDescription` FROM `user` LEFT JOIN `instructor_details` ON `user`.`ID` = `instructor_details`.`userID` WHERE `user`.`status` = 'active' AND `user`.`role` = 'instructor'");
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
            return [];
        }
    }

    public function check_id()
    {
        $stmt = $this->conn->prepare("SELECT * FROM `user` WHERE ID = ?");
        $stmt->bind_param("i", $this->instructorId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_instructor_details()
    {
        $stmt = $this->conn->prepare("SELECT `user`.`ID`, `user`.`firstName`, `user`.`lastName`, `user`.`profilePicUrl`, `instructor_details`.`goal`, `instructor_details`.`personalDescription` FROM `user` LEFT JOIN `instructor_details` ON `user`.`ID` = `instructor_details`.`userID` WHERE `user`.`ID` = ? AND `user`.`status` = 'active' AND `user`.`role` = 'instructor'");
        $stmt->bind_param("i", $this->instructorId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return [];
        }
    }

    public function get_workouts()
    {
        $stmt = $this->conn->prepare("SELECT `workout`.`ID`, `workout`.`workoutName`, `workout`.`workoutPicUrl`, `workout`.`workoutDescription`, `workout`.`difficulty`, (SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(`duration`))) FROM `workout_exercises` WHERE `workout_exercises`.`workoutID` = `workout`.`ID`) AS `duration` FROM `workout` WHERE `workout`.`status` = '1' AND `workout`.`userID` = ? LIMIT 3");
        $stmt->bind_param("i", $this->instructorId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            $exerciseRows = [];
            while ($rows = $result->fetch_assoc()) {
                if (isset($rows['duration'])) {
                    $parts = explode(':', $rows['duration']);
                    $durationFormatted = $parts[0] . 'h ' . $parts[1] . 'm ' . $parts[2] . 's';
                    $rows['duration'] = $durationFormatted;
                } else {
                    $rows['duration'] = 'No duration';
                }
                $exerciseRows[] = $rows;
            }
            return $exerciseRows;
        } else {
            return [];
        }
    }
}

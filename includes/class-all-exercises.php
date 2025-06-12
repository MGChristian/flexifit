<?php

//Get all the exercises from the database

class AllExercise
{
    private $id;
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }


    // EXPLORE EXERCISES PAGE
    public function get_recent_exercises()
    {
        $stmt = $this->conn->prepare("SELECT `ID`, `exerciseName`, `exercisePicUrl`, `description` FROM `exercise` WHERE `status` = '1'");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function get_muscles()
    {
        $stmt = $this->conn->prepare("SELECT * FROM `muscle`");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function get_exercises_by_muscle()
    {
        $stmt = $this->conn->prepare("SELECT `exercise`.*, `muscle`.`ID` AS `muscleID`, `muscle`.`muscleName` FROM `exercise` WHERE ");
    }

    function get_search_exercise($exerciseName)
    {
        $searchTerm = "%" . strtolower($exerciseName) . "%";
        $stmt = $this->conn->prepare("SELECT `ID`, `exerciseName`, `exercisePicUrl`, `description` 
                           FROM `exercise` 
                           WHERE `status` = '1' 
                           AND `exerciseName` LIKE ?");
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();

        $exercises = [];
        while ($row = $result->fetch_assoc()) {
            $exercises[] = $row;
        }
        $stmt->close();
        return $exercises;
    }

    // ALL EXERCISES PAGE
    public function get_exercises($letter)
    {
        $stmt = $this->conn->prepare("SELECT * FROM `exercise` WHERE `exerciseName` LIKE ? AND `status` = '1'");
        $search_param = $letter . '%';
        $stmt->bind_param("s", $search_param);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
}

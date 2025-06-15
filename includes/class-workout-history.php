<?php

//Get all the workout history from the database

class History
{
    private $conn;
    private $userID;

    public function __construct($conn, $userID)
    {
        $this->conn = $conn;
        $this->userID = $userID;
    }

    public function get_all_workout_history()
    {
        $stmt = $this->conn->prepare("SELECT `workout_history`.*, `workout`.`workoutName` FROM `workout_history` INNER JOIN `workout` ON `workout_history`.`workoutID` = `workout`.`ID` WHERE `workout_history`.`userID` = ? ");
        $stmt->bind_param("i", $this->userID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function get_collection($collectionID) {}
}

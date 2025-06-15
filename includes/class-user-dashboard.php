<?php

//Get all the user dashboard details from the database

class UserDashboard
{
    private $conn;
    private $userID;

    public function __construct($conn, $userID)
    {
        $this->conn = $conn;
        $this->userID = $userID;
    }

    public function get_total_workouts()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(`ID`) AS `countID` FROM `workout_history` WHERE userID = ?");
        $stmt->bind_param("i", $this->userID);
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

    public function get_total_collections()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(`ID`) AS `countID` FROM `collection` WHERE `userID` = ?");
        $stmt->bind_param("i", $this->userID);
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

    public function get_total_saved_workouts()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(`ID`) AS `countID` FROM `saved_workouts` WHERE `userID` = ?");
        $stmt->bind_param("i", $this->userID);
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
}

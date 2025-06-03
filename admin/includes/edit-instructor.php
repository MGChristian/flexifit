<?php

//Get the workouts from the database

class Instructor
{
    private $id;
    private $instructorId;
    private $conn;

    public function __construct($conn, $instructorId)
    {
        $this->conn = $conn;
        $this->instructorId = $instructorId;
    }

    public function is_id_valid()
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

    public function get_instructor_user_details()
    {
        $stmt = $this->conn->prepare("SELECT `username`, `firstName`, `lastName`, `DOB`, `email`, `contactNo`, `gender`, `status` FROM `user` WHERE ID = ?");
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

    public function get_instructor_other_details()
    {
        $stmt = $this->conn->prepare("SELECT `goal`, `personalDescription` FROM `instructor_details` WHERE `userID` = ?");
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
}

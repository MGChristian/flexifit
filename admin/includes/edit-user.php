<?php

//Get the workouts from the database

class User
{
    private $id;
    private $userId;
    private $conn;

    public function __construct($conn, $userId)
    {
        $this->conn = $conn;
        $this->userId = $userId;
    }

    public function is_id_valid()
    {
        $stmt = $this->conn->prepare("SELECT * FROM `user` WHERE ID = ?");
        $stmt->bind_param("i", $this->userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_user_details()
    {
        $stmt = $this->conn->prepare("SELECT `username`, `firstName`, `lastName`, `DOB`, `email`, `contactNo`, `gender`, `status` FROM `user` WHERE ID = ?");
        $stmt->bind_param("i", $this->userId);
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

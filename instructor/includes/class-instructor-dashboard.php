<?php

class InstructorDashboard
{
    private $conn;
    private $userID;

    public function __construct($conn, $userID)
    {
        $this->conn = $conn;
        $this->userID = $userID;
    }

    public function get_total_users()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(ID) AS countID FROM user WHERE role = 'user'");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['countID'];
        } else {
            return 0;
        }
    }

    public function get_total_instructors()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(ID) AS countID FROM user WHERE role = 'instructor'");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['countID'];
        } else {
            return 0;
        }
    }

    public function get_total_exercises()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(ID) AS countID FROM exercise WHERE userID = ?");
        $stmt->bind_param("i", $this->userID);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['countID'];
        } else {
            return 0;
        }
    }

    public function get_total_workouts()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(ID) AS countID FROM workout WHERE userID = ?");
        $stmt->bind_param("i", $this->userID);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['countID'];
        } else {
            return 0;
        }
    }
}

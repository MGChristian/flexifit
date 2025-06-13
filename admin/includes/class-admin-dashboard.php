<?php

class AdminDashboard
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function get_total_users()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(ID) AS countID FROM user WHERE role = 'user'");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->num_rows > 0 ? $result->fetch_assoc()['countID'] : 0;
    }

    public function get_total_instructors()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(ID) AS countID FROM user WHERE role = 'instructor'");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->num_rows > 0 ? $result->fetch_assoc()['countID'] : 0;
    }

    public function get_total_exercises()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(ID) AS countID FROM exercise");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->num_rows > 0 ? $result->fetch_assoc()['countID'] : 0;
    }

    public function get_total_workouts()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(ID) AS countID FROM workout");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->num_rows > 0 ? $result->fetch_assoc()['countID'] : 0;
    }
}

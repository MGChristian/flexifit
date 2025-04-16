<?php

//Get the exercises from the database

class Exercise
{
    private $id;
    private $exerciseId;
    private $conn;

    public function __construct($conn, $exerciseId)
    {
        $this->conn = $conn;
        $this->exerciseId = $exerciseId;
    }

    public function check_id()
    {
        $stmt = $this->conn->prepare("SELECT * FROM `exercise` WHERE ID = ?");
        $stmt->bind_param("i", $this->exerciseId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_exercise()
    {
        $stmt = $this->conn->prepare("SELECT * FROM `exercise` WHERE ID = ?");
        $stmt->bind_param("i", $this->exerciseId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return [];
        }
    }

    public function get_equipments()
    {
        $stmt = $this->conn->prepare("SELECT * FROM `exercise` WHERE exerciseID = ?");
        $stmt->bind_param("i", $this->exerciseId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return [];
        }
    }

    public function get_muscles()
    {
        $stmt = $this->conn->prepare("SELECT * FROM `exercise` WHERE exerciseID = ?");
        $stmt->bind_param("i", $this->exerciseId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            $muscles = [];
            while ($rows = $result->fetch_assoc()) {
                $muscles[] = $rows;
            }
            return $muscles;
        } else {
            return [];
        }
    }

    public function get_test()
    {
        $stmt = $this->conn->prepare("SELECT * FROM `exercise`");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            $muscles = [];
            while ($rows = $result->fetch_assoc()) {
                $muscles[] = $rows;
            }
            return $muscles;
        } else {
            return [];
        }
    }

    public function get_categories()
    {
        $stmt = $this->conn->prepare("SELECT * FROM `exercise` WHERE exerciseID = ?");
        $stmt->bind_param("i", $this->exerciseId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            $categories = [];
            while ($rows = $result->fetch_assoc()) {
                $categories[] = $rows;
            }
            return $categories;
        } else {
            return [];
        }
    }

    public function get_exercise_steps()
    {
        $stmt = $this->conn->prepare("SELECT * FROM `exercise_steps` WHERE exerciseID = ?");
        $stmt->bind_param("i", $this->exerciseId);
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

function get_exercises($conn)
{
    $stmt = $conn->prepare("SELECT `ID`, `exerciseName`, `exercisePicUrl`, `description` FROM `exercise`");
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if ($result->num_rows > 0) {
        $exerciseRows = [];
        while ($rows = $result->fetch_assoc()) {
            $exerciseRows[] = $rows;
        }
        return $exerciseRows;
    } else {
        return '';
    }
}

function get_muscles($conn) {}

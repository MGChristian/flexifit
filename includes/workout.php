<?php

//Get the workouts from the database

class Workout
{
    private $id;
    private $workoutId;
    private $conn;

    public function __construct($conn, $workoutId)
    {
        $this->conn = $conn;
        $this->workoutId = $workoutId;
    }

    public function check_id()
    {
        $stmt = $this->conn->prepare("SELECT * FROM `workout` WHERE ID = ?");
        $stmt->bind_param("i", $this->workoutId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_workout()
    {
        $stmt = $this->conn->prepare("SELECT * FROM `workout` WHERE ID = ?");
        $stmt->bind_param("i", $this->workoutId);
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
        $stmt = $this->conn->prepare("SELECT `equipment`.`equipment_name`, `equipment`.`ID` FROM `equipment` INNER JOIN `workout_equipment`  ON `equipment`.`ID` = `workout_equipment`.`equipmentID`  WHERE workoutId = ?");
        $stmt->bind_param("i", $this->workoutId);
        $stmt->execute();
        $result = $stmt->get_result();
        $equipments = [];
        while ($row = $result->fetch_assoc()) {
            $equipments[] = $row;
        }
        $stmt->close();
        return $equipments;
    }

    public function get_muscles()
    {
        $stmt = $this->conn->prepare("SELECT `muscle`.`muscle_name`, `muscle`.`ID` FROM `muscle` INNER JOIN `workout_muscle`  ON `muscle`.`ID` = `workout_muscle`.`muscleID`  WHERE workoutId = ?");
        $stmt->bind_param("i", $this->workoutId);
        $stmt->execute();
        $result = $stmt->get_result();
        $muscles = [];
        while ($row = $result->fetch_assoc()) {
            $muscles[] = $row;
        }

        $stmt->close();
        return $muscles;
    }

    public function get_categories()
    {
        $stmt = $this->conn->prepare("SELECT `category`.`category_name`, `category`.`ID` FROM `category` INNER JOIN `workout_category`  ON `category`.`ID` = `workout_category`.`categoryID`  WHERE workoutId = ?");
        $stmt->bind_param("i", $this->workoutId);
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

    public function get_workout_steps()
    {
        $stmt = $this->conn->prepare("SELECT * FROM `workout_steps` WHERE workoutId = ?");
        $stmt->bind_param("i", $this->workoutId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $steps = [];
        while ($row = $result->fetch_assoc()) {
            $steps[] = $row;
        }
        return $steps;
    }
}

<?php

//Get the exercises from the database

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

    public function get_workout_sets()
    {
        $stmt = $this->conn->prepare("SELECT DISTINCT `workoutSet` FROM `workout_exercises` WHERE workoutId = ? ORDER BY `workoutSet`");
        $stmt->bind_param("i", $this->workoutId);
        $stmt->execute();
        $result = $stmt->get_result();
        $workoutSets = [];
        while ($row = $result->fetch_assoc()) {
            $workoutSets[] = $row;
        }
        $stmt->close();
        return $workoutSets;
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

    public function get_exercise($workoutSetNumber)
    {
        $stmt = $this->conn->prepare("SELECT `workout_exercises`.*, `exercise`.`exerciseName` FROM `workout_exercises` INNER JOIN `exercise` ON `workout_exercises`.`exerciseID` = `exercise`.`ID` WHERE `workout_exercises`.`workoutID` = ? AND `workout_exercises`.`workoutSet` = ?");
        $stmt->bind_param("ii", $this->workoutId, $workoutSetNumber);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function get_equipments()
    {
        $query = "
        SELECT DISTINCT `equipment`.`ID`,`equipment`.`equipment_name` 
        FROM `workout`
        JOIN `workout_exercises` ON `workout`.`ID` = `workout_exercises`.`workoutID`
        JOIN `exercise` ON `workout_exercises`.`exerciseID` = `exercise`.`ID`
        JOIN `exercise_equipment` ON `exercise`.`ID` = `exercise_equipment`.`exerciseID`
        JOIN `equipment` ON `exercise_equipment`.`equipmentID` = `equipment`.`ID`
        WHERE `workout`.`ID` = ?
        ORDER BY `equipment`.`equipment_name`;
        ";
        $stmt = $this->conn->prepare($query);
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
        $stmt = $this->conn->prepare("SELECT `muscle`.`muscle_name`, `muscle`.`ID` FROM `muscle` INNER JOIN `exercise_muscle`  ON `muscle`.`ID` = `exercise_muscle`.`muscleID`  WHERE exerciseID = ?");
        $stmt->bind_param("i", $this->exerciseId);
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
        $stmt = $this->conn->prepare("SELECT `category`.`category_name`, `category`.`ID` FROM `category` INNER JOIN `exercise_category`  ON `category`.`ID` = `exercise_category`.`categoryID`  WHERE exerciseID = ?");
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
        $steps = [];
        while ($row = $result->fetch_assoc()) {
            $steps[] = $row;
        }
        return $steps;
    }

    // WORKOUT PLAY METHODS

    public function get_exercise_count()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(`ID`) as `exerciseCount` FROM `workout_exercises` WHERE `workoutID` = ?");
        $stmt->bind_param("i", $this->workoutId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return '';
        }
    }
}

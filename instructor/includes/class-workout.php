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

    public function is_id_valid()
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

    public function get_unique_workout_sets()
    {
        $stmt = $this->conn->prepare("SELECT DISTINCT `workoutSet` FROM `workout_exercises` WHERE workoutID = ? ORDER BY `workoutSet`");
        $stmt->bind_param("i", $this->workoutId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $workoutSets = [];
        while ($row = $result->fetch_assoc()) {
            $workoutSets[] = $row;
        }
        return $workoutSets;
    }

    public function get_exercise_list($workoutSet)
    {
        $stmt = $this->conn->prepare("SELECT `workout_exercises`.*, `exercise`.`exerciseName` FROM `workout_exercises` INNER JOIN `exercise` ON `workout_exercises`.`exerciseID` = `exercise`.`ID` WHERE workoutID = ? AND `workoutSet` = ?");
        $stmt->bind_param("ii", $this->workoutId, $workoutSet);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $exerciseList = [];
        while ($row = $result->fetch_assoc()) {
            $exerciseList[] = $row;
        }
        return $exerciseList;
    }

    public function get_exercise_options($selected)
    {
        $stmt = $this->conn->prepare("SELECT * FROM `exercise` WHERE NOT `ID` = ? ORDER BY `exerciseName`");
        $stmt->bind_param("i", $selected);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $exerciseOptionList = [];
        while ($row = $result->fetch_assoc()) {
            $exerciseOptionList[] = $row;
        }
        return $exerciseOptionList;
    }
}

<?php

//Get the workouts from the database

class Workout
{
    private $id;
    private $workoutId;
    private $conn;
    private $secretKey;

    public function __construct($conn, $workoutId, $secretKey)
    {
        $this->conn = $conn;
        $this->workoutId = $workoutId;
        $this->secretKey = $secretKey;
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

    public function is_mac_valid()
    {
        $stmt = $this->conn->prepare("SELECT `userID`, `workoutName`, `workoutDescription`, `workoutPicUrl`, `difficulty`, `mac` FROM `workout` WHERE ID = ?");
        $stmt->bind_param("i", $this->workoutId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows === 0) {
            return false; // No such workout
        }

        $row = $result->fetch_assoc();

        $mac_data = $row['userID'] . $row['workoutName'] . $row['workoutDescription'] . $row['workoutPicUrl'] . $row['difficulty'];
        $expected_mac = hash_hmac('sha256', $mac_data, $this->secretKey);

        return hash_equals($expected_mac, $row['mac']);
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

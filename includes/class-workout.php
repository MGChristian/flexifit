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
        $query = "
    SELECT DISTINCT `muscle`.`ID`, `muscle`.`muscle_name` 
    FROM `workout`
    JOIN `workout_exercises` ON `workout`.`ID` = `workout_exercises`.`workoutID`
    JOIN `exercise` ON `workout_exercises`.`exerciseID` = `exercise`.`ID`
    JOIN `exercise_muscle` ON `exercise`.`ID` = `exercise_muscle`.`exerciseID`
    JOIN `muscle` ON `exercise_muscle`.`muscleID` = `muscle`.`ID`
    WHERE `workout`.`ID` = ?
    ORDER BY `muscle`.`muscle_name`;
    ";

        $stmt = $this->conn->prepare($query);
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
        $query = "
    SELECT DISTINCT `category`.`ID`, `category`.`category_name` 
    FROM `workout`
    JOIN `workout_exercises` ON `workout`.`ID` = `workout_exercises`.`workoutID`
    JOIN `exercise` ON `workout_exercises`.`exerciseID` = `exercise`.`ID`
    JOIN `exercise_category` ON `exercise`.`ID` = `exercise_category`.`exerciseID`
    JOIN `category` ON `exercise_category`.`categoryID` = `category`.`ID`
    WHERE `workout`.`ID` = ?
    ORDER BY `category`.`category_name`;
    ";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->workoutId);
        $stmt->execute();
        $result = $stmt->get_result();
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
        $stmt->close();
        return $categories;
    }

    public function get_workout_creator_info()
    {
        $query = "
    SELECT 
        CONCAT(`user`.`firstName`, ' ', `user`.`lastName`) AS creator_name,
        `user`.`role` AS creator_role
    FROM `user`
    INNER JOIN `workout` ON `user`.`ID` = `workout`.`userID`
    WHERE `workout`.`ID` = ?
    LIMIT 1;
    ";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->workoutId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $creatorInfo = $result->fetch_assoc();
            $stmt->close();
            return $creatorInfo;
        }

        $stmt->close();
        return [
            'creator_name' => 'Unknown Creator',
            'creator_role' => null
        ];
    }

    public function get_saved_status($userId)
    {
        $stmt = $this->conn->prepare("SELECT `ID` FROM `saved_workouts` WHERE `workoutID` = ? AND `userID` = ?");
        $stmt->bind_param("ii", $this->workoutId, $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_collections_list($userId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM `collection` WHERE `userID` = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
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

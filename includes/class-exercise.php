<?php

//Get the exercises from the database

class Exercise
{
    private $id;
    private $exerciseId;
    private $conn;
    private $secretKey;

    public function __construct($conn, $exerciseId, $secretKey)
    {
        $this->conn = $conn;
        $this->exerciseId = $exerciseId;
        $this->secretKey = $secretKey;
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
        $stmt = $this->conn->prepare("SELECT `equipment`.`equipment_name`, `equipment`.`ID` FROM `equipment` INNER JOIN `exercise_equipment`  ON `equipment`.`ID` = `exercise_equipment`.`equipmentID`  WHERE exerciseID = ?");
        $stmt->bind_param("i", $this->exerciseId);
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

    public function is_mac_valid()
    {
        $stmt = $this->conn->prepare("SELECT `userID`, `exerciseName`, `description`, `exercisePicUrl`, `mac` FROM `exercise` WHERE ID = ?");
        $stmt->bind_param("i", $this->exerciseId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows === 0) {
            return false; // Exercise doesn't exist
        }

        $row = $result->fetch_assoc();

        // Reconstruct the same data used during MAC generation
        $mac_data = $row['userID'] . $row['exerciseName'] . $row['description'] . $row['exercisePicUrl'];
        $expected_mac = hash_hmac('sha256', $mac_data, $this->secretKey);

        return hash_equals($expected_mac, $row['mac']);
    }
}

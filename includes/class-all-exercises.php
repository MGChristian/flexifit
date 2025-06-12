<?php

//Get all the exercises from the database

class AllExercise
{
    private $id;
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }


    // EXPLORE EXERCISES PAGE
    public function get_recent_exercises()
    {
        $stmt = $this->conn->prepare("SELECT `ID`, `exerciseName`, `exercisePicUrl`, `description` FROM `exercise` WHERE `status` = '1'");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    function get_search_exercise($exerciseName)
    {
        $searchTerm = "%" . strtolower($exerciseName) . "%";
        $stmt = $this->conn->prepare("SELECT `ID`, `exerciseName`, `exercisePicUrl`, `description` 
                           FROM `exercise` 
                           WHERE `status` = '1' 
                           AND `exerciseName` LIKE ?");
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();

        $exercises = [];
        while ($row = $result->fetch_assoc()) {
            $exercises[] = $row;
        }
        $stmt->close();
        return $exercises;
    }


    // ALL EXERCISES PAGE
    public function get_exercises($letter)
    {
        $stmt = $this->conn->prepare("SELECT * FROM `exercise` WHERE `exerciseName` LIKE ? AND `status` = '1'");
        $search_param = $letter . '%';
        $stmt->bind_param("s", $search_param);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }



    // MUSCLES
    public function get_muscles()
    {
        $stmt = $this->conn->prepare("SELECT * FROM `muscle`");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    // EQUIPMENTS
    public function get_equipments()
    {
        $stmt = $this->conn->prepare("SELECT * FROM `equipment`");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    // CATEGORIES
    public function get_categories()
    {
        $stmt = $this->conn->prepare("SELECT * FROM `category`");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }


    //SPECIFIC MUSCLE

    public function get_muscle($muscleID)
    {
        $stmt = $this->conn->prepare("SELECT * FROM `muscle` WHERE `ID` = ?");
        $stmt->bind_param("i", $muscleID);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    // EXERCISES BY MUSCLE
    public function get_exercises_by_muscle($muscleID)
    {
        $stmt = $this->conn->prepare("
        SELECT 
            exercise.ID AS exerciseID,
            exercise.exerciseName,
            exercise.exercisePicUrl,
            exercise.description AS exerciseDescription
        FROM 
            exercise
        INNER JOIN 
            exercise_muscle ON exercise.ID = exercise_muscle.exerciseID
        WHERE 
            exercise_muscle.muscleID = ? AND exercise.status = '1'
    ");
        $stmt->bind_param("i", $muscleID);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    // SPECIFIC EQUIPMENT
    public function get_equipment($equipmentID)
    {
        $stmt = $this->conn->prepare("SELECT * FROM `equipment` WHERE `ID` = ?");
        $stmt->bind_param("i", $equipmentID);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    // EXERCISES BY EQUIPMENT
    public function get_exercises_by_equipment($equipmentID)
    {
        $stmt = $this->conn->prepare("
        SELECT 
            exercise.ID AS exerciseID,
            exercise.exerciseName,
            exercise.exercisePicUrl,
            exercise.description AS exerciseDescription
        FROM 
            exercise
        INNER JOIN 
            exercise_equipment ON exercise.ID = exercise_equipment.exerciseID
        WHERE 
            exercise_equipment.equipmentID = ? AND exercise.status = '1'
    ");
        $stmt->bind_param("i", $equipmentID);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    // SPECIFIC CATEGORY
    public function get_category($categoryID)
    {
        $stmt = $this->conn->prepare("SELECT * FROM `category` WHERE `ID` = ?");
        $stmt->bind_param("i", $categoryID);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    // EXERCISES BY CATEGORY
    public function get_exercises_by_category($categoryID)
    {
        $stmt = $this->conn->prepare("
        SELECT 
            exercise.ID AS exerciseID,
            exercise.exerciseName,
            exercise.exercisePicUrl,
            exercise.description AS exerciseDescription
        FROM 
            exercise
        INNER JOIN 
            exercise_category ON exercise.ID = exercise_category.exerciseID
        WHERE 
            exercise_category.categoryID = ? AND exercise.status = '1'
    ");
        $stmt->bind_param("i", $categoryID);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function get_instructor($instructorID)
    {
        $stmt = $this->conn->prepare("SELECT firstName, lastName FROM user WHERE ID = ? AND role = 'instructor'");
        $stmt->bind_param("i", $instructorID);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }


    public function get_exercises_by_instructor($instructorID)
    {
        $stmt = $this->conn->prepare("
        SELECT 
            e.ID AS exerciseID,
            e.exerciseName,
            e.exercisePicUrl,
            e.description AS exerciseDescription
        FROM exercise e
        WHERE e.status = '1' AND e.userID = ?
    ");
        $stmt->bind_param("i", $instructorID);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
}

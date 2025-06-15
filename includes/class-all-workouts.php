<?php

//Get all the workouts from the database

class AllWorkout
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function get_workouts($letter)
    {
        $stmt = $this->conn->prepare("
            SELECT 
                w.*, 
                (
                    SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(we.duration))) 
                    FROM workout_exercises we 
                    WHERE we.workoutID = w.ID
                ) AS duration
            FROM workout w
            WHERE w.workoutName LIKE ? AND w.status = '1'
        ");

        $search_param = $letter . '%';
        $stmt->bind_param("s", $search_param);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $workouts = [];
        while ($row = $result->fetch_assoc()) {
            $row['duration'] = $this->format_duration($row['duration']);
            $workouts[] = $row;
        }

        return $workouts;
    }

    //Get the exercises from the database
    function get_recent_workouts()
    {
        $stmt = $this->conn->prepare("SELECT `workout`.`ID`, `workout`.`workoutName`, `workout`.`workoutPicUrl`, `workout`.`workoutDescription`, `workout`.`difficulty`, (SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(`duration`))) FROM `workout_exercises` WHERE `workout_exercises`.`workoutID` = `workout`.`ID`) AS `duration` FROM `workout` WHERE `status` = '1' LIMIT 10");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $workouts = [];
        while ($row = $result->fetch_assoc()) {
            $row['duration'] = $this->format_duration($row['duration']);
            $workouts[] = $row;
        }

        return $workouts;
    }

    function get_search_workouts($workoutName)
    {
        $searchTerm = "%" . strtolower($workoutName) . "%";
        $stmt = $this->conn->prepare("SELECT `workout`.`ID`, `workout`.`workoutName`, `workout`.`workoutPicUrl`, `workout`.`workoutDescription`, `workout`.`difficulty`,
        (SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(`duration`))) 
         FROM `workout_exercises` 
         WHERE `workout_exercises`.`workoutID` = `workout`.`ID`) AS `duration`
        FROM `workout` 
        WHERE `status` = '1' 
        AND LOWER(`workoutName`) LIKE ?");

        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $workouts = [];
        while ($row = $result->fetch_assoc()) {
            $row['duration'] = $this->format_duration($row['duration']);
            $workouts[] = $row;
        }

        return $workouts;
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

    public function get_workouts_by_muscle($muscleID)
    {
        $stmt = $this->conn->prepare("
        SELECT 
            `workout`.ID,
            `workout`.workoutName,
            `workout`.workoutPicUrl,
            `workout`.workoutDescription,
            `workout`.difficulty,
            (
                SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(workout_exercises.duration)))
                FROM workout_exercises
                WHERE workout_exercises.workoutID = `workout`.ID
            ) AS duration
        FROM `workout`
        INNER JOIN workout_exercises `workout_exercises` ON `workout`.ID = `workout_exercises`.workoutID
        INNER JOIN exercise ON `workout_exercises`.exerciseID = `exercise`.ID
        INNER JOIN exercise_muscle em ON `exercise`.ID = em.exerciseID
        WHERE em.muscleID = ? AND `workout`.status = '1'
        GROUP BY `workout`.ID
    ");

        $stmt->bind_param("i", $muscleID);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $workouts = [];
        while ($row = $result->fetch_assoc()) {
            $row['duration'] = $this->format_duration($row['duration']);
            $workouts[] = $row;
        }

        return $workouts;
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

    public function get_workouts_by_equipment($equipmentID)
    {
        $stmt = $this->conn->prepare("
        SELECT 
            w.ID,
            w.workoutName,
            w.workoutPicUrl,
            w.workoutDescription,
            w.difficulty,
            (
                SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(we.duration)))
                FROM workout_exercises we
                WHERE we.workoutID = w.ID
            ) AS duration
        FROM workout w
        INNER JOIN workout_exercises we ON w.ID = we.workoutID
        INNER JOIN exercise e ON we.exerciseID = e.ID
        INNER JOIN exercise_equipment ee ON e.ID = ee.exerciseID
        WHERE ee.equipmentID = ? AND w.status = '1'
        GROUP BY w.ID
    ");

        $stmt->bind_param("i", $equipmentID);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $workouts = [];
        while ($row = $result->fetch_assoc()) {
            $row['duration'] = $this->format_duration($row['duration']);
            $workouts[] = $row;
        }

        return $workouts;
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


    public function get_workouts_by_category($categoryID)
    {
        $stmt = $this->conn->prepare("
        SELECT 
            w.ID,
            w.workoutName,
            w.workoutPicUrl,
            w.workoutDescription,
            w.difficulty,
            (
                SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(we.duration)))
                FROM workout_exercises we
                WHERE we.workoutID = w.ID
            ) AS duration
        FROM workout w
        INNER JOIN workout_exercises we ON w.ID = we.workoutID
        INNER JOIN exercise e ON we.exerciseID = e.ID
        INNER JOIN exercise_category ec ON e.ID = ec.exerciseID
        WHERE ec.categoryID = ? AND w.status = '1'
        GROUP BY w.ID
    ");

        $stmt->bind_param("i", $categoryID);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $workouts = [];
        while ($row = $result->fetch_assoc()) {
            $row['duration'] = $this->format_duration($row['duration']);
            $workouts[] = $row;
        }

        return $workouts;
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


    public function get_workouts_by_instructor($instructorID)
    {
        $stmt = $this->conn->prepare("
        SELECT 
            w.ID,
            w.workoutName,
            w.workoutPicUrl,
            w.workoutDescription,
            w.difficulty,
            (
                SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(we.duration)))
                FROM workout_exercises we
                WHERE we.workoutID = w.ID
            ) AS duration
        FROM workout w
        WHERE w.userID = ? AND w.status = '1'
    ");

        $stmt->bind_param("i", $instructorID);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $workouts = [];
        while ($row = $result->fetch_assoc()) {
            $row['duration'] = $this->format_duration($row['duration']);
            $workouts[] = $row;
        }

        return $workouts;
    }


    private function format_duration($duration)
    {
        if (!$duration) return 'No duration';
        $parts = explode(':', $duration);
        $formatted = '';
        if ((int)$parts[0] > 0) $formatted .= (int)$parts[0] . 'h ';
        if ((int)$parts[1] > 0) $formatted .= (int)$parts[1] . 'm ';
        if ((int)$parts[2] > 0 || $formatted === '') $formatted .= (int)$parts[2] . 's';
        return trim($formatted);
    }
}

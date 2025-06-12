<?php
class Collection
{
    private $conn;
    private $userID;
    private $collectionID;

    public function __construct($conn, $userID)
    {
        $this->conn = $conn;
        $this->userID = $userID;
    }

    public function initialize_id($collectionID)
    {
        $this->collectionID = $collectionID;
    }

    public function get_all_collection()
    {
        $stmt = $this->conn->prepare("SELECT * FROM `collection` WHERE `userID` = ?");
        $stmt->bind_param("i", $this->userID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function check_id()
    {
        $stmt = $this->conn->prepare("SELECT * FROM `collection` WHERE ID = ?");
        $stmt->bind_param("i", $this->collectionID);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_collection()
    {
        $stmt = $this->conn->prepare("SELECT * FROM `collection` WHERE `ID` = ? AND `userID` = ?");
        $stmt->bind_param("ii", $this->collectionID, $this->userID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return [];
        }
    }

    public function get_collection_workouts()
    {
        $stmt = $this->conn->prepare("
        SELECT 
            collection_workouts.*,
            workout.ID,
            workout.workoutName,
            workout.workoutPicUrl,
            workout.workoutDescription,
            workout.difficulty,
            (
                SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(workout_exercises.duration))) 
                FROM workout_exercises 
                WHERE workout_exercises.workoutID = workout.ID
            ) AS duration
        FROM collection_workouts
        JOIN workout ON collection_workouts.workoutID = workout.ID
        WHERE collection_workouts.collectionID = ? AND workout.status = 1
    ");
        $stmt->bind_param("i", $this->collectionID);
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

<?php
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
                ) AS rawDuration
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
            // Format duration
            if ($row['rawDuration']) {
                list($h, $m, $s) = explode(':', $row['rawDuration']);
                $formatted = '';
                if ((int)$h > 0) $formatted .= (int)$h . 'h ';
                if ((int)$m > 0) $formatted .= (int)$m . 'm ';
                if ((int)$s > 0 || $formatted === '') $formatted .= (int)$s . 's';
                $row['duration'] = trim($formatted);
            } else {
                $row['duration'] = 'No duration';
            }

            $workouts[] = $row;
        }

        return $workouts;
    }
}

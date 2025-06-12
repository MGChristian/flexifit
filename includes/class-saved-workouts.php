<?php
class Saved
{
    private $conn;
    private $userID;

    public function __construct($conn, $userID)
    {
        $this->conn = $conn;
        $this->userID = $userID;
    }

    public function get_all_saved_workouts()
    {
        $stmt = $this->conn->prepare("SELECT `saved_workouts`.*, `workout`.`workoutName`, `workout`.`workoutDescription`, `workout`.`difficulty` FROM `saved_workouts` INNER JOIN `workout` ON `saved_workouts`.`workoutID` = `workout`.`ID`  WHERE `saved_workouts`.`userID` = ?");
        $stmt->bind_param("i", $this->userID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function get_collection($collectionID) {}
}

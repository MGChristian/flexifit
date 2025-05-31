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
}

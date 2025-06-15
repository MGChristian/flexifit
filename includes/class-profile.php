<?php

//Get all the user details from the database

class Profile
{
    private $conn;
    private $id;
    private $name;
    private $username;
    private $email;
    private $DOB;
    private $contactNo;
    private $profilePicUrl;

    public function __construct($conn, $id)
    {
        $this->conn = $conn;
        $this->id = $id;
    }

    public function check_user()
    {
        $stmt = $this->conn->prepare("SELECT `ID` FROM `user` WHERE ID = ?");
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_user_details()
    {
        $stmt = $this->conn->prepare("SELECT * FROM `user` WHERE ID = ?");
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row;
    }
}

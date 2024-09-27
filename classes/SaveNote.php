<?php
require_once 'DatabaseConnection.php';

class SaveNote
{
    private $conn;

    function __construct()
    {
        $obj = new DatabaseConnection();
        $this->conn = $obj->getConnection();
    }

    public function save($userid,$name,$description)
    {

        $stmt = $this->conn->prepare("INSERT INTO notes (userid, name, description) VALUES (:userid, :name, :description)");
        $stmt->bindParam(":userid", $userid);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->execute();
    }
}
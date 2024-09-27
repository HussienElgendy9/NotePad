<?php

require_once 'DatabaseConnection.php';

class GetNotes
{
    private $conn;

    function __construct()
    {
        $obj = new DatabaseConnection();
        $this->conn = $obj->getConnection();
    }

    public function display($userid)
    {

        $stmt = $this->conn->prepare("SELECT * FROM notes WHERE userid  = :userid");
        $stmt->bindParam(":userid", $userid);
        $stmt->execute();
        $notes = $stmt->fetchAll();
        // var_dump($notes);
        return $notes;
    }
}
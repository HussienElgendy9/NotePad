<?php

require_once 'DatabaseConnection.php';

class Delete{
    private $conn;

    function __construct()
    {
        $obj = new DatabaseConnection();
        $this->conn = $obj->getConnection();
    }
    public function deleteRecord($id){
        $sql = "DELETE FROM notes WHERE id = :id";
        $stmt=$this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->execute()) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record";
        }
    }
}
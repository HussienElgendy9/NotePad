<?php
require_once 'DatabaseConnection.php';

class Update
{
    private $conn;

    function __construct()
    {
        $obj = new DatabaseConnection();
        $this->conn = $obj->getConnection();
    }
    public function EditUser($id, $name,$description)
    {
        try{
            $stmt = $this->conn->prepare("UPDATE notes SET name = :name, description = :description  WHERE id= :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->execute();
            return $stmt->rowcount();
        }
        catch (PDOException $e) {
            echo "Error updating user: " . $e->getMessage();
            return false;
        }
    }
}
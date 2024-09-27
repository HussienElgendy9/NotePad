<?php
require_once 'DatabaseConnection.php';

class login
{
    private $conn;

    function __construct()
    {
        $obj = new DatabaseConnection();
        $this->conn = $obj->getConnection();
        $this->logging();
    }
    protected function emailExist($email)
    {//used chat gpt
        try {
            $stmt = $this->conn->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $count = $stmt->fetchColumn();

            return $count > 0;
        } catch (PDOException $e) {
            echo "Error" . $e->getMessage();
            return false;
        }
    }
    private function logging()
    {
        $email = filter_var($_POST["email"] ?? '', FILTER_SANITIZE_EMAIL);
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            session_start();
            $_SESSION["error_message"] = "Invalid email format."; // chat
            header("Location:../login.php"); 
            exit();
        }
        $passwords = $_POST["password"] ?? '';
        
        if ($this->emailExist($email)) {
            // $stmt = $this->conn->prepare("SELECT password FROM clients WHERE email = :email");
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $credentials = $stmt->fetch();
            if (password_verify($passwords, $credentials['password'])) {
                session_start();
                $_SESSION["success_message"] = "Login Successful";
                $_SESSION["id"] = $credentials['id'];
                $_SESSION["email"] = $credentials['email'];


                    header("Location:../home.php");
            } else {
                session_start();
                // print_r($credentials) ;
                $_SESSION["error_message"] = "Password is Incorrect!";
                header(header: "Location:../login.php");
            }
        } else {
            session_start();
            $_SESSION["error_message"] = "Email is incorrect";
            header("Location:../login.php");
            exit();
        }
    }
}
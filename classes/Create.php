<?php
require_once  'DatabaseConnection.php';
class Create
{
    private $conn;
    function __construct()
    {
        // $this->conn = DatabaseConnection::getConnection();
        $obj = new DatabaseConnection();
        $this->conn = $obj->getConnection();
        $this->user();
    }

    private function user()
    {
        try {
            $email = $this->check_email();
            $password = $this->check_pass();

            $stmt = $this->conn->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");

            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);

            if ($this->emailExist($email)) {
                session_start();
                $_SESSION['error_message'] = "Email already exists.";
                header('Location: ../index.php');
                exit();
            }

            $stmt->execute();
            session_start();
            $_SESSION['success_message'] = "New Record Created!";
            header('Location: ../index.php');
            exit();

        } catch (PDOException $e) {
            echo "Error" . $e->getMessage();
        }
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

    private function check_email()
    {
        if (isset($_POST["email"])) {
            $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return $email;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    private function check_pass()
    {
        if (isset($_POST["password"]) && isset($_POST["repassword"])) {
            $pass = trim($_POST["password"]);
            $repass = trim($_POST["repassword"]);
            if ($repass === $pass) {
                // return $pass;
                return password_hash($pass, PASSWORD_DEFAULT);
            }
        } else {
            return false;
        }
    }

}
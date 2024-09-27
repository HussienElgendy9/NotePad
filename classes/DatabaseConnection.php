<?php
class DatabaseConnection
{
  private $servername = "localhost";
  private $username = "root";
  private $password = "";
  private $dbname = "notepad";
  private static $conn = null;
  public function __construct()
  {
    try {
      // set the PDO error mode to exception
      self::$conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
      self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  public static function getConnection()
  {
    if (self::$conn === null) {
        new self();
    }
    return self::$conn;
  }
}
// class DatabaseConnection
// {
//   private $servername = "localhost";
//   private $username = "root";
//   private $password = "root";
//   private $dbname = "ecommerce";
//   private static $conn = null;
//   public function __construct()
//   {
//     try {
//       // set the PDO error mode to exception
//         self::$conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
//         self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         return $this->getConnection();
//     } catch (PDOException $e) {
//       echo "Error: " . $e->getMessage();
//     }
//   }

//   public static function getConnection()
//   {
//     if (self::$conn === null) {
//         new self();
//     }
//     return self::$conn;
//   }
// }

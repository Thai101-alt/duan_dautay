<?php 
$dbPath = dirname(dirname(dirname(__FILE__))) . '/Configs/database.php';
if (!file_exists($dbPath)) {
    die("Database config not found at: " . $dbPath);
}
require_once $dbPath;

class UserModel {
    private $conn;

    public function __construct() {
        $db = new database();
        $this->conn = $db->connect();
    }

    public function getUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function taoUser($googleId,$email,$name) {
        $sql = "INSERT INTO users (google_id, email, name) VALUES (:google_id, :email, :name)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':google_id', $googleId);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':name', $name);
        return $stmt->execute();
    }
}

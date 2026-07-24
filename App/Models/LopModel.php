<?php
$dbPath = dirname(dirname(dirname(__FILE__))) . '/Configs/database.php';
if (!file_exists($dbPath)) {
    die("Database config not found at: " . $dbPath);
}
require_once $dbPath;
class LopModels{
    private $conn;
    public function __construct() {
        $db = new database();
        $this->conn = $db->connect();
    }
    public function getAllLop(){
        $sql = "SELECT * FROM lop";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   public function themlop() {
        $sql = "INSERT INTO lop (ma_lop, ten_lop) VALUES (:ma_lop, :ten_lop)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ma_lop', $_POST['ma_lop']);
        $stmt->bindParam(':ten_lop', $_POST['ten_lop']);
        return $stmt->execute();
    }
    public function sualop() {
        $sql = "UPDATE lop SET ten_lop = :ten_lop WHERE ma_lop = :ma_lop";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ma_lop', $_POST['ma_lop']);
        $stmt->bindParam(':ten_lop', $_POST['ten_lop']);
        return $stmt->execute();
    }
    public function xoalop() {
        $sql = "DELETE FROM lop WHERE ma_lop = :ma_lop";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ma_lop', $_POST['ma_lop']);
        return $stmt->execute();
    }
}
?>

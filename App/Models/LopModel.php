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

    // Đếm tổng số lớp học (dùng cho Dashboard)
    public function demLop(){
        $sql = "SELECT COUNT(*) AS total FROM lop";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)($row['total'] ?? 0);
    }
   public function themlop() {
        $sql = "INSERT INTO lop (MA_LOP, TENLOP, description) VALUES (:ma_lop, :ten_lop, :description)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ma_lop', $_POST['ma_lop']);
        $stmt->bindParam(':ten_lop', $_POST['ten_lop']);
        $stmt->bindParam(':description', $_POST['description']);
        return $stmt->execute();
    }
    public function sualop() {
        $sql = "UPDATE lop SET TENLOP = :ten_lop, description = :description WHERE MA_LOP = :ma_lop";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ma_lop', $_POST['ma_lop']);
        $stmt->bindParam(':ten_lop', $_POST['ten_lop']);
        $stmt->bindParam(':description', $_POST['description']);
        return $stmt->execute();
    }
    public function xoalop() {
        $sql = "DELETE FROM lop WHERE MA_LOP = :ma_lop";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ma_lop', $_POST['ma_lop']);
        return $stmt->execute();
    }
}
?>
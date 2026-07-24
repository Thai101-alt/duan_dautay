<?php
$dbPath = dirname(dirname(dirname(__FILE__))) . '/Configs/database.php';
if (!file_exists($dbPath)) {
    die("Database config not found at: " . $dbPath);
}
require_once $dbPath;
class SinhVienModels{
    private $conn;
    public function __construct() {
        $db = new database();
        $this->conn = $db->connect();
    }
    public function getALLSinhVien(){
        $sql = "SELECT * FROM sinh_vien";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
     public function themsv() {
        $ma_sv = $_POST['ma_sv'] ?? null;
        $ho_ten = $_POST['ho_ten'] ?? null;
        $gioi_tinh = $_POST['gioi_tinh'] ?? null;
        $ngay_sinh = $_POST['ngay_sinh'] ?? null;
        $email = $_POST['email'] ?? null;
        $sdt = $_POST['SDT'] ?? null;

        if (!$ma_sv || !$ho_ten || !$gioi_tinh || !$ngay_sinh || !$email || !$sdt) {
            return false;
        }

        $sql = "INSERT INTO sinh_vien (MASV, HO_TEN, GIOI_TINH, NGAY_SINH, EMAIL, SDT) VALUES (:ma_sv, :ho_ten, :gioi_tinh, :ngay_sinh, :email, :SDT)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ma_sv', $ma_sv);
        $stmt->bindParam(':ho_ten', $ho_ten);
        $stmt->bindParam(':gioi_tinh', $gioi_tinh);
        $stmt->bindParam(':ngay_sinh', $ngay_sinh);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':SDT', $sdt);
        return $stmt->execute();
    }
    public function suasv($ma_sv, $ho_ten, $gioi_tinh, $ngay_sinh, $email, $SDT) {
        $sql = "UPDATE sinh_vien SET HO_TEN = :ho_ten, NGAY_SINH = :ngay_sinh, GIOI_TINH = :gioi_tinh, EMAIL = :email, SDT = :SDT WHERE MASV = :ma_sv";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ho_ten', $ho_ten);
        $stmt->bindParam(':ngay_sinh', $ngay_sinh);
        $stmt->bindParam(':gioi_tinh', $gioi_tinh);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':SDT', $SDT);
        $stmt->bindParam(':ma_sv', $ma_sv);
        return $stmt->execute();
    }
    public function xoasv($ma_sv) {
        $sql = "DELETE FROM sinh_vien WHERE MASV = :ma_sv";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ma_sv', $ma_sv);
        return $stmt->execute();
    }
}
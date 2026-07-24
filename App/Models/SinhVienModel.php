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

        $sql = "INSERT INTO sinh_vien (ma_sv, ho_ten, gioi_tinh, ngay_sinh, email, SDT) VALUES (:ma_sv, :ho_ten, :gioi_tinh, :ngay_sinh, :email, :sdt)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':MASV', $ma_sv);
        $stmt->bindParam(':HO_TEN', $ho_ten);
        $stmt->bindParam(':GIOI_TINH', $gioi_tinh);
        $stmt->bindParam(':NGAY_SINH', $ngay_sinh);
        $stmt->bindParam(':EMAIL', $email);
        $stmt->bindParam(':SDT', $sdt);
        return $stmt->execute();
    }
    public function suasv() {
        $sql = "UPDATE sinh_vien SET ten_sv = :ten_sv, ngay_sinh = :ngay_sinh, gioi_tinh = :gioi_tinh, dia_chi = :dia_chi, ma_lop = :ma_lop WHERE ma_sv = :ma_sv";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':MASV', $_POST['ma_sv']);
        $stmt->bindParam(':HO_TEN', $_POST['ho_ten']);
        $stmt->bindParam(':GIOI_TINH', $_POST['gioi_tinh']);
        $stmt->bindParam(':NGAY_SINH', $_POST['ngay_sinh']);
        $stmt->bindParam(':EMAIL', $_POST['email']);
        $stmt->bindParam(':SDT', $_POST['SDT']);
        return $stmt->execute();
    }
    public function xoasv() {
        $sql = "DELETE FROM sinh_vien WHERE ma_sv = :ma_sv";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':MASV', $_POST['ma_sv']);
        return $stmt->execute();
    }
}
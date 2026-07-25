<?php
$dbPath = dirname(dirname(dirname(__FILE__))) . '/Configs/database.php';
if (!file_exists($dbPath)) {
    die("Database config not found at: " . $dbPath);
}
require_once $dbPath;
class SinhVienModels
{
    private $conn;
    public function __construct()
    {
        $db = new database();
        $this->conn = $db->connect();
    }
    public function getALLSinhVien()
    {
        $sql = "SELECT sv.*,
                       GROUP_CONCAT(l.TENLOP SEPARATOR ', ') AS CLASSES,
                       GROUP_CONCAT(l.id_LOP SEPARATOR ',') AS CLASS_IDS
                FROM sinh_vien sv
                LEFT JOIN sinhvien_lop svl ON sv.id_SV = svl.id_SV
                LEFT JOIN lop l ON svl.id_LOP = l.id_LOP
                GROUP BY sv.id_SV";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Đếm tổng số sinh viên (dùng cho Dashboard)
    public function demSinhVien()
    {
        $sql = "SELECT COUNT(*) AS total FROM sinh_vien";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) ($row['total'] ?? 0);
    }
    public function themsv()
    {
        $ma_sv = $_POST['ma_sv'] ?? null;
        $ho_ten = $_POST['ho_ten'] ?? null;
        $gioi_tinh = $_POST['gioi_tinh'] ?? null;
        $ngay_sinh = $_POST['ngay_sinh'] ?? null;
        $email = $_POST['email'] ?? null;
        $sdt = $_POST['SDT'] ?? null;
        $lop_ids = $_POST['lop_ids'] ?? [];

        if (!$ma_sv || !$ho_ten || !$gioi_tinh || !$ngay_sinh || !$email || !$sdt) {
            return false;
        }

        try {
            $this->conn->beginTransaction();

            $sql = "INSERT INTO sinh_vien (MASV, HO_TEN, GIOI_TINH, NGAY_SINH, EMAIL, SDT) VALUES (:ma_sv, :ho_ten, :gioi_tinh, :ngay_sinh, :email, :SDT)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':ma_sv', $ma_sv);
            $stmt->bindParam(':ho_ten', $ho_ten);
            $stmt->bindParam(':gioi_tinh', $gioi_tinh);
            $stmt->bindParam(':ngay_sinh', $ngay_sinh);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':SDT', $sdt);
            $stmt->execute();

            $id_sv = $this->conn->lastInsertId();

            $this->ganLop($id_sv, $lop_ids);

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            die("LỖI SQL (themsv): " . $e->getMessage() . " | lop_ids nhận được: " . json_encode($lop_ids)); // TODO: xóa dòng này sau khi debug xong
        }
    }

    private function ganLop($id_sv, $lop_ids)
    {
        if (empty($lop_ids) || !is_array($lop_ids)) {
            return;
        }
        $sql = "INSERT INTO sinhvien_lop (id_SV, id_LOP) VALUES (:id_sv, :id_lop)";
        $stmt = $this->conn->prepare($sql);
        foreach ($lop_ids as $id_lop) {
            $stmt->execute([':id_sv' => $id_sv, ':id_lop' => $id_lop]);
        }
    }
    public function suasv($ma_sv, $ho_ten, $gioi_tinh, $ngay_sinh, $email, $SDT, $lop_ids = [])
    {
        try {
            $this->conn->beginTransaction();

            $sql = "UPDATE sinh_vien SET HO_TEN = :ho_ten, NGAY_SINH = :ngay_sinh, GIOI_TINH = :gioi_tinh, EMAIL = :email, SDT = :SDT WHERE MASV = :ma_sv";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':ho_ten', $ho_ten);
            $stmt->bindParam(':ngay_sinh', $ngay_sinh);
            $stmt->bindParam(':gioi_tinh', $gioi_tinh);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':SDT', $SDT);
            $stmt->bindParam(':ma_sv', $ma_sv);
            $stmt->execute();

            $id_sv = $this->layIdSVTheoMa($ma_sv);

            if ($id_sv) {
                $del = $this->conn->prepare("DELETE FROM sinhvien_lop WHERE id_SV = :id_sv");
                $del->bindParam(':id_sv', $id_sv);
                $del->execute();

                $this->ganLop($id_sv, $lop_ids);
            }

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    private function layIdSVTheoMa($ma_sv)
    {
        $stmt = $this->conn->prepare("SELECT id_SV FROM sinh_vien WHERE MASV = :ma_sv");
        $stmt->bindParam(':ma_sv', $ma_sv);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['id_SV'] ?? null;
    }

    public function xoasv($ma_sv)
    {
        try {
            $this->conn->beginTransaction();

            $id_sv = $this->layIdSVTheoMa($ma_sv);
            if ($id_sv) {
                $del = $this->conn->prepare("DELETE FROM sinhvien_lop WHERE id_SV = :id_sv");
                $del->bindParam(':id_sv', $id_sv);
                $del->execute();
            }

            $sql = "DELETE FROM sinh_vien WHERE MASV = :ma_sv";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':ma_sv', $ma_sv);
            $stmt->execute();

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }
}
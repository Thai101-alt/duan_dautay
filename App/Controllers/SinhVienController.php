<?php
require_once(__DIR__ . '/../Models/SinhVienModel.php');
require_once(__DIR__ . '/../Models/LopModel.php');
class SinhVienController
{
    private $sinhvien_model;
    private $lop_model;
    public function __construct()
    {
        $this->sinhvien_model = new SinhVienModels();
        $this->lop_model = new LopModels();
    }

    private function requireAuth()
    {
        if (empty($_SESSION['user'])) {
            header('Location: ./index.php?controller=AuthController&action=login');
            exit();
        }
    }

    public function index()
    {
        $this->requireAuth();
        $sinh_vien = $this->sinhvien_model->getALLSinhVien();
        $lop = $this->lop_model->getAllLop();
        require_once __DIR__ . '/../Views/SinhVien.php';
    }
    public function themsv()
    {
        $this->requireAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->sinhvien_model->themsv();
            if ($result) {
                header('Location: ./index.php?controller=SinhVienController&action=index');
                exit();
            } else {
                echo "Thêm sinh viên thất bại.";
            }
        }
    }
    public function suasv()
    {
        $this->requireAuth();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $this->sinhvien_model->suasv(
                $_POST['ma_sv'],
                $_POST['ho_ten'],
                $_POST['gioi_tinh'],
                $_POST['ngay_sinh'],
                $_POST['email'],
                $_POST['SDT'],
                $_POST['lop_ids'] ?? []
            );

            header("Location: index.php?controller=SinhVienController&action=index");
            exit;
        }
    }
    public function xoasv()
    {
        $this->requireAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->sinhvien_model->xoasv($_POST['ma_sv']);
            if ($result) {
                header('Location: ./index.php?controller=SinhVienController&action=index');
                exit();
            } else {
                echo "Xóa sinh viên thất bại.";
            }
        }
    }
}
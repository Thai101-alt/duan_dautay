<?php 
require_once(__DIR__ . '/../Models/SinhVienModel.php');
class SinhVienController{
    private $sinhvien_model;
    public function __construct() {
        $this->sinhvien_model = new SinhVienModels();
    }

    private function requireAuth() {
        if (empty($_SESSION['user'])) {
            header('Location: ./index.php?controller=AuthController&action=login');
            exit();
        }
    }

    public function index(){
        $this->requireAuth();
        $sinh_vien = $this->sinhvien_model->getALLSinhVien();
        require_once __DIR__ . '/../Views/SinhVien.php';
    }
    public function themsv() {
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
}
<?php
require_once(__DIR__ . '/../Models/LopModel.php');
class LopController
{
    private $lop_model;
    public function __construct() {
        $this->lop_model = new LopModels();
    }
    public function index()
    {
        $lop = $this->lop_model->getAllLop();
        require_once __DIR__ . '/../Views/Lop.php';
    }
    public function themlop()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->lop_model->themlop();
            if ($result) {
                header('Location: ./index.php?controller=LopController&action=index');
                exit();
            } else {
                echo "Thêm lớp thất bại.";
            }
        }
    }
    public function sualop()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->lop_model->sualop();
            if ($result) {
                header('Location: ./index.php?controller=LopController&action=index');
                exit();
            } else {
                echo "Sửa lớp thất bại.";
            }
        }
    }
    public function xoalop()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->lop_model->xoalop();
            if ($result) {
                header('Location: ./index.php?controller=LopController&action=index');
                exit();
            } else {
                echo "Xóa lớp thất bại.";
            }
        }
    }
}
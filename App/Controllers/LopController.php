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
}
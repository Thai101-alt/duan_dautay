<?php
class database
{
    private $host = "localhost";
    private $dbname = "quan_ly_sinh_vien";
    private $username = "root";
    private $password = "";
    private $port = 3306;

    public $con;
    public function connect()
    {
        $this->con = null;
        try {
            $this->con = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->username,
                $this->password
            );
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die("Kết nối thất bại: " . $e->getMessage());
        }
        return $this->con;
    }
}
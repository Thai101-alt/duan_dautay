<?php
$dbPath = dirname(dirname(dirname(__FILE__))) . '/Configs/database.php';
if (!file_exists($dbPath)) {
    die("Database config not found at: " . $dbPath);
}
require_once $dbPath;

class UserModel
{
    private $conn;

    public function __construct()
    {
        $db = new database();
        $this->conn = $db->connect();
    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function taoUser($googleId, $email, $name, $password = null, $role = 'student')
    {
        $sql = "INSERT INTO users (google_id, email, name, password, role) VALUES (:google_id, :email, :name, :password, :role)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':google_id', $googleId);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':name', $name);
        if ($password === null || $password === '') {
            $stmt->bindValue(':password', null, PDO::PARAM_NULL);
        } else {
            $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        }
        $stmt->bindParam(':role', $role);
        return $stmt->execute();
    }

    public function setPasswordByEmail($email, $passwordHash)
    {
        $sql = "UPDATE users SET password = :password WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':password', $passwordHash);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    public function setPasswordById($id, $passwordHash)
    {
        $sql = "UPDATE users SET password = :password WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':password', $passwordHash);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    public function login($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user || empty($user['password'])) {
            return false;
        }

        $storedPassword = $user['password'];
        if (password_verify($password, $storedPassword)) {
            return $user;
        }

        if ($storedPassword === $password || $storedPassword === md5($password)) {
            $newHash = password_hash($password, PASSWORD_DEFAULT);
            $this->setPasswordById($user['id'], $newHash);
            $user['password'] = $newHash;
            return $user;
        }

        return false;
    }
}
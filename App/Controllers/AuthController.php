<?php

class AuthController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            require_once __DIR__ . '/../Models/UserModel.php';
            $userModel = new UserModel();

            $user = $userModel->login($email, $password);

            if ($user) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'picture' => $user['picture'] ?? null,
                    'role' => $user['role'] ?? 'student'
                ];
                header("Location: index.php?controller=AuthController&action=dashboard");
                exit();
            } else {
                echo "<script>alert('Sai email hoặc mật khẩu');history.back();</script>";
            }
        } else {
            require "./App/Views/Login.php";
        }
    }
    public function dashboard()
    {
        require_once __DIR__ . '/../Models/SinhVienModel.php';
        require_once __DIR__ . '/../Models/LopModel.php';

        $sinhVienModel = new SinhVienModels();
        $lopModel = new LopModels();

        $tong_sv = $sinhVienModel->demSinhVien();
        $tong_lop = $lopModel->demLop();

        require "./App/Views/Dashboard.php";
    }
    public function logout()
    {
        session_destroy();
        header("Location: ./index.php?controller=AuthController&action=login");
        exit();
    }

    public function googleLogin()
    {
        require_once __DIR__ . '/../../Configs/google.php';

        $loginUrl = $client->createAuthUrl();

        header("Location: " . $loginUrl);
        exit();
    }
    public function setPassword()
    {
        if (!isset($_SESSION))
            session_start();
        require_once __DIR__ . '/../Models/UserModel.php';
        $userModel = new UserModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_SESSION['temp_user_email'] ?? ($_POST['email'] ?? null);
            $password = $_POST['password'] ?? null;
            $confirm = $_POST['confirm_password'] ?? null;

            if (!$email || !$password || $password !== $confirm) {
                echo "<script>alert('Mật khẩu không hợp lệ hoặc không khớp.');history.back();</script>";
                return;
            }

            $hash = password_hash($password, PASSWORD_DEFAULT);
            $userModel->setPasswordByEmail($email, $hash);

            $user = $userModel->getUserByEmail($email);
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'picture' => $_SESSION['temp_user_picture'] ?? null,
                'role' => $user['role'] ?? 'student'
            ];

            unset($_SESSION['temp_user_email'], $_SESSION['temp_user_name'], $_SESSION['temp_user_picture']);

            header("Location: index.php?controller=AuthController&action=dashboard");
            exit();
        }

        require "./App/Views/SetPassword.php";
    }

}
<?php
if (!isset($_SESSION)) session_start();
$email = $_SESSION['temp_user_email'] ?? '';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đặt mật khẩu</title>
    <link rel="stylesheet" href="Asset/css/style.css">
    <style> .container{max-width:420px;margin:40px auto;padding:20px;border:1px solid #ddd} label{display:block;margin-top:10px}</style>
</head>
<body>
    <div class="container">
        <h2>Hoàn tất đăng nhập</h2>
        <p>Tài khoản: <strong><?= htmlspecialchars($email) ?></strong></p>

        <form action="index.php?controller=AuthController&action=setPassword" method="POST">
            <label>Mật khẩu mới</label>
            <input type="password" name="password" required>

            <label>Xác nhận mật khẩu</label>
            <input type="password" name="confirm_password" required>

            <button type="submit">Lưu mật khẩu</button>
        </form>
    </div>
</body>
</html>

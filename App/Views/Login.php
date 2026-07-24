<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial;
        }

        body {
            background: #f3f4f6;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            width: 400px;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .login-box h1 {
            margin-bottom: 15px;
        }

        .google-btn {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 25px;
            background: #4285F4;
            color: white;
            border-radius: 8px;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="login-box">
        <h1>Quản lý sinh viên</h1>

        <p>Đăng nhập bằng tài khoản Google</p>

        <a href="?controller=AuthController&action=googleLogin" class="google-btn">
            Đăng nhập với Google
        </a>
    </div>

</body>

</html>
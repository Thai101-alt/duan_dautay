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
            box-shadow: 0 0 15px rgba(0,0,0,.1);
            text-align: center;
        }

        .login-box h1 {
            margin-bottom: 10px;
        }

        .login-box p {
            margin-bottom: 20px;
            color: #666;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }

        .login-btn:hover {
            background: #218838;
        }

        .divider {
            margin: 25px 0;
            color: #888;
            position: relative;
        }

        .divider::before,
        .divider::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background: #ddd;
        }

        .divider::before {
            left: 0;
        }

        .divider::after {
            right: 0;
        }

        .google-btn {
            display: block;
            width: 100%;
            padding: 12px;
            background: #4285F4;
            color: white;
            border-radius: 8px;
            text-decoration: none;
        }

        .google-btn:hover {
            background: #3367d6;
        }
    </style>
</head>

<body>

    <div class="login-box">
        <h1>Quản lý sinh viên</h1>

        <p>Đăng nhập hệ thống</p>

        <form action="?controller=AuthController&action=login" method="POST">

            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Mật khẩu" required>
            </div>

            <button type="submit" class="login-btn">
                Đăng nhập
            </button>

        </form>

        <div class="divider">HOẶC</div>

        <a href="?controller=AuthController&action=googleLogin" class="google-btn">
            Đăng nhập với Google
        </a>

    </div>

</body>

</html>
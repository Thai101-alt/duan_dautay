<?php
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <link rel="stylesheet" href="Asset/css/style.css">
</head>

<body>

    <div class="container">

        <aside class="sidebar">

            <div class="logo">
                <i class="fa-solid fa-graduation-cap"></i>
                <span>QL Sinh Viên</span>
            </div>

            <div class="user">
                <img src="https://i.pravatar.cc/80" alt="">
                <h3><?= htmlspecialchars($_SESSION['user']['name']) ?></h3>
                <p>Administrator</p>
            </div>

            <ul>

                <li class="active">
                    <a href="index.php?controller=AuthController&action=dashboard">
                        <i class="fa-solid fa-house"></i>
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="index.php?controller=SinhVienController&action=index">
                        <i class="fa-solid fa-user-graduate"></i>
                        Sinh viên
                    </a>
                </li>

                <li>
                    <a href="index.php?controller=LopController&action=index">
                        <i class="fa-solid fa-book"></i>
                        Lớp học
                    </a>
                </li>

                <li>
                    <a href="index.php?controller=AuthController&action=logout">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Đăng xuất
                    </a>
                </li>

            </ul>

        </aside>

        <main class="content">

            <div class="topbar">
                <h1>Dashboard</h1>

                <div class="date">
                    <i class="fa-solid fa-calendar-days"></i>
                    <?= date("d/m/Y") ?>
                </div>

            </div>

            <div class="cards">

                <div class="card blue">
                    <div>
                        <h2>120</h2>
                        <p>Sinh viên</p>
                    </div>

                    <i class="fa-solid fa-user-graduate"></i>
                </div>

                <div class="card green">
                    <div>
                        <h2>15</h2>
                        <p>Lớp học</p>
                    </div>

                    <i class="fa-solid fa-book-open"></i>
                </div>

                <div class="card orange">
                    <div>
                        <h2>25</h2>
                        <p>Giảng viên</p>
                    </div>

                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>

            </div>

            <div class="dashboard">

                <div class="box">
                    <h2>Thông báo</h2>

                    <ul>
                        <li>✔️ Hệ thống hoạt động bình thường.</li>
                        <li>✔️ Đã cập nhật danh sách sinh viên.</li>
                        <li>✔️ Có 3 lớp học mới.</li>
                        <li>✔️ Backup dữ liệu thành công.</li>
                    </ul>

                </div>

                <div class="box">
                    <h2>Hoạt động gần đây</h2>

                    <table>

                        <tr>
                            <th>Thời gian</th>
                            <th>Nội dung</th>
                        </tr>

                        <tr>
                            <td>08:30</td>
                            <td>Thêm sinh viên mới</td>
                        </tr>

                        <tr>
                            <td>09:10</td>
                            <td>Cập nhật lớp CNTT1</td>
                        </tr>

                        <tr>
                            <td>10:20</td>
                            <td>Đăng nhập hệ thống</td>
                        </tr>

                    </table>

                </div>

            </div>

        </main>

    </div>

</body>

</html>
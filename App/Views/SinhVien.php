<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý sinh viên</title>

    <link rel="stylesheet" href="Asset/css/style.css">
</head>

<body>
    <h1>Quản lý sinh viên</h1>

    <button id="btnThem">+ Thêm sinh viên</button>
    <table border="1">
        <thead>
            <tr>
                <th>Mã SV</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Giới tính</th>
                <th>Ngày sinh</th>
                <th>Số điện thoại</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($sinh_vien) && is_array($sinh_vien)) {
                if (count($sinh_vien) > 0) {
                    foreach ($sinh_vien as $sv) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($sv['ma_sv'] ?? '') . '</td>';
                        echo '<td>' . htmlspecialchars($sv['ho_ten'] ?? '') . '</td>';
                        echo '<td>' . htmlspecialchars($sv['email'] ?? '') . '</td>';
                        echo '<td>' . htmlspecialchars($sv['gioi_tinh'] ?? '') . '</td>';
                        echo '<td>' . htmlspecialchars($sv['ngay_sinh'] ?? '') . '</td>';
                        echo '<td>' . htmlspecialchars($sv['SDT'] ?? '') . '</td>';
                        echo '<td>';
                        echo '<button>Sửa</button>';
                        echo '<button>Xóa</button>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="7" style="text-align:center;">Không có dữ liệu</td></tr>';
                }
            } else {
                echo '<tr><td colspan="7" style="text-align:center;">Lỗi tải dữ liệu</td></tr>';
            }
            ?>
        </tbody>
    </table>
    <div id="modalThem" class="modal">
        <div class="modal-content">
        
            <span class="close">&times;</span>

            <h2>Thêm sinh viên</h2>

            <form action="index.php?controller=SinhVienController&action=themsv" method="POST">

                <label>Mã sinh viên</label>
                <input type="text" name="ma_sv" required>

                <label>Họ tên</label>
                <input type="text" name="ho_ten" required>

                <label>Giới tính</label>
                <input type="text" name="gioi_tinh" required>

                <label>Ngày sinh</label>
                <input type="date" name="ngay_sinh" required>

                <label>Email</label>
                <input type="email" name="email" required>

                <label>Số điện thoại</label>
                <input type="text" name="SDT" required>

                <button type="submit">Lưu</button>
                <button type="button" id="btnHuy">Hủy</button>
            </form>
        </div>
    </div>
    <script>
        const modal = document.getElementById("modalThem");
        const btnThem = document.getElementById("btnThem");
        const btnHuy = document.getElementById("btnHuy");
        const close = document.querySelector(".close");

        btnThem.onclick = function () {
            modal.style.display = "block";
        }

        close.onclick = function () {
            modal.style.display = "none";
        }

        btnHuy.onclick = function () {
            modal.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
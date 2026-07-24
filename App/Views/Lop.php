<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý lớp học</title>

    <link rel="stylesheet" href="Asset/css/style.css">
</head>

<body>
    <h1>Quản lý lớp học</h1>
    <a href="index.php?controller=AuthController&action=dashboard" class="btnDashboard">
        ← Quay lại Dashboard
    </a></br>

    <button id="btnThem">+ Thêm lớp</button>

    <table border="1">
        <thead>
            <tr>
                <th>Mã lớp</th>
                <th>Tên lớp</th>
                <th>Mô tả</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($lop) && is_array($lop)) {
                if (count($lop) > 0) {
                    foreach ($lop as $l) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($l['MA_LOP'] ?? '') . '</td>';
                        echo '<td>' . htmlspecialchars($l['TENLOP'] ?? '') . '</td>';
                        echo '<td>' . htmlspecialchars($l['description'] ?? '') . '</td>';
                        echo '<td>';
                        echo '<button type="button" class="btnSua" data-ma_lop="' . htmlspecialchars($l['MA_LOP'] ?? '') . '" data-ten_lop="' . htmlspecialchars($l['TENLOP'] ?? '') . '" data-description="' . htmlspecialchars($l['description'] ?? '') . '">Sửa</button>';
                        echo '<form class="deleteForm" action="index.php?controller=LopController&action=xoalop" method="POST" style="display:inline;margin-left:5px;">';
                        echo '<input type="hidden" name="ma_lop" value="' . htmlspecialchars($l['MA_LOP'] ?? '') . '">';
                        echo '<button type="submit">Xóa</button>';
                        echo '</form>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="4" style="text-align:center;">Không có dữ liệu</td></tr>';
                }
            } else {
                echo '<tr><td colspan="4" style="text-align:center;">Lỗi tải dữ liệu</td></tr>';
            }
            ?>
        </tbody>
    </table>

    <div id="modalThem" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close" style="cursor:pointer;">&times;</span>
            <h2>Thêm lớp</h2>
            <form action="index.php?controller=LopController&action=themlop" method="POST">
                <label>Mã lớp</label>
                <input type="text" name="ma_lop" required>

                <label>Tên lớp</label>
                <input type="text" name="ten_lop" required>
                <label>Description</label>
                <input type="text" name="description" required>
                <button type="submit">Lưu</button>
                <button type="button" id="btnHuyThem">Hủy</button>
            </form>
        </div>
    </div>

    <div id="modalSua" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="closeSua" style="cursor:pointer;">&times;</span>
            <h2>Sửa lớp</h2>
            <form action="index.php?controller=LopController&action=sualop" method="POST">
                <label>Mã lớp</label>
                <input type="text" name="ma_lop" id="sua_ma_lop" readonly>

                <label>Tên lớp</label>
                <input type="text" name="ten_lop" id="sua_ten_lop" required>

                <label>Description</label>
                <input type="text" name="description" id="sua_description" required>

                <button type="submit">Cập nhật</button>
                <button type="button" id="btnHuySua">Hủy</button>
            </form>
        </div>
    </div>

    <script>
        const modalThem = document.getElementById('modalThem');
        const btnThem = document.getElementById('btnThem');
        const btnHuyThem = document.getElementById('btnHuyThem');
        const closeThem = document.querySelector('#modalThem .close');

        const modalSua = document.getElementById('modalSua');
        const btnHuySua = document.getElementById('btnHuySua');
        const closeSua = document.querySelector('#modalSua .closeSua');

        btnThem.onclick = function () {
            modalThem.style.display = 'block';
        }

        closeThem.onclick = function () {
            modalThem.style.display = 'none';
        }

        btnHuyThem.onclick = function () {
            modalThem.style.display = 'none';
        }

        closeSua.onclick = function () {
            modalSua.style.display = 'none';
        }

        btnHuySua.onclick = function () {
            modalSua.style.display = 'none';
        }

        document.querySelectorAll('.btnSua').forEach(button => {
            button.addEventListener('click', function () {
                document.getElementById('sua_ma_lop').value = this.dataset.ma_lop;
                document.getElementById('sua_ten_lop').value = this.dataset.ten_lop;
                document.getElementById('sua_description').value = this.dataset.description;

                modalSua.style.display = 'block';
            });
        });

        document.querySelectorAll('.deleteForm').forEach(form => {
            form.addEventListener('submit', function (event) {
                if (!confirm('Bạn có chắc muốn xóa lớp này không?')) {
                    event.preventDefault();
                }
            });
        });

        window.onclick = function (event) {
            if (event.target == modalThem) {
                modalThem.style.display = 'none';
            }
            if (event.target == modalSua) {
                modalSua.style.display = 'none';
            }
        }
    </script>
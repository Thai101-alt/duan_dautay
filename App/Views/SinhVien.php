<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý sinh viên</title>

    <link rel="stylesheet" href="Asset/css/style.css">
</head>

<body>
    <h1>Quản lý sinh viên</h1>
    <a href="index.php?controller=AuthController&action=dashboard" class="btnDashboard">
        ← Quay lại Dashboard
    </a></br>
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
                <th>Lớp</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($sinh_vien) && is_array($sinh_vien)) {
                if (count($sinh_vien) > 0) {
                    foreach ($sinh_vien as $sv) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($sv['MASV'] ?? '') . '</td>';
                        echo '<td>' . htmlspecialchars($sv['HO_TEN'] ?? '') . '</td>';
                        echo '<td>' . htmlspecialchars($sv['EMAIL'] ?? '') . '</td>';
                        echo '<td>' . htmlspecialchars($sv['GIOI_TINH'] ?? '') . '</td>';
                        echo '<td>' . htmlspecialchars($sv['NGAY_SINH'] ?? '') . '</td>';
                        echo '<td>' . htmlspecialchars($sv['SDT'] ?? '') . '</td>';
                        echo '<td>' . htmlspecialchars($sv['CLASSES'] ?? '') . '</td>';
                        echo '<td>';
                        echo '<button type="button" class="btnSua"
                            data-ma_sv="' . htmlspecialchars($sv['MASV'] ?? '') . '"
                            data-ho_ten="' . htmlspecialchars($sv['HO_TEN'] ?? '') . '"
                            data-email="' . htmlspecialchars($sv['EMAIL'] ?? '') . '"
                            data-gioi_tinh="' . htmlspecialchars($sv['GIOI_TINH'] ?? '') . '"
                            data-ngay_sinh="' . htmlspecialchars($sv['NGAY_SINH'] ?? '') . '"
                            data-SDT="' . htmlspecialchars($sv['SDT'] ?? '') . '"
                            data-class_ids="' . htmlspecialchars($sv['CLASS_IDS'] ?? '') . '"
                            >Sửa</button>';
                        echo '<form method="POST" action="index.php?controller=SinhVienController&action=xoasv" style="display:inline;margin-left:5px;">';
                        echo '<input type="hidden" name="ma_sv" value="' . htmlspecialchars($sv['MASV'] ?? '') . '">';
                        echo '<button type="submit" onclick="return confirm(\'Bạn có chắc chắn muốn xóa sinh viên này?\')">Xóa</button>';
                        echo '</form>';
                        echo '</td>';
                        echo '</tr>';

                    }
                } else {
                    echo '<tr><td colspan="8" style="text-align:center;">Không có dữ liệu</td></tr>';
                }
            } else {
                echo '<tr><td colspan="8" style="text-align:center;">Lỗi tải dữ liệu</td></tr>';
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

                <label>Lớp</label>
                <select name="lop_ids[]" multiple size="4">
                    <?php if (isset($lop) && is_array($lop)): ?>
                        <?php foreach ($lop as $l): ?>
                            <option value="<?= htmlspecialchars($l['MA_LOP']) ?>"><?= htmlspecialchars($l['TENLOP']) ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                <button type="submit">Lưu</button>
                <button type="button" id="btnHuy">Hủy</button>
            </form>
        </div>
    </div>
    <div id="modalSua" class="modal">
        <div class="modal-content">
            <span class="closeSua">&times;</span>

            <h2>Sửa sinh viên</h2>

            <form action="index.php?controller=SinhVienController&action=suasv" method="POST">

                <label>Mã sinh viên</label>
                <input type="text" name="ma_sv" id="sua_ma_sv" readonly>

                <label>Họ tên</label>
                <input type="text" name="ho_ten" id="sua_ho_ten">

                <label>Giới tính</label>
                <input type="text" name="gioi_tinh" id="sua_gioi_tinh">

                <label>Ngày sinh</label>
                <input type="date" name="ngay_sinh" id="sua_ngay_sinh">

                <label>Email</label>
                <input type="email" name="email" id="sua_email">

                <label>Số điện thoại</label>
                <input type="text" name="SDT" id="sua_SDT">

                <label>Lớp</label>
                <select name="lop_ids[]" id="sua_lop_ids" multiple size="4">
                    <?php if (isset($lop) && is_array($lop)): ?>
                        <?php foreach ($lop as $l): ?>
                            <option value="<?= htmlspecialchars($l['MA_LOP']) ?>"><?= htmlspecialchars($l['TENLOP']) ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                <button type="submit">Cập nhật</button>
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

        const modalSua = document.getElementById("modalSua");

        document.querySelectorAll(".btnSua").forEach(button => {
            button.addEventListener("click", function () {

                document.getElementById("sua_ma_sv").value = this.dataset.ma_sv;
                document.getElementById("sua_ho_ten").value = this.dataset.ho_ten;
                document.getElementById("sua_email").value = this.dataset.email;
                document.getElementById("sua_gioi_tinh").value = this.dataset.gioi_tinh;
                document.getElementById("sua_ngay_sinh").value = this.dataset.ngay_sinh;
                document.getElementById("sua_SDT").value = this.dataset.SDT;

                const selectedClassIds = this.dataset.class_ids ? this.dataset.class_ids.split(",") : [];
                const classSelect = document.getElementById("sua_lop_ids");
                Array.from(classSelect.options).forEach(option => {
                    option.selected = selectedClassIds.includes(option.value);
                });

                modalSua.style.display = "block";
            });
        });

        document.querySelector(".closeSua").onclick = function () {
            modalSua.style.display = "none";
        }
    </script>
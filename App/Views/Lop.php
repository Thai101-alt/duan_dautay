<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý lớp học</title>

    <link rel="stylesheet" href="Asset/css/style.css">
</head>
<body>
<h1>Quản lý lớp học</h1>

<button>+ Thêm lớp</button>

<table border="1">
    <thead>
        <tr>
            <th>Mã lớp</th>
            <th>Tên lớp</th>
            <th>Số sinh viên</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($lop) && is_array($lop)) {
            if (count($lop) > 0) {
                foreach ($lop as $l) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($l['ma_lop'] ?? '') . '</td>';
                    echo '<td>' . htmlspecialchars($l['ten_lop'] ?? '') . '</td>';
                    echo '<td>' . htmlspecialchars($l['so_sinh_vien'] ?? '0') . '</td>';
                    echo '<td>';
                    echo '<button>Sửa</button>';
                    echo '<button>Xóa</button>';
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
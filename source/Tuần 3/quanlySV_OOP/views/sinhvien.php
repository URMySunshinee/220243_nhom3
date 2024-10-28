<?php
require_once '../db.php';
$stmt = $conn->query("SELECT * FROM sinhvien");
$sinhviens = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Sinh Viên</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Danh Sách Sinh Viên</h2>
    <div class="mb-3">
        <a href="form_sinhvien.php" class="btn btn-primary">Thêm Sinh Viên</a>
        <a href="lophoc.php" class="btn btn-primary">Xem Lớp Học</a>
    </div>
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Mã SV</th>
                <th>Họ Lót</th>
                <th>Tên</th>
                <th>Ngày Sinh</th>
                <th>Giới Tính</th>
                <th>Mã Lớp</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sinhviens as $sv): ?>
                <tr>
                    <td><?= htmlspecialchars($sv['maSV']) ?></td>
                    <td><?= htmlspecialchars($sv['hoLot']) ?></td>
                    <td><?= htmlspecialchars($sv['tenSV']) ?></td>
                    <td><?= htmlspecialchars($sv['ngaySinh']) ?></td>
                    <td><?= htmlspecialchars($sv['gioiTinh']) ?></td>
                    <td><?= htmlspecialchars($sv['maLop']) ?></td>
                    <td>
                        <a href="form_sinhvien.php?id=<?= htmlspecialchars($sv['maSV']) ?>" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="../controllers/delete_sinhvien.php?id=<?= htmlspecialchars($sv['maSV']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?');">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

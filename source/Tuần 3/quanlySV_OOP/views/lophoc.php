<?php
require_once '../db.php';
$stmt = $conn->query("SELECT * FROM lophoc");
$lophocs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Lớp Học</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Danh Sách Lớp Học</h2>
    <div class="mb-3">
        <a href="form_lophoc.php" class="btn btn-primary">Thêm Lớp Học</a>
        <a href="sinhvien.php" class="btn btn-primary">Xem Sinh Viên</a>
    </div>
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Mã Lớp</th>
                <th>Tên Lớp</th>
                <th>Năm Học</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lophocs as $lop): ?>
                <tr>
                    <td><?= htmlspecialchars($lop['maLop']) ?></td>
                    <td><?= htmlspecialchars($lop['tenLop']) ?></td>
                    <td><?= htmlspecialchars($lop['namHoc']) ?></td>
                    <td>
                        <a href="form_lophoc.php?id=<?= htmlspecialchars($lop['maLop']) ?>" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="../controllers/delete_lophoc.php?id=<?= htmlspecialchars($lop['maLop']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa lớp này?');">Xóa</a>
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

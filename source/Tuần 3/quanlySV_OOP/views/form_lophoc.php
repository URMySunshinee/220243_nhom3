<?php
require_once '../db.php';
require_once '../models/Classroom.php';
require_once '../controllers/Manager.php';

$classroomManager = new Manager(new Classroom());
$editing = isset($_GET['id']);  // Kiểm tra đang sửa hay thêm mới
$error = '';  // Biến lưu thông báo lỗi

// Lấy thông tin lớp học nếu đang chỉnh sửa
if ($editing) {
    $maLop = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM lophoc WHERE maLop = ?");
    $stmt->execute([$maLop]);
    $lophoc = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Xử lý form khi người dùng bấm nút Lưu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $maLop = $_POST['maLop'];
    $tenLop = $_POST['tenLop'];
    $namHoc = $_POST['namHoc'];

    // Kiểm tra mã lớp học trùng nếu đang thêm mới
    if (!$editing) {
        $stmt = $conn->prepare("SELECT COUNT(*) FROM lophoc WHERE maLop = ?");
        $stmt->execute([$maLop]);
        $exists = $stmt->fetchColumn();

        if ($exists) {
            $error = "Mã lớp học đã tồn tại. Vui lòng nhập mã khác!";
        }
    }

    // Nếu không có lỗi, thêm hoặc cập nhật dữ liệu
    if (empty($error)) {
        $data = [
            'maLop' => $maLop,
            'tenLop' => $tenLop,
            'namHoc' => $namHoc
        ];

        if ($editing) {
            $classroomManager->edit($maLop, $data);
        } else {
            $classroomManager->add($data);
        }

        header("Location: lophoc.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $editing ? 'Sửa Lớp Học' : 'Thêm Lớp Học' ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-size: cover;
            background-position: center;
            color: #333;
        }
        .form-container {
            background: rgba(255, 255, 255, 0.8); /* Nền trắng trong suốt */
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="form-container">
        <h2 class="text-center"><?= $editing ? 'Sửa Lớp Học' : 'Thêm Lớp Học' ?></h2>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="maLop">Mã Lớp:</label>
                    <input type="text" class="form-control" id="maLop" name="maLop" value="<?= htmlspecialchars($lophoc['maLop'] ?? '') ?>" <?= $editing ? 'readonly' : '' ?> required>
                </div>
                <div class="form-group col-md-4">
                    <label for="tenLop">Tên Lớp:</label>
                    <input type="text" class="form-control" id="tenLop" name="tenLop" value="<?= htmlspecialchars($lophoc['tenLop'] ?? '') ?>" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="namHoc">Năm Học:</label>
                    <input type="number" class="form-control" id="namHoc" name="namHoc" value="<?= htmlspecialchars($lophoc['namHoc'] ?? '') ?>" required>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="lophoc.php" class="btn btn-secondary">Quay lại</a>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

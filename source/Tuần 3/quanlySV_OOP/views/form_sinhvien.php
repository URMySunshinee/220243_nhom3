<?php
require_once '../db.php';
require_once '../models/Student.php';
require_once '../controllers/Manager.php';

$studentManager = new Manager(new Student());
$editing = isset($_GET['id']);  
$error = '';  

if ($editing) {
    $maSV = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM sinhvien WHERE maSV = ?");
    $stmt->execute([$maSV]);
    $sinhvien = $stmt->fetch(PDO::FETCH_ASSOC);
}

$stmt = $conn->query("SELECT * FROM lophoc");
$lophocs = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $maSV = $_POST['maSV'];
    $hoLot = $_POST['hoLot'];
    $tenSV = $_POST['tenSV'];
    $ngaySinh = $_POST['ngaySinh'];
    $gioiTinh = $_POST['gioiTinh'];
    $maLop = $_POST['maLop'];


    if (!$editing) {
        $stmt = $conn->prepare("SELECT COUNT(*) FROM sinhvien WHERE maSV = ?");
        $stmt->execute([$maSV]);
        $exists = $stmt->fetchColumn();

        if ($exists) {
            $error = "Mã sinh viên đã tồn tại. Vui lòng nhập mã khác!";
        }
    }

    // Nếu không có lỗi, thêm hoặc cập nhật dữ liệu
    if (empty($error)) {
        $data = [
            'maSV' => $maSV,
            'hoLot' => $hoLot,
            'tenSV' => $tenSV,
            'ngaySinh' => $ngaySinh,
            'gioiTinh' => $gioiTinh,
            'maLop' => $maLop
        ];

        if ($editing) {
            $studentManager->edit($maSV, $data);
        } else {
            $studentManager->add($data);
        }

        header("Location: sinhvien.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $editing ? 'Sửa Sinh Viên' : 'Thêm Sinh Viên' ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-size: cover;
            background-position: center;
            color: #333;
        }
        .form-container {
            background: rgba(255, 255, 255, 0.8); 
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="form-container">
        <h2 class="text-center"><?= $editing ? 'Sửa Sinh Viên' : 'Thêm Sinh Viên' ?></h2>
        
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="maSV">Mã SV:</label>
                    <input type="text" class="form-control" id="maSV" name="maSV" value="<?= htmlspecialchars($sinhvien['maSV'] ?? '') ?>" <?= $editing ? 'readonly' : 'required' ?> >
                </div>
                <div class="form-group col-md-4">
                    <label for="hoLot">Họ Lót:</label>
                    <input type="text" class="form-control" id="hoLot" name="hoLot" value="<?= htmlspecialchars($sinhvien['hoLot'] ?? '') ?>" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="tenSV">Tên:</label>
                    <input type="text" class="form-control" id="tenSV" name="tenSV" value="<?= htmlspecialchars($sinhvien['tenSV'] ?? '') ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="ngaySinh">Ngày Sinh:</label>
                    <input type="date" class="form-control" id="ngaySinh" name="ngaySinh" value="<?= htmlspecialchars($sinhvien['ngaySinh'] ?? '') ?>" required>
                </div>
                <div class="form-group col-md-4">
                    <label>Giới Tính:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gioiTinh" id="gioiTinhNam" value="Nam" <?= isset($sinhvien) && $sinhvien['gioiTinh'] === 'Nam' ? 'checked' : '' ?> >
                        <label class="form-check-label" for="gioiTinhNam">Nam</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gioiTinh" id="gioiTinhNu" value="Nu" <?= isset($sinhvien) && $sinhvien['gioiTinh'] === 'Nữ' ? 'checked' : '' ?> >
                        <label class="form-check-label" for="gioiTinhNu">Nữ</label>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="maLop">Mã Lớp:</label>
                    <?php if (!$editing): ?>
                        <select class="form-control" id="maLop" name="maLop" required>
                            <option value="">Chọn lớp</option>
                            <?php foreach ($lophocs as $lop): ?>
                                <option value="<?= $lop['maLop'] ?>" <?= isset($sinhvien) && $sinhvien['maLop'] === $lop['maLop'] ? 'selected' : '' ?> >
                                    <?= $lop['tenLop'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    <?php else: ?>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($sinhvien['maLop'] ?? '') ?>" readonly>
                    <?php endif; ?>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="sinhvien.php" class="btn btn-secondary">Quay lại</a>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

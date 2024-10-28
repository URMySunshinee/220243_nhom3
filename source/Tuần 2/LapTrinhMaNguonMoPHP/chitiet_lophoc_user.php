<?php
session_start(); // Bắt đầu session

// Kiểm tra nếu người dùng chưa đăng nhập
if (!isset($_SESSION['username'])) {
    // Nếu chưa đăng nhập, chuyển hướng về trang login
    header("Location: login.php");
    exit(); // Dừng script
}
if ($_SESSION['role'] !== 'user') {
    echo "Bạn không có quyền truy cập trang này.";
    exit();
}
?>

<?php
// Kết nối cơ sở dữ liệu
include_once("connect.php");

if (isset($_GET['maLop'])) {
    $maLop = $_GET['maLop'];

    // Truy vấn thông tin sinh viên thuộc lớp học
    $sql = "SELECT * FROM sinhvien WHERE maLop = '$maLop'";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sinh Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        .container {
            margin-top: 50px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        h2 {
            margin-bottom: 20px;
        }
        table {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">Danh sách sinh viên thuộc lớp: <strong><?php echo htmlspecialchars($maLop); ?></strong></h2>

    <?php if ($result->num_rows > 0): ?>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Mã SV</th>
                    <th>Họ Lót</th>
                    <th>Tên</th>
                    <th>Ngày Sinh</th>
                    <th>Giới Tính</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['maSV']); ?></td>
                        <td><?php echo htmlspecialchars($row['hoLot']); ?></td>
                        <td><?php echo htmlspecialchars($row['tenSV']); ?></td>
                        <td><?php echo htmlspecialchars($row['ngaySinh']); ?></td>
                        <td><?php echo htmlspecialchars($row['gioiTinh']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-warning" role="alert">Không có sinh viên nào trong lớp này.</div>
    <?php endif; ?>

    <a href="lophoc_user.php" class="btn btn-secondary mt-3">Trở về danh sách lớp học</a>
</div>

</body>
</html>

<?php
} else {
    echo "<div class='container mt-5'><div class='alert alert-danger' role='alert'>Không có mã lớp.</div></div>";
}
?>

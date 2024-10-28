<?php
session_start(); // Bắt đầu session

// Kiểm tra nếu người dùng chưa đăng nhập
if (!isset($_SESSION['username'])) {
    // Nếu chưa đăng nhập, chuyển hướng về trang login
    header("Location: login.php");
    exit(); // Dừng script
}
if ($_SESSION['role'] !== 'admin') {
  echo "Bạn không có quyền truy cập trang này.";
  exit();
}
?>

<?php
include_once("connect.php");

if (isset($_GET['maSV'])) {
    $maSV = $_GET['maSV'];

    // Truy vấn thông tin sinh viên dựa trên mã sinh viên
    $sql = "SELECT * FROM sinhvien WHERE maSV = '$maSV'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Không tìm thấy sinh viên với mã này.";
        exit();
    }
} else {
    echo "Không có mã sinh viên để chỉnh sửa.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sửa Thông Tin Sinh Viên</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <style>
    body {
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container {
      background: rgba(255, 255, 255, 0.5);
      padding: 50px;
      border-radius: 15px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      font-weight: bold;
      color: #333;
    }

    .btn-primary {
      background: #4e54c8;
      border: none;
      transition: background 0.3s ease;
    }

    .btn-primary:hover {
      background: #6c63ff;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>SỬA THÔNG TIN SINH VIÊN</h2>
  <form action="xuly_suasinhvien.php" method="post">
    <div class="form-group">
      <label for="masv">Mã sinh viên:</label>
      <input type="text" class="form-control" id="masv" value="<?php echo $row['maSV']; ?>" name="txtMaSV" readonly>
    </div>
    <div class="form-group">
      <label for="holot">Họ lót:</label>
      <input type="text" class="form-control" id="holot" value="<?php echo $row['hoLot']; ?>" name="txtHoLot" required>
    </div>
    <div class="form-group">
      <label for="tensv">Tên sinh viên:</label>
      <input type="text" class="form-control" id="tensv" value="<?php echo $row['tenSV']; ?>" name="txtTenSV" required>
    </div>
    <div class="form-group">
      <label for="ngaysinh">Ngày sinh:</label>
      <input type="date" class="form-control" id="ngaysinh" value="<?php echo $row['ngaySinh']; ?>" name="txtNgaySinh" required>
    </div>
    <div class="form-group">
      <label for="gioitinh">Giới tính:</label>
      <select class="form-control" id="gioitinh" name="txtGioiTinh" required>
        <option value="Nam" <?php if ($row['gioiTinh'] == 'Nam') echo 'selected'; ?>>Nam</option>
        <option value="Nữ" <?php if ($row['gioiTinh'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
      </select>
    </div>
    <div class="form-group">
      <label for="malop">Lớp học:</label>
      <select class="form-control" id="malop" name="txtMaLop" required>
        <?php
            $sql = "SELECT maLop, tenLop FROM lophoc";
            $result = $conn->query($sql);
            while ($lophoc = $result->fetch_assoc()) {
                $selected = ($lophoc['maLop'] == $row['maLop']) ? 'selected' : '';
                echo "<option value='".$lophoc['maLop']."' $selected>".$lophoc['maLop']." - ".$lophoc['tenLop']."</option>";
            }
        ?>
      </select>
    </div>

    <button type="submit" class="btn btn-primary btn-block">Lưu Thay Đổi</button>
    <a href="sinhvien.php" class="btn btn-secondary btn-block">Quay lại</a>
  </form>
</div>

</body>
</html>

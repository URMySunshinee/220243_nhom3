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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Thêm Sinh Viên</title>
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
  <h2>THÊM SINH VIÊN</h2>
  <form action="xuly_themsinhvien.php" method="post">
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="masv">Mã sinh viên:</label>
        <input type="text" class="form-control" id="masv" placeholder="Nhập mã sinh viên" name="txtMaSV" required>
      </div>
      <div class="form-group col-md-6">
        <label for="holot">Họ lót:</label>
        <input type="text" class="form-control" id="holot" placeholder="Nhập họ lót" name="txtHoLot" required>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="tensv">Tên sinh viên:</label>
        <input type="text" class="form-control" id="tensv" placeholder="Nhập tên sinh viên" name="txtTenSV" required>
      </div>
      <div class="form-group col-md-6">
        <label for="ngaysinh">Ngày sinh:</label>
        <input type="date" class="form-control" id="ngaysinh" name="txtNgaySinh" required max="2006-12-31">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="gioitinh">Giới tính:</label>
        <select class="form-control" id="gioitinh" name="txtGioiTinh" required>
          <option value="Nam">Nam</option>
          <option value="Nữ">Nữ</option>
        </select>
      </div>
      <div class="form-group col-md-6">
        <label for="malop">Lớp học:</label>
        <select class="form-control" id="malop" name="txtMaLop" required>
          <?php
              $sql = "SELECT maLop, tenLop FROM lophoc";
              $result = $conn->query($sql);
              while ($row = $result->fetch_assoc()) {
                  echo "<option value='".$row['maLop']."'>".$row['maLop']." - ".$row['tenLop']."</option>";
              }
          ?>
        </select>
      </div>
    </div>

    <button type="submit" class="btn btn-primary btn-block">Thêm</button>
    <a href="sinhvien.php" class="btn btn-secondary btn-block">Quay lại</a>
  </form>
</div>

</body>
</html>

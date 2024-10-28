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

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Thêm Lớp Học</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <style>
    /* Hiệu ứng sóng mượt */
    body {
      background: linear-gradient(45deg, #a8c0ff, #fbc2eb, #a8c0ff);
      background-size: 200% 200%;
      animation: waveBackground 6s ease infinite;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Arial', sans-serif;
    }
    
    /* Tạo hiệu ứng sóng */
    @keyframes waveBackground {
      0% {
        background-position: 0% 50%;
      }
      50% {
        background-position: 100% 50%;
      }
      100% {
        background-position: 0% 50%;
      }
    }

    .container {
      background: rgba(255, 255, 255, 0.5);
      padding: 90px;
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
  <h2>THÊM LỚP HỌC</h2>
  <form action="xuly_themlop.php" method="post">
    <div class="form-group">
      <label for="malop">Mã lớp:</label>
      <input type="text" class="form-control" id="malop" placeholder="Nhập mã lớp" name="txtMa" required>
    </div>
    <div class="form-group">
      <label for="tenlop">Tên lớp:</label>
      <input type="text" class="form-control" id="tenlop" placeholder="Nhập tên lớp" name="txtTen" required>
    </div>

    <button type="submit" class="btn btn-primary btn-block">Thêm mới</button>
    <a href="lophoc.php" class="btn btn-secondary btn-block">Hủy</a>
  </form>
</div>

</body>
</html>

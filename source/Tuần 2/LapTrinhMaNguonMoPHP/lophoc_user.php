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

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Quản Lý Thông Tin Lớp Học</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body {
      background-color: #f0f2f5;
      font-family: 'Arial', sans-serif;
    }

    .container {
      margin-top: 50px;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }

    .btn-primary {
      background-color: #4e54c8;
      border: none;
      transition: background 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #6c63ff;
    }

    .table-hover tbody tr:hover {
      background-color: #f1f3f8;
    }

    .table th, .table td {
      text-align: center;
      vertical-align: middle;
    }

    a {
      color: black; 
      text-decoration: none; 
      transition: color 0.2s; 
    }

    a:hover {
      color: #6c63ff; 
      text-decoration: none; 
    }

	.btn-action {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      width: 35px;
      height: 35px;
      padding: 0;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    .btn-action:hover {
      opacity: 0.8;
    }

    .btn:hover {
        transform: scale(1.05);
    }

    td {
      vertical-align: middle;
    }
  </style>
</head>
<body>
  
<div class="container">
  <h2>THÔNG TIN LỚP HỌC</h2>
  <a class="btn btn-primary mb-3 float-right" href="logout.php">Đăng Xuất</a>


  <?php
    include_once("connect.php");

    $sql = "SELECT * FROM lophoc";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo "<table class='table table-hover'>";
      echo "<thead class='thead-dark'><tr><th>Mã lớp</th><th>Tên lớp</th></tr></thead>";
      echo "<tbody>";
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><a href='chitiet_lophoc_user.php?maLop=" . $row['maLop'] . "'>" . $row['maLop'] . "</a></td>";
        echo "<td><a href='chitiet_lophoc_user.php?maLop=" . $row['maLop'] . "'>" . $row['tenLop'] . "</a></td>";
        echo "</tr>";
      }
      echo "</tbody></table>";
    } else {
      echo "<p>Không có lớp nào trong danh sách.</p>";
    }

    $conn->close();
  ?>

</div>

</body>
</html>

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

    //! Lấy mã lớp từ URL
    $ma = $_GET['ma'];
    $maLop = $tenLop = "";

    //todo Lấy thông tin lớp hiện tại từ database để hiển thị lên form
    if (!empty($ma)) {
        $sql = "SELECT * FROM lophoc WHERE maLop = '$ma'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $maLop = $row['maLop']; // Lấy mã lớp hiện tại
            $tenLop = $row['tenLop']; // Lấy tên lớp hiện tại
        } else {
            echo "Lớp không tồn tại!";
            exit;
        }
    }

    //todo Cập nhật thông tin lớp khi submit form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $maMoi = $_POST["txtMa"]; // Lấy mã lớp mới
        $tenMoi = $_POST["txtTen"]; // Lấy tên lớp mới

        //? Nếu mã lớp không thay đổi, chỉ cập nhật tên lớp
        if ($maMoi === $maLop) {
            $sql_update = "UPDATE lophoc SET tenLop = '$tenMoi' WHERE maLop = '$maLop'";
        } else {
            //? Nếu mã lớp thay đổi, kiểm tra xem mã lớp mới đã tồn tại chưa
            $sql_check = "SELECT * FROM lophoc WHERE maLop = '$maMoi'";
            $result_check = $conn->query($sql_check);

            if ($result_check->num_rows > 0) {
                //? Nếu mã lớp mới đã tồn tại, thông báo lỗi
                echo "Mã lớp mới đã tồn tại, vui lòng chọn mã khác.";
                exit;
            } else {
                //? Nếu mã lớp mới chưa tồn tại, cập nhật cả mã lớp và tên lớp
                $sql_update = "UPDATE lophoc SET maLop = '$maMoi', tenLop = '$tenMoi' WHERE maLop = '$maLop'";
            }
        }

        //todo Thực hiện cập nhật
        if ($conn->query($sql_update) === TRUE) {
            header("Location: lophoc.php");
            exit(); // Dừng script sau khi redirect
        } else {
            echo "Lỗi: " . $sql_update . "<br>" . $conn->error;
        }
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sửa thông tin lớp học</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Custom CSS -->
  <style>
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card {
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    h2 {
        color: #333;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="card p-4">
    <h2 class="text-center">Sửa thông tin lớp học</h2>
    <form action="" method="post">
      <div class="form-group">
        <label for="malop">Mã lớp:</label>
        <input type="text" class="form-control" id="malop" value="<?php echo $maLop; ?>" name="txtMa" required>
      </div>
      <div class="form-group">
        <label for="tenlop">Tên lớp:</label>
        <input type="text" class="form-control" id="tenlop" value="<?php echo $tenLop; ?>" name="txtTen" required>
      </div>

      <button type="submit" class="btn btn-primary btn-block">
        <i class="fas fa-save"></i> Cập nhật
      </button>
      <a href="lophoc.php" class="btn btn-secondary btn-block">Hủy</a>
    </form>
  </div>
</div>

</body>
</html>

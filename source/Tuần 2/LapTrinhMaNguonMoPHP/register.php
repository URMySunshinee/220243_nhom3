<?php
include_once("connect.php");
session_start(); // Bắt đầu phiên làm việc

// Kiểm tra và hiển thị thông báo nếu có

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Đăng Ký Tài Khoản</title>
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
    <h2>ĐĂNG KÝ TÀI KHOẢN</h2>

    <?php 
    if (isset($_SESSION['register_error'])) {
        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['register_error'] . '</div>';
        unset($_SESSION['register_error']); 
    }
    
    if (isset($_SESSION['register_success'])) {
        echo '<div class="alert alert-success" role="alert">' . $_SESSION['register_success'] . '</div>';
        unset($_SESSION['register_success']); 
    }
    ?>

    <form action="xuly_dangky.php" method="post">
        <div class="form-group">
            <label for="username">Tên đăng nhập:</label>
            <input type="text" class="form-control" id="username" placeholder="Nhập tên đăng nhập" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" class="form-control" id="password" placeholder="Nhập mật khẩu" name="password" required>
        </div>
        <div class="form-group">
            <label for="role">Vai trò:</label>
            <select class="form-control" id="role" name="role" required>
                <option value="admin">Giáo viên</option>
                <option value="user">Sinh viên</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Đăng Ký</button>
        <a href="login.php" class="btn btn-secondary btn-block">Đã có tài khoản? Đăng nhập</a>
    </form>
</div>

</body>
</html>

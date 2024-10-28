<?php
session_start(); // Bắt đầu phiên làm việc
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Trang Chủ</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.8);
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        h1 {
            margin-bottom: 30px;
            font-weight: bold;
            color: #333;
        }

        .btn {
            width: 200px;
            margin: 10px;
            transition: transform 0.2s;
        }

        .btn:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Chào Mừng Đến Với Hệ Thống</h1>
    <a href="login.php" class="btn btn-primary">Đăng Nhập</a>
    <a href="register.php" class="btn btn-secondary">Đăng Ký</a>
</div>

</body>
</html>

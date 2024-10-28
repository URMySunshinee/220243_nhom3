<?php
include_once("connect.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Truy vấn kiểm tra tài khoản
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Kiểm tra mật khẩu
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Chuyển hướng theo vai trò
            if ($user['role'] == 'admin') {
                header("Location: lophoc.php");
            } else {
                header("Location: lophoc_user.php"); // Trang chỉ xem
            }
            exit();
            } else {
            // Mật khẩu không đúng
              $_SESSION['error_message'] = "Sai mật khẩu!";
                header("Location: login.php");
             exit();
            }
    } else {
        // Tài khoản không tồn tại
        $_SESSION['error_message'] = "Tài khoản không tồn tại!";
        header("Location: login.php");
        exit();
    }
} else {
    // Nếu không phải là yêu cầu POST
    $_SESSION['error_message'] = "Vui lòng điền đầy đủ thông tin!";
    header("Location: login.php");
    exit();
}

$conn->close();
?>

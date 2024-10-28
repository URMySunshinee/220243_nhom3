<?php
include_once("connect.php");
session_start(); // Bắt đầu phiên làm việc

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Mã hóa mật khẩu
    $role = $_POST['role'];

    // Kiểm tra xem tài khoản đã tồn tại chưa
    $sql_check = "SELECT * FROM users WHERE username = '$username'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        // Thiết lập thông báo vào biến phiên và chuyển hướng về trang đăng ký
        $_SESSION['register_error'] = "Tài khoản đã tồn tại. Vui lòng chọn tên khác!";
        header("Location: register.php");
        exit(); // Dừng script
    } else {
        // Thêm tài khoản mới vào cơ sở dữ liệu
        $sql_insert = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
        if ($conn->query($sql_insert) === TRUE) {
            // Thiết lập thông báo thành công
            $_SESSION['register_success'] = "Đăng ký thành công! Vui lòng đăng nhập.";
            // Chuyển hướng đến trang login
            header("Location: login.php");
            exit(); // Dừng script
        } else {
            echo "Lỗi khi đăng ký: " . $conn->error;
        }
    }
} else {
    echo "Vui lòng điền đầy đủ thông tin!";
}

$conn->close();
?>

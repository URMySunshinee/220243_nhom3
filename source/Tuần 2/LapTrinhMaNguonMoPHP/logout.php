<?php
session_start();

// Xóa tất cả các biến phiên
$_SESSION = [];

// Hủy phiên
session_destroy();

// Chuyển hướng đến trang đăng nhập
header("Location: login.php");
exit();
?>

<?php
require_once '../models\Student.php';
require_once 'Manager.php';

$studentManager = new Manager(new Student());
$maSV = $_GET['id'];  // Lấy mã sinh viên từ URL

$studentManager->delete($maSV);  // Gọi hàm xóa

header("Location: ../views/sinhvien.php");  // Quay lại trang danh sách
exit;
?>

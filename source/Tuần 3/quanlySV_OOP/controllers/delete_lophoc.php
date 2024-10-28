<?php
require_once '../models\Classroom.php';
require_once '../controllers\Manager.php';

$classroomManager = new Manager(new Classroom());
$maLop = $_GET['id'];  // Lấy mã lớp học từ URL

$classroomManager->delete($maLop);  // Gọi hàm xóa

header("Location: ../views/lophoc.php");  // Quay lại trang danh sách
exit;
?>

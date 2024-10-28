<?php
include_once("connect.php");

if (isset($_GET['maSV'])) {
    $maSV = $_GET['maSV'];

    // Truy vấn để kiểm tra sinh viên có tồn tại không
    $sql_check = "SELECT * FROM sinhvien WHERE maSV = '$maSV'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        // Thực hiện truy vấn xóa
        $sql = "DELETE FROM sinhvien WHERE maSV = '$maSV'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Xóa sinh viên thành công!'); window.location='sinhvien.php';</script>";
        } else {
            echo "Lỗi khi xóa sinh viên: " . $conn->error;
        }
    } else {
        echo "Không tìm thấy sinh viên với mã này.";
    }
} else {
    echo "Không có mã sinh viên để xóa.";
}

$conn->close();
?>

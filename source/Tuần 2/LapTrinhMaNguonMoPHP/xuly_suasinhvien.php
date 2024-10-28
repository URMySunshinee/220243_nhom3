<?php
include_once("connect.php");

if (isset($_POST['txtMaSV']) && isset($_POST['txtHoLot']) && isset($_POST['txtTenSV']) && isset($_POST['txtNgaySinh']) && isset($_POST['txtGioiTinh']) && isset($_POST['txtMaLop'])) {
    $maSV = $_POST['txtMaSV'];
    $hoLot = $_POST['txtHoLot'];
    $tenSV = $_POST['txtTenSV'];
    $ngaySinh = $_POST['txtNgaySinh'];
    $gioiTinh = $_POST['txtGioiTinh'];
    $maLop = $_POST['txtMaLop'];

    $sql = "UPDATE sinhvien SET hoLot = '$hoLot', tenSV = '$tenSV', ngaySinh = '$ngaySinh', gioiTinh = '$gioiTinh', maLop = '$maLop' WHERE maSV = '$maSV'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Cập nhật thông tin sinh viên thành công!'); window.location='sinhvien.php';</script>";
    } else {
        echo "Lỗi khi cập nhật sinh viên: " . $conn->error;
    }
} else {
    echo "Thiếu dữ liệu để cập nhật sinh viên.";
}

$conn->close();
?>

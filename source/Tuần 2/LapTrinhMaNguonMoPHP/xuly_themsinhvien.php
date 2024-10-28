<?php
include_once("connect.php");

if (isset($_POST['txtMaSV']) && isset($_POST['txtHoLot']) && isset($_POST['txtTenSV']) && isset($_POST['txtNgaySinh']) && isset($_POST['txtGioiTinh']) && isset($_POST['txtMaLop'])) {
    $maSV = $_POST['txtMaSV'];
    $hoLot = $_POST['txtHoLot'];
    $tenSV = $_POST['txtTenSV'];
    $ngaySinh = $_POST['txtNgaySinh'];
    $gioiTinh = $_POST['txtGioiTinh'];
    $maLop = $_POST['txtMaLop'];

    $sql = "INSERT INTO sinhvien (maSV, hoLot, tenSV, ngaySinh, gioiTinh, maLop) VALUES ('$maSV', '$hoLot', '$tenSV', '$ngaySinh', '$gioiTinh', '$maLop')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Thêm sinh viên thành công!'); window.location='sinhvien.php';</script>";
    } else {
        echo "Lỗi khi thêm sinh viên: " . $conn->error;
    }
} else {
    echo "Thiếu dữ liệu để thêm sinh viên.";
}

$conn->close();
?>

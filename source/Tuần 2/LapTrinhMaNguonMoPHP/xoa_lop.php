<?php
    include_once("connect.php");

    //todo Lấy mã lớp từ URL
    $ma = $_GET['ma'];

    //todo Xóa lớp học khỏi database
    if (!empty($ma)) {
        $sql_delete = "DELETE FROM lophoc WHERE maLop = '$ma'";

        if ($conn->query($sql_delete) === TRUE) {
            header("Location: lophoc.php");
        } else {
            echo "Lỗi: " . $sql_delete . "<br>" . $conn->error;
        }
    } else {
        echo "Mã lớp không hợp lệ!";
    }

    $conn->close();
?>

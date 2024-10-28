<?php
    include_once("connect.php");

    //todo Lấy dữ liệu từ form
    $ma = $ten = "";
    if (!empty($_POST["txtMa"]) && !empty($_POST["txtTen"])) {
        $ma = $_POST["txtMa"];
        $ten = $_POST["txtTen"];

        //todo Kiểm tra xem mã lớp hoặc tên lớp đã tồn tại chưa
        $sql_check = "SELECT * FROM lophoc WHERE maLop = '$ma' OR tenLop = '$ten'";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows > 0) {
            //? Nếu mã lớp hoặc tên lớp đã tồn tại, thông báo lỗi
            echo "Mã lớp hoặc tên lớp đã tồn tại. Vui lòng chọn mã hoặc tên khác!";
        } else {
            //! Nếu chưa tồn tại, thêm mới vào database
            $sql_insert = "INSERT INTO lophoc (maLop, tenLop) VALUES ('$ma', '$ten')";
            if ($conn->query($sql_insert) === TRUE) {
                header("Location: lophoc.php");
            } else {
                echo "Lỗi: " . $sql_insert . "<br>" . $conn->error;
            }
        }
    } else {
        echo "Vui lòng nhập đầy đủ thông tin!";
    }

    //! Đóng kết nối
    $conn->close();
?>

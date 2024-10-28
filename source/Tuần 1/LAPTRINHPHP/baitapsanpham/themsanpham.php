<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Thêm Sản Phẩm</title>

    <style>
        /* Hiệu ứng nền sóng */
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(45deg, #a8c0ff, #fbc2eb, #a8c0ff);
            background-size: 200% 200%;
            animation: waveBackground 5s ease-in-out infinite;
        }

        @keyframes waveBackground {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        /* Chỉnh form cho đẹp */
        .card {
            background-color: rgba(255, 255, 255, 0.4); /* Form trong suốt nhẹ */
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
        }
    </style>

</head>

<body>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card w-50">
        <div class="card-header">
            <h2>Thêm Sản Phẩm</h2>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Tên Sản Phẩm</label>
                    <input type="text" name="ten_sp" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="">Ảnh Sản Phẩm</label><br>
                    <input type="file" name="image" >
                </div>
                
                <div class="form-group">
                    <label for="">Giá</label> 
                    <input type="number" name="gia_sp" class="form-control" step="500" min="500" required id="gia_sp_input">
                    <small id="error_message" style="color: red; display: none;">Giá trị không được nhỏ hơn 500. Vui lòng nhập lại.</small>
                </div>

                <script>
                const input = document.getElementById('gia_sp_input');
                const errorMessage = document.getElementById('error_message');

                    input.addEventListener('input', function () {
                        if (this.value < 500) {
                            errorMessage.style.display = 'block';  // Hiển thị thông báo lỗi
                        } else {
                            errorMessage.style.display = 'none';  // Ẩn thông báo nếu giá trị hợp lệ
                        }
                    });
                </script>

                <div class="form-group">
                    <label for="">Thương Hiệu</label>
                    <input type="text" name="hieu_sp" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="">Mô Tả</label>
                    <input type="text" name="mota_sp" class="form-control" required>
                </div>

                <button name="them_sp" class="btn btn-primary btn-block" type="submit"> Thêm </button> 
                <a name="quay_lai" class="btn btn-secondary btn-block" href="sanpham.php"> Quay lại </a>
            </form>
        </div>
    </div>
</div> 
</body>

<?php
    include './connect.php'; //kết nối với file liên kết sql

    if(isset($_POST['them_sp'])){
        $ten_sp = $_POST['ten_sp'];
        $gia_sp = $_POST['gia_sp'];
        $mota_sp = $_POST['mota_sp'];
        $hieu_sp = $_POST['hieu_sp'];

        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        // Chèn ảnh vào bảng image
        $sql_image = "INSERT INTO hinhanh (img_data) VALUES ('$image')";
        mysqli_query($connect, $sql_image);

        $image_id = mysqli_insert_id($connect);

        $sql_product = "INSERT INTO sanpham (ten_sp, gia_sp ,hieu_sp, mota_sp, id_img) 
                        VALUES ('$ten_sp', '$gia_sp', '$hieu_sp', '$mota_sp', '$image_id')";
        mysqli_query($connect , $sql_product);
        move_uploaded_file($image_tmp,'img/'.$image);
        //echo $sql_image;
        //echo $sql_product;
        header('location: sanpham.php' );
    }
?>

</html>
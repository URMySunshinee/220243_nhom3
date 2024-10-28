<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Sản Phẩm</title>

    <style>
        body {
            background: #e9eff1;
            color: #333;
            font-family: 'Roboto', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        h2 {
            margin-bottom: 30px;
            font-weight: bold;
            color: #2c3e50;
        }

        .table {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .table thead th {
            background-color: #3498db;
            color: #fff;
            font-weight: bold;
        }

        .table tbody tr {
            transition: background-color 0.3s;
        }

        .table tbody tr:hover {
            background-color: #f5f5f5;
        }

        .table img {
            border-radius: 8px;
            transition: transform 0.3s;
        }

        .table img:hover {
            transform: scale(1.1);
        }

        .price {
            color: #e74c3c;
            font-weight: bold;
        }
    </style>

</head>
<body>
    
    <div class="container mt-5">
        <h2 class="text-center">Danh Sách Sản Phẩm</h2>    
        <a class="btn btn-primary mb-3 float-right" href="themsanpham.php">Thêm sản phẩm</a>      
        <table class="table table-hover">
            <thead>
            <tr>
                <th>STT</th>
                <th>Tên Sản Phẩm</th>
                <th>Ảnh Sản Phẩm</th>
                <th>Giá</th>
                <th>Thương Hiệu</th>
                <th>Mô Tả</th>
            </tr>
            </thead>
            <tbody>
            <?php
            include './connect.php';

            $sql_products = "SELECT * FROM sanpham inner join hinhanh on sanpham.id_img = hinhanh.id_img";         
            $query_products = mysqli_query($connect,$sql_products);

                $i = 1;
                    while($row = mysqli_fetch_assoc($query_products)){ ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['ten_sp']; ?></td>

                        <td>
                            <img style ="width: 120px; height: auto;" src="img/<?php echo $row['img_data']; ?>">
                        </td>   
                        <td style="color:red"><?php echo number_format($row['gia_sp']),'',''.' VND' ;?></td>
                        <td><?php echo $row['hieu_sp']; ?></td>
                        
                        <td><?php echo $row['mota_sp']; ?></td>
                    </tr> 
                <?php  }?>
            </tbody>
        </table>
    </div>
</body>
</html>
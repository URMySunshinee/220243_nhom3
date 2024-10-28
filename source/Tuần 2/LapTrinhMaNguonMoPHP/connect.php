<?php
	//todo Kết nối cơ sở dữ liệu
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ql_sinhvien";

	//todo Tạo biến kết nối database
	$conn = new mysqli($servername, $username, $password, $dbname);
	//todo Kiểm tra kết nối
	if ($conn->connect_error) {
  		die("Connection failed: " . $conn->connect_error);
	}
?>
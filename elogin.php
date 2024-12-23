<?php 
session_start();
require_once ('process/dbh.php');
if (isset($_SESSION['id'])){
	$id=$_SESSION['id'];
	$sql = "SELECT * from `employee` WHERE id=$id";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) == 1){
		header("Location: eloginwel.php");
	}
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Đăng nhập | Hệ thống quản lý nhân viên</title>
	<!-- Bootstrap CSS -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lobster|Montserrat" rel="stylesheet">
	<style>
		body {
			background-color: #f8f9fa;
			/* Nền trang nhẹ nhàng */
		}

		header {
			background-color: #343a40;
			/* Màu nền cho header */
			padding: 20px 0;
			/* Padding cho header */
		}

		header h1 {
			color: white;
			/* Màu chữ trắng cho tiêu đề */
			text-align: center;
			/* Căn giữa tiêu đề */
			font-family: 'Lobster', cursive;
			/* Font chữ cho tiêu đề */
			font-size: 2.5rem;
			/* Kích thước chữ cho tiêu đề */
		}

		#navli {
			list-style-type: none;
			/* Xóa dấu chấm cho danh sách */
			padding: 0;
			/* Xóa padding */
		}

		#navli li {
			display: inline;
			/* Hiển thị danh sách ngang */
			margin: 0 15px;
			/* Khoảng cách giữa các mục */
		}

		#navli a {
			color: #fff;
			/* Màu chữ trắng cho liên kết */
			text-decoration: none;
			/* Xóa gạch chân */
		}

		#navli a:hover {
			color: #ffc107;
			/* Màu chữ vàng khi hover */
		}

		.loginbox {
			max-width: 400px;
			/* Chiều rộng tối đa cho hộp đăng nhập */
			margin: 100px auto;
			/* Căn giữa hộp đăng nhập */
			padding: 20px;
			/* Padding cho hộp đăng nhập */
			background-color: white;
			/* Nền trắng cho hộp đăng nhập */
			border-radius: 10px;
			/* Bo góc cho hộp đăng nhập */
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			/* Đổ bóng cho hộp đăng nhập */
		}

		.loginbox h1 {
			margin-bottom: 20px;
			/* Khoảng cách dưới cho tiêu đề */
			text-align: center;
			/* Căn giữa tiêu đề */
			font-size: 1.5rem;
			/* Kích thước chữ cho tiêu đề */
		}

		.loginbox p {
			margin-bottom: 5px;
			/* Khoảng cách dưới cho các nhãn */
		}

		.loginbox input[type="text"],
		.loginbox input[type="password"] {
			width: 100%;
			/* Chiều rộng 100% cho input */
			padding: 10px;
			/* Padding cho input */
			margin-bottom: 15px;
			/* Khoảng cách dưới cho input */
			border: 1px solid #ccc;
			/* Đường viền cho input */
			border-radius: 5px;
			/* Bo góc cho input */
		}

		.loginbox input[type="submit"] {
			width: 100%;
			/* Chiều rộng 100% cho nút submit */
			padding: 10px;
			/* Padding cho nút submit */
			background-color: #343a40;
			/* Màu nền cho nút submit */
			color: white;
			/* Màu chữ trắng cho nút submit */
			border: none;
			/* Không có đường viền cho nút submit */
			border-radius: 5px;
			/* Bo góc cho nút submit */
			font-size: 1rem;
			/* Kích thước chữ cho nút submit */
			cursor: pointer;
			/* Con trỏ khi hover */
		}

		.loginbox input[type="submit"]:hover {
			background-color: #495057;
			/* Màu nền khi hover */
		}
	</style>
</head>

<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark">
			<div class="container">
				<h1>HỆ THỐNG QUẢN LÝ NHÂN VIÊN</h1>
				<ul id="navli" class="navbar-nav">
					<li class="nav-item"><a class="nav-link" href="../bookstore/index.html">TRANG CHỦ</a></li>
					<li class="nav-item"><a class="nav-link" href="elogin.php">NHÂN VIÊN</a></li>
				</ul>
			</div>
		</nav>
	</header>
	<div class="divider"></div>
	<div class="loginbox">
		<img src="assets/user.png" class="avatar img-fluid mx-auto d-block" alt="Avatar">
		<h1>Nhân viên đăng nhập</h1>
		<form action="process/eprocess.php" method="POST">
			<p>Email</p>
			<input type="text" name="mailuid" placeholder="Nhập Email" required="required">
			<p>Mật khẩu</p>
			<input type="password" name="pwd" placeholder="Nhập mật khẩu" required="required">
			<input type="submit" name="login-submit" value="Login">
		</form>
	</div>

	<!-- Bootstrap JS (tuỳ chọn nếu cần) -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
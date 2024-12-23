<?php
session_start();
require_once ('process/dbh.php');
if (!isset($_SESSION['id'])){
	header('location:logout.php');
}else{
	//check quyen
    $id=$_SESSION['id'];
    $sql = "SELECT * from `alogin` WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) == 0){
        header("Location: logout.php");
    }
}

$sql = "SELECT employee.id,employee.firstName,employee.lastName,salary.base,salary.bonus,salary.total from employee,`salary` where employee.id=salary.id";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="vi">
<head>
	<title>Bảng lương | Hệ thống quản lý nhân viên</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<style>
        .sidebar {
            height: 100vh;
            background-color: #f8f9fa;
            padding: 15px;
        }
        .sidebar .nav-link {
            color: #495057;
        }
        .sidebar .nav-link.active-nav {
            background-color: #6c757d;
            color: white !important;
            border-radius: 5px;
        }
        .content {
            padding: 20px;
        }
        .header-nav {
            background-color: #6c757d;
        }
        .header-nav .nav-link {
            color: white;
        }
        .header-nav .nav-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

        <?php include('sidebar.php'); ?>
	<div class="container mt-5">
		<h2 class="text-center mb-4">Bảng lương nhân viên</h2>
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Tên</th>
					<th scope="col">Lương cơ bản</th>
					<th scope="col">Thưởng thêm</th>
					<th scope="col">Tổng</th>
				</tr>
			</thead>
			<tbody>
			<?php
				while ($employee = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$employee['id']."</td>";
					echo "<td>".$employee['lastName']." ".$employee['firstName']."</td>";
					echo "<td>".$employee['base']."</td>";
					echo "<td>".$employee['bonus']." %</td>";
					echo "<td>".$employee['total']."</td>";
					echo "</tr>";
				}
			?>
			</tbody>
		</table>
	</div>
			</div>
			</div>
	<!-- Thêm Bootstrap JS và jQuery -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

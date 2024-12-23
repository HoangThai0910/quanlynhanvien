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

$sql = "SELECT * from `project` order by subdate desc";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Trạng thái dự án | Admin Panel | Hệ thống quản lý nhân viên</title>
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
        <h2 class="text-center mb-4">Trạng thái dự án</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Task ID</th>
                    <th scope="col">Mã nhân viên</th>
                    <th scope="col">Tên dự án</th>
                    <th scope="col">Ngày đến hạn</th>
                    <th scope="col">Ngày nộp</th>
                    <th scope="col">Điểm</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Tùy chọn</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($employee = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$employee['pid']."</td>";
                    echo "<td>".$employee['eid']."</td>";
                    echo "<td>".$employee['pname']."</td>";
                    echo "<td>".$employee['duedate']."</td>";
                    echo "<td>".$employee['subdate']."</td>";
                    echo "<td>".$employee['mark']."</td>";
                    echo "<td>".$employee['status']."</td>";
                    echo "<td><a href='mark.php?id=".$employee['eid']."&pid=".$employee['pid']."' class='btn btn-primary btn-sm'>Đánh giá</a></td>";
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

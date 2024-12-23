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


?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Giao Dự Án | Bảng Quản Lý | Hệ thống quản lý nhân viên</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
        <div class="card">
            <div class="card-header" style="background-color:#6c757d; color: white;">
                <h2 class="mb-0">Giao Task</h2>
            </div>
            <div class="card-body">
                <form action="process/assignp.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="eid">Mã Nhân Viên</label>
                        <input type="text" class="form-control" id="eid" name="eid" placeholder="Nhập mã nhân viên" required>
                    </div>
                    <div class="form-group">
                        <label for="pname">Tên Task</label>
                        <input type="text" class="form-control" id="pname" name="pname" placeholder="Phân công nhiệm vụ" required>
                    </div>
                    <div class="form-group">
                        <label for="duedate">Ngày Kết Thúc</label>
                        <input type="date" class="form-control" id="duedate" name="duedate" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php
session_start();
require_once ('process/dbh.php');

if (!isset($_SESSION['id'])) {
    header('location:logout.php');
} else {
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM `alogin` WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {
        header("Location: logout.php");
    }
}

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Thêm nhân viên | Hệ thống quản lý nhân viên</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
            <h2 class="text-center">Thêm nhân viên</h2>
            <div class="card mt-3">
                <div class="card-body">
                    <form action="process/addempprocess.php" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input class="form-control" type="text" placeholder="Họ" name="lastName" required>
                            </div>
                            <div class="form-group col-md-6">
                                <input class="form-control" type="text" placeholder="Tên" name="firstName" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="email" placeholder="Email" name="email" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Ngày sinh</label>
                                <input class="form-control" type="date" name="birthday" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Giới tính</label>
                                <select name="gender" class="form-control" required>
                                    <option value="" disabled selected>Chọn giới tính</option>
                                    <option value="Male">Nam</option>
                                    <option value="Female">Nữ</option>
                                    <option value="Other">Khác</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Số điện thoại" name="contact" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Địa chỉ" name="address" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Phòng ban" name="dept" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Bằng cấp" name="degree" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="number" placeholder="Lương" name="salary">
                        </div>
                        <div class="form-group">
                            <label>Chọn file ảnh</label>
                            <input class="form-control-file" type="file" name="file">
                        </div>
                        <button type="submit" class="btn btn-success">Gửi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>

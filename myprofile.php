<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location:logout.php');
}
require_once('process/dbh.php');
$id = $_SESSION['id'];
$sql = "SELECT * from `employee` WHERE id=$id";
$sql2 = "SELECT total from `salary` WHERE id = $id";
$result = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql2);
$salary = mysqli_fetch_array($result2);
$empS = ($salary['total']);
if ($result) {
    while ($res = mysqli_fetch_assoc($result)) {
        $firstname = $res['firstName'];
        $lastname = $res['lastName'];
        $email = $res['email'];
        $contact = $res['contact'];
        $address = $res['address'];
        $gender = $res['gender'];
        $birthday = $res['birthday'];
        $dept = $res['dept'];
        $degree = $res['degree'];
        $pic = $res['pic'];
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hồ sơ | Hệ thống quản lý nhân viên</title>
    <!-- Bootstrap CSS -->
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
    <?php include('eheader.php'); ?>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">Thông tin cá nhân</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="myprofileup.php">
                    <div class="text-center mb-3">
                        <img src="process/<?php echo $pic; ?>" class="rounded-circle" alt="Profile Picture" height="150" width="150">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Họ</label>
                            <input class="form-control" type="text" name="lastName" value="<?php echo $lastname; ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tên</label>
                            <input class="form-control" type="text" name="firstName" value="<?php echo $firstname; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name="email" value="<?php echo $email; ?>" readonly>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Ngày sinh</label>
                            <input class="form-control" type="text" name="birthday" value="<?php echo $birthday; ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Giới tính</label>
                            <input class="form-control" type="text" name="gender" value="<?php echo $gender; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input class="form-control" type="number" name="contact" value="<?php echo $contact; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input class="form-control" type="text" name="address" value="<?php echo $address; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Phòng ban</label>
                        <input class="form-control" type="text" name="dept" value="<?php echo $dept; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Bằng cấp</label>
                        <input class="form-control" type="text" name="degree" value="<?php echo $degree; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Lương</label>
                        <input class="form-control" type="text" name="degree" value="<?php echo $empS; ?>" readonly>
                    </div>
                    <input type="hidden" name="id" id="textField" value="<?php echo $id; ?>" required="required">
                    <div class="text-center mt-4">
                        <button class="btn btn-primary" name="send">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

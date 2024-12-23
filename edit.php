<?php
session_start();
if (!isset($_SESSION['id'])){
    header('location:logout.php');
}
require_once ('process/dbh.php');

if(isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $dept = mysqli_real_escape_string($conn, $_POST['dept']);
    $degree = mysqli_real_escape_string($conn, $_POST['degree']);
    $base = mysqli_real_escape_string($conn,$_POST['salary_base']);

    $salary_update = "UPDATE `salary` SET `base`='$base' WHERE id=$id";
    // Xử lý upload ảnh
    $imagePath = "";
    if(isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] == 0) {
        $targetDir = "images/";
        $imagePath = $targetDir . basename($_FILES["profilePicture"]["name"]);
        move_uploaded_file($_FILES["profilePicture"]["tmp_name"],  "process/images/".basename($_FILES["profilePicture"]["name"]));
        // Cập nhật thông tin khác bao gồm cả ảnh
        $sql = "UPDATE `employee` SET `firstName`='$firstname', `lastName`='$lastname', `email`='$email', `birthday`='$birthday', `gender`='$gender', `contact`='$contact', `address`='$address', `dept`='$dept', `degree`='$degree', `pic`='$imagePath' WHERE id=$id";
    } else {
        // Cập nhật ảnh
        $sql = "UPDATE `employee` SET `firstName`='$firstname', `lastName`='$lastname', `email`='$email', `birthday`='$birthday', `gender`='$gender', `contact`='$contact', `address`='$address', `dept`='$dept', `degree`='$degree' WHERE id=$id";
    }
    if (mysqli_query($conn, $sql) && mysqli_query($conn,$salary_update)) {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Cập nhật thành công')
        window.location.href='viewemp.php';
        </SCRIPT>");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<?php
$id = (isset($_GET['id']) ? $_GET['id'] : '');
$sql = "SELECT * from `employee` WHERE id=$id";
$result = mysqli_query($conn, $sql);
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
    }
}
$salary_sql = "SELECT * FROM `salary` WHERE id=$id";
$result2 = mysqli_query($conn,$salary_sql);
if ($result2){
    while ($res2 = mysqli_fetch_assoc($result2)) {
        $salary_base = $res2['base'];
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Quản lý | Hệ thống quản lý nhân viên</title>
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
    <div class="container mt-5">
        <h2 class="text-center">Thông tin</h2>
        <div class="card mt-3">
            <div class="card-body">
                <form action="edit.php" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Họ</label>
                            <input class="form-control" type="text" value="<?php echo $lastname;?>" name="lastName" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tên</label>
                            <input class="form-control" type="text" value="<?php echo $firstname;?>" name="firstName" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" value="<?php echo $email;?>" name="email" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Ngày sinh</label>
                            <input class="form-control" type="date" value="<?php echo $birthday;?>" name="birthday" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Giới tính</label>
                            <select name="gender" class="form-control" required>
                                <option value="<?php echo $gender ?>"><?php echo $gender ?></option>
                                <option value="Male">Nam</option>
                                <option value="Female">Nữ</option>
                                <option value="Other">Khác</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input class="form-control" type="text" value="<?php echo $contact;?>" name="contact" required>
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input class="form-control" type="text" value="<?php echo $address;?>" name="address" required>
                    </div>
                    <div class="form-group">
                        <label>Phòng ban</label>
                        <input class="form-control" type="text" value="<?php echo $dept;?>" name="dept" required>
                    </div>
                    <div class="form-group">
                        <label>Bằng cấp</label>
                        <input class="form-control" type="text" value="<?php echo $degree;?>" name="degree" required>
                    </div>
                    <div class="form-group">
                        <label for="profilePicture">Ảnh đại diện</label>
                        <input type="file" class="form-control-file" id="profilePicture" name="profilePicture">
                    </div>
                    <div class="form-group">
                        <label>Lương cơ bản</label>
                        <input class="form-control" type="number" value="<?php echo $salary_base;?>" name="salary_base" required>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit" name="update" class="btn btn-success">Gửi</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>

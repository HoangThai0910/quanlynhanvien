<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location:logout.php');
}
require_once('process/dbh.php');
if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    
    $result = mysqli_query($conn, "UPDATE `employee` SET `email`='$email',`contact`='$contact',`address`='$address' WHERE id=$id");
    echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Successfully Updated')
        window.location.href='myprofile.php?id=$id';
        </SCRIPT>");
}

$id = $_SESSION['id'];
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
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cập nhật hồ sơ | Hệ thống quản lý nhân viên</title>
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
                <h2 class="mb-0">Cập nhật thông tin</h2>
            </div>
            <div class="card-body">
                <form action="myprofileup.php" method="POST">
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name="email" value="<?php echo $email; ?>">
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input class="form-control" type="number" name="contact" value="<?php echo $contact; ?>">
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input class="form-control" type="text" name="address" value="<?php echo $address; ?>">
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" required="required">
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit" name="update">Lưu thay đổi</button>
                    </div>
                </form>
                <br>
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

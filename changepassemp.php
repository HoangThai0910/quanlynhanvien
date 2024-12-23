<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location:logout.php');
}
require_once('process/dbh.php');

if (isset($_POST['update'])) {
    $id = $_SESSION['id'];
    $old = $_POST['oldpass'];
    $new = $_POST['newpass'];
  
    $result = mysqli_query($conn, "SELECT employee.password FROM employee WHERE id = $id");
    $employee = mysqli_fetch_assoc($result);
    
    if ($old == $employee['password']) {
        $sql = "UPDATE `employee` SET `password`='$new' WHERE id = $id";
        mysqli_query($conn, $sql);
        echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Đổi mật khẩu thành công')
            window.location.href='myprofile.php?id=$id';</SCRIPT>");
    } else {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Thay đổi thất bại')
            window.location.href='javascript:history.go(-1)';
            </SCRIPT>");
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Đổi mật khẩu | Hệ thống quản lý nhân viên</title>
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
                <h2 class="mb-0">Đổi mật khẩu</h2>
            </div>
            <div class="card-body">
                <form action="changepassemp.php" method="POST">
                    <div class="form-group">
                        <label for="oldpass">Mật khẩu cũ</label>
                        <input class="form-control" type="password" name="oldpass" required>
                    </div>
                    <div class="form-group">
                        <label for="newpass">Mật khẩu mới</label>
                        <input class="form-control" type="password" name="newpass" required>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" required="required">
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit" name="update">Lưu</button>
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

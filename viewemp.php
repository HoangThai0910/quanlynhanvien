<?php
session_start();
require_once ('process/dbh.php');

if (!isset($_SESSION['id'])){
    header('location:logout.php');
} else {
    // check quyền
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM `alogin` WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {
        header("Location: logout.php");
    }
}
$current_page = basename($_SERVER['PHP_SELF']);
$sql = "SELECT * FROM `employee`, `rank` WHERE employee.id = rank.eid";
$result = mysqli_query($conn, $sql);

// Kiểm tra nếu có lỗi trong truy vấn SQL
if (!$result) {
    die("Có lỗi xảy ra khi truy vấn cơ sở dữ liệu: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Quản lý | Hệ thống quản lý nhân viên</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Thêm Font Awesome -->
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
        table td, table th {
    white-space: nowrap;
    overflow: visible; 
    text-overflow: clip; 
}

table {
    table-layout: auto; 
}

table img {
    object-fit: cover;
    width: 60px;
    height: 60px;
}
    </style>
</head>
<body>
        <?php include('sidebar.php'); ?>
        <div class="container mt-5">
            <h2 class="text-center mb-4">Danh sách nhân viên</h2>
            <input type="text" id="searchInput" class="form-control mb-3" placeholder="Tìm kiếm nhân viên...">
            <table class="table table-striped" id="employeeTable">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Ảnh đại diện</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Ngày sinh</th>
                        <th scope="col">Giới tính</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Phòng ban</th>
                        <th scope="col">Bằng cấp</th>
                        <th scope="col">Điểm</th>
                        <th scope="col">Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result) {
                        while ($employee = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>".$employee['id']."</td>";
                            echo "<td><img src='process/".$employee['pic']."' height='60px' width='60px'></td>";
                            echo "<td>".$employee['lastName']." ".$employee['firstName']."</td>";
                            echo "<td>".$employee['email']."</td>";
                            echo "<td>".$employee['birthday']."</td>";
                            echo "<td>".$employee['gender']."</td>";
                            echo "<td>".$employee['contact']."</td>";
                            echo "<td>".$employee['address']."</td>";
                            echo "<td>".$employee['dept']."</td>";
                            echo "<td>".$employee['degree']."</td>";
                            echo "<td>".$employee['points']."</td>";
                            echo "<td>
                                <a href='edit.php?id=".$employee['id']."' class='btn btn-primary btn-sm'>
                                    <i class='fas fa-edit'></i> Sửa
                                </a>
                                <a href='delete.php?id=".$employee['id']."' class='btn btn-danger btn-sm' onClick=\"return confirm('Bạn có chắc chắn muốn xóa?')\">
                                    <i class='fas fa-trash-alt'></i> Xóa
                                </a>
                            </td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>

    <!-- Thêm Bootstrap JS và jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    $(document).ready(function() {
        $("#searchInput").on("keyup", function() {
            var query = $(this).val();
            console.log("Đang tìm: " + query);
            $.ajax({
                url: "search.php",
                method: "GET",
                data: { query: query },
                success: function(data) {
                    $("#employeeTable tbody").html(data);
                    console.log("Data received: ", data);
                },
                error: function(xhr, status, error) {
                    console.error("Ajax Error: ", status, error);
                }
            });
        });
    });
    </script>

</body>
</html>

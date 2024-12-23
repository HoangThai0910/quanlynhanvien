<?php
session_start();
require_once('process/dbh.php');
if (!isset($_SESSION['id'])) {
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

$sql = "SELECT employee.id, employee.firstName, employee.lastName, employee_leave.start, employee_leave.end, employee_leave.reason, employee_leave.status, employee_leave.token 
        FROM employee 
        JOIN employee_leave ON employee.id = employee_leave.id 
        ORDER BY employee_leave.token";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Yêu cầu nghỉ | Hệ thống quản lý nhân viên</title>
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
        <h2 class="text-center mb-4">Danh sách đơn xin nghỉ</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Token</th>
                    <th>Tên</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Tổng số ngày</th>
                    <th>Lý do</th>
                    <th>Trạng thái</th>
                    <th>Tùy chọn</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($employee = mysqli_fetch_assoc($result)) {
                    $date1 = new DateTime($employee['start']);
                    $date2 = new DateTime($employee['end']);
                    $interval = $date1->diff($date2);
                    echo "<tr>";
                    echo "<td>" . $employee['id'] . "</td>";
                    echo "<td>" . $employee['token'] . "</td>";
                    echo "<td>" . $employee['lastName'] . " " . $employee['firstName'] . "</td>";
                    echo "<td>" . $employee['start'] . "</td>";
                    echo "<td>" . $employee['end'] . "</td>";
                    echo "<td>" . $interval->days . "</td>";
                    echo "<td>" . $employee['reason'] . "</td>";
                    echo "<td>" . $employee['status'] . "</td>";
                    echo "<td>
                            <a href=\"approve.php?id={$employee['id']}&token={$employee['token']}\" class='btn btn-success btn-sm' onClick=\"return confirm('Bạn có chắc chắn muốn phê duyệt yêu cầu?')\">Phê duyệt</a>
                            <a href=\"cancel.php?id={$employee['id']}&token={$employee['token']}\" class='btn btn-danger btn-sm' onClick=\"return confirm('Bạn có chắc chắn muốn hủy yêu cầu?')\">Hủy</a>
                          </td>";
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

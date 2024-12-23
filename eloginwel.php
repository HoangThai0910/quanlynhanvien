<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location:logout.php');
}
$id = $_SESSION['id'];
require_once('process/dbh.php');

// Truy vấn lấy thông tin nhân viên
$sql1 = "SELECT * FROM `employee` WHERE id = '$id'";
$result1 = mysqli_query($conn, $sql1);
$employeen = mysqli_fetch_array($result1);
$empName = ($employeen['firstName']);

// Truy vấn Leaderboard
$sql = "SELECT id, firstName, lastName, points FROM employee, rank WHERE rank.eid = employee.id ORDER BY rank.points DESC";
$result = mysqli_query($conn, $sql);

// Truy vấn các dự án sắp đến hạn
$sql1 = "SELECT `pname`, `duedate` FROM `project` WHERE eid = $id AND status = 'Due'";
$result1 = mysqli_query($conn, $sql1);

// Truy vấn các đơn xin nghỉ
$sql2 = "SELECT * FROM employee, employee_leave WHERE employee.id = $id AND employee_leave.id = $id ORDER BY employee_leave.token";
$result2 = mysqli_query($conn, $sql2);

// Truy vấn lương
$sql3 = "SELECT * FROM `salary` WHERE id = $id";
$result3 = mysqli_query($conn, $sql3);

// Kiểm tra lỗi trong truy vấn
if (!$result || !$result1 || !$result2 || !$result3) {
    die('Lỗi truy vấn SQL: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Nhân viên | Hệ thống quản lý nhân viên</title>
    <link href="https://fonts.googleapis.com/css?family=Lobster|Montserrat&display=swap" rel="stylesheet">
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
        .card-body {
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
        h2 {
            margin-bottom: 20px;
        }
        .list-group-item {
            padding: 15px;
        }
    </style>
</head>

<body>
    <?php include('eheader.php'); ?>
    <div class="container">
        <!-- Căn giữa các mục trong mỗi hàng -->
        <div class="row">
            <!-- Leaderboard -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h2>Leaderboard</h2>
                        <ul class="list-group">
                            <?php
                            $seq = 1;
                            while ($employee = mysqli_fetch_assoc($result)) {
                                echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                                echo "ID: " . $employee['id'] . " - " . $employee['lastName'] . " " . $employee['firstName'];
                                echo "<span class='badge badge-primary badge-pill'>" . $employee['points'] . " pts</span>";
                                echo "</li>";
                                $seq += 1;
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Sắp đến hạn -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h2>Sắp đến hạn</h2>
                        <ul class="list-group">
                            <?php
                            while ($employee1 = mysqli_fetch_assoc($result1)) {
                                echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                                echo $employee1['pname'];
                                echo "<span class='badge badge-danger'>" . $employee1['duedate'] . "</span>";
                                echo "</li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Căn giữa các mục trong một hàng -->
        <div class="row">
            <!-- Lương -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h2>Lương</h2>
                        <?php
                        while ($employee = mysqli_fetch_assoc($result3)) {
                            echo "<p>Lương cơ bản: <strong>" . $employee['base'] . "</strong></p>";
                            echo "<p>Thưởng thêm: <strong>" . $employee['bonus'] . " %</strong></p>";
                            echo "<p>Tổng lương: <strong>" . $employee['total'] . "</strong></p>";
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Đơn xin nghỉ -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h2>Đơn xin nghỉ</h2>
                        <ul class="list-group">
                            <?php
                            while ($employee = mysqli_fetch_assoc($result2)) {
                                $date1 = new DateTime($employee['start']);
                                $date2 = new DateTime($employee['end']);
                                $interval = $date1->diff($date2);
                                echo "<li class='list-group-item'>";
                                echo "Ngày bắt đầu: " . $employee['start'] . ", Ngày kết thúc: " . $employee['end'] . ", Số ngày: " . $interval->days . ", Lí do: " . $employee['reason'] . ", Trạng thái: " . $employee['status'];
                                echo "</li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Thêm Bootstrap JS và jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

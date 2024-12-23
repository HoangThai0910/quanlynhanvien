<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location:logout.php');
}

$id = $_SESSION['id'];
require_once('process/dbh.php');
$sql = "SELECT * FROM `project` WHERE eid = '$id'";
$result = mysqli_query($conn, $sql);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Nhân viên | Hệ thống quản lý nhân viên</title>
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
        <h2 class="mb-4">Dự án của bạn</h2>
        <div class="divider"></div>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
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
                    echo "<td>" . htmlspecialchars($employee['pid']) . "</td>";
                    echo "<td>" . htmlspecialchars($employee['pname']) . "</td>";
                    echo "<td>" . htmlspecialchars($employee['duedate']) . "</td>";
                    echo "<td>" . htmlspecialchars($employee['subdate']) . "</td>";
                    echo "<td>" . htmlspecialchars($employee['mark']) . "</td>";
                    echo "<td>" . htmlspecialchars($employee['status']) . "</td>";
                    echo "<td><a class='btn btn-primary' href='psubmit.php?pid=" . htmlspecialchars($employee['pid']) . "&id=" . htmlspecialchars($employee['eid']) . "'>Đánh dấu là đã nộp</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
            </div>
            </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

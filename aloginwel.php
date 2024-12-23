<?php 
session_start();
require_once ('process/dbh.php');
if (!isset($_SESSION['id'])){
    header('location:logout.php');
} else {
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM `alogin` WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {
        header("Location: logout.php");
    }
}

$sql = "SELECT id, firstName, lastName, points FROM employee, rank WHERE rank.eid = employee.id ORDER BY rank.points DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Quản lý | Hệ thống quản lý nhân viên</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Thêm jQuery -->
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

    <h2 class="text-center">Leaderboard</h2>

    <!-- Thêm ô tìm kiếm -->
    <div class="form-group">
        <input type="text" class="form-control" id="search" placeholder="Tìm kiếm theo ID, tên..." onkeyup="searchLeaderboard()">
    </div>

    <table class="table table-striped" id="leaderboard-table">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">ID</th>
                <th scope="col">Tên</th>
                <th scope="col">Điểm</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $seq = 1;
            while ($employee = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$seq."</td>";
                echo "<td>".$employee['id']."</td>";
                echo "<td>".$employee['lastName']." ".$employee['firstName']."</td>";
                echo "<td>".$employee['points']."</td>";
                echo "</tr>";
                $seq += 1;
            }
            ?>
        </tbody>
    </table>

    <div class="text-right mt-3">
        <a href="reset.php" class="btn btn-danger">Reset</a>
    </div>

    <script>
        // Hàm tìm kiếm với AJAX
        function searchLeaderboard() {
            var searchQuery = document.getElementById("search").value;

            $.ajax({
                url: "search_leaderboard.php", // File PHP xử lý tìm kiếm
                method: "GET",
                data: { search: searchQuery },
                success: function(data) {
                    // Cập nhật bảng với kết quả tìm kiếm
                    $("#leaderboard-table tbody").html(data);
                }
            });
        }
    </script>
</body>
</html>

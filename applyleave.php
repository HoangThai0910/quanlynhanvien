<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location:logout.php');
}

$id = $_SESSION['id'];
require_once('process/dbh.php');
$sql = "SELECT * FROM `employee` WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$employee = mysqli_fetch_array($result);
$empName = htmlspecialchars($employee['firstName']);
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
        <h2 class="mb-4">Đơn xin nghỉ</h2>
        <div class="divider"></div>
        <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
            <div class="wrapper wrapper--w680">
                <div class="card card-1">
                    <div class="card-heading"></div>
                    <div class="card-body">
                        <form action="process/applyleaveprocess.php?id=<?php echo $id; ?>" method="POST">
                            <div class="input-group mb-3">
                                <input class="input--style-1 form-control" type="text" placeholder="Reason" name="reason" required>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <p>Ngày bắt đầu</p>
                                    <div class="input-group">
                                        <input class="input--style-1 form-control" type="date" placeholder="start" name="start" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <p>Ngày kết thúc</p>
                                    <div class="input-group">
                                        <input class="input--style-1 form-control" type="date" placeholder="end" name="end" required>
                                    </div>
                                </div>
                            </div>
                            <div class="p-t-20">
                                <button class="btn btn-success" type="submit">Gửi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <h2 class="mt-5 mb-4">Danh sách đơn xin nghỉ</h2>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Ngày bắt đầu</th>
                    <th scope="col">Ngày kết thúc</th>
                    <th scope="col">Số ngày</th>
                    <th scope="col">Lí do</th>
                    <th scope="col">Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT employee.id, employee.firstName, employee.lastName, employee_leave.start, employee_leave.end, employee_leave.reason, employee_leave.status 
                        FROM employee 
                        JOIN employee_leave ON employee.id = employee_leave.id 
                        WHERE employee.id = $id 
                        ORDER BY employee_leave.token";
                $result = mysqli_query($conn, $sql);
                while ($employee = mysqli_fetch_assoc($result)) {
                    $date1 = new DateTime($employee['start']);
                    $date2 = new DateTime($employee['end']);
                    $interval = $date1->diff($date2);

                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($employee['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($employee['lastName']) . " " . htmlspecialchars($employee['firstName']) . "</td>";
                    echo "<td>" . htmlspecialchars($employee['start']) . "</td>";
                    echo "<td>" . htmlspecialchars($employee['end']) . "</td>";
                    echo "<td>" . $interval->days . "</td>";
                    echo "<td>" . htmlspecialchars($employee['reason']) . "</td>";
                    echo "<td>" . htmlspecialchars($employee['status']) . "</td>";
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

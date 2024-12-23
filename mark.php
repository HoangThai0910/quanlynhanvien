<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location:logout.php');
}
require_once ('process/dbh.php');
if (isset($_GET['id']) && isset($_GET['pid'])){
  $id = $_GET['id'];
  $pid = $_GET['pid'];

  $sql1 = "SELECT pid, project.eid, project.pname, project.duedate, project.subdate, project.mark, rank.points, employee.firstName, employee.lastName, salary.base, salary.bonus, salary.total 
          FROM `project`, `rank`, `employee`, `salary` 
          WHERE project.eid = $id AND project.pid = $pid AND project.eid = rank.eid AND salary.id = project.eid AND employee.id = project.eid AND employee.id = rank.eid";

  $result1 = mysqli_query($conn, $sql1);

  if ($result1) {
      $res = mysqli_fetch_assoc($result1);
      $pname = $res['pname'];
      $duedate = $res['duedate'];
      $subdate = $res['subdate'];
      $firstName = $res['firstName'];
      $lastName = $res['lastName'];
      $mark = $res['mark'];
      $points = $res['points'];
      $base = $res['base'];
      $bonus = $res['bonus'];
      $total = $res['total'];
  }
}
if (isset($_POST['update'])) {
    $eid = mysqli_real_escape_string($conn, $_POST['eid']);
    $pid = mysqli_real_escape_string($conn, $_POST['pid']);
    $mark = mysqli_real_escape_string($conn, $_POST['mark']);
    $points = mysqli_real_escape_string($conn, $_POST['points']);
    $base = mysqli_real_escape_string($conn, $_POST['base']);
    $bonus = mysqli_real_escape_string($conn, $_POST['bonus']);

    $upPoint = $points + $mark;
    $upBonus = $bonus + $mark;
    $upSalary = $base + ($upBonus * $base) / 100;

    mysqli_query($conn, "UPDATE `project` SET `mark`='$mark' WHERE eid=$eid and pid = $pid");
    mysqli_query($conn, "UPDATE `rank` SET `points`='$upPoint' WHERE eid=$eid");
    mysqli_query($conn, "UPDATE `salary` SET `bonus`='$upBonus', `total`='$upSalary' WHERE id=$eid");

    echo "<script>
            alert('Mark updated successfully!');
            window.location.href='assignproject.php';
          </script>";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Project Mark | Admin Panel | Hệ thống quản lý nhân viên</title>
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
    <div class="container">
        <h2 class="mb-4">Đánh giá</h2>
        <form action="mark.php" method="POST">
            <div class="form-group">
                <label>Tên dự án</label>
                <input type="text" class="form-control" name="pname" value="<?php echo $pname; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Tên nhân viên</label>
                <input type="text" class="form-control" name="firstName" value="<?php echo $lastName . ' ' . $firstName; ?>" readonly>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Ngày đến hạn</label>
                    <input type="text" class="form-control" name="duedate" value="<?php echo $duedate; ?>" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label>Ngày nộp</label>
                    <input type="text" class="form-control" name="subdate" value="<?php echo $subdate; ?>" readonly>
                </div>
            </div>
            <div class="form-group">
                <label>Đánh giá</label>
                <input type="number" class="form-control" name="mark" value="<?php echo $mark; ?>" required>
            </div>
            <input type="hidden" name="eid" value="<?php echo $id; ?>">
            <input type="hidden" name="pid" value="<?php echo $pid; ?>">
            <input type="hidden" name="points" value="<?php echo $points; ?>">
            <input type="hidden" name="base" value="<?php echo $base; ?>">
            <input type="hidden" name="bonus" value="<?php echo $bonus; ?>">
            <div class="form-group">
                <button type="submit" name="update" class="btn btn-primary">Gửi</button>
            </div>
        </form>
    </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<header>
        <nav class="navbar header-nav">
            <span class="navbar-brand text-white">HVT Company</span>
            <div class="ml-auto d-flex">
                <a class="nav-link text-white" href="adchangepwd.php">Đổi mật khẩu</a>
                <a class="nav-link text-white" href="logout.php">Đăng xuất</a>
            </div>
        </nav>
    </header>
    <div class="d-flex">
<!-- sidebar.php -->
<div class="sidebar">
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link <?php echo ($current_page == 'aloginwel.php') ? 'active-nav' : ''; ?>" href="aloginwel.php">Trang chủ</a></li>
        <li class="nav-item"><a class="nav-link <?php echo ($current_page == 'viewemp.php') ? 'active-nav' : ''; ?>" href="viewemp.php">Danh sách nhân viên</a></li>
        <li class="nav-item"><a class="nav-link <?php echo ($current_page == 'addemp.php') ? 'active-nav' : ''; ?>" href="addemp.php">Thêm nhân viên</a></li>
        <li class="nav-item"><a class="nav-link <?php echo ($current_page == 'assign.php') ? 'active-nav' : ''; ?>" href="assign.php">Giao dự án</a></li>
        <li class="nav-item"><a class="nav-link <?php echo ($current_page == 'assignproject.php') ? 'active-nav' : ''; ?>" href="assignproject.php">Trạng thái dự án</a></li>
        <li class="nav-item"><a class="nav-link <?php echo ($current_page == 'salaryemp.php') ? 'active-nav' : ''; ?>" href="salaryemp.php">Bảng lương</a></li>
        <li class="nav-item"><a class="nav-link <?php echo ($current_page == 'empleave.php') ? 'active-nav' : ''; ?>" href="empleave.php">Đơn xin nghỉ</a></li>
    </ul>
</div>

<div class="content flex-grow-1">

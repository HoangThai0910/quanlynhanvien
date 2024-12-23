<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<header>
        <nav class="navbar header-nav">
            <span class="navbar-brand text-white">HVT Company</span>
            <div class="ml-auto d-flex">
                <a class="nav-link text-white" href="changepassemp.php">Đổi mật khẩu</a>
                <a class="nav-link text-white" href="logout.php">Đăng xuất</a>
            </div>
        </nav>
    </header>
    <div class="d-flex">
<!-- sidebar -->
<div class="sidebar">
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link <?php echo ($current_page == 'eloginwel.php') ? 'active-nav' : ''; ?>" href="eloginwel.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link <?php echo ($current_page == 'myprofile.php') ? 'active-nav' : ''; ?>" href="myprofile.php">Hồ sơ</a></li>
        <li class="nav-item"><a class="nav-link <?php echo ($current_page == 'empproject.php') ? 'active-nav' : ''; ?>" href="empproject.php">Dự án</a></li>
        <li class="nav-item"><a class="nav-link <?php echo ($current_page == 'applyleave.php') ? 'active-nav' : ''; ?>" href="applyleave.php">Xin nghỉ</a></li>
    </ul>
</div>
<div class="content flex-grow-1">

<?php
session_start();
require_once ('dbh.php');

$email = mysqli_real_escape_string($conn,$_POST['mailuid']);
$password = mysqli_real_escape_string($conn,$_POST['pwd']);

$sql = "SELECT * from `alogin` WHERE email = '$email' AND password = '$password'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 1){
	$row = mysqli_fetch_assoc($result);
    $_SESSION['id'] = $row['id'];
	header("Location: ../aloginwel.php");
}

else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Sai thông tin đăng nhập')
    window.location.href='javascript:history.go(-1)';
    </SCRIPT>");
}
?>
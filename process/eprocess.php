<?php
session_start();
require_once ('dbh.php');

$email = $_POST['mailuid'];
$password = $_POST['pwd'];

$sql = "SELECT * from `employee` WHERE email = '$email' AND password = '$password'";
$sqlid = "SELECT id from `employee` WHERE email = '$email' AND password = '$password'";

$result = mysqli_query($conn, $sql);
$id = mysqli_query($conn , $sqlid);

$empid = "";
if(mysqli_num_rows($result) == 1){
	
	$employee = mysqli_fetch_array($id);
	$empid = ($employee['id']);
	$_SESSION['id']=$empid;
	header("Location: ../eloginwel.php");
}

else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Sai thông tin đăng nhập')
    window.location.href='javascript:history.go(-1)';
    </SCRIPT>");
}
?>
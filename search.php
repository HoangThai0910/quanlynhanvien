<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location:logout.php');
}
require_once('process/dbh.php');

$searchTerm = $_GET['query'] ?? '';
echo "Tìm kiếm: " . $searchTerm;

$sql = "SELECT * FROM `employee`, `rank` WHERE employee.id = rank.eid AND (employee.firstName LIKE '%$searchTerm%' OR employee.lastName LIKE '%$searchTerm%' OR employee.email LIKE '%$searchTerm%')";
$result = mysqli_query($conn, $sql);

$output = '';
while ($employee = mysqli_fetch_assoc($result)) {
    $output .= '<tr>';
    $output .= '<td>'.$employee['id'].'</td>';
    $output .= '<td><img src="process/'.$employee['pic'].'" height="60px" width="60px"></td>';
    $output .= '<td>'.$employee['lastName'].' '.$employee['firstName'].'</td>';
    $output .= '<td>'.$employee['email'].'</td>';
    $output .= '<td>'.$employee['birthday'].'</td>';
    $output .= '<td>'.$employee['gender'].'</td>';
    $output .= '<td>'.$employee['contact'].'</td>';
    $output .= '<td>'.$employee['address'].'</td>';
    $output .= '<td>'.$employee['dept'].'</td>';
    $output .= '<td>'.$employee['degree'].'</td>';
    $output .= '<td>'.$employee['points'].'</td>';
    $output .= '<td>
        <a href="edit.php?id='.$employee['id'].'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
        <a href="delete.php?id='.$employee['id'].'" class="btn btn-danger btn-sm" onClick="return confirm(\'Bạn có chắc chắn muốn xóa?\')"><i class="fas fa-trash-alt"></i></a>
    </td>';
    $output .= '</tr>';
}

echo $output;
?>

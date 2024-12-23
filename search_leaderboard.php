<?php
require_once ('process/dbh.php');

if (isset($_GET['search'])) {
    $searchQuery = mysqli_real_escape_string($conn, $_GET['search']);
    
    $sql = "SELECT id, firstName, lastName, points 
            FROM employee, rank 
            WHERE rank.eid = employee.id 
            AND (employee.firstName LIKE '%$searchQuery%' OR employee.lastName LIKE '%$searchQuery%' OR employee.id LIKE '%$searchQuery%') 
            ORDER BY rank.points DESC";
    $result = mysqli_query($conn, $sql);
    
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
}
?>

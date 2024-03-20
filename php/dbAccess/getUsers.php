<?php
// DB Connection
require '/home/earwiggr/ATSdb.php';

// Select all rows of users
$sql = "
        SELECT * FROM Users
        ORDER BY userId
    ";

// Store result in variable
$result = mysqli_query($cnxn, $sql);

// Array to store results
$users = [];

// 
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

// Format for HTML
header('Content-Type: application/json');
echo json_encode($users);
?>
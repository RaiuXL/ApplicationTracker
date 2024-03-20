<?php
session_start();
$userId = $_SESSION['userId'];
require '/home/earwiggr/ATSdb.php';
$sql = "
        SELECT * FROM Applications
        WHERE userId = $userId
        ORDER BY applicationId
    ";

$result = mysqli_query($cnxn, $sql);

$applications = [];

while ($row = mysqli_fetch_assoc($result)) {
    $applications[] = $row;
}

header('Content-Type: application/json');
echo json_encode($applications);
?>

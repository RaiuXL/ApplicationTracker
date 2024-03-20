<?php
require '/home/earwiggr/ATSdb.php';

$sql = "SELECT * FROM newApplicationsTest WHERE ApplicationId = 1";

$result = mysqli_query($cnxn, $sql);

$applications = [];

if ($row = mysqli_fetch_assoc($result)) {
    $applications[] = $row;
}

header('Content-Type: application/json');
echo json_encode($applications);
?>

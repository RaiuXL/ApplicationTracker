<?php
require '/home/earwiggr/ATSdb.php';

$sql = "
        SELECT * FROM AdminAnnouncements
        ORDER BY announcementId
    ";

$result = mysqli_query($cnxn, $sql);

$announcements = [];

while ($row = mysqli_fetch_assoc($result)) {
    $announcements[] = $row;
}

header('Content-Type: application/json');
echo json_encode($announcements);
?>

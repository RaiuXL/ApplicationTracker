<?php
require '/home/earwiggr/ATSdb.php'; // Include the database connection file

$announcementId = $_GET['announcementId']; // Retrieve the announcementId from the URL parameters

// Prevent SQL Injection
$statement = $cnxn->prepare("SELECT * FROM AdminAnnouncements WHERE announcementId = ?");
$statement->bind_param("i", $announcementId); // "i" indicates the data type is integer
$statement->execute();
$result = $statement->get_result();

if ($row = $result->fetch_assoc()) {
    header('Content-Type: application/json');
    echo json_encode($row); // Return the data of the announcement with the specific announcementId
} else {
    echo "No announcement found with ID: $announcementId";
}
?>

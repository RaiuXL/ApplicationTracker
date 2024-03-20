<?php
require '/home/earwiggr/ATSdb.php';

// Check if the applicationId and userId parameters are passed in
$data = trim(file_get_contents("php://input"));
$decoded = json_decode($data, true);

$userId = $decoded['userId'];

// Prepare the statement to toggle the isAdmin flag for the user
$sql = "UPDATE Users SET isAdmin = 1 - isAdmin WHERE userId = ?";

// Using prepared statements to prevent SQL Injection
$stmt = $cnxn->prepare($sql);
$stmt->bind_param("i", $userId); // "i" indicates the data type is integer
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo true;
} else {
    echo false;
}
?>

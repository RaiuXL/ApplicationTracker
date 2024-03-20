<?php
require '/home/earwiggr/ATSdb.php';

// Check if applicationId and userId parameters are passed
// if (isset($_POST['applicationId']) && isset($_POST['userId'])) {
    $data = trim(file_get_contents("php://input"));
    $decoded = json_decode($data, true);
    
    
    $applicationId = $decoded['applicationId'];
    $userId = $decoded['userId'];

    // Temporary userId = 1 until we get login figured out
    // Prepare the statement for soft delete (update isDeleted field)
    $sql = "INSERT INTO InactiveApplications SELECT * FROM Applications WHERE applicationId = '$applicationId' AND userId = 1";
    mysqli_query($cnxn, $sql);
    
    $sql = "DELETE FROM Applications WHERE applicationId = '$applicationId' AND userId = 1";
    $result = mysqli_query($cnxn, $sql);
    
    if ($result) {
        echo true;
    } else {
        echo false;
    }

?>

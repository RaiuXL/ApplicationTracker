<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Application Receipt</title>
    <script src="/pages/Sprint_5/scripts/checkForDarkMode.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/pages/Sprint_5/styles/nav-styles.css">
    <link rel="stylesheet" href="/pages/Sprint_5/styles/styles.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body class="d-flex flex-column">
<div id="navbarPlaceholder"></div>
<?php
require '/home/earwiggr/ATSdb.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // 1. Remove space key value.
    $applicationId = trim($_POST['applicationId']);
    $jobPosition = trim($_POST['jobPosition']);
    $dateOfApplication = trim($_POST['dateApplied']);
    $descriptionUrl = trim($_POST['descriptionURL']);
    $applicationStatus = trim($_POST['status']);
    $comments = trim($_POST['notes']);
    $followUpDate = trim($_POST['followUpDate']);
    $organization = trim($_POST['organization']);
    

    // Update query
    $sql = "UPDATE Applications 
                SET jobPosition = '$jobPosition', 
                    dateApplied = '$dateOfApplication', 
                    descriptionURL = '$descriptionUrl', 
                    status = '$applicationStatus', 
                    notes = '$comments', 
                    followUpDate = '$followUpDate',
                    organization = '$organization'
                WHERE applicationId = '$applicationId'";

    // Execute the query
    mysqli_query($cnxn, $sql);

    // 2. Make sure no empty value entered.
    if (!empty($jobPosition) && !empty($dateOfApplication) && !empty($descriptionUrl) && !empty($applicationStatus) && !empty($followUpDate)) {
        // HTML encode to prevent XSS
        echo "
                <div class='container mt-4'>
                    <div class='row justify-content-center'>
                        <div class='col-md-8 col-lg-6 receipt text-center text-lg-start'>
                            <div class='form-group mt-3 custom-dark-mode'>
                                <h2 class='receipt-header'>Edit Application Reciept</h2>
                                <hr>
                            </div>
                            <div class='d-flex flex-wrap justify-content-between mt-4 flex-row'>
                                <h2 class='key'>Position:</h2>
                                <h2 class='result'>" . htmlspecialchars($jobPosition) . "</h2>
                            </div>
                            <div class='d-flex flex-wrap justify-content-between mt-5 flex-row'>
                                <h2 class='key'>Application Date :</h2>
                                <h2 class='result'>" . htmlspecialchars($dateOfApplication) . "</h2>
                            </div>
                            <div class='d-flex flex-wrap justify-content-between mt-5 flex-row'>
                                <h2 class='key'>Status :</h2>
                                <h2 class='result'>" . htmlspecialchars($applicationStatus) . "</h2>
                            </div>
                            <div class='d-flex flex-wrap justify-content-between mt-5 flex-row'>
                                <h2 class='key'>Follow-up Date :</h2>
                                <h2 class='result'>" . htmlspecialchars($followUpDate) . "</h2>
                            </div>
                            <div class='d-flex text-truncate justify-content-between mt-5 flex-column me-auto text-start multi-line-input'
                                style='margin-left: -10px; padding-left:10px'>
                                <h2>Description Url :</h2>
                                <h3 class='result text-truncate'>" . htmlspecialchars($descriptionUrl) . "</h3>
                            </div>
                            <div class='d-flex flex-wrap justify-content-between mt-5 flex-column me-auto text-start multi-line-input'
                                style='margin-left: -10px; padding-left:10px'>
                                <h2>Notes :</h2>
                                <h3 class='result'>" . htmlspecialchars($comments) . "</h3>
                            </div>
                            <div class='d-flex flex-wrap justify-content-between mt-5 flex-column me-auto text-start multi-line-input'
                                style='margin-left: -10px; padding-left:10px'>
                                <h2>Notes :</h2>
                                <h3 class='result'>" . htmlspecialchars($organization) . "</h3>
                            </div>
                        </div>
                    </div>
                </div>";

        // You can add additional processing or email sending logic here if needed.
        //send a email to earwiggreenriver@gmail.com
        // tschrock@greenriver.edu
        $to = "earwiggreenriver@gmail.com";
        $subject = "New edit changes to ".$jobPosition."!";
        $message = "
                <html>
                    <head>
                        <title>HTML email</title>
                    </head>
                    <body>
                        <p>This email contains HTML Tags!</p>
                        <table>
                            <tr>
                                <th>Job Position</th>
                                <th>Date of Application</th>
                                <th>Description URL</th>
                                <th>Application Status</th>
                                <th>Comments</th>
                                <th>Follow up Date</th>
                            </tr>
                            <tr>
                                <td>$jobPosition</td>
                                <td>$dateOfApplication</td>
                                <td>$descriptionUrl</td>
                                <td>$applicationStatus</td>
                                <td>$comments</td>
                                <td>$followUpDate</td>
                                <td>$organization</td>
                            </tr>
                        </table>
                    </body>
                </html>
            ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <webmaster@example.com>' . "\r\n";
        $headers .= 'Cc: myboss@example.com' . "\r\n";

        mail($to,$subject,$message,$headers);
    } else {
        echo "<h2>Please fill the form correctly!</h2> ";
    }
} else {
    echo "<h2>Please fill the form correctly</h2>";
}
?>
<div id="footerPlaceholder"></div>
<script src="/pages/Sprint_5/scripts/navBar.js"></script>
</body>
</html>


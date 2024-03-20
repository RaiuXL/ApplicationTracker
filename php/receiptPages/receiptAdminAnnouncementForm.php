<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
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
 if($_SERVER['REQUEST_METHOD'] == "POST") {
    //Gathering data, trimming
     $title = trim($_POST['name']);
     $jobType = trim($_POST['jobtype']);
     $location = trim($_POST['location']);
     $employer = trim($_POST['employer']);
     $moreInfo = trim($_POST['moreInfo']);
     $URL = trim($_POST['DescriptionUrl']);
     $email = trim($_POST['email']);
     
    //add data to sql
    $sql = "
        INSERT INTO AdminAnnouncements (userId, title, jobType, location, employer, moreInfo, url, email) 
        VALUES (1, '$title', '$jobType', '$location', '$employer', '$moreInfo', '$URL', '$email')";
    mysqli_query($cnxn, $sql);

     //Checking for empty fields
     if(!empty($title) && !empty($jobType) && !empty($location) && !empty($employer) && !empty($URL)){
         echo "
                <div class='container mt-4'>
                    <div class='row justify-content-center'>
                        <div class='col-md-8 col-lg-6 receipt text-center text-lg-start'>
                            <div class='form-group mt-3 custom-dark-mode'>
                                <h2 class='receipt-header'>Admin Announcement Reciept</h2>
                                <hr>
                            </div>
                            <div class='d-flex flex-wrap justify-content-between mt-4 flex-row'>
                                <h2 class='key'>Oppertunity Title :</h2>
                                <h2 class='result'>" . htmlspecialchars($title) . "</h2>
                            </div>
                            <div class='d-flex flex-wrap justify-content-between mt-5 flex-row'>
                                <h2 class='key'>Oppertunity Type :</h2>
                                <h2 class='result'>" . htmlspecialchars($jobType) . "</h2>
                            </div>
                            <div class='d-flex flex-wrap justify-content-between mt-5 flex-row'>
                                <h2 class='key'>Employer :</h2>
                                <h2 class='result'>" . htmlspecialchars($employer) . "</h2>
                            </div>
                            <div class='d-flex flex-wrap justify-content-between mt-5 flex-row'>
                                <h2 class='key'>Email :</h2>
                                <h2 class='result'>" . htmlspecialchars($email) . "</h2>
                            </div>
                            <div class='d-flex text-truncate justify-content-between mt-5 flex-column me-auto text-start multi-line-input'
                                style='margin-left: -10px; padding-left:10px'>
                                <h2>Location :</h2>
                                <h3 class='result text-truncate'>" . htmlspecialchars($location) . "</h3>
                            </div>
                            <div class='d-flex text-truncate justify-content-between mt-5 flex-column me-auto text-start multi-line-input'
                                style='margin-left: -10px; padding-left:10px'>
                                <h2>Description Url :</h2>
                                <h3 class='result text-truncate'>" . htmlspecialchars($URL) . "</h3>
                            </div>
                            <div class='d-flex flex-wrap justify-content-between mt-5 flex-column me-auto text-start multi-line-input'
                                style='margin-left: -10px; padding-left:10px'>
                                <h2>More Info :</h2>
                                <h3 class='result'>" . htmlspecialchars($moreInfo) . "</h3>
                            </div>
                        </div>
                    </div>
                </div>";


         // send email
         // tschrock@greenriver.edu
         $to = "earwiggreenriver@gmail.com";
         $subject = "New Annoucement: ".$title." added!";
         $message = "
                <html>
                    <head>
                        <title>HTML email</title>
                    </head>
                    <body>
                        <p>This email contains HTML Tags!</p>
                        <table>
                            <tr>
                                <th>Title</th>
                                <th>Job Type</th>
                                <th>Location</th>
                                <th>Employer</th>
                                <th>More Info</th>
                                <th>URL</th>
                                <th>Email</th>
                            </tr>
                            <tr>
                                <td>$title</td>
                                <td>$jobType</td>
                                <td>$location</td>
                                <td>$employer</td>
                                <td>$moreInfo</td>
                                <td>$URL</td>
                                <td>$email</td>
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
     }else {
         echo "<h2>Please fill the form correctly!</h2> ";
     }
 }
 else{
     echo "<h2>Please fill the form correctly</h2>";
 }
?>
<div id="footerPlaceholder"></div>
<script src="/pages/Sprint_5/scripts/navBar.js"></script>
</body>
</html>

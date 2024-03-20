<!doctype html>
<html lang="en">

<head>
    <title>Contact Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="/pages/Sprint_5/scripts/checkForDarkMode.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/pages/Sprint_5/styles/styles.css">
    <link rel="stylesheet" href="/pages/Sprint_5/styles/nav-styles.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</head>
<body>
<div id="navbarPlaceholder"></div>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                //1.remove space key value.
                $name = trim($_POST['nameContact']);
                $email = trim($_POST['emailContact']);
                $message = trim($_POST["messageContact"]);
                //2.make sure no empty value entered.
                echo "<h2> Contact Information:</h2>";
                if(!empty($name) && !empty($email)&&!empty($message)){
                    //https://www.w3schools.com/php/php_form_validation.asp
                    //htmlspecialchars()  This prevents attackers from exploiting the code by injecting HTML
                    // or Javascript code (Cross-site Scripting attacks) in forms.
                    echo "<p>Name: " . htmlspecialchars($name) . "</p>";
                    echo "<p>Email: " . htmlspecialchars($email) . "</p>";
                    echo "<p>Message: ". htmlspecialchars($message). "</p>";

                    //send a email to earwiggreenriver@gmail.com
                    // tschrock@greenriver.edu
                    $to = "earwiggreenriver@gmail.com";
                    $subject = "User: ".$name." sent a message!";
                    $message = "
                            <html>
                                <head>
                                    <title>HTML email</title>
                                </head>
                                <body>
                                    <p>This email contains HTML Tags!</p>
                                    <table>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Message</th>
                                        </tr>
                                        <tr>
                                            <td>$name</td>
                                            <td>$email</td>
                                            <td>$message</td>
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
        </div>
    </div>
</div>
<div id="footerPlaceholder"></div>
<script src="/pages/Sprint_5/scripts/navBar.js"></script>
</body>
</html>

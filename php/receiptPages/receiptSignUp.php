<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Receipt</title>
  <script src="/pages/Sprint_5/scripts/checkForDarkMode.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://earwig.greenriverdev.com/pages/Sprint_5/styles/nav-styles.css">
  <link rel="stylesheet" href="https://earwig.greenriverdev.com/pages/Sprint_5/styles/styles.css">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body class="d-flex flex-column">
  <div id="navbarPlaceholder"></div><?php
    require '/home/earwiggr/ATSdb.php';
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //1.remove space key value.
        $firstName = trim($_POST['firstName']);
        $lastName = trim($_POST['lastName']);
        $name = $firstName . " " . $lastName;
        $email = trim($_POST['email']);
        $cohort = trim($_POST['cohort']);
        $status = isset($_POST['checkboxes']) ? $_POST['checkboxes'] : ""; //isset() is checking if there s $_POST['checkboxes']
        $roles = trim($_POST["roles"]);
        $password = $_POST['password'];  
        $username = $_POST['username'];  
        
         // Check if username already exists
    $userCheckQuery = "SELECT * FROM Users WHERE username = '$username'";
    $result = mysqli_query($cnxn, $userCheckQuery);
    if (mysqli_num_rows($result) > 0) {
        // Username already exists
        echo "<h2>Username already exists. Please choose a different username.</h2>";
        exit; // Stop the script
    }
        
        // Encrypt the password using the password_hash function
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO Users (firstName, lastName, username, email, cohortNum, password, appUseOptions, customNotes)
            VALUES ('$firstName', '$lastName', '$username', '$email', '$cohort', '$hashedPassword', '" . implode(", ", array_map('htmlspecialchars', $status)) . "', '$roles')";
                        
        // Execute the query
        mysqli_query($cnxn, $sql);
        //2.make sure no empty value entered. I did not include ！empty($roles) since it not required
        if(!empty($name) && !empty($email)&&!empty($cohort)&&!empty($roles)){
            echo "
                    <div class='container mt-4'>
                        <div class='row justify-content-center'>
                            <div class='col-md-8 col-lg-6 receipt text-center text-lg-start'>
                                <div class='form-group mt-3 custom-dark-mode'>
                                    <h2 class='receipt-header'>Sign Up Receipt</h2>
                                    <hr>
                                </div>
                                <div class='d-flex flex-wrap justify-content-between mt-4 flex-row'>
                                    <h2 class='key'>UserName :</h2>
                                    <h2 class='result'>" . htmlspecialchars($username) . "</h2>
                                </div>
                                <div class='d-flex flex-wrap justify-content-between mt-4 flex-row'>
                                    <h2 class='key'>Name :</h2>
                                    <h2 class='result'>" . htmlspecialchars($name) . "</h2>
                                </div>
                                <div class='d-flex flex-wrap justify-content-between mt-5 flex-row'>
                                    <h2 class='key'>Email :</h2>
                                    <h2 class='result'>" . htmlspecialchars($email) . "</h2>
                                </div>
                                <div class='d-flex flex-wrap justify-content-between mt-5 flex-row'>
                                    <h2 class='key'>Cohort Number :</h2>
                                    <h2 class='result'>" . htmlspecialchars($cohort) . "</h2>
                                </div>
                                <div class='d-flex flex-wrap justify-content-between mt-5 flex-row'>
                                    <h2 class='key'>Status :</h2>
                                    <h2 class='result'>" . htmlspecialchars(implode(", ", array_map('htmlspecialchars', $status))) . "</h2>
                                </div>
                                <div class='d-flex text-truncate justify-content-between mt-5 flex-column me-auto text-start multi-line-input' style='margin-left: -10px; padding-left:10px'>
                                    <h2>Roles :</h2>
                                    <h3 class='result text-truncate'>" . htmlspecialchars($roles) . "</h3>
                                </div>
                            </div>
                        </div>
                    ";

            //send a email to earwiggreenriver@gmail.com
            $to = "earwiggreenriver@gmail.com";
            $subject = "New User: ".$name." Signed up!";
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
                                    <th>Cohort</th>
                                    <th>Status</th>
                                    <th>Roles</th>
                                </tr>
                                <tr>
                                    <td>$name</td>
                                    <td>$email</td>
                                    <td>$cohort</td>
                                    <td>$status</td>
                                    <td>$roles</td>
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
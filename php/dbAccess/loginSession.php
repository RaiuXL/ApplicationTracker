<?php
session_start(); // Start a new session or resume the existing one
// loginSession
// Include the database connection file
require '/home/earwiggr/ATSdb.php';

// Check if username, password, and confirm_password have been received via POST method
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Escape the received username to prevent SQL injection
    $username = mysqli_real_escape_string($cnxn, $_POST['username']);

    // Construct an SQL query to get the user data by username
    $sql = "SELECT * FROM Users WHERE username='$username'";

    $result = mysqli_query($cnxn, $sql);

    // Check if a user with the given username was found
    if (mysqli_num_rows($result) == 1) {
        // Fetch the user data
        $user = mysqli_fetch_assoc($result);

        // Verify hashed password
        if (password_verify($_POST['password'], $user['password'])) {
            // Set a session variable for the username
            $_SESSION['username'] = $username;

            // Check if the user is an admin
            if ($user['isAdmin'] == 1) {
                // Set a session variable to indicate this user is an admin
                $_SESSION['isAdmin'] = true;

                // Redirect to the admin dashboard
                header('Location: /pages/Sprint_5/AdminDashboard.php');
                exit();
            } else {
                // Set the session variable to indicate this user is not an admin
                $_SESSION['isAdmin'] = false;

                // Redirect to the application dashboard
                header('Location: /pages/Sprint_5/ApplicationDashboard.html');
                exit();
            }
        } else {
            // Password verification failed, redirect to the login page
            $_SESSION['error'] = 'Invalid username or password';
            header('Location: /pages/Sprint_5/login.php');
            exit();
        }
    } else {
        // No user found, redirect to the login page
        $_SESSION['error'] = 'Invalid username or password';
        header('Location: /pages/Sprint_5/login.php');
        exit();
    }
} else {
    // If username or password was not received, redirect to the login page
    $_SESSION['error'] = 'Invalid username or password';
    header('Location:/pages/Sprint_5/login.php');
    exit();
}
?>

<?php
session_start();

// Unset the session variable
unset($_SESSION['username']);
unset($_SESSION['isAdmin']);

// Clear all session variables
$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
//$params["path"], $params["domain"], $params["secure"], $params["httponly"]: 
// These are the parameters fetched from the existing session cookie. By providing 
// these to setcookie(), the function knows which cookie to delete (since cookies 
// are identified by a combination of name, domain, and path). The "secure" and 
// "httponly" flags are also preserved, which are important for the security
// of the cookie.
// Destroy the session
session_destroy();

// Redirect to the login page
header('Location: /pages/Sprint_5/login.php');
exit();
?>

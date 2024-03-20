<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sign up Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="./scripts/checkForDarkMode.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles/styles.css">
  <link rel="stylesheet" href="./styles/nav-styles.css">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body data-gr-ext-installed="" data-new-gr-c-s-check-loaded="14.1160.0">
  <div id="navbarPlaceholder"></div>
  <div class="container mt-4">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form action="/pages/Sprint_5/php/dbAccess/loginSession.php" class="custom-form" method="post">
          <div class="form-group mt-3 custom-dark-mode">
            <?php
                             
                            if (isset($_SESSION['error'])) {
                                echo '<p style="color:red;">' . $_SESSION['error'] . '';
                                unset($_SESSION['error']);
                            }
                            ?>
            <h2 class="contact-header">Login Form</h2>
            <hr>
            <label for="username">Username*</label> <input autocomplete="username" class="form-control" id="username" name="username" required="" type="text"><br>
            <label for="password">Password*</label>
            <div style="position: relative;">
              <input type="password" class="form-control" id="password" name="password" required=""> <i id="togglePassword" class="fas fa-eye" style="position: absolute; cursor: pointer; right: -30px; top: 10px;"></i>
            </div>
          </div><button class="btn custom-btn custom-dark-mode my-3" id="loginButton" type="submit">Login</button>
        </form>
      </div>
    </div>
  </div>
  <div id="footerPlaceholder"></div>
  <script src="./scripts/navBar.js"></script> 
  <script src="./scripts/togglePassword.js"></script>
</body>
</html>
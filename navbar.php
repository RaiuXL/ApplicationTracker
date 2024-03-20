<?php
session_start();
if (!isset($_SESSION['userId'])) {
    $_SESSION['userId'] = -1;
}// 开始会话
?>

<nav class="navbar navbar-expand-md navbar-light fixed-top">
    <a class="navbar-brand col-4 col-md-2 order-1" href="/">
        <div class="d-flex justify-content-center w-100 order-0">
            <img class="logo mx-3" alt="Green River Logo">
        </div>
    </a>
    <div class="d-flex order-0 justify-content-center col-4 d-md-none">
        <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
            class="navbar-toggler align-self-center order-2" data-target="#navbarSupportedContent"
            data-toggle="collapse" type="button" id="toggler-button">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse col-md-8 order-4 order-md-2 justify-content-md-center" id="navbarSupportedContent">
        <ul class="navbar-nav justify-content-start">
            <li class="nav-item active">
                <a class="nav-link" href="/pages/Sprint_5/ApplicationDashboard.html">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/pages/Sprint_5/NewApplicationForm.html">New Application</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/pages/Sprint_5/ContactPage.html">Contact Us</a>
            </li>
 <!-- 只有在用户未登录时显示 Sign Up -->
    <?php if (!isset($_SESSION['username'])): ?>
        <li class="nav-item">
            <a class="nav-link" href="/pages/Sprint_5/SignUp_Form.html">Sign Up</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/pages/Sprint_5/login.php">Login</a>
        </li>
    <?php else: ?>
        <!-- 用户登录后显示 Logout -->
        <li class="nav-item">
            <a class="nav-link" href="/pages/Sprint_5/php/logout.php">Logout</a>
        </li>
    <?php endif; ?>
        </ul>
    </div>
    <div class="col-4 col-md-2 d-flex align-items-center order-2 order-md-2">
        <button onclick="darkMode()" class="darkModeToggle d-flex flex-column align-self-center justify-content-center mx-auto mb-md-0">
            <img class="border-bottom border-2 mx-auto pb-2" alt="Dark Mode Icon">
            <span id="darkModeToggleText" class="mx-auto">Color Theme</span>
        </button>
    </div>
</nav>

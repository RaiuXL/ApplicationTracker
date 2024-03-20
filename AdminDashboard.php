<?php
session_start(); // Start a new session or resume the existing one

// Redirect the user if they're not logged in or if they're not an admin
if (!isset($_SESSION['username']) || $_SESSION['isAdmin'] = false) {
    header('Location: /pages/Sprint_5/SignUp_Form.html'); // Redirect to login page or another appropriate page
    exit(); // Ensure that the script stops executing after the redirect
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ApplicationManagerDashboard</title>
    <script src="./scripts/checkForDarkMode.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/nav-styles.css">
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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

<body class="d-flex flex-column px-3 px-lg-1">
    <div id="navbarPlaceholder"></div>
    <div
        class="content w-100 mt-5 px-0 d-flex flex-column align-self-center align-self-lg-auto flex-lg-row-reverse justify-content-lg-center">
        <div class="reminders d-flex col-12 col-sm-10 col-md-8 col-lg-4 col-xl-3 mx-auto mx-lg-0 align-self-lg-start flex-column col-lg-4 shadow">
            <div class="row align-self-center align-self-lg-auto">
                <h2 class="text-center mt-3">Notifications</h2>
            </div>
            <div class="mt-3 col-sm-10 col-lg-12 align-self-sm-center d-flex flex-column">
                <div class="mb-3">
                    <div class="col-12 d-flex">
                        <a id="showAnnouncements" data-toggle="collapse" href="#announcements" role="button" aria-expanded="true"
                            aria-controls="announcements" class="icon-link">
                            Announcements
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                            </svg>
                        </a>
                    </div>
                    <ul id="announcements" class="w-100 collapse show"></ul>
                </div>
                <div class="mb-3">
                    <div class="d-flex flex-column">
                        <div class="col-12 d-flex">
                            <a id="showApps" data-toggle="collapse" href="#apps" role="button" aria-expanded="true" aria-controls="apps"
                               class="icon-link mx-lg-0">
                                Upcoming Apps
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8">
                                    </path>
                                </svg>
                            </a>
                        </div>
                        <ul id="apps" class="w-100 collapse show"></ul>
                    </div>
                </div>
                <div class="mb-1">
                    <div class="col-12 d-flex">
                        <a id="showLateApps" data-toggle="collapse" href="#lateApps" role="button" aria-expanded="true"
                            aria-controls="lateApps" class="icon-link mx-lg-0">
                            Late Apps
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8">
                                </path>
                            </svg>
                        </a>
                    </div>
                    <ul id="lateApps" class="w-100 collapse show"></ul>
                </div>
            </div>
            <div class="row">
                <h3 class="text-center mt-3 mt-lg-5">
                    <a class="text-decoration-none mx-auto icon-link icon-link-hover" href="https://www.devs.greenrivertech.net/">
                        Find More Opportunities
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" id="find-more-icon"
                            class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8m-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5" />
                        </svg>
                    </a>
                </h3>
            </div>
        </div>
        <div id="dataTable" class="carousel slide col-lg-7 col-xl-8 mt-4 mt-lg-0 shadow me-lg-4 me-xl-5">
                <div class="carousel-item active" id="userSlide">
                    <div class="d-flex align-self-center align-self-lg-auto">
                        <h1 class="ms-lg-4 mt-1 mt-lg-3">Users</h1>
                    </div>
                    <div class="d-flex flex-column labels">
                        <div class="d-flex mt-2">
                            <div class="col-3 col-md-3 d-none d-sm-flex align-items-center">
                            <span class="d-inline-block text-truncate text-start">
                                 Name
                            </span>
                            </div>
                            <div class="col-5 col-sm-4 col-md-3 col-lg-4 col-xxl-3 d-flex align-items-center justify-content-between">
                                <span>Email</span>
                            </div>
                            <div class="d-flex d-flex col-5 col-sm-4 col-md-3 align-items-center justify-content-evenly text-center">
                                <div class="align-items-center col-4 d-flex justify-content-center">
                            <span class="d-inline-block text-center">
                                Cohort
                            </span>
                                </div>

                                <div class="text-center align-items-center d-none d-sm-flex d-lg-none d-xl-flex col-4 justify-content-center">
                            <span class="d-inline-block text-center">
                                Usage
                            </span>
                                </div>

                                <div class="d-flex align-items-center justify-content-center col-4">
                            <span class="d-inline-block text-center">
                                Admin
                            </span>
                                </div>
                            </div>
                            <div
                                    style="width: max-content"
                                    class="ms-3 ms-lg-4 d-none d-md-flex d-lg-none d-xxl-flex align-items-center justify-content-between">
                                <span class="text-truncate">Created</span>
                            </div>
                        </div>
                    </div>
                    <ul id="usersList" class="ps-0"></ul>
                    <div class="w-100 d-flex justify-content-evenly">
                        <button onclick="changeDisplay('userSlide', 'appSlide')" class="text-white mb-1 text-decoration-underline bg-transparent border-0 link-offset-3"
                        >
                            View Apps
                        </button>
                        <button onclick="changeDisplay('userSlide', 'announcementSlide')" class="text-white mb-1 text-decoration-underline bg-transparent border-0 link-offset-3"
                        >
                            View Announcements
                        </button>
                    </div>
                </div>
                <div class="carousel-item" id="appSlide">
                    <div class="d-flex align-self-center align-self-lg-auto">
                        <h1 class="ms-lg-4 mt-1 mt-lg-3">Applications</h1>
                    </div>
                    <div class="d-flex flex-column labels">
                        <div class="d-flex mt-2">
                            <div class="col-2 col-md-1 col-lg-2 d-none d-sm-flex align-items-center">
                            <span class="d-inline-block text-truncate text-start">
                                 Applied
                            </span>
                            </div>
                            <div class="col-7 col-sm-5 ps-sm-4 ps-lg-0 col-md-4 col-lg-4 col-xxl-3 d-flex align-items-center justify-content-between">
                                <span>Position</span>
                            </div>
                            <div class="col-4 col-md-3 col-xl-3 col-xxl-2 d-none d-md-flex d-lg-none d-xl-flex align-items-center justify-content-between">
                                <span>Organization</span>
                            </div>
                            <div class="d-flex d-flex col-4 col-md-3 col-lg-5 col-xl-2 align-items-center justify-content-start">
                                <div class="align-items-center col-5 col-md-6 col-lg-5 col-xl-8 col-xxl-8 d-flex">
                            <span class="d-inline-block">
                                Status
                            </span>
                                </div>

                                <div class="text-center align-items-center d-none col-3 justify-content-center">
                            <span class="d-inline-block text-center">
                                Notes
                            </span>
                                </div>

                                <div class="d-none d-sm-flex align-items-center justify-content-center col-3">
                            <span class="d-inline-block text-center">
                                Url
                            </span>
                                </div>
                            </div>
                            <div
                                    style="width: max-content"
                                    class="ms-3 ms-lg-4 d-none d-xxl-flex align-items-center justify-content-between">
                                <span class="text-truncate">Follow-up</span>
                            </div>
                        </div>
                    </div>
                    <ul id="applicationsList" class="ps-0"></ul>
                    <div class="w-100 pb-4 d-flex justify-content-evenly">
                        <a class="text-white text-decoration-underline link-offset-3"
                           href="/pages/Sprint_5/NewApplicationForm.html">
                            Create new application
                        </a>
                        <button onclick="changeDisplay('appSlide', 'userSlide')" class="text-white mb-1 text-decoration-underline bg-transparent border-0 link-offset-3"
                        >
                            View Users
                        </button>
                        <button onclick="changeDisplay('appSlide', 'announcementSlide')" class="text-white mb-1 text-decoration-underline bg-transparent border-0 link-offset-3"
                        >
                            View Announcements
                        </button>
                    </div>
                </div>
                <div class="carousel-item" id="announcementSlide">
                    <div class="d-flex align-self-center align-self-lg-auto">
                        <h1 class="ms-lg-4 mt-1 mt-lg-3">Announcements</h1>
                    </div>
                    <div class="d-flex flex-column labels">
                        <div class="d-flex mt-2">
                            <div class="col-2 col-md-1 col-lg-2 d-none d-sm-flex align-items-center">
                        <span class="d-inline-block text-truncate text-start">
                             Created
                        </span>
                            </div>
                            <div class="col-7 col-sm-5 ps-sm-4 ps-lg-0 col-md-4 col-lg-4 col-xxl-3 d-flex align-items-center justify-content-between">
                                <span>Title</span>
                            </div>
                            <div class="col-4 col-md-3 col-xl-3 col-xxl-2 d-none d-md-flex d-lg-none d-xl-flex align-items-center justify-content-between">
                                <span>Employer</span>
                            </div>
                            <div class="d-flex d-flex col-4 col-md-3 col-lg-5 col-xl-2 align-items-center justify-content-start">
                                <div class="align-items-center col-5 col-md-6 col-lg-5 col-xl-8 col-xxl-8 d-flex">
                        <span class="d-inline-block">
                            Type
                        </span>
                                </div>

                                <div class="text-center align-items-center d-none col-3 justify-content-center">
                        <span class="d-inline-block text-center">
                            Notes
                        </span>
                                </div>

                                <div class="d-none d-sm-flex align-items-center justify-content-center col-3">
                        <span class="d-inline-block text-center">
                            Url
                        </span>
                                </div>
                            </div>
                            <div
                                    style="width: max-content"
                                    class="ms-3 ms-lg-4 d-none d-xxl-flex align-items-center justify-content-between">
                                <span class="text-truncate">Follow-up</span>
                            </div>
                        </div>
                    </div>
                    <ul id="announcementsList" class="ps-0"></ul>
                    <div class="w-100 d-flex justify-content-evenly">
                        <a class="text-white mb-1 text-decoration-underline link-offset-3"
                           href="/pages/Sprint_5/AdminAnnouncementForm.html">
                            Send announcement
                        </a>
                        <button onclick="changeDisplay('announcementSlide', 'userSlide')" class="text-white mb-1 text-decoration-underline bg-transparent border-0 link-offset-3"
                           >
                            View Users
                        </button>
                        <button onclick="changeDisplay('announcementSlide', 'appSlide')" class="text-white mb-1 text-decoration-underline bg-transparent border-0 link-offset-3"
                               >
                            View Apps
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="footerPlaceholder"></div>
    <script src="./scripts/navBar.js"></script>
    <script src="./scripts/displayUsersAdmin.js"></script>
    <script src="./scripts/displayApplications.js"></script>
    <script src="./scripts/deleteApplication.js"></script>
    <script src="./scripts/alterUser.js"></script>
    <script src="./scripts/makeAdmin.js"></script>
    <script src="./scripts/helperFunction.js"></script>
 
</body>
</html>

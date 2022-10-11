<?php

// Authorization - Access Control
// check Whether the user is logged in or not
if (!isset($_SESSION['user'])) {
    // user is not logged in
    // redirect to login with message
    $_SESSION['no-login-message'] = "<div class='error-message text-center'>Please login to get acccess</div>";
    // redirect to login page
    header('Location:' . SITEURL . 'admin/login.php');
}

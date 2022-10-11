<?php
// include constants.php for SITEURL
include('../config/constants.php');
// 1. destroy the section (also unset $_SESSION['user']) 
session_destroy();

// 2. redirect to login page
header('Location:' . SITEURL . 'admin/login.php');

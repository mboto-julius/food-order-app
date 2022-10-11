<?php
// include constants.php for SITEURL
include('../config/constants.php');
// 1. destroy the section 
session_destroy();

// 2. redirect to login page
header('LOcation:' . SITEURL . 'admin/login.php');

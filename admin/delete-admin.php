<?php

// include constants.php file here
include('../config/constants.php');

// 1. Get the ID of the user to be deleted
echo $id = $_GET['id'];

// 2. Create SQL Query to Delete User
$query = "DELETE FROM users WHERE id=$id";

// execute the query
$result = mysqli_query($connection, $query);

// check whether the query is executed successfully or not
if ($result == TRUE) {
    // query executed successful and user deleted
    // echo "User deleted successful";
    // create session variable to display message
    $_SESSION['delete'] = "<div class='success-message'>User deleted successful</div>";
    // Redirect to Manage Admin Page
    header('Location:' . SITEURL . 'admin/manage-admin.php');
} else {
    // failed to delete user
    // echo "Failed to delete user";
    // create session variable to display message
    $_SESSION['delete'] = "<div class='error-message'>User deleted Fail</div>";
    // Redirect to Manage Admin Page
    header('Location:' . SITEURL . 'admin/manage-admin.php');
}

// 3. Redirect to Manage Admin Page with message (success or error)
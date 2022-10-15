<?php

// include constant page
include('../config/constants.php');

// check whether the id and image_name value is set or not
if (isset($_GET['id']) && isset($_GET['image_name'])) {

    // Process to delete
    // 1. get id and image name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // 2. remove the image name
    if ($image_name != "") {

        // image is available so remove it
        $path = "/var/www/foodapp/images/food/" . $image_name;

        // remove the image
        $remove = unlink($path);

        // if fail to remove image then add an error message and stop the process
        if ($remove == false) {
            // set the session message
            $_SESSION['remove-food'] = "<div class='error-message'>Failed to remove image file</div>";
            // redirect to manage food page
            header('Location:' . SITEURL . 'admin/manage-food.php');
            // stop the process
            die();
        }
    }

    // 3. delete food from database
    $query = "DELETE FROM foods WHERE id=$id";

    // execute the query
    $result = mysqli_query($connection, $query);

    // check whether the data is delete from database
    if ($result == true) {

        // set success message and redirects
        $_SESSION['delete-food'] = "<div class='success-message'>Food Deleted Successfully</div>";

        // redirect to manage category page
        header('Location:' . SITEURL . 'admin/manage-food.php');
    } else {

        // set fail message and redirects
        $_SESSION['delete-food'] = "<div class='error-message'>Failed to Delete Food</div>";

        // redirect to manage category page
        header('Location:' . SITEURL . 'admin/manage-food.php');
    }
} else {

    // redirect to manage food page
    $_SESSION['unauthorize'] = "<div class='error-message'>Unauthorized Acess</div>";
    header('Location:' . SITEURL . 'admin/manage-food.php');
}

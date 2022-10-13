<?php
// include constants file
include('../config/constants.php');

// check whether the id and image_name value is set or not
if (isset($_GET['id']) and isset($_GET['image_name'])) {
    //  get the value and delete
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];


    //  remove the physical image file is available
    if ($image_name != "") {
        // image is available so remove it
        $path = "/var/www/foodapp/images/category/" . $image_name;
        // remove the image
        $remove = unlink($path);

        // if fail to remove image then add an error message and stop the process
        if ($remove == false) {
            // set the session message
            $_SESSION['remove-category'] = "<div class='error-message'>Failed to remove category image</div>";
            // redirect to manage category page
            header('Location:' . SITEURL . 'admin/manage-category.php');
            // stop the process
            die();
        }
    }

    // delete data from database
    $query = "DELETE FROM categories WHERE id=$id";

    // execute the query
    $result = mysqli_query($connection, $query);

    // check whether the data is delete from database
    if ($result == true) {
        // set success message and redirects
        $_SESSION['delete-category'] = "<div class='success-message'>Category Deleted Successfully</div>";
        // redirect to manage category page
        header('Location:' . SITEURL . 'admin/manage-category.php');
    } else {
        // set fail message and redirects
        $_SESSION['delete-category'] = "<div class='error-message'>Failed to Delete Categoryx</div>";
        // redirect to manage category page
        header('Location:' . SITEURL . 'admin/manage-category.php');
    }
} else {
    // redirect to manage category page
    header('Location:' . SITEURL . 'admin/manage-category.php');
}

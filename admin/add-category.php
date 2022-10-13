<?php include('includes/menu.php'); ?>

<!-- Main Section Starts -->
<div class="main">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <!-- session message starts -->
        <?php

        // checking whether the session is set or not
        if (isset($_SESSION['add-category'])) {
            echo $_SESSION['add-category'];
            unset($_SESSION['add-category']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?>
        <!-- session message ends -->

        <br>
        <!-- Add Category Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="table-add-admin">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Categoty Title"></td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                        <!-- add multipart/form-data for upload to form tag -->
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                        <input type="submit" name="submit" value="Add Category" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add Category Form Ends -->

        <?php
        // check whether the submit button is clicked or not
        if (isset($_POST['submit'])) {
            // echo "clicked";
            // 1. get the value from form
            $title = $_POST['title'];

            // for input type radio we need to check whether the button is selected or not
            if (isset($_POST['featured'])) {
                // if selected get the value from form
                $featured = $_POST['featured'];
            } else {
                // if not selected, set the default value
                $featured = "No";
            }

            if (isset($_POST['active'])) {
                // if selected get the value from form
                $active = $_POST['active'];
            } else {
                // if not selected, set the default value
                $active = "No";
            }

            // check whether the image is selected or not and set the value for image name accordingly
            // print_r($_FILES['image']);
            // the break the code
            //die();
            //  Array ( [name] => pizza.jpeg [full_path] => pizza.jpeg [type] => image/jpeg [tmp_name] => /tmp/phpW5hlKn [error] => 0 [size] => 660158 ) 
            if (isset($_FILES['image']['name'])) {
                // upload the image
                // to upload image we need image name, source path and destination path
                $image_name = $_FILES['image']['name'];
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = '/var/www/foodapp/images/category/' . $image_name;

                // finally upload the image
                $upload = move_uploaded_file($source_path, $destination_path);

                // check whether the image is uploaded or not
                // and if the image is not uploaded the we will stop the process and redirect with error message
                if ($upload == false) {
                    // set message
                    $_SESSION['upload'] = "<div class='error-message'>Failed to upload the Image.</div>";
                    // redirect to add category page
                    header('Location:' . SITEURL . 'admin/add-category.php');
                    // stop the process
                    die();
                }
            } else {
                // dont upload image and set the image name value as blank
                $image_name = "";
            }

            // 2. create sql query to insert category into database
            $query = "INSERT INTO categories SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
            ";

            // 3. Execute the query and save in databases
            $result = mysqli_query($connection, $query);

            // 4. Check whether the query executed or not and data is added or not
            if ($result == true) {
                // Query executed and Category added
                $_SESSION['add-category'] = "<div class='success-message'>Category Added Successfully</div>";
                // redirect to manage category Page
                header('Location:' . SITEURL . 'admin/manage-category.php');
            } else {
                // Fail to add category 
                $_SESSION['add-category'] = "<div class='error-message'>Failed to Add Category</div>";
                // redirect to add category Page
                header('Location:' . SITEURL . 'admin/add-category.php');
            }
        }

        ?>

    </div>
</div>
<!-- Main Section Ends -->

<?php include('includes/footer.php'); ?>
<?php include('includes/menu.php'); ?>

<!-- Main Section Starts -->
<div class="main">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php
        // check whether the id is set or not
        if (isset($_GET['id'])) {
            // get the id and all other details
            $id = $_GET['id'];

            // create sql query to get all other details
            $query = "SELECT * FROM categories WHERE id=$id";

            // execute the query
            $result = mysqli_query($connection, $query);

            // count the rows to check whether the id is valid or not
            $count = mysqli_num_rows($result);

            if ($count == 1) {
                // get all the data
                $row = mysqli_fetch_assoc($result);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                // redirect to manage category with session message
                $_SESSION['no-category-found'] = "<div class='error-message'>Category not found</div>";
                header('Location:' . SITEURL . 'admin/manage-category.php');
            }
        } else {
            // redirect to manage category
            header('Location:' . SITEURL . 'admin/manage-category.php');
        }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="table-add-admin">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            // display the image
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="200px">
                        <?php
                        } else {
                            // display message
                            echo "<div class='error-message'>Image not added</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php
                                if ($featured == "Yes") {
                                    echo "checked";
                                }
                                ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php
                                if ($featured == "No") {
                                    echo "checked";
                                }
                                ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php
                                if ($active == "Yes") {
                                    echo "checked";
                                }
                                ?> type="radio" name="active" value="Yes">Yes
                        <input <?php
                                if ($active == "No") {
                                    echo "checked";
                                }
                                ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>

        <!-- dealing with submit button -->
        <?php
        if (isset($_POST['submit'])) {
            // 1. get all the value from our form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            // 2. updating new image if selected
            // check whether the image is selected or not
            if (isset($_FILES['image']['name'])) {

                // get the image details
                $image_name = $_FILES['image']['name'];

                // check whether the image is available or not
                if ($image_name != "") {

                    // image available
                    //A. upload the new image 

                    // Auto rename our image
                    // get the extension of our image (jpg, png, gif, etc) "food1.jpg"
                    $extension = end(explode('.', $image_name));

                    // rename the image
                    $image_name = "food_category_" . rand(000, 999) . '.' . $extension;

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
                        header('Location:' . SITEURL . 'admin/manage-category.php');
                        // stop the process
                        die();
                    }

                    //B.  remove the current image if available
                    if ($current_image !== "") {
                        $removePath = "/var/www/foodapp/images/category/" . $current_image;

                        $remove = unlink($removePath);

                        // check whether the image is removed or not 
                        // if failed to remove then display message and stop the process
                        if ($remove == false) {
                            // Failed to remove image
                            $_SESSION['failed-remove'] = "<div class='error-message'>Failed to remove current image.</div>";
                            header('Location:' . SITEURL . 'admin/manage-category.php');
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            // 3. update the database
            $queryUpdate = "UPDATE categories SET 
                title = '$title',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active'
                WHERE id=$id
            ";

            //Execute the query
            $resultUpdate = mysqli_query($connection, $queryUpdate);

            // 4. redirect to manage category with message
            // check whether executed or not
            if ($resultUpdate == true) {
                // Category updated
                $_SESSION['update-category'] = "<div class='success-message'>Category Updated Successfully</div>";
                header('Location:' . SITEURL . 'admin/manage-category.php');
            } else {
                // failed to update category
                $_SESSION['update-category'] = "<div class='error-message'>Failed to update category</div>";
                header('Location:' . SITEURL . 'admin/manage-category.php');
            }
        }

        ?>

    </div>
</div>
<!-- Main Section Ends -->

<?php include('includes/footer.php'); ?>
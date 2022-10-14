<?php include('includes/menu.php'); ?>

<!-- Main Section Starts -->
<div class="main">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php

        if (isset($_SESSION['upload-food'])) {
            echo $_SESSION['upload-food'];
            unset($_SESSION['upload-food']);
        }


        ?>

        <!-- Add Food Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="table-add-admin">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Food Title"></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30" rows="5" placeholder="Description"></textarea></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price"></td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                        <!-- add multipart/form-data for upload to form tag -->
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category" class="custom-select">

                            <?php
                            // diplay category from database
                            //1. sql query to get all active category from database
                            $query = "SELECT * FROM categories WHERE active='Yes'";

                            // executing the query
                            $result = mysqli_query($connection, $query);

                            // count rows to check whether  we have categories or not
                            $count = mysqli_num_rows($result);

                            // if count is greater than zero, then we have category else we dont
                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // get the details of category
                                    $id = $row['id'];
                                    $title = $row['title'];

                            ?>

                                    <!-- // 2. display on dropdown -->
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                <?php

                                }
                            } else {
                                ?>
                                <option value="0">No Category Found</option>
                            <?php
                            }

                            ?>

                        </select>
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
                        <input type="submit" name="submit" value="Add Food" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add Food Form Ends -->


        <?php
        // check whether the button is clicked or not
        if (isset($_POST['submit'])) {
            // add food to the database
            // 1. Get the Data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            // check whether the radio button for featured and active are chacked or not
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

            // 2. Upload the image if selected
            // checked whether selected image is clicked or not and upload the image only if the image is selected
            if (isset($_FILES['image']['name'])) {

                // get the details of the selected image
                $image_name = $_FILES['image']['name'];

                // check whether the image is selected or not and upload image only if selected
                if ($image_name != "") {
                    // this means image is selected
                    // A. rename the image
                    // get the extension of selected image (jpg, png, gif etc) 
                    $extension = end(explode(".", $image_name));

                    // create new name for image (name will be like Food-Name-666.jpg)
                    $image_name = "Food-Name-" . rand(0000, 9999) . "." . $extension;

                    // B. upload the image
                    // get the source path and destionation path
                    // source path is the current location of the image
                    $srcPath = $_FILES['image']['tmp_name'];

                    // destination path for the image to be uploaded    
                    $dstPath = '/var/www/foodapp/images/food/' . $image_name;

                    // finally upload food image
                    $upload = move_uploaded_file($srcPath, $dstPath);

                    // check whether image uploaded or not
                    if ($upload == false) {
                        // set message
                        $_SESSION['upload-food'] = "<div class='error-message'>Failed to upload the Image.</div>";
                        // redirect to add category page
                        header('Location:' . SITEURL . 'admin/add-food.php');
                        // stop the process
                        die();
                    }
                }
            } else {

                // setting default value as blank
                $image_name = "";
            }


            // 3. Insert  into the database
            // create a sql query to save or add food
            $queryInsert = "INSERT INTO foods SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'  
            ";

            // execute the query
            $resultInsert = mysqli_query($connection, $queryInsert);

            // check whether data is inserted or not
            // 4. Redirect with message to manage food page
            if ($resultInsert == true) {
                // Data inserted successfully
                $_SESSION['add-food'] = "<div class='success-message'>Food Added Successfully</div>";
                header('Location:' . SITEURL . 'admin/manage-food.php');
            } else {
                // Failed to insert data
                $_SESSION['add-food'] = "<div class='error-message'>Failed to Add Food</div>";
                header('Location:' . SITEURL . 'admin/manage-food.php');
            }
        }

        ?>
    </div>
</div>
<!-- Main Section Ends -->

<?php include('includes/footer.php'); ?>
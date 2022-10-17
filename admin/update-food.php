<?php include('includes/menu.php'); ?>

<?php

// check whether id is set or not
if (isset($_GET['id'])) {

    // get all the details
    $id = $_GET['id'];

    // sql query to get the selected food
    $sql2 = "SELECT * FROM foods WHERE id=$id";

    // execute the query
    $result2 = mysqli_query($connection, $sql2);

    // get the value based on query executed
    $row2 = mysqli_fetch_assoc($result2);

    // get the individual values of selected food
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];

    // 
} else {

    // redirect to manage food
    header('Location:' . SITEURL . 'admin/manage-food.php');
}

?>

<!-- Main Section Starts -->
<div class="main">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <!-- Add Food Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="table-add-admin">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><input type=" number" name="price" value="<?php echo $price; ?>"></td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <!-- display image if available -->
                        <?php

                        if ($current_image == "") {
                            // image not available
                            echo "<div class='error-message'>Image Not Available.</div>";
                        } else {
                            // image available
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="200px">
                        <?php
                        }

                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category" class="custom-select">

                            <?php

                            // query to get active categories
                            $sql = "SELECT * FROM categories WHERE active='Yes'";

                            // execute the query
                            $result = mysqli_query($connection, $sql);

                            // count rows
                            $count = mysqli_num_rows($result);

                            // check whether category available or not
                            if ($count > 0) {

                                // category available
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];

                                    // echo "<option value='$category_id'>$category_title</option>";
                            ?>

                                    <option <?php if ($current_category ==  $category_id) {
                                                echo "selected";
                                            } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

                            <?php

                                }
                            } else {

                                // category not available
                                echo "<option value='0' class='error-message'>Category Not Available.</option>";
                            }

                            ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured">Yes
                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                } ?> type="radio" name="featured">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active">Yes
                        <input <?php if ($active == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="$current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add Food Form Ends -->

        <?php

        if (isset($_POST['submit'])) {

            // 1. Get all the details from the form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['image_name'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            // 2. upload the image if selected
            // check whether the upload button is clicked or not
            if (isset($_FILES['image']['name'])) {
                // upload button clicked
                $image_name = $_FILES['image']['name'];

                // check whether the file is available or not
                if ($image_name != "") {
                    // get the extension of the image
                    $extension = end(explode('.', $image_name));

                    // this will rename image
                    $image_name = "Food-Name-" . rand(0000, 99999) . '.' . $extension;

                    $srcPath = $_FILES['image']['tmp_name'];
                    $destPath = "../images/food/" . $image_name;

                    // upload the image
                    $upload = move_uploaded_file($srcPath, $destPath);

                    // check whether the image is uploaded or not
                    if ($upload == false) {
                        // failed to upload
                        $_SESSION['upload-image'] = "<div class='error-message'>Failed to upload new image</div>";
                        // redirect to manage food
                        header('Location:' . SITEURL . 'admin/manage-food.php');
                        // stop the process
                        die();
                    }

                    // 3. remove the current image if new image is uploaded and current image exists
                    if ($current_image != "") {
                        $removePath = "../images/food" . $image_name;

                        $remove = unlink($removePath);

                        // check whether the image is removed or not
                        if ($remove == false) {
                            $_SESSION['upload-image'] = "<div class='error-message'>Failed to remove the current image</div>";
                            // redirect to manage food
                            header('Location:' . SITEURL . 'admin/manage-food.php');
                            // stop the process
                            die();
                        }
                    }
                }
            }


            // 4. update the food in database
            $query3 = "UPDATE foods SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active' 
                WHERE id=$id 
          ";

            // Execute the query 
            $result3 = mysqli_query($connection, $query3);

            // check whether the query is executed or not
            if ($result3 == true) {
                // query execute and food update
                $_SESSION['update'] = "<div class='success-message'>Food Update Successfully</div>";
                header('Location:' . SITEURL . 'admin/manage-food.php');
            } else {
                // failed to update food
                $_SESSION['update'] = "<div class='error-message'>Food Update Successfully</div>";
                header('Location:' . SITEURL . 'admin/manage-food.php');
            }
        }

        ?>

    </div>
</div>
<!-- Main Section Ends -->

<?php include('includes/footer.php'); ?>
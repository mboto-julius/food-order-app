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
                                ?> type="radio" name="active" value="Yes">Yes
                        <input <?php
                                if ($featured == "No") {
                                    echo "checked";
                                }
                                ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php
                                if ($active == "Yes") {
                                    echo "checked";
                                }
                                ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php
                                if ($active == "No") {
                                    echo "checked";
                                }
                                ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                        <input type="submit" name="submit" value="Update Category" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<!-- Main Section Ends -->

<?php include('includes/footer.php'); ?>
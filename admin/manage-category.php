<?php

include('includes/menu.php');

?>

<!-- Main Section Starts -->
<div class="main">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br><br>

        <!-- session message starts -->
        <?php

        // checking whether the session is set or not
        if (isset($_SESSION['add-category'])) {
            echo $_SESSION['add-category'];
            unset($_SESSION['add-category']);
        }

        if (isset($_SESSION['remove-category'])) {
            echo $_SESSION['remove-category'];
            unset($_SESSION['remove-category']);
        }

        if (isset($_SESSION['delete-category'])) {
            echo $_SESSION['delete-category'];
            unset($_SESSION['delete-category']);
        }

        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }



        ?>
        <!-- session message ends -->

        <!-- button Starts-->
        <br>
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br>
        <br>
        <!-- button Ends -->

        <!-- table Starts-->
        <table class="table-width">
            <tr>
                <th>S/N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php

            // query to get all  categories from database
            $query = "SELECT * FROM categories";
            // ecxecute query
            $result = mysqli_query($connection, $query);
            // counts rows
            $count = mysqli_num_rows($result);
            // create a serial number variable
            $sn = 1;
            // check whether we have data in database or not
            if ($count > 0) {
                // we have data in database
                // get the data and display (while loop will continue as long as we have database   )
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

            ?>

                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>

                        <td>
                            <?php
                            // echo $image_name; 
                            if ($image_name != "") {
                                // display the image
                            ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="200px">
                            <?php
                            } else {
                                // display the message
                                echo "<div class='error-message'>Image not added</div>";
                            }
                            ?>
                        </td>

                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete</a>
                        </td>
                    </tr>


                <?php
                }
            } else {
                // we do not have data
                // we will display the message inside table
                ?>

                <tr>
                    <td colspan="6">
                        <div class="error-message">No category Added.</div>
                    </td>
                </tr>

            <?php
            }

            ?>
        </table>
        <!-- table Ends -->
    </div>
</div>
<!-- Main Section Ends -->

<?php

include('includes/footer.php');

?>
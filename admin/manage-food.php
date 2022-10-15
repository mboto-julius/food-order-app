<?php

include('includes/menu.php');

?>

<!-- Main Section Starts -->
<div class="main">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <!-- button Starts-->
        <br>
        <br>

        <?php

        if (isset($_SESSION['add-food'])) {
            echo $_SESSION['add-food'];
            unset($_SESSION['add-food']);
        }

        if (isset($_SESSION['delete-food'])) {
            echo $_SESSION['delete-food'];
            unset($_SESSION['delete-food']);
        }

        if (isset($_SESSION['remove-food'])) {
            echo $_SESSION['remove-food'];
            unset($_SESSION['remove-food']);
        }


        if (isset($_SESSION['unauthorize'])) {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
        }


        ?>

        <br>
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br>
        <br>
        <br>
        <!-- button Ends -->

        <!-- table Starts-->
        <table class="table-width">
            <tr>
                <th>S/N</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>

            <?php
            // create sql query to get all data the food
            $query = "SELECT * FROM foods";

            // execute rows to check whether we have foods or not
            $result = mysqli_query($connection, $query);

            // count rows to check whether we have foods or not
            $count = mysqli_num_rows($result);

            // create serial number variable and set the default value as 1
            $sn = 1;

            if ($count > 0) {

                // we have food in the database
                // get the food from database and display
                while ($row = mysqli_fetch_assoc($result)) {

                    // get the value from individual column
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

            ?>

                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td>$<?php echo $price; ?></td>
                        <td>
                            <?php
                            // check whether we have image or not
                            if ($image_name == "") {
                                // we dont have image, display error message
                                echo "<div class='error-message'>Image not added</div>";
                            } else {

                                // we have image, display image

                            ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="150px">
                            <?php

                            }
                            ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete</a>
                        </td>
                    </tr>

            <?php
                }
            } else {

                // food not added in database
                echo "<tr><td colspan='7' class='error-message'>Food Not Added Yet.</td></tr>";
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
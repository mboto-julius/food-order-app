<?php include('includes/menu.php'); ?>

<!-- Main Section Starts -->
<div class="main">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>
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
    </div>
</div>
<!-- Main Section Ends -->

<?php include('includes/footer.php'); ?>
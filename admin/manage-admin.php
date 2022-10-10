<?php

include('includes/menu.php');

?>

<!-- Main Section Starts -->
<div class="main">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br>
        <!-- session message starts -->
        <?php
        // checking whether the session is set or not
        if (isset($_SESSION['add'])) {
            // display session message
            echo $_SESSION['add'];
            // removing session message
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }


        ?>
        <br>
        <!-- session message ends -->

        <!-- button Starts-->
        <br>
        <br>
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br>
        <br>
        <!-- button Ends -->

        <!-- table Starts-->
        <table class="table-width">
            <tr>
                <th>S/N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <!-- displaying users from database -->

            <?php
            // query to get all admin from database
            $query = "SELECT * FROM users";
            // execute the query
            $result = mysqli_query($connection, $query);
            // check whether the query is executed or not
            if ($result == TRUE) {
                // count rows to check whether we have data in database or not
                $count = mysqli_num_rows($result);

                // create variable for incrementing s/n 
                $sn = 1;

                // check the num of rows
                if ($count > 0) {
                    // we have data in database
                    while ($rows = mysqli_fetch_assoc($result)) {
                        // while loop to get the data from databases | will run as long as we have data in database
                        // get individual data
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        // display the values our table
            ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete</a>
                            </td>
                        </tr>

            <?php
                    }
                } else {
                    // we dont have data in database
                }
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
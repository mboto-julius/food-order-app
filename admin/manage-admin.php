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
                            <td><?php echo $id; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td>
                                <a href="" class="btn-secondary">Update</a>
                                <a href="" class="btn-danger">Delete</a>
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
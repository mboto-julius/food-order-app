<?php include('includes/menu.php'); ?>

<div class="main">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php

        // get the ID of selected admin
        $id = $_GET['id'];

        // create sql query to get the details
        $query = "SELECT * from users where id=$id";

        // execute the  query
        $result = mysqli_query($connection, $query);

        // check whether the query is executed or not
        if ($result == TRUE) {
            // check whether the data is available or not
            $count = mysqli_num_rows($result);
            // check whether we have admin data or not
            if ($count == 1) {
                // Get the details
                $row = mysqli_fetch_assoc($result);
                $full_name = $row['full_name'];
                $username = $row['username'];
            } else {
                // Redirect the Manage Admin Page
                header('Location:' . SITEURL . 'admin/manage-admin.php');
            }
        }

        ?>
        <form action="" method="POST">

            <table class="table-add-admin">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" value="<?php echo $username ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Update" class="btn-primary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<!-- update when submit button is clicked -->
<?php

// check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    // echo "Button is clicked";
    // get all the values from form to update
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    // sql query to update admin
    $query = "UPDATE users SET
              full_name = '$full_name',
               username = '$username'
               WHERE id = '$id'
            ";

    // execute the query

    $result = mysqli_query($connection, $query);

    // check whether the query executed successful or not
    if ($result == true) {
        // query executed and admin updated
        $_SESSION['update'] = "<div class='success-message'>User Updated Successfully</div>";
        // redirect to Manage Admin Page
        header('Location:' . SITEURL . 'admin/manage-admin.php');
    } else {
        // failed to updated admin
        $_SESSION['update'] = "<div class='success-message'>Failed to Delete Admin</div>";
        // redirect to Manage Admin Page
        header('Location:' . SITEURL . 'admin/manage-admin.php');
    }
}

?>


<?php include('includes/footer.php'); ?>
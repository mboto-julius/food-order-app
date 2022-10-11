<?php include('includes/menu.php'); ?>

<!-- Main Section Starts -->
<div class="main">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        ?>

        <form action="" method="POST">
            <table class="table-add-admin">
                <tr>
                    <td>Current Password: </td>
                    <td><input type="password" name="current_password" placeholder="Current assword"></td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td><input type="password" name="new_password" placeholder="New Password"></td>
                </tr>
                <tr>
                    <td>Confirm Password: </td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<!-- Main Section Ends -->

<?php

// check whether the submit button is clicked or not
if (isset($_POST['submit'])) {

    // 1. get the data from form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    // 2. check whether the user with current id and password exists or not 
    $query = "SELECT * FROM users WHERE id=$id AND password='$current_password'";

    // execute the query
    $result = mysqli_query($connection, $query);

    if ($result == TRUE) {
        // check whether the data is available or not
        $count = mysqli_num_rows($result);

        if ($count == 1) {
            // user exists and password can be changed
            // check if the new password and current password match
            if ($new_password == $confirm_password) {
                // update the password
                $query1 = "UPDATE users SET password='$new_password' WHERE id=$id";

                //execute the query
                $result1 = mysqli_query($connection, $query1);

                // check whether the data is available or not
                if ($result1 == TRUE) {
                    // display the success message 
                    $_SESSION['password-changed'] = "<div class='success-message'>Password Changed Successfully.</div>";
                    // redirect the user
                    header("Location: " . SITEURL . 'admin/manage-admin.php');
                } else {
                    // display error message
                    $_SESSION['password-not-match'] = "<div class='error-message'>Failed to change password.</div>";
                    // redirect the user
                    header("Location: " . SITEURL . 'admin/manage-admin.php');
                }
            } else {
                // redirect to manage admin page with error message
                // user does not exits, set message and redirect
                $_SESSION['password-not-match'] = "<div class='error-message'>Password not match.</div>";
                // redirect the user
                header("Location: " . SITEURL . 'admin/manage-admin.php');
            }
        } else {
            // user does not exits, set message and redirect
            $_SESSION['user-not-found'] = "<div class='error-message'>User not found.</div>";
            // redirect the user
            header("Location: " . SITEURL . 'admin/manage-admin.php');
        }
    }

    // 3. check whether the new password and confirm password math or not

    // 4. change password if all above is true

}

?>

<?php include('includes/footer.php'); ?>
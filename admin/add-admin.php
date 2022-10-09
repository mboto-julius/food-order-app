<?php include('includes/menu.php'); ?>

<!-- Main Section Starts -->
<div class="main">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>
        <form action="" method="POST">
            <table class="table-add-admin">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Enter Your Username"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter Your Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<!-- Main Section Ends -->

<?php include('includes/footer.php'); ?>

<?php
// process the value from form and save it to the database

if (isset($_POST['submit'])) {

    // get the data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    // password encryption with MD5
    $password = md5($_POST['password']);

    // sql query to save the data into the database 
    $query = "INSERT INTO users SET
            full_name = '$full_name',
            username = '$username',
            password = '$password'
            ";

    // executing query and save data to the database
    $result = mysqli_query($connection, $query);

    // check whether the query is executed or not
    if ($result == TRUE) {
        echo "Data is inserted successful";
    } else {
        echo "Failed to insert data";
    }
}
?>
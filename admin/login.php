<?php include('../config/constants.php') ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br>

        <?php

        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        ?>

        <br>

        <!-- login form starts here -->
        <form action="" method="POST" class="text-center">
            <label for="username">Username: </label>
            <input type="text" name="username" placeholder="Enter Username">
            <br><br>
            <label for="Password">Password: </label>
            <input type="password" name="password" placeholder="Enter Password">
            <br><br><br>
            <div class="text-center">
                <input type="submit" name="submit" value="submit" class="btn-primary">
            </div>
        </form>
        <!-- login form ends here -->

        <br><br><br>
        <p class="text-center">Created By - <a href="#">Julius Mboto</a> </p>
    </div>
</body>

</html>


<?php

// check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    // process for login
    // 1. get the data from login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // 2. sql to check whether the user with username and password exists or not
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";

    // 3. execute the query
    $result = mysqli_query($connection, $query);

    // 4. count rows to check whether the user exists or not
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        // user available and login success message
        $_SESSION['login'] = "<div class='success-message'>Login Successful</div>";
        // redirect to home page/dashboard
        header('Location:' . SITEURL . 'admin/');
    } else {
        // user not available
        $_SESSION['login'] = "<div class='error-message text-center'>Username or Password did not match</div>";
        // redirect to login page
        header('Location:' . SITEURL . 'admin/login.php');
    }
}

?>
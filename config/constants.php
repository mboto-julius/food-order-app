<!-- db connection -->
<?php

// constant values
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'adminfood');
define('DB_PASSWORD', 'mysql-Password-2022');
define('DB_NAME', 'foodapp');


$connection = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (!$connection) {
    die('connection failed' . mysqli_connect_error());
}

?>
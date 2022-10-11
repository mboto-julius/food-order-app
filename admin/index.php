<?php

include('includes/menu.php');

?>

<!-- Main Section Starts -->
<div class="main">
    <div class="wrapper">
        <h1>Dashboard</h1>

        <br>
        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>
        <br>

        <div class="main-col">
            <div class="col-4 text-center">
                <h1>5</h1><br>
                <p>Categories</p>
            </div>
            <div class="col-4 text-center">
                <h1>5</h1><br>
                <p>Categories</p>
            </div>
            <div class="col-4 text-center">
                <h1>5</h1><br>
                <p>Categories</p>
            </div>
            <div class="col-4 text-center">
                <h1>5</h1><br>
                <p>Categories</p>
            </div>
        </div>
    </div>
</div>
<!-- Main Section Ends -->

<?php

include('includes/footer.php');

?>
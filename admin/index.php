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
                <?php
                // sql query 
                $sql = "SELECT * FROM categories";
                // execute query
                $result = mysqli_query($connection, $sql);
                // count rows
                $count = mysqli_num_rows($result);
                ?>
                <h1><?php echo $count; ?></h1><br>
                <p>Categories</p>
            </div>
            <div class="col-4 text-center">
                <?php
                // sql query 
                $sql1 = "SELECT * FROM foods";
                // execute query
                $result1 = mysqli_query($connection, $sql1);
                // count rows
                $count1 = mysqli_num_rows($result1);
                ?>
                <h1><?php echo $count1; ?></h1><br>
                <p>Foods</p>
            </div>
            <div class="col-4 text-center">
                <?php
                // sql query 
                $sql2 = "SELECT * FROM orders";
                // execute query
                $result2 = mysqli_query($connection, $sql2);
                // count rows
                $count2 = mysqli_num_rows($result2);
                ?>
                <h1><?php echo $count2; ?></h1><br>
                <p>Total Orders</p>
            </div>
            <div class="col-4 text-center">

                <?php
                // sql query to get the total revenue generated
                // aggregate function in sql
                // once we delivery the food, only we get revenue
                $sql3 = "SELECT SUM(total) AS Total FROM orders WHERE status='Delivery'";

                $result3 = mysqli_query($connection, $sql3);

                $row3 = mysqli_fetch_assoc($result3);

                $total_revenue = $row3['Total'];

                ?>

                <h1>$<?php echo $total_revenue; ?></h1><br>
                <p>Revenue Generated</p>
            </div>
        </div>
    </div>
</div>
<!-- Main Section Ends -->

<?php

include('includes/footer.php');

?>
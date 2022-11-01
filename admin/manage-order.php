<?php

include('includes/menu.php');

?>

<!-- Main Section Starts -->
<div class="main">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br><br>

        <?php

        if (isset($_SESSION['order'])) {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }

        ?>

        <!-- table Starts-->
        <table class="table-width">
            <tr>
                <th>S/N</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Customer Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Action</th>
            </tr>

            <?php

            // get all the order from databases (ORDER BY to get the latest order)
            $sql = "SELECT * FROM orders ORDER BY id DESC";
            // execute query
            $result = mysqli_query($connection, $sql);
            // count the rows
            $count = mysqli_num_rows($result);

            // create a serial number and set its initial value as 1
            $sn = 1;

            if ($count > 0) {
                // order available
                while ($row = mysqli_fetch_assoc($result)) {
                    // get the order details
                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];

            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $food; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php echo $qty; ?></td>
                        <td><?php echo $total; ?></td>
                        <td><?php echo $order_date; ?></td>
                        <td>
                            <?php

                            if ($status == "Ordered") {
                                echo "<label>$status</label>";
                            } elseif ($status == "On Delivery") {
                                echo "<label style='color:orange;'>$status</label>";
                            } elseif ($status == "Delivery") {
                                echo "<label style='color:green;'>$status</label>";
                            } elseif ($status == "Cancelled") {
                                echo "<label style='color:red;'>$status</label>";
                            }

                            ?>
                        </td>
                        <td><?php echo $customer_name; ?></td>
                        <td><?php echo $customer_contact; ?></td>
                        <td><?php echo $customer_email; ?></td>
                        <td><?php echo $customer_address; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id ?>" class="btn-secondary">Update</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                // order not available
                echo "<tr><td colspan='12' class='error-message'>Orders not available</td></tr>";
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
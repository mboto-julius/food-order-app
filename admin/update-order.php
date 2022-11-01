<?php include('includes/menu.php') ?>

<div class="main">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php

        if (isset($_GET['id'])) {
            // get the order details
            $id = $_GET['id'];

            // get all other details based on this id
            $sql = "SELECT * FROM orders WHERE id='$id'";

            // execute query
            $result = mysqli_query($connection, $sql);

            // count rows
            $count = mysqli_num_rows($result);

            if ($count == 1) {
                // details available
                $row = mysqli_fetch_assoc($result);
                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];
            } else {
            }
        } else {
            // redirect to manage order page
            header('Location:' . SITEURL . 'admin/manage-order.php');
        }


        ?>

        <form action="" method="POST">

            <table class="table-add-admin">
                <tr>
                    <td>Food Name: </td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><b>$ <?php echo $price; ?></b></td>
                </tr>
                <tr>
                    <td>Qty: </td>
                    <td><input type="number" name="qty" value="<?php echo $qty ?>"></td>
                </tr>
                <tr>
                    <td>Status: </td>
                    <td>
                        <select name="status">
                            <option <?php if ($status == 'ordered') {
                                        echo 'selected';
                                    } ?> value="Ordered">Ordered</option>
                            <option <?php if ($status == 'On Delivery') {
                                        echo 'selected';
                                    } ?> value="On Delivery">On Delivery</option>
                            <option <?php if ($status == 'Delivery') {
                                        echo 'selected';
                                    } ?> value="Delivery">Delivery</option>
                            <option <?php if ($status == 'Cancelled') {
                                        echo 'selected';
                                    } ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name: </td>
                    <td><input type="text" name="customer_name" value="<?php echo $customer_name; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Contact: </td>
                    <td><input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Email: </td>
                    <td><input type="text" name="customer_email" value="<?php echo $customer_email; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Address: </td>
                    <td><textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="hidden" name="price" value="<?php echo $price ?>">
                        <input type="submit" name="submit" value="Update" class="btn-primary">
                    </td>
                </tr>
            </table>

        </form>

        <?php

        // check whether update button is clicked or not 
        if (isset($_POST['submit'])) {
            // echo "clicked";
            // get all the value from form 
            $id = $_POST['id'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];

            $total = $price * $qty;

            $status = $_POST['status'];
            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_address = $_POST['customer_address'];
        }

        $sql2 = "UPDATE orders SET
        qty = '$qty',
        total = '$total',
        status = '$status',
        customer_name = '$customer_name',
        customer_contact = '$customer_contact',
        customer_email = '$customer_email',
        customer_address = '$customer_address'
        WHERE id=$id;
        ";

        // execute the query
        $result2 = mysqli_query($connection, $sql2);

        // check whether the query executed successfully or nots
        if ($result2 == true) {
            $_SESSION['update-order'] = "<div class='success-message text-center'>Order Updated Successfully</div>";
            header('Location:' . SITEURL . 'admin/manage-order.php');
        } else {
            $_SESSION['update-order'] = "<div class='success-message text-center'>Failed to update order</div>";
            header('Location:' . SITEURL . 'admin/manage-order.php');
        }

        ?>
    </div>
</div>

<?php include('includes/footer.php') ?>
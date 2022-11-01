<?php include('includes/menu.php'); ?>

<?php

// check whether the food id is set or not
if (isset($_GET['food_id'])) {
  // get the food id and details of the selected food
  $food_id = $_GET['food_id'];
  // get the details of the selected food
  $sql = "SELECT * FROM foods WHERE id=$food_id";
  // execute the query
  $result = mysqli_query($connection, $sql);
  // count the rows
  $count = mysqli_num_rows($result);
  // check whether the data is available of not
  if ($count == 1) {
    // we have data, the get the data from the database
    $row = mysqli_fetch_assoc($result);
    $title = $row['title'];
    $price = $row['price'];
    $image_name = $row['image_name'];
  } else {
    // food is not available
    // redirect to home page
    header('Location: ' . SITEURL);
  }
} else {
  // redirect to home page
  header('Location: ' . SITEURL);
}

?>




<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
  <div class="container">
    <h2 class="text-center text-white">
      Fill this form to confirm your order.
    </h2>

    <form action="" method="POST" class="order">
      <fieldset>
        <legend>Selected Food</legend>

        <div class="food-menu-img">
          <?php
          if ($image_name == "") {

            // image not available
            echo "<div class='error-message'>Image not available.</div>";
          } else {

            // image available
          ?>
            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve" />
          <?php
          }

          ?>
        </div>

        <div class="food-menu-desc">
          <h3><?php echo $title; ?></h3>
          <input type="hidden" name="food" value="<?php echo $title; ?>">

          <p class="food-price">$<?php echo $price; ?></p>
          <input type="hidden" name="price" value="<?php echo $price; ?>">

          <div class="order-label">Quantity</div>
          <input type="number" name="qty" class="input-responsive" value="1" required />
        </div>
      </fieldset>

      <fieldset>
        <legend>Delivery Details</legend>
        <div class="order-label">Full Name</div>
        <input type="text" name="full-name" placeholder="E.g. Julius Mboto" class="input-responsive" required />

        <div class="order-label">Phone Number</div>
        <input type="tel" name="contact" placeholder="E.g. +255xxxxxx" class="input-responsive" required />

        <div class="order-label">Email</div>
        <input type="email" name="email" placeholder="E.g. juliusmboto@gmail.com" class="input-responsive" required />

        <div class="order-label">Address</div>
        <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

        <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary" />
      </fieldset>
    </form>


  </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php

if (isset($_POST['submit'])) {

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  // get all the details from the form
  $food = $_POST['food'];
  $price = $_POST['price'];
  $qty = $_POST['qty'];

  $total = $price * $qty;

  $order_date = date("Y-m-d h:i:s");

  // status like ordered, On Delivery, Delivered, Cancelled
  $status = "Ordered";

  $customer_name = $_POST['full-name'];
  $customer_contact = $_POST['contact'];
  $customer_email = $_POST['email'];
  $customer_address = $_POST['address'];

  // save the order in databases
  $sql2 = "INSERT INTO orders SET
  food = '$food',
  price = '$price',
  qty = '$qty',
  total = '$total',
  order_date = '$order_date',
  status = '$status',
  customer_name = '$customer_name',
  customer_contact = '$customer_contact',
  customer_email = '$customer_email',
  customer_address = '$customer_address'
  ";

  // execute the query
  $result2 = mysqli_query($connection, $sql2);

  // check whether the query executed successfully or nots
  if ($result2 == true) {
    $_SESSION['order'] = "<div class='success-message text-center'>Food Ordered Successfully</div>";
    header('Location:' . SITEURL);
  } else {
    $_SESSION['order'] = "<div class='error-message text-center'>Fail to Order Food.</div>";
    header('Location:' . SITEURL);
  }
}

?>


<?php include('includes/footer.php'); ?>
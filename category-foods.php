<?php include('includes/menu.php'); ?>

<?php
// check whether the id is passed or not.
if (isset($_GET['id'])) {

  // category_id is set and get the id
  $id = $_GET['id'];

  // get the category title based on category id
  $sql = "SELECT title FROM categories WHERE id=$id";

  // execute the query
  $result =  mysqli_query($connection, $sql);

  // get the value from databases
  $row = mysqli_fetch_assoc($result);

  // get the title
  $title = $row['title'];
} else {
  // category not passed
  header('Location:' . SITEURL);
}

?>



<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
  <div class="container">
    <h2>Foods on <a href="#" class="text-white">"<?php echo $title; ?>"</a></h2>
  </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
  <div class="container">
    <h2 class="text-center">Food Menu</h2>

    <?php

    // sql query to get foods based on selected category
    $sql2 = "SELECT * FROM foods WHERE category_id=$id";

    // execute the query
    $result2 = mysqli_query($connection, $sql2);

    // count the rows
    $count2 = mysqli_num_rows($result2);

    // check whether food is available or not
    if ($count2 > 0) {

      // food is available
      while ($rows2 = mysqli_fetch_assoc($result2)) {
        $title = $rows2['title'];
        $price = $rows2['price'];
        $description = $row2['description'];
        $image_name = $row2['image_name'];

    ?>

        <div class="food-menu-box">
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
            <h4><?php echo $title; ?></h4>
            <p class="food-price"><?php echo $price; ?></p>
            <p class="food-detail"><?php echo $description; ?></p>
            <br />

            <a href="#" class="btn btn-primary">Order Now</a>
          </div>
        </div>

    <?php

      }
    } else {

      // food is not available
      echo "<div class='error-message'>Food Not Available</div>";
    }

    ?>

    <div class="clearfix"></div>
  </div>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('includes/footer.php'); ?>
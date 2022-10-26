<?php include('includes/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
  <div class="container">
    <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
      <input type="search" name="search" placeholder="Search for Food.." required />
      <input type="submit" name="submit" value="Search" class="btn btn-primary" />
    </form>
  </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
  <div class="container">
    <h2 class="text-center">Food Menu</h2>

    <?php
    // display foods that are active
    $sql = "SELECT * FROM foods WHERE active='Yes'";

    // Execute the query
    $result = mysqli_query($connection, $sql);

    // count rows
    $count = mysqli_num_rows($result);

    // check whether the foods are available or not
    if ($count > 0) {
      // foods available
      while ($row = mysqli_fetch_assoc($result)) {
        // get the values
        $id = $row['id'];
        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    ?>

        <div class="food-menu-box">
          <div class="food-menu-img">
            <?php
            // check whether the image available or not
            if ($image_name == "") {
              // image not available
              echo "<div class='error-message'>Image not available</div>";
            } else {
              // image available
            ?>
              <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve" />
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
      // food not availble
      echo "<div class='error-message'>Food not found</div>";
    }

    ?>

    <div class="clearfix"></div>
  </div>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('includes/footer.php'); ?>
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
    // getting foods from database that are active and featured
    // sql query
    $sql1 = "SELECT * FROM foods WHERE active='Yes'";

    $result1 = mysqli_query($connection, $sql1);

    $count1 = mysqli_num_rows($result1);

    if ($count1 > 0) {
      // food available
      while ($row1 = mysqli_fetch_assoc($result1)) {
        // get all values
        $id = $row1['id'];
        $title = $row1['title'];
        $price = $row1['price'];
        $description = $row1['description'];
        $image_name = $row1['image_name'];
    ?>

        <div class="food-menu-box">
          <div class="food-menu-img">
            <?php
            // check whether image available or not
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
            <p class="food-price">$<?php echo $price; ?></p>
            <p class="food-detail"><?php echo $description; ?></p>
            <br />

            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
          </div>
        </div>

    <?php
      }
    }

    ?>

    <div class="clearfix"></div>
  </div>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('includes/footer.php'); ?>
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

<!-- CAtegories Section Starts Here -->
<section class="categories">
  <div class="container">
    <h2 class="text-center">Explore Foods</h2>

    <?php
    // create sql query to display categories from database
    $sql = "SELECT * FROM categories WHERE active='Yes' AND featured='Yes' LIMIT 3";

    // execute the query
    $result = mysqli_query($connection, $sql);

    // count row to check whether the category is available or not
    $count = mysqli_num_rows($result);

    if ($count > 0) {

      // categories available
      while ($row = mysqli_fetch_assoc($result)) {

        // get the values from databases
        $id = $row['id'];
        $title = $row['title'];
        $image_name = $row['image_name'];

    ?>

        <a href="<?php echo SITEURL; ?>category-foods.php?id=<?php echo $id; ?>">
          <div class="box-3 float-container">

            <?php
            // check whether the image is available or not
            if ($image_name == "") {
              // display image
              echo "<div class='error-message'>Image not available</div>";
            } else {

              // image available
            ?>
              <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" class="img-responsive img-curve" />
            <?php
            }

            ?>
            <h3 class="float-text text-white"><?php echo $title; ?></h3>
          </div>
        </a>

    <?php

      }
    } else {
      // categories not available
      echo "<div class='error-message'>Category not added.</div>";
    }


    ?>

    <div class="clearfix"></div>
  </div>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
  <div class="container">
    <h2 class="text-center">Food Menu</h2>

    <?php

    // getting foods from database that are active and featured
    $sql2 = "SELECT * FROM foods WHERE active='Yes' AND featured='Yes' LIMIT 6 ";

    $result2 = mysqli_query($connection, $sql2);

    $count2 = mysqli_num_rows($result2);

    // check whether food available or not
    if ($count2 > 0) {
      // food available
      while ($row = mysqli_fetch_assoc($result2)) {
        $id = $row['id'];
        $title = $row['title'];
        $price = $row['price'];
        $description = $row['description'];
        $image_name = $row['image_name'];
    ?>

        <div class="food-menu-box">
          <div class="food-menu-img">

            <?php
            if ($image_name == "") {
              // image not available
              echo "<div class='error-message'>Food not available.</div>";
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

            <a href="order.html" class="btn btn-primary">Order Now</a>
          </div>
        </div>

    <?php

      }
    } else {
      // food not available
      echo "<div class='error-message'>Food not available.</div>";
    }


    ?>

    <div class="clearfix"></div>
  </div>

  <p class="text-center">
    <a href="#">See All Foods</a>
  </p>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('includes/footer.php'); ?>
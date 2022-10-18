<?php include('includes/menu.php'); ?>

<!-- CAtegories Section Starts Here -->
<section class="categories">
  <div class="container">
    <h2 class="text-center">Explore Foods</h2>

    <?php

    // display all categories that are active
    $sql = "SELECT * FROM categories WHERE active='Yes'";

    // Execute the query
    $result = mysqli_query($connection, $sql);

    // count rows
    $count = mysqli_num_rows($result);

    // check whether categories available or not
    if ($count > 0) {
      // categories available
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $title = $row['title'];
        $image_name = $row['image_name'];
    ?>
        <a href="category-foods.html">
          <div class="box-3 float-container">

            <?php
            if ($image_name == "") {
              // image not available
              echo "<div class='error-message'>Image not found</div>";
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
      echo "<div class='error-message'>Categories not found</div>";
    }

    ?>

    <div class="clearfix"></div>
  </div>
</section>
<!-- Categories Section Ends Here -->

<?php include('includes/footer.php'); ?>
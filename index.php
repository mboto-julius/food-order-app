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

    <div class="food-menu-box">
      <div class="food-menu-img">
        <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve" />
      </div>

      <div class="food-menu-desc">
        <h4>Food Title</h4>
        <p class="food-price">$2.3</p>
        <p class="food-detail">
          Made with Italian Sauce, Chicken, and organice vegetables.
        </p>
        <br />

        <a href="order.html" class="btn btn-primary">Order Now</a>
      </div>
    </div>

    <div class="food-menu-box">
      <div class="food-menu-img">
        <img src="images/menu-burger.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve" />
      </div>

      <div class="food-menu-desc">
        <h4>Smoky Burger</h4>
        <p class="food-price">$2.3</p>
        <p class="food-detail">
          Made with Italian Sauce, Chicken, and organice vegetables.
        </p>
        <br />

        <a href="#" class="btn btn-primary">Order Now</a>
      </div>
    </div>

    <div class="food-menu-box">
      <div class="food-menu-img">
        <img src="images/menu-burger.jpg" alt="Chicke Hawain Burger" class="img-responsive img-curve" />
      </div>

      <div class="food-menu-desc">
        <h4>Nice Burger</h4>
        <p class="food-price">$2.3</p>
        <p class="food-detail">
          Made with Italian Sauce, Chicken, and organice vegetables.
        </p>
        <br />

        <a href="#" class="btn btn-primary">Order Now</a>
      </div>
    </div>

    <div class="food-menu-box">
      <div class="food-menu-img">
        <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve" />
      </div>

      <div class="food-menu-desc">
        <h4>Food Title</h4>
        <p class="food-price">$2.3</p>
        <p class="food-detail">
          Made with Italian Sauce, Chicken, and organice vegetables.
        </p>
        <br />

        <a href="#" class="btn btn-primary">Order Now</a>
      </div>
    </div>

    <div class="food-menu-box">
      <div class="food-menu-img">
        <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve" />
      </div>

      <div class="food-menu-desc">
        <h4>Food Title</h4>
        <p class="food-price">$2.3</p>
        <p class="food-detail">
          Made with Italian Sauce, Chicken, and organice vegetables.
        </p>
        <br />

        <a href="#" class="btn btn-primary">Order Now</a>
      </div>
    </div>

    <div class="food-menu-box">
      <div class="food-menu-img">
        <img src="images/menu-momo.jpg" alt="Chicke Hawain Momo" class="img-responsive img-curve" />
      </div>

      <div class="food-menu-desc">
        <h4>Chicken Steam Momo</h4>
        <p class="food-price">$2.3</p>
        <p class="food-detail">
          Made with Italian Sauce, Chicken, and organice vegetables.
        </p>
        <br />

        <a href="#" class="btn btn-primary">Order Now</a>
      </div>
    </div>

    <div class="clearfix"></div>
  </div>

  <p class="text-center">
    <a href="#">See All Foods</a>
  </p>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('includes/footer.php'); ?>
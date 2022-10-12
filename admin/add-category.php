<?php include('includes/menu.php'); ?>

<!-- Main Section Starts -->
<div class="main">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <!-- session message starts -->
        <?php

        // checking whether the session is set or not
        if (isset($_SESSION['add-category'])) {
            echo $_SESSION['add-category'];
            unset($_SESSION['add-category']);
        }

        ?>
        <!-- session message ends -->

        <br>
        <!-- Add Category Form Starts -->
        <form action="" method="POST">
            <table class="table-add-admin">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Categoty Title"></td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                        <input type="submit" name="submit" value="Add Category" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add Category Form Ends -->

        <?php
        // check whether the submit button is clicked or not
        if (isset($_POST['submit'])) {
            // echo "clicked";
            // 1. get the value from form
            $title = $_POST['title'];

            // for input type radio we need to check whether the button is selected or not
            if (isset($_POST['featured'])) {
                // if selected get the value from form
                $featured = $_POST['featured'];
            } else {
                // if not selected, set the default value
                $featured = "No";
            }

            if (isset($_POST['active'])) {
                // if selected get the value from form
                $active = $_POST['active'];
            } else {
                // if not selected, set the default value
                $active = "No";
            }

            // 2. create sql query to insert category into database
            $query = "INSERT INTO categories SET
                    title = '$title',
                    featured = '$featured',
                    active = '$active'
            ";

            // 3. Execute the query and save in databases
            $result = mysqli_query($connection, $query);

            // 4. Check whether the query executed or not and data is added or not
            if ($result ==  TRUE) {
                // Query executed and Category added
                $_SESSION['add-category'] = "<div class='success-message'>Category Added Successfully</div>";
                // redirect to manage category Page
                header('Location:' . SITEURL . 'admin/manage-category.php');
            } else {
                // Fail to add category 
                $_SESSION['add-category'] = "<div class='error-message'>Failed to Add Category</div>";
                // redirect to add category Page
                header('Location:' . SITEURL . 'admin/add-category.php');
            }
        }

        ?>

    </div>
</div>
<!-- Main Section Ends -->

<?php include('includes/footer.php'); ?>
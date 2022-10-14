<?php include('includes/menu.php'); ?>

<!-- Main Section Starts -->
<div class="main">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>
        <!-- Add Food Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="table-add-admin">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Food Title"></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30" rows="5" placeholder="Description"></textarea></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price"></td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                        <!-- add multipart/form-data for upload to form tag -->
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category" class="custom-select">
                            <option value="1">Food</option>
                            <option value="2">Drink</option>
                            <option value="3">Snacks</option>
                        </select>
                    </td>
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
                        <input type="submit" name="submit" value="Add Food" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add Food Form Ends -->
    </div>
</div>
<!-- Main Section Ends -->

<?php include('includes/footer.php'); ?>
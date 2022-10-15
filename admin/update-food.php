<?php include('includes/menu.php'); ?>

<!-- Main Section Starts -->
<div class="main">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <!-- Add Food Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="table-add-admin">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title"></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30" rows="5"></textarea></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price"></td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <!-- display image if available -->
                    </td>
                </tr>
                <tr>
                    <td>Select New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category" class="custom-select">
                            <option value="0">Test Category</option>
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
                        <input type="submit" name="submit" value="Update Food" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add Food Form Ends -->

    </div>
</div>
<!-- Main Section Ends -->

<?php include('includes/footer.php'); ?>
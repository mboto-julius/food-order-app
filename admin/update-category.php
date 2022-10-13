<?php include('includes/menu.php'); ?>

<!-- Main Section Starts -->
<div class="main">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="table-add-admin">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title"></td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        Image will be displayed here
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
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
                        <input type="submit" name="submit" value="Update Category" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<!-- Main Section Ends -->

<?php include('includes/footer.php'); ?>
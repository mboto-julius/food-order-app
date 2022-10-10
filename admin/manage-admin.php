<?php

include('includes/menu.php');

?>

<!-- Main Section Starts -->
<div class="main">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br>
        <!-- session message starts -->
        <?php
        // checking whether the session is set or not
        if (isset($_SESSION['add'])) {
            // display session message
            echo $_SESSION['add'];
            // removing session message
            unset($_SESSION['add']);
        }
        ?>
        <br>
        <!-- session message ends -->

        <!-- button Starts-->
        <br>
        <br>
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br>
        <br>
        <!-- button Ends -->

        <!-- table Starts-->
        <table class="table-width">
            <tr>
                <th>S/N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td>1.</td>
                <td>Julius Mboto</td>
                <td>mboto</td>
                <td>
                    <a href="" class="btn-secondary">Update</a>
                    <a href="" class="btn-danger">Delete</a>
                </td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Julius Mboto</td>
                <td>mboto</td>
                <td>
                    <a href="" class="btn-secondary">Update</a>
                    <a href="" class="btn-danger">Delete</a>
                </td>
            </tr>
            <tr>
                <td>3.</td>
                <td>Julius Mboto</td>
                <td>mboto</td>
                <td>
                    <a href="" class="btn-secondary">Update</a>
                    <a href="" class="btn-danger">Delete</a>
                </td>
            </tr>
        </table>
        <!-- table Ends -->
    </div>
</div>
<!-- Main Section Ends -->

<?php

include('includes/footer.php');

?>
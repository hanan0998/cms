<?php include 'includes/header.php'; ?>

<?php include 'functions.php'; ?>

<?php
if (isset($_GET['delete'])) {
    $the_cat_id = $_GET['delete'];
    $query = "DELETE FROM categories WHERE id = $the_cat_id";
    mysqli_query($connection, $query);
    header("Location: categories.php");
}

// Handle category update
if (isset($_POST['update'])) {
    $updated_cat_title = $_POST['cat_title'];
    $cat_id = $_POST['cat_id'];
    $query = "UPDATE categories SET cat_title = '$updated_cat_title' WHERE id = $cat_id";
    $result = mysqli_query($connection, $query);

    if ($result) {
        header("Location: categories.php");
    } else {
        echo "Failed to update category: " . mysqli_error($connection);
    }
}
?>

<div id="wrapper">
    <?php include 'includes/navigation.php'; ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small>Author</small>
                    </h1>
                </div>
            </div>

            <div class="col-xs-6">
                <?php
                // Insert new category
                add_category();
                ?>
                
                <!-- Form to Add Category -->
                <form action="" method="post">
                    <div class="form-group">
                        <label for="cat-title">Add Category</label>
                        <input type="text" name="cat_title" class="form-control" placeholder="Category Title" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Add Category" class="btn btn-primary" name="submit">
                    </div>
                </form>

                <!-- Form to Edit Category -->
                <?php if (isset($_GET['edit'])): ?>
                    <?php
                        
                         $cat_title = '';
                        edit_category();
                        
                    ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="cat-title">Edit Category</label>
                            <input type="hidden" name="cat_id" value="<?php echo $edit_id; ?>">
                            <input type="text" name="cat_title" class="form-control" placeholder="Category Title" value="<?php echo $cat_title; ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Update Category" class="btn btn-primary" name="update">
                        </div>
                    </form>
                <?php endif; ?>
            </div>

            <div class="col-xs-6">
                <!-- Table to display categories -->
                <table class="table table-bordered table-hover table-collapsed">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        echoAllCategories();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

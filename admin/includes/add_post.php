<?php
if (isset($_POST['create_post'])) {
    // Sanitize input data
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $category_id = mysqli_real_escape_string($connection, $_POST['post_category_id']);
    echo "<h1>$category_id</h1>";
    $author = mysqli_real_escape_string($connection, $_POST['post_author']);
    $status = mysqli_real_escape_string($connection, $_POST['post_status']);
    $tags = mysqli_real_escape_string($connection, $_POST['post_tags']);
    $content = mysqli_real_escape_string($connection, $_POST['post_content']);
    
    $image = $_FILES['post_image']['name'];
    $image_temp_name = $_FILES['post_image']['tmp_name'];

    // Check for upload errors
    if ($_FILES['post_image']['error'] !== UPLOAD_ERR_OK) {
        die("File upload failed with error code " . $_FILES['post_image']['error']);
    }

    // Set the post date and initialize post comments count
    $date = date('Y-m-d H:i:s');
    $comments_count = 0; // Set to 0 or desired default

    // Handle file upload securely
    $target_directory = "../images/";
    $unique_image_name = time() . '_' . basename($image);
    $target_file = $target_directory . $unique_image_name;
    move_uploaded_file($image_temp_name, $target_file);

    // Use prepared statements to avoid SQL injection
    $stmt = mysqli_prepare($connection, "INSERT INTO posts (post_title, post_date, post_author, post_image, post_content, post_category_id, post_tags, post_status, post_comments_count) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'ssssssssi', $title, $date, $author, $unique_image_name, $content,$category_id, $tags, $status, $comments_count);
    mysqli_stmt_execute($stmt);

    // Check if the query was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "<h1 class='text-center'>Post created successfully!</h1>";
    } else {
        die("Query failed: " . mysqli_error($connection));
    }

    mysqli_stmt_close($stmt);
}
?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title" >Post Title</label>
        <input type="text" name="title" class="form-control">
    </div>
    <div class="form-group">
    <label for="post_category_id">Post Category</label>
    <select name="post_category_id" class="form-control">
        <?php
        // Fetch all categories from the 'categories' table
        $category_query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection, $category_query);
        
        while ($row = mysqli_fetch_assoc($select_categories)) {
            $cat_id = $row['id'];
            $cat_title = $row['cat_title'];
            
            // Dynamically generate the dropdown options
            echo "<option value='{$cat_id}'>{$cat_title}</option>";
        }
        ?>
    </select>
</div>

    <div class="form-group">
        <label for="post_author" >Post Author</label>
        <input type="text" name="post_author" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_status" >Post Status</label>
        <input type="text" name="post_status" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_image" >Post Image</label>
        <input type="file" name="post_image" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_tags" >Post Tags</label>
        <input type="text" name="post_tags" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_content" >Post Content</label>
        <textarea type="text" name="post_content" class="form-control" rows="10" cols="30"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" value="Publish Post" class="btn btn-success" name="create_post">
    </div>
</form>
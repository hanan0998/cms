<?php
// Check if the 'delete' parameter is set
if (isset($_GET['delete'])) {
    $the_id_to_be_deleted = intval($_GET['delete']);
    
    // Prepare the DELETE query using a prepared statement
    $stmt = mysqli_prepare($connection, "DELETE FROM posts WHERE post_id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $the_id_to_be_deleted);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Post deleted successfully!";
    } else {
        echo "No post found with the provided ID or failed to delete.";
    }

    mysqli_stmt_close($stmt);
}

// Check if the 'edit' parameter is set
if (isset($_GET['edit'])) {
    $the_id_to_be_edited = intval($_GET['edit']);
    
    // Fetch the post data to be edited
    $query = "SELECT * FROM posts WHERE post_id = $the_id_to_be_edited";
    $select_post = mysqli_query($connection, $query);
    $post_data = mysqli_fetch_assoc($select_post);
    
    // Display the edit form
    if ($post_data) {
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Post Title</label>
                <input type="text" name="post_title" class="form-control" value="<?php echo $post_data['post_title']; ?>">
            </div>
            <div class="form-group">
    <label for="post_category_id">Post Category</label>
    <select name="post_category_id" class="form-control">
        <?php
        // Fetch all categories from the 'categories' table
        $category_query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection, $category_query);
        
        while ($row = mysqli_fetch_assoc($select_categories)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            
            // Check if this is the current category of the post being edited
            $selected = ($cat_id == $post_data['post_category_id']) ? 'selected' : '';
            
            echo "<option value='{$cat_title}' {$selected}>{$cat_title}</option>";
        }
        ?>
    </select>
</div>

            <div class="form-group">
                <label for="post_author">Post Author</label>
                <input type="text" name="post_author" class="form-control" value="<?php echo $post_data['post_author']; ?>">
            </div>
            <div class="form-group">
                <label for="post_status">Post Status</label>
                <input type="text" name="post_status" class="form-control" value="<?php echo $post_data['post_status']; ?>">
            </div>
            <div class="form-group">
                <input type="file" name="post_image" class="form-control mb-4">
                <img width="100" src="../images/<?php echo $post_data['post_image']; ?>">
            </div>
            <div class="form-group">
                <label for="post_tags">Post Tags</label>
                <input type="text" name="post_tags" class="form-control" value="<?php echo $post_data['post_tags']; ?>">
            </div>
            <div class="form-group">
                <label for="post_content">Post Content</label>
                <textarea type="text" name="post_content" class="form-control" rows="10" cols="30"><?php echo $post_data['post_content']; ?></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Update Post" class="btn btn-success" name="update_post">
            </div>
        </form>
        <?php
    }
}

// Handle the form submission to update the post
if (isset($_POST['update_post'])) {
    $updated_title = mysqli_real_escape_string($connection, $_POST['post_title']);
    $updated_author = mysqli_real_escape_string($connection, $_POST['post_author']);
    $updated_category_id = mysqli_real_escape_string($connection, $_POST['post_category_id']);
    $updated_status = mysqli_real_escape_string($connection, $_POST['post_status']);
    $updated_tags = mysqli_real_escape_string($connection, $_POST['post_tags']);
    $updated_content = mysqli_real_escape_string($connection, $_POST['post_content']);
    
    $updated_image = $_FILES['post_image']['name'];
    $updated_image_temp = $_FILES['post_image']['tmp_name'];

    // Check if a new image has been uploaded
    if (!empty($updated_image)) {
        move_uploaded_file($updated_image_temp, "../images/$updated_image");
    } else {
        // Use the existing image if no new image is uploaded
        $updated_image = $post_data['post_image'];
    }

    // Prepare the UPDATE query using a prepared statement
    $stmt = mysqli_prepare($connection, "UPDATE posts SET post_title = ?, post_author = ?, post_category_id = ?, post_status = ?, post_image = ?, post_tags = ?, post_content = ? WHERE post_id = ?");
    mysqli_stmt_bind_param($stmt, 'sssssssi', $updated_title, $updated_author, $updated_category_id, $updated_status, $updated_image, $updated_tags, $updated_content, $the_id_to_be_edited);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Post updated successfully!";
        // Redirect to avoid form resubmission
        header("Location: posts.php");
        exit();
    } else {
        echo "Failed to update the post.";
    }

    mysqli_stmt_close($stmt);
}
?>

<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM posts";
        $all_posts = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($all_posts)) {
            $post_title = $row['post_title'];
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comments_count = $row['post_comments_count'];
            $post_date = $row['post_date'];
            echo "<tr>";
            echo "<td>$post_id</td>";
            echo "<td>$post_author</td>";
            echo "<td>$post_title</td>";
            echo "<td>$post_category_id</td>";
            echo "<td>$post_status</td>";
            echo "<td><img width='100' src='../images/$post_image'></td>";
            echo "<td>$post_tags</td>";
            echo "<td>$post_comments_count</td>";
            echo "<td>$post_date</td>";
            echo "<td><a href='posts.php?delete=$post_id'>Delete</a> | <a href='posts.php?edit=$post_id'>Edit</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

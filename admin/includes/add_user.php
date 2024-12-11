<?php
if (isset($_POST['create_user'])) {
    // Sanitize input data
    $firstname = mysqli_real_escape_string($connection, $_POST['first_name']);
    $lastname = mysqli_real_escape_string($connection, $_POST['last_name']);
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $email = mysqli_real_escape_string($connection, $_POST['user_email']);
    $role = mysqli_real_escape_string($connection, $_POST['user_role']);
    $password = mysqli_real_escape_string($connection, $_POST['user_password']);
    // $content = mysqli_real_escape_string($connection, $_POST['post_content']);
    
    // $image = $_FILES['post_image']['name'];
    // $image_temp_name = $_FILES['post_image']['tmp_name'];

    // // Check for upload errors
    // if ($_FILES['post_image']['error'] !== UPLOAD_ERR_OK) {
    //     die("File upload failed with error code " . $_FILES['post_image']['error']);
    // }

    // Set the post date and initialize post comments count
    // $date = date('Y-m-d H:i:s');
    // $comments_count = 0; // Set to 0 or desired default

    // // Handle file upload securely
    // $target_directory = "../images/";
    // $unique_image_name = time() . '_' . basename($image);
    // $target_file = $target_directory . $unique_image_name;
    // move_uploaded_file($image_temp_name, $target_file);

    // Use prepared statements to avoid SQL injection
    $stmt = mysqli_prepare($connection, "INSERT INTO users (user_firstname, user_lastname, user_name, user_password, user_email, user_role) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'ssssss', $firstname, $lastname, $username, $password, $email, $role);
    mysqli_stmt_execute($stmt);

    // Check if the query was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "<h1 class='text-center'>User created successfully!</h1>";
    } else {
        die("Query failed: " . mysqli_error($connection));
    }

    mysqli_stmt_close($stmt);
}
?>


<form action="" method="post" enctype="multipart/form-data">
    
 <div class="form-group">
        <label for="user_firstname" >First Name</label>
        <input type="text" name="first_name" class="form-control">
    </div>
    <div class="form-group">
        <label for="last_name" >Last Name</label>
        <input type="text" name="last_name" class="form-control">
    </div>
    <div class="form-group">
        <label for="username" >Username</label>
        <input type="text" name="username" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_email" >User Email</label>
        <input type="text" name="user_email" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_password" >User Password</label>
        <input type="password" name="user_password" class="form-control">
    </div>
    <!-- <div class="form-group">
        <label for="post_image" >Post Image</label>
        <input type="file" name="post_image" class="form-control">
    </div> -->
    
    <!-- <div class="form-group">
        <label for="post_content" >Post Content</label>
        <textarea type="text" name="post_content" class="form-control" rows="10" cols="30"></textarea>
    </div> -->

    <div class="form-group">
    <label for="user_role">User Roles</label>
    <select name="user_role" class="form-control">
       
        <option value='subscriber'>Subscriber</option>
            <option value='admin'>Admin</option>
        
    </select>
</div>

    <div class="form-group">
        <input type="submit" value="Add User" class="btn btn-success" name="create_user">
    </div>
</form>
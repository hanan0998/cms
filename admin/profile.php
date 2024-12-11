<?php include 'includes/header.php'; ?>

<?php include 'functions.php'; ?>

<?php

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $fetch_user_data = mysqli_query($connection, "SELECT * FROM users WHERE user_name = '$username'");
    while($row = mysqli_fetch_assoc($fetch_user_data)){
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_password = $row['user_password'];
        $user_image = $row['user_image'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
        $randSalt = $row['randSalt'];
    }
    
}

if (isset($_POST['update_profile'])) {
    $updated_firstname = mysqli_real_escape_string($connection, $_POST['first_name']);
    $updated_lastname = mysqli_real_escape_string($connection, $_POST['last_name']);
    $updated_username = mysqli_real_escape_string($connection, $_POST['username']);
    $updated_email = mysqli_real_escape_string($connection, $_POST['user_email']);
    $updated_password = mysqli_real_escape_string($connection, $_POST['user_password']);
    $updated_role = mysqli_real_escape_string($connection, $_POST['user_role']);
    $the_user_id = $_SESSION['user_id'];
    


    // Prepare the UPDATE query using a prepared statement
    $stmt = mysqli_prepare($connection, "UPDATE users SET user_firstname = ?, user_lastname = ?, user_name = ?, user_email = ?, user_password = ?, user_role = ? WHERE user_name = ?");
    mysqli_stmt_bind_param($stmt, 'sssssss', $updated_firstname, $updated_lastname, $updated_username, $updated_email, $updated_password, $updated_role, $username);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Post updated successfully!";
        // Redirect to avoid form resubmission
        header("Location: profile.php");
        exit();
    } else {
        echo "Failed to update the post.";
    }

    mysqli_stmt_close($stmt);
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
                    <form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
           <label for="user_firstname" >First Name</label>
           <input type="text" name="first_name" class="form-control" value="<?php   echo $user_firstname;  ?>">
       </div>
       <div class="form-group">
           <label for="last_name" >Last Name</label>
           <input type="text" name="last_name" class="form-control" value="<?php   echo $user_lastname;  ?>">
       </div>
       <div class="form-group">
           <label for="username" >Username</label>
           <input type="text" name="username" class="form-control" value="<?php   echo $user_name;  ?>">
       </div>
       <div class="form-group">
           <label for="user_email" >User Email</label>
           <input type="text" name="user_email" class="form-control" value="<?php   echo $user_email;  ?>">
       </div>
       <div class="form-group">
           <label for="user_password" >User Password</label>
           <input type="password" name="user_password" class="form-control" value="<?php   echo $user_password;  ?>" >
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
       <select name="user_role" class="form-control" value="<?php   echo $user_role;  ?>">
          
           <option value='subscriber'>Subscriber</option>
            <option value='admin'>Admin</option>
           
       </select>
   </div>
   
       <div class="form-group">
           <input type="submit" value="Update Profile" class="btn btn-success" name="update_profile">
       </div>
   </form>
                    
                </div>
            </div>
              



        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

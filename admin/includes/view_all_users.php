<?php
// Check if the 'delete' parameter is set
if (isset($_GET['delete'])) {
   if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role'] == 'admin'){
            $the_id_to_be_deleted = intval($_GET['delete']);
    
            // Prepare the DELETE query using a prepared statement
            $stmt = mysqli_prepare($connection, "DELETE FROM users WHERE user_id = ?");
            mysqli_stmt_bind_param($stmt, 'i', $the_id_to_be_deleted);
            mysqli_stmt_execute($stmt);
        
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "Post deleted successfully!";
                header("location: users.php");
            } else {
                echo "No post found with the provided ID or failed to delete.";
            }
        
            mysqli_stmt_close($stmt);
        }
   }
}

if(isset($_GET['change_to_admin'])){
    $the_user_id = $_GET['change_to_admin'];
    $query = mysqli_query($connection, "UPDATE users set user_role = 'admin' WHERE user_id = $the_user_id");
    if(!$approve_query){
        echo "<h1> Error</h1>";
    } else  {
        echo "working";
        
    }
    header("location: users.php");

}

if(isset($_GET['change_to_sub'])){
    $the_user_id = $_GET['change_to_sub'];
    $query = mysqli_query($connection, "UPDATE users set user_role = 'subscriber' WHERE user_id = $the_user_id");
    if(!$approve_query){
        echo "<h1> Error</h1>";
    } else  {
        echo "working";
        
    }
    header("location: users.php");

}

// Check if the 'edit' parameter is set
if (isset($_GET['edit'])) {
    $the_id_to_be_edited = intval($_GET['edit']);
    
    // Fetch the post data to be edited
    $query = "SELECT * FROM users WHERE user_id = $the_id_to_be_edited";
    $select_post = mysqli_query($connection, $query);
    $user_data = mysqli_fetch_assoc($select_post);
    
    // Display the edit form
    if ($user_data) {
        ?>
        <form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
           <label for="user_firstname" >First Name</label>
           <input type="text" name="first_name" class="form-control" value="<?php   echo $user_data['user_firstname'];  ?>">
       </div>
       <div class="form-group">
           <label for="last_name" >Last Name</label>
           <input type="text" name="last_name" class="form-control" value="<?php   echo $user_data['user_lastname'];  ?>">
       </div>
       <div class="form-group">
           <label for="username" >Username</label>
           <input type="text" name="username" class="form-control" value="<?php   echo $user_data['user_name'];  ?>">
       </div>
       <div class="form-group">
           <label for="user_email" >User Email</label>
           <input type="text" name="user_email" class="form-control" value="<?php   echo $user_data['user_email'];  ?>">
       </div>
       <div class="form-group">
           <label for="user_password" >User Password</label>
           <input type="password" name="user_password" class="form-control" value="<?php   echo $user_data['user_password'];  ?>" >
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
       <select name="user_role" class="form-control" value="<?php   echo $user_data['user_role'];  ?>">
          
           <option value='subscriber'>Subscriber</option>
            <option value='admin'>Admin</option>
           
       </select>
   </div>
   
       <div class="form-group">
           <input type="submit" value="Update User" class="btn btn-success" name="update_user">
       </div>
   </form>
        <?php
    }
}

// Handle the form submission to update the post
if (isset($_POST['update_user'])) {
    $updated_firstname = mysqli_real_escape_string($connection, $_POST['first_name']);
    $updated_lastname = mysqli_real_escape_string($connection, $_POST['last_name']);
    $updated_username = mysqli_real_escape_string($connection, $_POST['username']);
    $updated_email = mysqli_real_escape_string($connection, $_POST['user_email']);
    $updated_password = mysqli_real_escape_string($connection, $_POST['user_password']);
    $updated_role = mysqli_real_escape_string($connection, $_POST['user_role']);
    $user_id = $_GET['edit'];
    


    // Prepare the UPDATE query using a prepared statement
    $stmt = mysqli_prepare($connection, "UPDATE users SET user_firstname = ?, user_lastname = ?, user_name = ?, user_email = ?, user_password = ?, user_role = ? WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt, 'ssssssi', $updated_firstname, $updated_lastname, $updated_username, $updated_email, $updated_password, $updated_role, $user_id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Post updated successfully!";
        // Redirect to avoid form resubmission
        header("Location: users.php");
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
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th colspan="4" class="text-center">Actions</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM users";
        $all_users = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($all_users)) {
            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_password = $row['user_password'];
            $user_image = $row['user_image'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            $randSalt = $row['randSalt'];
            
            echo "<tr>";
            echo "<td>$user_id</td>";
            echo "<td>$user_name</td>";
            echo "<td>$user_firstname</td>";
            echo "<td>$user_lastname</td>";
            echo "<td>$user_email</td>";
            echo "<td>$user_role</td>";
           // echo "<td><img width='100' src='../images/$post_image'></td>";
            
           
           echo "<td><a href='users.php?change_to_admin=$user_id'>Convert to Admin</a></td>" ;
           echo "<td><a href='users.php?change_to_sub=$user_id'>Convert to Subscriber</a></td>";
           echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";
           echo "<td><a href='users.php?edit=$user_id'>Edit</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

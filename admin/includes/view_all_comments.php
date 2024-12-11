<?php
// Check if the 'delete' parameter is set
if (isset($_GET['delete']) ) {
    $the_id_to_be_deleted = intval($_GET['delete']);
    
    // Prepare the DELETE query using a prepared statement
    $stmt = mysqli_prepare($connection, "DELETE FROM comments WHERE comment_id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $the_id_to_be_deleted);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Post deleted successfully!";
    } else {
        echo "No post found with the provided ID or failed to delete.";
    }

    mysqli_stmt_close($stmt);
    header("location: comments.php");
}

if(isset($_GET['approve'])){
    $the_comment_id = $_GET['approve'];
    $approve_query = mysqli_query($connection, "UPDATE comments set comment_status = 'Approved' WHERE comment_id = $the_comment_id");
    if(!$approve_query){
        echo "<h1> Error</h1>";
    } else  {
        echo "working";
        
    }
    header("location: comments.php");

}
if(isset($_GET['unapprove'])){
    $the_comment_id = $_GET['unapprove'];
    $approve_query = mysqli_query($connection, "UPDATE comments set comment_status = 'Unapproved' WHERE comment_id = $the_comment_id");
    if(!$approve_query){
        echo "<h1> Error</h1>";
    } else  {
        echo "working";
        
    }
    header("location: comments.php");

}


?>

<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>UnApprove</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM comments";
        $all_comments = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($all_comments)) {
            $comment_id = $row['comment_id'];
            $comment_author = $row['comment_author'];
            $comment_post_id = $row['comment_post_id'];
            $comment_email = $row['comment_email'];
            $comment_content = $row['comment_content'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];
            
            echo "<tr>";
            echo "<td>$comment_id</td>";
            echo "<td>$comment_author</td>";
            echo "<td>$comment_content</td>";
            echo "<td>$comment_email</td>";
            echo "<td>$comment_status</td>";

            $query_post_title = mysqli_query($connection, "SELECT * FROM posts WHERE post_id = $comment_post_id");
            while($row = mysqli_fetch_assoc($query_post_title)){
                $post_title = $row['post_title'];
                $post_id = $row['post_id'];
                echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
            }
            
            // echo "<td>$comment_post_id</td>";
            // echo "<td>$post_comments_count</td>";
            echo "<td>$comment_date</td>";
            echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>" ;
            echo "<td><a href='comments.php?unapprove=$comment_id'>UnApprove</a></td>";
            echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

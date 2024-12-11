<?php  include "includes/db.php"  ?>
<?php  include "includes/header.php"  ?>

    <!-- Navigation -->
   
<?php  include "includes/navigation.php"  ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

            <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

            <?php


                if(isset($_GET['p_id'])){
                    $the_post_id = $_GET['p_id'];
                }

                $query = "SELECT * FROM posts where post_id=$the_post_id;";
                $select_all_posts_query = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($select_all_posts_query)){
                    $post_title = $row['post_title'];
                    $post_date = $row['post_date'];
                    $post_author = $row['post_author'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];

                    echo "<h2><a href='#'> $post_title </a></h2>";
                    echo "<p class='lead'>by <a href='index.php'> $post_author </a></p>";
                    echo "<p><span class='glyphicon glyphicon-time'></span> Posted on $post_date </p><hr>";
                    echo "<img class='img-responsive' src='images/$post_image' alt='No Content'><hr>";
                    echo "<p> $post_content </p>";
                    echo "<a class='btn btn-primary' href='#'>Read More <span class='glyphicon glyphicon-hchevron-right'></span></a><hr>";


                    
                }



            ?>

                <!-- Comments Form -->
                <div class="well">
                <?php
                    if(isset($_POST['submit'])){
                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content =  $_POST['comment_content'];
                        $comment_content = mysqli_real_escape_string($connection, $comment_content); // Escape the content
                        $comment_author = mysqli_real_escape_string($connection, $comment_author);
                        $comment_email = mysqli_real_escape_string($connection, $comment_email);
                        $comment_post_id = $_GET['p_id'];
                        
                        $query = "INSERT INTO comments (comment_author, comment_post_id, comment_email, comment_content, comment_status, comment_date) VALUES('$comment_author', $comment_post_id, '$comment_email', '$comment_content', 'UnApproved', now());";

                        $result = mysqli_query($connection, $query);
                        if($result){
                            echo "<h1>Comment Uploaded</h1>";
                        } else {
                            die('Unsuccessful'.mysqli_error($connection));
                        }


                        $query = "UPDATE posts SET post_comments_count = post_comments_count + 1 WHERE post_id = $comment_post_id";
                        mysqli_query($connection, $query);
                    }
                


                ?>
                    <h4>Leave a Comment:</h4>
                    <hr>
                    <form role="form" method="post" >
                        <div class="form-group">
                            <label for="author">Author </label>
                            <input class="form-control" type="text" name="comment_author" id="author">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" type="text" name="comment_email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="content">Comment</label>
                            <textarea class="form-control" rows="3" name="comment_content" id="content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

 

                <!-- Comment -->
                <div class="media">
                    <?php
                    $comment_post_id = $_GET['p_id'];
                    $query_to_fetch_comments = "SELECT * FROM comments where comment_post_id = $comment_post_id AND comment_status = 'Approved' ORDER BY comment_id DESC ";
                    $comment_fetch_result = mysqli_query($connection, $query_to_fetch_comments);
                    while($row = mysqli_fetch_assoc($comment_fetch_result)){
                        $comment_author = $row['comment_author'];
                        $comment_content = $row['comment_content'];
                        $comment_date = $row['comment_date'];
                    ?>
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author  ?>
                            <small> <?php echo $comment_date  ?> </small>
                        </h4>
                        <?php echo $comment_content ?>
                        
                        <!-- End Nested Comment -->
                    </div>

                    <?php } ?>
                </div>

                

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php  include "includes/sidebar.php"  ?>

        </div>
        <!-- /.row -->

        <hr>

        <?php  include "includes/footer.php"  ?>
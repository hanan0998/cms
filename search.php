<?php  include "includes/db.php"  ?>
<?php  include "includes/header.php"  ?>

    <!-- Navigation -->
   
<?php  include "includes/navigation.php"  ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

            

            <?php



                if(isset($_POST['submit'])){
                    $search = $_POST['search'];
                    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
                    $search_query = mysqli_query($connection, $query);
                    if(!$search_query){
                        echo "good to go !!";
                    } 
                    // to check how many rows fetched by query
                    $count = mysqli_num_rows($search_query);
                    // echo $count;
                    if($count == 0){
                        echo "<h1>No Result</h1>";
                    } else {
                        
                        
                        while($row = mysqli_fetch_assoc($search_query)){
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

                    }
                }













            ?>



                

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php  include "includes/sidebar.php"  ?>

        </div>
        <!-- /.row -->

        <hr>

        <?php  include "includes/footer.php"  ?>
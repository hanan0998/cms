<?php  include 'includes/header.php' ?>

    <div id="wrapper">

   

        <?php  include 'includes/navigation.php' ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo $_SESSION['username'];?></small>
                        </h1>
                        
                        
                    </div>
                </div>
                <!-- /.row -->

                        
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                    $post_result = mysqli_query($connection, "SELECT * FROM posts");
                    $num_of_posts = mysqli_num_rows($post_result);
                    echo "<div class='huge'>$num_of_posts</div>";

                    ?>
                  
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                    $comment_result = mysqli_query($connection, "SELECT * FROM comments");
                    $num_of_comments = mysqli_num_rows($comment_result);
                    echo "<div class='huge'>$num_of_comments</div>";

                    ?>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                    $user_result = mysqli_query($connection, "SELECT * FROM users");
                    $num_of_users = mysqli_num_rows($user_result);
                    echo "<div class='huge'>$num_of_users</div>";

                    ?>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                    $category_result = mysqli_query($connection, "SELECT * FROM categories");
                    $num_of_categories = mysqli_num_rows($category_result);
                    echo "<div class='huge'>$num_of_categories</div>";

                    ?>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.row -->
<?php

$post_draft_result = mysqli_query($connection, "SELECT * FROM posts where post_status = 'draft';");
$num_of_draft_posts = mysqli_num_rows($post_draft_result);

$comment_unapprove_result = mysqli_query($connection, "SELECT * FROM comments where comment_status = 'UnApproved';");
$num_of_unapproved_comments = mysqli_num_rows($comment_unapprove_result);

$subscriber_result = mysqli_query($connection, "SELECT * FROM users where user_role = 'subscriber';");
$num_of_subscribers = mysqli_num_rows($subscriber_result);



?>

<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],
            <?php
            $element_text = ["Active Posts","Draft Posts", "Comments", "Pending Comments" , "Users" ,"Subscribers", "Categories" ];
            $element_count = [$num_of_posts, $num_of_draft_posts , $num_of_comments, $num_of_unapproved_comments , $num_of_users, $num_of_subscribers , $num_of_categories];
            for($i=0;$i<7; $i++){
                echo "['{$element_text[$i]}'" . " , " . "{$element_count[$i]}],";
            }
            ?>
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <div id="columnchart_material" style="width: 100%; height: 500px;"></div>



            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php  include 'includes/footer.php' ?>
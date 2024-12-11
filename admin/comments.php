<?php include 'includes/header.php'; ?>

<?php include 'functions.php'; ?>



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

                    <?php
                    if(isset($_GET['source'])){
                        $source = $_GET['source'];

                    }else{
                        $source='';
                    }
                    switch($source){
                        case 'add_post':
                            include "includes/add_post.php";
                            break;
                        case '10':
                            echo "Nice 10";
                            break;
                        case '20':
                            echo "Nice 20";
                            break;
                        default:
                            include "includes/view_all_comments.php";

                            
                    }

                    ?>






                </div>

              



        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

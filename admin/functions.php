<?php


function escape($string){
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}


function add_category(){
    global $connection;
    if (isset($_POST['submit'])) {

        $cat_title = $_POST['cat_title'];
        $query = "INSERT INTO categories(cat_title) VALUE('$cat_title');";
        $result = mysqli_query($connection, $query);
        if (!$result) {
            die("Error" . mysqli_error($connection));
        }
    }
}

function edit_category(){
    global $connection;
    global $cat_title;
    $edit_id = $_GET['edit'];
    $result = mysqli_query($connection, "SELECT cat_title FROM categories WHERE id = $edit_id");
    $cat_title = '';
    if ($result) {
        $row = mysqli_fetch_assoc($result);
         $cat_title = $row['cat_title'];
    }
}

function echoAllCategories(){
    global $connection;
    $query = "SELECT * FROM categories";
                        $all_categories = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_assoc($all_categories)) {
                            $category_title = $row['cat_title'];
                            $category_id = $row['id'];
                            echo "<tr>";
                            echo "<td>$category_id</td>";
                            echo "<td>$category_title</td>";
                            echo "<td><a href='categories.php?edit=$category_id'>Edit</a> | <a href='categories.php?delete=$category_id'>Delete</a></td>";
                            echo "</tr>";
                        }
}
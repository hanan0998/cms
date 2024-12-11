<?php
include 'db.php';
session_start();

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
    $query = "Select * from users WHERE user_name = '$username'";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die("Failed".mysqli_error($connection));
    }

    while($row = mysqli_fetch_assoc($result)){
        $db_user_id = $row['user_id'];
        $db_user_name = $row['user_name'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_password = $row['user_password'];
        $db_user_role = $row['user_role'];
    }
    if($username === $db_user_name && $password === $db_user_password){
        $_SESSION['username'] = $db_user_name;
        $_SESSION['user_id'] = $db_user_id;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;

        header("Location: ../admin");
    }  else {
        header("Location: ../index.php");
    }
}






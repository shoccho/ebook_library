<?php
include_once 'db_connect.php';

if(isset($_GET["id"])){
    $id = $_GET["id"];
    $sql = "delete from users where user_id = '$id';";
    if( mysqli_query($conn, $sql)){
        header("Location:index.php?page=view_user");
    }else{
        $error = mysqli_error($conn);
        header("Location:index.php?page=view_user&error=$error");
    }
}
?>
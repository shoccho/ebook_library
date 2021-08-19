<?php
include_once 'db_connect.php';

if(isset($_GET["id"])){
    $id = $_GET["id"];
    $sql = "delete from registration_requests where id = '$id';";
    if( mysqli_query($conn, $sql)){
        header("Location:index.php?page=req_reg");
    }else{
        $error = mysqli_error($conn);
        header("Location:index.php?page=req_reg&error=$error");
    }
}
?>
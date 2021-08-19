<?php
include_once 'db_connect.php';

if(isset($_GET["id"])){
    $id = $_GET["id"];
    $sql = "delete from book_requests where req_id = '$id';";
    if( mysqli_query($conn, $sql)){
        header("Location:index.php?page=v_req_book");
    }else{
        $error = mysqli_error($conn);
        header("Location:index.php?page=v_req_book&error=$error");
    }
}
?>
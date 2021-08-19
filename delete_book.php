<?php
include_once 'db_connect.php';

if(isset($_GET["isbn"])){
    $isbn = $_GET["isbn"];
    $offset = $_GET["offset"];
    $sql = "select * from books where isbn ='$isbn'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if(!unlink($row["path"])){
        $error = "File could not be deleted!";
        header("Location:index.php?page=books&error=$error");
    }
    $sql = "delete from books where isbn = '$isbn';";
    if( mysqli_query($conn, $sql)){
        header("Location:index.php?page=books&offset=$offset");
    }else{
        $error = mysqli_error($conn);
        header("Location:index.php?page=books&error=$error");
    }
}
?>
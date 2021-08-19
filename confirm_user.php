<?php
    include 'db_connect.php';
    $username = $_GET['username'];
    $sql = "SELECT * FROM registration_requests where username = '$username'";
    $result = mysqli_query($conn, $sql);
    if($row = mysqli_fetch_assoc($result)){
        $sql = "insert into users (username,email,password) values ('".$row["username"]."','".$row["email"]."','".$row["password"]."');";
        $result = mysqli_query($conn, $sql);
        if (!$result){
            echo("erorr : ".mysqli_error($conn));
        }else{
            $sql="DELETE FROM registration_requests WHERE username='$username'";
            $result = mysqli_query($conn, $sql);
            if (!$result){
                echo("erorr : ".mysqli_error($conn));
            }else{
                header("Location:index.php");
            }
        }
    }else{
        
        echo("erorr : ".mysqli_error($conn));
    }
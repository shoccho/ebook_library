<?php
    include_once 'db_connect.php';
    $username=$_POST['username'];
    $password=$_POST['password'];
    $sql = "SELECT * FROM users where username = '$username'";
    $result = mysqli_query($conn, $sql);
    session_start();
    if(!$result){
        echo("erorr : ".mysqli_error($conn));
    }
    $row = mysqli_fetch_assoc($result);
    if($row){ 
        if (md5($password) == $row['password']) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['usertype'] = $row['type'];
            header("Location: index.php");
            exit();
        }else{
            $error = "passwords don't match";
            
        }
    }else{
        $sql = "SELECT * FROM registration_requests where username = '$username'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        if($row){ 
            $error = "Registration pending.";
            
        }else{
            $error = "No registered user with this username";
        }
    }
    if (isset($error)){
        header("Location: index.php?error=$error");
    }
?>
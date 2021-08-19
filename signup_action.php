<?php
    include 'db_connect.php';
    $username=trim($_POST['username']);
    $password=trim($_POST['password']);
    $email=trim($_POST['email']);
    session_destroy();
    if (empty($username)){   
        $error="Username can not be empty";
    }else if (empty($password)){
        $error="Password can not be empty";
    }else if (empty($email)){
        $error="Email can not be empty";
    }else if (!preg_match("/^[a-zA-Z]*$/",$username)) {
        $error = "Only letters allowed in username";
    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    }else if(strlen($password)<6 || strlen($password)>20 ){
        $error = "Password must between 6-20 charecters";
    }
    $sql = "SELECT * FROM users where username = '$username' ";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        echo("erorr : ".mysqli_error($conn));
    }
    $row = mysqli_fetch_assoc($result);

    if ($row){
        $error="User with same username already exists";
        echo $error;
    }
    $sql = "SELECT * FROM users where email = '$email' ";
    $result = mysqli_query($conn, $sql);

    if(!$result){
        echo("erorr : ".mysqli_error($conn));
    }
    $row = mysqli_fetch_assoc($result);
    if ($row){
        $error="user with same email already exists";
        echo $error;
    }
    $password = md5($password);
 
    if(isset($error)){
        header("Location:index.php?page=signup&error=$error");
    }else{
        $sql = "insert into `registration_requests` (email, username, password) values('$email','$username','$password')";
        if (!mysqli_query($conn, $sql)){
            echo("erorr : ".mysqli_error($conn));
            
        }
        header("location:index.php");    
    }
?>
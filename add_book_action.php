<?php
    include_once 'db_connect.php';
    $name = ($_POST["name"]);
    $isbn = ($_POST["isbn"]);
    settype($name,"string");
    settype($isbn,"string");
    // $name = trim($name);
    // $isbn = trim($isbn);
    $author = trim($_POST["author"]);
    $target_dir = "./books/";
    $upload_ok = 1;
    $target_file = $target_dir . basename($_FILES["file_to_upload"]["name"]);
    
    $file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if (empty($name)){
        $error = "Book name can not be empty!";
        $upload_ok = 0;
    }else if (empty($isbn)){
        $error = "Book ISBN can not be empty!";
        $upload_ok = 0;
    }else if (empty($author)){
        $error = "Book author can not be empty!";
        $upload_ok = 0;
    }else if (file_exists($target_file)) {
        $error = "File already exists";
        $upload_ok = 0;
    }else if($file_type != "pdf" && $file_type!="c" && $file_type != "epub") {
        $error = "Only pdf and epub files are allowed!";
        $upload_ok = 0; 
    }else if ($result = mysqli_query($conn, "select * from books where isbn = '$isbn'")){
        if($row = mysqli_fetch_assoc($result)){
            $error = "Book with same ISBN number exists!";
            $upload_ok = 0; 
        }else{
            echo("erorr : ".mysqli_error($conn));
        }
    
    }else if ($result = mysqli_query($conn, "select * from books where name = '$name'")){
        if($row = mysqli_fetch_assoc($result)){
            $error = "Book with same name exists!";
            $upload_ok = 0; 
        }else{
            echo("erorr : ".mysqli_error($conn));
        }
    }

    if ($upload_ok == 0) {
        header("location:index.php?page=add_book&error=$error");
        mysqli_close($conn); 
    } else {
        if (move_uploaded_file($_FILES["file_to_upload"]["tmp_name"], $target_file)) {
            $path = "books/".htmlspecialchars( basename( $_FILES["file_to_upload"]["name"]));
            $sql = "insert into books (name, isbn, author, path) values ('$name', '$isbn', '$author','$path')";
            
            if (!mysqli_query($conn, $sql)){
                echo("erorr : ".mysqli_error($conn));
                
            }else{
                header("location:index.php?page=add_book");    
            }
            
        } else {
            header("location:index.php?page=add_book&error=There was an error uploading your file");
        }
        mysqli_close($conn);
    }
?>
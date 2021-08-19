<div>
    <h3>Request a book</h3>
    <form  method="POST">
        <div class="mb-3">
            <lable class="form-label" for="name">Book name</lable>
            <input class="form-control" type="text" id="name" name="name"></input>
        </div>
        <div class="mb-3">
            <lable class="form-label" for="isbn">Book ISBN</lable>
            <input class="form-control" type="text" id="isbn" name="isbn"></input>
        </div>
        <div class="mb-3">
            <lable class="form-label" for="author">Book author</lable>
            <input class="form-control" type="text" id="author" name="author"></input>
        </div>
        <!-- <br > -->
        <button class="btn btn-primary" type="submit">Request</button>
    </form>
</div>
<?php
    require 'db_connect.php';
    if (isset($_POST["name"]) ){
        $name = $_POST["name"];
        $isbn = $_POST["isbn"];
        $author = $_POST["author"];

        if (empty(trim($author))){
            $author = "Unknown";
        }
        if ( empty(trim($isbn)) && empty(trim($name)) ){
            $error = "Please enter ISBN or the name of the book";
        }else{
            if (empty(trim($isbn))){
                $isbn ="Unknown";
            }else{
                $name ="Unknown";
            }
        }
        $uname = $_SESSION['username'];
        if (isset($error)){
            header("Location:index.php?page=req_book&error=$error");
        }else { 
            $sql = "insert into book_requests (name, isbn, author, requested_by) values ('$name','$isbn','$author','$uname');";
            if (!mysqli_query($conn, $sql)){
                // echo("erorr : ".mysqli_error($conn));
                $error = mysqli_error($conn);
                header("Location:index.php?page=req_book&error=$error");
            }
            header("location:index.php?page=req_book");
        }
    }


?>
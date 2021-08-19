<?php
    include "header.php";

    if(isset($_SESSION["username"])){
        echo "<div class=\"container-fluid\">";
        echo "<ul class=\"nav nav-pills  mb-3\">";
            echo "<li class=\"nav-item\">";
                $act=(isset($_GET["page"]) && $_GET["page"]=="books") ? "active":"";    
                echo "<a class=\"nav-link ". $act  . " \" href=\"index.php?page=books\">Books</a>";
            echo "</li><li class=\"nav-item\">";
                $act=(isset($_GET["page"]) && $_GET["page"]=="req_book") ? "active":"";    
            echo "<a class=\"nav-link ". $act ."\" href=\"index.php?page=req_book\">Request Books</a>";
            echo "</li><li class=\"nav-item\">";
                $act=(isset($_GET["page"]) && $_GET["page"]=="search") ? "active":""  ;  
                echo "<a class=\"nav-link ". $act ." \" href=\"index.php?page=search\">Search</a>";
            echo "</li>";
        
        if($_SESSION['usertype'] == 'admin'){
            echo "<li class=\"nav-item\">";
                $act=(isset($_GET["page"]) && $_GET["page"]=="add_book") ? "active":"" ;   
            echo "<a class=\"nav-link ". $act . " \" href=\"index.php?page=add_book\">Add Books</a>";
            echo "</li><li class=\"nav-item\">";
                $act=(isset($_GET["page"]) && $_GET["page"]=="req_reg") ? "active":""   ; 
            echo "<a class=\"nav-link ". $act .  " \" href=\"index.php?page=req_reg\">Registration Requests</a>";
            echo "</li><li class=\"nav-item\">";
                $act=(isset($_GET["page"]) && $_GET["page"]=="v_req_book") ? "active":"" ;   
            echo "<a class=\"nav-link ". $act . " \" href=\"index.php?page=v_req_book\">Book Requests</a>";
            echo "</li><li class=\"nav-item\">";
                $act=(isset($_GET["page"]) && $_GET["page"]=="view_user") ? "active":"" ;   
            echo "<a class=\"nav-link ". $act . " \" href=\"index.php?page=view_user\">Users</a>";
            echo "</li>";
        }
        echo "<li class=\"nav-item\" style=\"margin-left:auto\">";

            echo"<a class=\"nav-link bg-danger text-white\" href=\"logout.php\">Log out</a>";
        echo "</li></ul></div>";

        if (isset($_GET["error"])){
            
            echo "<div class=\"alert alert-danger\" role=\"alert\">".trim($_GET["error"])."</div>";
        }
        echo "<hr/>";
        if (isset($_GET["page"])){
            echo "<div class=\"container-xl\">";
            $page = $_GET["page"];
            if($page == "books"){
                include 'view_books.php';
            }elseif ($page == "req_book") {
                include 'request_books.php';
            }else if ($page == "search"){
                include 'search.php';
            }else if ($page == "add_book"){
                include 'add_book.php';
            }else if ($page == "req_reg"){
                include 'view_pending_registrations.php';
            }else if ($page == "v_req_book"){
                include 'view_requested_books.php';
            }else if ($page == "view_user"){
                include 'view_users.php';
            }
            echo "</div>";
        }else{
            include "quote.php";
        }
    }else if (isset($_GET["page"]) && $_GET["page"] == "signup"){
        if (isset($_GET["error"])){
            echo "<div class=\"alert alert-danger\" role=\"alert\">".trim($_GET["error"])."</div>";
        }
        include "signup.php";
    }else{
        if (isset($_GET["error"])){
            echo "<div class=\"alert alert-danger\" role=\"alert\">".trim($_GET["error"])."</div>";
        }
        include "login.php";  
    }
    ?>
    </div>

</body>
</html>

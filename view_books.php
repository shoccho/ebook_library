<?php
        include_once 'db_connect.php';
        if (isset($_GET["offset"])){
            $offset=$_GET["offset"];
        }else{
            $offset = 0;
        }
        $sql = "SELECT * FROM books order by name asc limit $offset,15;";
        
        $result = mysqli_query($conn, $sql);
    
        if(!$result){
            echo("erorr : ".mysqli_error($conn));
        }
        ?>
        <h3>All Books</h3>
        <table class="table">
            <tr>
            <th >Book name</th>
            <th >Author</th>
            <th >ISBN</th>
            <th >Download</th>
            <?php echo $_SESSION["usertype"]=="admin" ? "<th>Delete</th>":"";
            ?>
        </tr>
        <?php
        $count = 0;
        while ($row = mysqli_fetch_assoc($result)){
            echo "<tr><td>".$row['name']."</td><td>".$row['author']."</td><td>".$row['isbn']."</td>";
            echo "<td><a href=http://localhost/ebookmgr/".$row['path'].">Download</a>";
            if($_SESSION["usertype"]=="admin"){
                echo "<td><a href=\"delete_book.php?offset=$offset&isbn=". $row['isbn']. "\"><p class=\"text-danger\">Delete</p></a></td>";
            }
            echo "</tr>";
            $count=$count+1;
        }?>
        </table>
        <div class="pt-2">
        <?php
            echo "<p3>Showing ".$count." results </p3><br />";
            $nf=(int)$offset+15;
            if ($offset>=15){
                $pf=$offset-15;
                echo "<a href=\"index.php?page=books&offset=$pf\">Previous</a>";    
            }
            if ($count==15){
                echo "<a href=\"index.php?page=books&offset=$nf\">Next</a>";
            }
        ?>
        </div>
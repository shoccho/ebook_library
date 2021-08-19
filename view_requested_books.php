
    <?php
        include 'db_connect.php';
        if (isset($_GET["offset"])){
            $offset=$_GET["offset"];
        }else{
            $offset = 0;
        }
        $sql = "SELECT * FROM book_requests limit $offset,15;";
        $result = mysqli_query($conn, $sql);
    
        if(!$result){
            echo("erorr : ".mysqli_error($conn));
        }
    ?>
    <table class="table">
        <tr><th colspan=5>Requested Books</th></tr>
        <tr><td>Book name</td><td>ISBN</td><td>Author</td><td>Requested by</td><td>Action</td></tr>
        <?php
        $count = 0;
            while ($row = mysqli_fetch_assoc($result)){
                echo "<tr><td>".$row['name']."</td><td>".$row['isbn']."</td><td>".$row['author']."</td><td>".$row['requested_by']."</td>";
                echo "<td><a href=\"delete_book_request.php?id=".$row['req_id']."\"><p class=\"text-danger\">Delete</p></a></td>";
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
          echo "<a href=\"index.php?page=v_req_book&offset=$pf\">Previous</a>";    
      }
      if ($count>=15){
          echo "<a href=\"index.php?page=v_req_book&offset=$nf\">Next</a>";
      }
    ?>
    </div>

<div >
    <?php
        include 'db_connect.php';
        if (isset($_GET["offset"])){
            $offset=$_GET["offset"];
        }else{
            $offset = 0;
        }
        $sql = "SELECT * FROM registration_requests limit $offset,15;";
        $result = mysqli_query($conn, $sql);
    
        if(!$result){
            echo("erorr : ".mysqli_error($conn));
        }
    ?>
    <table class="table">
        <h3>Users awaiting approval</h3>
        <tr><td>Username</td><td>Email Address</td><td colspan=2>Action</td>
        <?php
        $count = 0;
            while ($row = mysqli_fetch_assoc($result)){
                echo "<tr><td>".$row['username']."</td><td>".$row['email']."</td>";
                echo "<td><a href=\"confirm_user.php?username=".$row["username"]."\">Confirm</a></td>";
                echo "<td><a href=\"delete_registration_request.php?id=".$row["id"]."\"  ><p class=\"text-danger\">Delete</p></a></td>";
                echo "</tr>";
                $count = $count + 1;
        }?>
    </table>
    <div class="pt-2">
    <?php
      echo "<p3>Showing ".$count." results </p3><br />";
      $nf=(int)$offset+15;
      if ($offset>=15){
          $pf=$offset-15;
          echo "<a href=\"index.php?page=reg_req&offset=$pf\">Previous</a>";    
      }
      if ($count>=15){
          echo "<a href=\"index.php?page=reg_req&offset=$nf\">Next</a>";
      }
    ?>
    </div>
</div>
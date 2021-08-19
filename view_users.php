<?php
    include_once  'db_connect.php';
    if (isset($_GET["offset"])){
        $offset=$_GET["offset"];
    }else{
        $offset = 0;
    }
    $sql = "SELECT * FROM users limit $offset,15;";
    $result = mysqli_query($conn, $sql);

    if(!$result){
        echo("erorr : ".mysqli_error($conn));
    }
?>
<table class="table">
    <tr>
        <th >User name</th>
        <th >User Email</th>
        <th >Action</th>
    </tr>
<?php
    $count = 0;
    while ($row = mysqli_fetch_assoc($result)){
        echo "<tr><td>".$row['username']."</td><td>".$row['email']."</td>";
        if ($row["type"]!="admin"){
            
            echo "<td ><a href=\"delete_user.php?id=".$row["user_id"]."\" ><p class=\"text-danger\">Delete User</p></a></td>";
            
        }else{
            echo "<td></td>";
        }
        echo "</tr>";
        $count= $count + 1;
    }
?>
</table>

<div class="pt-2">
    <?php
      echo "<p3>Showing ".$count." results </p3><br />";
      $nf=(int)$offset+15;
      if ($offset>=15){
          $pf=$offset-15;
          echo "<a href=\"index.php?page=view_user&offset=$pf\">Previous</a>";    
      }
      if ($count>=15){
          echo "<a href=\"index.php?page=view_user&offset=$nf\">Next</a>";
      }
    ?>
</div>

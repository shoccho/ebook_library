
<div>
    <div class="row">
        <h3>Search a book</h3>
    </div>
    <div class="mb-4">
    <form  method="get">
    <input type="hidden" name="page" value="search" />

        <div class=" mb-4">
            <label class="form-label" for="keyword">Keyword</label>
            <input class="form-control" type="text" name="keyword" id="keyword"/>
        </div>
        <div class ="mb-4">
            <label class="form-label" for="type">Type</label>
            <select class="form-select" name="type" id="type">
                <option value="book">Book</option>
                <option value="author">Author</option>
            </select>
        </div>
        <Button type="submit" value="search" class="btn btn-primary mb-4">Search</Button>
    </form>
    </div>
</div>

<?php
    if(isset($_GET["keyword"])){
        include 'db_connect.php';
        $key = $_GET["keyword"];
        $type = $_GET["type"];
        if ($type =="author"){
            $sql = "select * from books where author like '$key'";

        }else{
            $sql = "select * from books where name like '$key'";
        }
        $result = mysqli_query($conn, $sql);
    
        if(!$result){
            echo("erorr : ".mysqli_error($conn));
        }
        echo "<table class=\"table\">";
            echo "<tr><th colspan=3>Search Reuslts</th></tr>";
        
        while ($row = mysqli_fetch_assoc($result)){
            echo "<tr><td>".$row['name']."</td><td>".$row['author']."</td>";
            echo "<td><a href=".$row['path'].">Download</a>";
            echo "</tr>";
        }
        echo "</table>";
    }
?>

<?php
include"header.php";
if($_SESSION['role'] == 'user')
{
    ?>
    <script>window.location = "index.php";</script>
    <?php
}

if(isset($_GET['tempdelete'])){
$row = mysqli_fetch_array(mysqli_query($conn, "Select path from files where id=".$_GET['tempdelete']." and owner='$uname';"));
          unlink($row['path']);

}

if(isset($_GET['delete'])){
              $row = mysqli_fetch_array(mysqli_query($conn, "Select path from files where id=".$_GET['delete']." and owner='$uname';"));
      
          
          $q="DELETE FROM files where id=".$_GET['delete']." and owner='$uname';";
          if(mysqli_query($conn,$q)){
            unlink($row['path']."_0");
            unlink($row['path']."_1");
            unlink($row['path']."_2");
              echo "<h4 style='color:red'>File DELETED</h4>";
              //header('Refresh: 1;url=home.php');
          }
          else{
              echo "<h4 style='color:red'>Error Deleting File</h4>";
              //header('Refresh: 1;url=home.php');
          }
            }


?>

<div class="card mb-3 bg-warning">
            <div class="card-header">
              <i class="fas fa-table"></i>
              All file Repository</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <?php
if(isset($_GET['q']))
{
$sql ="SELECT * FROM files where name like '%".$_GET['q']."%';";

}else
{
  $sql ="SELECT * FROM files;";

}
 
if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
            echo "<thead>";
                echo "<th>#</th>";
                echo "<th>File Name</th>";
                echo "<th>Owner</th>";
                echo "<th>Size</th>";
                echo "<th>Description</th>";
                echo "<th>Download</th>";
                echo "<th>Delete</th>";
            echo "</thead>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td><i class=\"fas fa-file fa-fw\"></i>" . $row['name'] ."</td>";
                echo "<td><i class=\"fas fa-user fa-fw\"></i>" . $row['owner'] . "</td>";
                echo "<td><i class=\"fas fa-database fa-fw\"></i>" . $row['size'] . "</td>";
                echo "<td>" . $row['description']. "</td>";
               
                echo "<td><a href=\"download.php?down=".$row['id'] ."\" onclick=\"confirm('Do You Want to Download This File?');\"><i class='fas fa-download fa-fw'></a></td>";
                echo "<td><a href=\"file.php?delete=".$row['id'] ."\" onclick=\"confirm('Do You Want to Delete This File?');\"><i class='fas fa-trash fa-fw'></a></td>";
                 
            echo "</tr>";
        }

        echo "</table>";

        // Free result set

        mysqli_free_result($result);

    } else{

        echo "No Files found.";

    }

} else{

    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);

}
 $conn->close(); 

?></table>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated Result.</div>
          </div>
<?php
include"footer.php";
?>

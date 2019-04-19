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

if(isset($_GET['delete']))
{
    /* Get the owner name of the files that to be deleted too */
    $username = mysqli_fetch_array(mysqli_query($conn,"SELECT * from users where id=".$_GET['delete']))['username'];

    /* Now delete the user from users table */
    $q="DELETE FROM users where id=".$_GET['delete'];
    if(mysqli_query($conn,$q))
    {   
        // Now delete the user-files (physical)
        $sql = "SELECT * from files where owner='$username'";
        $result = mysqli_query($conn,$sql);
        $rows_count = mysqli_num_rows($result);
        if($rows_count == 1)
        {
            $row = mysqli_fetch_array($result);
            unlink($row['path']."_0");
            unlink($row['path']."_1");
            unlink($row['path']."_2");
        }
        elseif($rows_count > 1)
        {
            while($row = mysqli_fetch_array($result))
            {
                unlink($row['path']."_0");
                unlink($row['path']."_1");
                unlink($row['path']."_2");
            }
        }

        //Now delete the files stored in database
        mysqli_query($conn, "DELETE from files where owner='$username'");

        echo "<h4 style='color:red'>User is deleted!</h4>";
        //header('Refresh: 1;url=home.php');
    }
    else{
        echo "<h4 style='color:red'>Error Deleting User</h4>";
        //header('Refresh: 1;url=home.php');
    }
}


?>

<div class="card mb-3 bg-warning">
    <div class="card-header">
        <i class="fas fa-table"></i>Registered users
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <?php

                $sql ="SELECT * FROM users order by role desc";
                
                if($result = mysqli_query($conn, $sql))
                {
                    if(mysqli_num_rows($result) > 0)
                    {
                        echo "<thead>";
                        echo "<th>#</th>";
                        echo "<th>User Name</th>";
                        echo "<th>Role</th>";
                        echo "<th>Email</th>";
                        echo "<th>Files count</th>";
                        echo "<th>Disk usage</th>";
                        echo "<th>Delete</th>";
                        echo "</thead>";
                        while($row = mysqli_fetch_array($result))
                        {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td><i class=\"fas fa-user fa-fw\"></i>" . $row['username'] . "</td>";
                            $temp_name = $row['username'];
                            $temp_id = $row['id'];
                            if($row['role'] == 1)
                                echo "<td>Admin</td>";
                            else
                                echo "<td>User</td>";
                            echo "<td>" . $row['email'] . "</td>";

                            echo "<td>". mysqli_fetch_array(mysqli_query($conn,"SELECT count(id) as fcount from files where owner='$temp_name'"))['fcount'] ."</td>";
                            echo "<td>". mysqli_fetch_array(mysqli_query($conn,"SELECT sum(size) as fsize from files where owner='$temp_name'"))['fsize'] ." Kb</td>";

                            ?>

                            <td><a <?php if($_SESSION['role'] == 'admin' && $row['role'] == 1) echo "class='btn disabled'"; else echo "class='btn'"; ?> href="users.php?delete=<?php echo $row['id']; ?>" onclick="confirm('Do you want to delete this user?');"><i class='fas fa-trash fa-fw'></i> Delete user</a></td>

                            <?php
                            echo "</tr>";
                        }
                        echo "</table>";
                        // Free result set
                        mysqli_free_result($result);
                    } else{
                        echo "No User found.";
                    }

                } else{
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                }
                $conn->close(); 

                ?>
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Updated Result.</div>
</div>

<script>
    function unhide_p(id){$('p.p'+id).css("visibility","visible");}

    function change_role(id)
    {
        var select = document.getElementById('select' + id);
        var selected_index = select.selectedIndex;

        var xmlhttp;
        if(window.XMLHttpRequest)
        {
            xmlhttp = new XMLHttpRequest();
        }
        else
        {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        
        xmlhttp.onreadystatechange = function() 
        {
            if(this.readyState == 4 && this.status == 200)
            {
                $('p.p'+id).css("visibility","hidden");
            }
        };

        xmlhttp.open("GET","change_role.php?uid="+ id + "&role="+ selected_index,true);
        xmlhttp.send();
    }
</script>

<?php
include"footer.php";
?>

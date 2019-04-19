
<?php
include"server.php";
$sql ="SELECT * FROM files";
  
if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
 while($row = mysqli_fetch_array($result)){

echo "'".date("d-m-Y", strtotime($row['date']))."',";}

}
}


    	?>
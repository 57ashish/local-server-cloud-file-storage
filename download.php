<?php 
include 'header.php';
include "algo.php";
include "split.php";
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="w3-container">
  <h2><?php         if(isset($_GET['down'])){
              $row = mysqli_fetch_array(mysqli_query($conn, "Select path,name from files where id=".$_GET['down']));

$key = "";
                  //get password from data
            my_decrypt($row['path']."_0",$row['path']."_d0",'aes-256-cbc',$key);
            my_decrypt($row['path']."_1",$row['path']."_d1",'des-cbc',$key);
            my_decrypt($row['path']."_2",$row['path']."_d2",'rc2-cbc',$key);
            echo(merge_file($row['path'],$row['path']."_d",3));
            unlink($row['path']."_d0");
            unlink($row['path']."_d1");
            unlink($row['path']."_d2");
            echo $row['name'];
            //header("Location: ".$row['path']);
            }?></h2>
  <p>Downloading Will Start After Decrypting The File.</p>

  <div class="w3-light-grey">
    <div id="myBar" class="w3-container w3-green" style="height:24px;width:0%">
    </div>
  </div>

  <p id="myP"><!-- <span id="demo">0</span> -->Decrypting Files</p>
 
  </div>

<script>
  move();
  window.onbeforeunload = function() {
    if(confirm("Do you really want to leave?"))
    {
      //$.get("<?php echo "file.php?delete=".$_GET['down'];?>");
      return true;
    }
    else{
    return false;
  }
   //if we return nothing here (just calling return;) then there will be no pop-up question at all
   //return;
};
function move() {
  var elem = document.getElementById("myBar");   
  var width = 0;
  var id = setInterval(frame, 10);
  function frame() {
    if (width >= 100) {
      clearInterval(id);
      document.getElementById("myP").className = "w3-text-green w3-animate-opacity";
      document.getElementById("myP").innerHTML = "File Downloading Finished!";
      window.open('<?php  echo $row['path'];?>');

      // delete file after download
var frame = document.createElement("iframe");
frame.src = '<?php echo "file.php?tempdelete=".$_GET['down'];?>';
frame.style.position = "relative";
frame.style.left = "-9999px";
document.body.appendChild(frame);

    } else {
      width++; 
      elem.style.width = width + '%'; 
      var num = width * 1 / 10;
      num = num.toFixed(0)
     // document.getElementById("demo").innerHTML = num;
    }
  }
}

</script>
<?php
include"footer.php";
?>
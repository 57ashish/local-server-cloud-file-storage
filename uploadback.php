<?php
include"server.php";
include"split.php";
include"algo.php";
 $uname=$_SESSION['username'];
    $desired_dir="files/$uname/";
if (!file_exists($desired_dir)) {
    mkdir($desired_dir, 0777, true);
}
		if(isset($_FILES['files'])){
			$cat_name=$_GET['cat'];
			
			if($cat_name=="Select File Category"){
			    echo "Category Required";
			    header('Refresh: 1;url=upload.php');
			}
			else{
			    $count=0;
			    
			    foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
				    $file_name = $_FILES['files']['name'][$key];
				    $size =$_FILES['files']['size'][$key];
				    $file_f = ($size / 1024);
				    $file_size =round($file_f);
				    $file_tmp =$_FILES['files']['tmp_name'][$key];
				    $file_type=$_FILES['files']['type'][$key];
				    $path="files/$uname/$file_name";
				    
				    
				    if($size==0){
					    echo "<h6 style='color:red'>$file_name Exeeds upload limit</h6>";
				    }
				    else{
					    //include "db.php";
					    
					    if (file_exists("$desired_dir".$file_name))
					    {
						    echo "<h6 style='color:red'>".$file_name . " already exists.</h6>";
					    }
					    else
					    {//$file_type 
						    $query="INSERT into files(name,owner,size,path,description,date) VALUES('$file_name','$uname','$file_size kb','$path','$cat_name','".date('y-m-d')."')";
						    if(move_uploaded_file($file_tmp,"$desired_dir".$file_name)){			      
							    
							    if(mysqli_query($conn,$query)){
									echo "<p style='color:blue'>$file_name Uploaded </p>";
							    	$count=$count+1;
							    	$row = mysqli_fetch_array(mysqli_query($conn, "Select path from files where id=(select max(id) from files) and owner='$uname';"));
							    	//echo($row['path']);
									echo(split_file($row['path'],3));
									//echo "<p style='color:green'>Splited. </p>";
									$key = mysqli_fetch_array(mysqli_query($conn, "Select filekey from users where username='$uname';"));
							    	
							        my_encrypt($row['path']."_0",$row['path']."_0",'aes-256-cbc',$key['filekey']);
							        my_encrypt($row['path']."_1",$row['path']."_1",'des-cbc',$key['filekey']);
							        my_encrypt($row['path']."_2",$row['path']."_2",'rc2-cbc',$key['filekey']);
							        unlink($row['path']);
							        //echo "<p style='color:green'>Encrypted. </p>";
							    }else
							    {
							    	unlink("$desired_dir".$file_name);
							    	echo "<p style='color:red'>Error Ocured </p>".mysqli_error($conn);
							    }
							    
						    }
						    else{
							    echo "Error in adding Files";
						    }
					    }
				    }
			    }
			    if($count>0)
			    {echo "<h6 style='color:blue'>"."$count Files Uploaded<h6>";
			    //header('Refresh: 2;url=file.php');
			    //ob_end_flush();

				}
			}
		}
		?>
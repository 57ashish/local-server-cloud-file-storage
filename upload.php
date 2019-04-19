<?php
ob_start();
include"header.php";
			    $filtername="Select File Category";
				if(isset($_POST['categ'])){
				    $filter=$_POST['categ'];
				    if($filter=='audio/*'){
					$filtername="Music";
				    }
				    else if ($filter=='image/*'){
					$filtername="Images";
				    }
				    else if($filter=='video/*'){
					$filtername="Videos";
				    }
				    else if($filter=='application/*'){
					$filtername="Documents";
				    }
				    else{
					$filtername="Text Files";
				    }
				}
			    ?>
<script>
/* Script written by Adam Khoury @ DevelopPHP.com */
/* Video Tutorial: http://www.youtube.com/watch?v=EraNFJiY0Eg */
var ajax = new XMLHttpRequest();
function _(el){
	return document.getElementById(el);
}
function uploadcancel(){
ajax.abort();
  _("status").innerHTML ="Uploading canceled!";
}
function uploadFile(){
	
	//var file = _("file1").files[0];
if(_("file1").files.length==0)
	{alert("Select file");
return false;}
	// alert(file.name+" | "+file.size+" | "+file.type);
	var formdata = new FormData();
	//formdata.append("files", file);
	for (let i = 0; i < _("file1").files.length; i++) {
    let file = _("file1").files[i];

    formdata.append('files[]', file);
}

	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "uploadback.php?cat=<?php echo($filtername);?>");
	ajax.send(formdata);
}
function progressHandler(event){
	//_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
	var percent = (event.loaded / event.total) * 100;
	_("progressBar").value = Math.round(percent);
	_("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
}
function completeHandler(event){
	_("status").innerHTML = event.target.responseText;
	_("progressBar").value = 0;
	$("#file1").remove();
}
function errorHandler(event){
	_("status").innerHTML = "Upload Failed";
}
function abortHandler(event){
	_("status").innerHTML = "Upload Aborted";
}
</script>
 <div class="container">
 
   <div class="card card-register mx-auto mt-2 mb-3 bg-warning">
 
     <div class="card-header text-center">Upload Files</div> 
 
     <div class="card-body">


<div class="col-md-">
 
               <label for="exampleInputName">File Owner</label>
 
               <input class="form-control" type="text" name="uploader" value="<?php echo $uname;?>" readonly/>
 
             </div>

              
<div class="col-md-">
               <label for="exampleInputName">Category</label>
  <form action="" method="post">
					<select name="categ" class="form-control" id="categ" onchange="this.form.submit();" required>
					    <option value="<?=$filter?>"><?=$filtername?></option>
					    <option value="audio/*">Music</option>
					    <option value="image/*">Images</option>
					    <option value="video/*">Videos</option>
					    <option value="application/*">Documents</option>
					    <option value="text/*">Text Files</option>
					</select></form>
             </div>
	
			 
		    <form method="post" id="upload_form" action="upload.php?cat=<?=$filtername?>" enctype="multipart/form-data">
			<div class="form-row">
			<div class="col-md-6">
 
               <label for="exampleInputName">Select Files</label>

            <input class="form-control" type="file" id="file1" name="files[]" accept="<?=$filter?>" multiple required/>
 
             </div>
<div class="col-md-6">
 
               <label for="password">Password</label>
 
               <input class="form-control" type="text" id="key" name="key" value="<?php echo $uname;?>"/>
 
             </div></div>
	<hr>
	<div class="form-row">
			 <div class="col-md-6">
				    <button type="button" onclick="uploadFile()" value="" class="btn btn-danger"><i class="fas fa-upload fa-fw"></i>Upload</button>&nbsp&nbsp
				    
  <p id="loaded_n_total"></p>
			</div><div class="col-md-6">
			 <button type="button" id="cancel" onclick="uploadcancel()" class="btn btn-secondary"><i class="fas fa-ban fa-fw"></i>Cancel Upload</button><br><br>
				   
			</div>
			<div class="form-row"><div class="col-md-12"><h3 id="status"></h3></div></div>
			<div class="form-row">
			<div class="col-md-6">
			<progress id="progressBar" class="form-control" value="0" max="100" style="width:500px;"></progress>
				     </div>
			</div>
		    </form><br>
		    <div class="col-md-">
		</div>
	    </div>
	</div>

<?php
include"footer.php";
?>
<?php
include"header.php";
$row = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM users where username='".$_SESSION['username']."';")); 


if (isset($_POST['reg_user'])) {
 
// receive all input values from the form
 
$username = mysqli_real_escape_string($conn, $_POST['username']);
 
$email = mysqli_real_escape_string($conn, $_POST['email']);
$filekey= mysqli_real_escape_string($conn, $_POST['filekey']);
$password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
 
$password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);
  
$password_3 = mysqli_real_escape_string($conn, $_POST['password_3']);

// form validation: ensure that the form is correctly filled ...
 
// by adding (array_push()) corresponding error unto $errors array
 
if (empty($username)) { array_push($errors, "Username is required"); }
 
if (empty($email)) { array_push($errors, "Email is required"); }
 
if (empty($password_1)&&empty($password_2)) { 
   if($row['password']==$password_3){
$query = "UPDATE users set  email='$email',filekey='$filekey' where id='".$row['id']."'";
  
if(mysqli_query($conn, $query))
{
$_SESSION['username'] = $username;
 
$_SESSION['success'] = "Details Updated Successfully.";
 }else
 {
  array_push($errors, "Enter Current Password Correctly");
 }


}

//array_push($errors, "Password is required"); 
}
 
if ($password_1 != $password_2) {
 
array_push($errors, "The two passwords do not match");
 
}
 if (empty($password_3)) { array_push($errors, "Password is required"); }
// first check the database to make sure
 
// a user does not already exist with the same username and/or email
 

// Finally, register user if there are no errors in the form
 
if (count($errors) == 0 && (!empty($password_1)&&!empty($password_2))) {
 
$password = md5($password_3);//encrypt the password before saving in the database
// echo "$password and ".$row['password'];
//echo $password ;
 if($row['password']==$password){
$query = "UPDATE users set email='$email',filekey='$filekey', password='".md5($password_1)."' where id='".$row['id']."'";
  
if(mysqli_query($conn, $query))
{
$_SESSION['username'] = $username;
 
echo $_SESSION['success'] = "Details Updated Successfully.";
 }else
 {
  array_push($errors, "Enter Current Password Correctly");
 }


}else
 {
  array_push($errors, "Enter Current Password Correctly");
 }
//header('location: login.php');
 
}
 
}
?>
 <div class="container">
 
   <div class="card card-register mx-auto mb-3 bg-warning">
 
     <div class="card-header text-center">User Profile</div>
 
     <div class="card-body">
 
       <form method="post" action="profile.php">
 
         <?php include('errors.php'); ?>

         <input class="form-control" id="exampleInputName" type="hidden"   name="filekey" value="<?php echo $row['filekey']; ?>" >
 
         <div class="form-group">
 
           <div class="form-row">
 
             <div class="col-md-12">
 
               <label for="exampleInputName">Username</label>
 
               <input class="form-control" id="exampleInputName" type="text"   name="username" value="<?php echo $row['username']; ?>" readonly>
 
             </div>
 
           </div>
 
         </div>

         <div class="form-group">
 
           <div class="form-row">
 
             <div class="col-md-12">
 
               <label for="exampleInputName">Role</label>
 
               <input class="form-control" id="exampleInputName" type="text"   name="username" value="<?php echo $_SESSION['role']; ?>" readonly>
 
             </div>
 
           </div>
 
         </div>

         <div class="form-group">
 
           <label for="exampleInputEmail1">Email address</label>
 
           <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" name="email" value="<?php echo $row['email']; ?>" >
 
         </div>
 
         <div class="form-group">
 
           <div class="form-row">
 
             <div class="col-md-6">
               <label for="exampleInputPassword1">Current Password</label>
 
               <input class="form-control" id="exampleInputPassword1" type="password" name="password_3" >
 
             </div>
 
            <div class="col-md-6">
               <label for="exampleInputPassword1">Change Password</label>
 
               <input class="form-control" id="exampleInputPassword1" type="password" name="password_1" >
 
                
             </div>
 
           </div>
 <div class="form-row">
 <div class="col-md-6">
 
              <label for="exampleInputPassword1">Confirm Password</label>
 
               <input class="form-control" id="exampleInputPassword2" type="password" name="password_2" >

 
             </div>
             </div>
         </div>
 
          <button type="submit" class="btn btn-danger btn-block" name="reg_user">Update Profile Details</button>
 
       </form>
 
       <div class="text-center">
 
        
 
       <!--- <a class="d-block small" href="forgot-password.html">Forgot Password?</a>-->
 
       </div>
 
     </div>
 
   </div>
 
 </div>

 <?php
include"footer.php";
?>
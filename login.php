<?php include('server.php'); 

if(isset($_POST['login_user'])) 
{ 
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	
	if (empty($username)) 
	{
		array_push($errors, "Username is required");
	}
	
	if(empty($password)) 
	{
		array_push($errors, "Password is required");
	}
	
	if (count($errors) == 0) 
	{
		$password = md5($password);
	
		$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
	
		$results = mysqli_query($conn, $query);
	
		if (mysqli_num_rows($results) == 1) 
		{
			$_SESSION['username'] = $username;

			/* Create separate session if the user is perticularly admin */
			$role = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM users WHERE username='$username' AND password='$password'"))['role'];
			if($role == 1)
				$_SESSION['role'] = "admin";
			if($role == 0)
				$_SESSION['role'] = "user";

			$_SESSION['success'] = "You are now logged in";
			header('location: index.php');
		}
		else
		{
			array_push($errors, "Wrong username/password combination");
		}
	}
}

?>
 
<!DOCTYPE html>
 
<html lang="en">
 
<head>
 
 <meta charset="utf-8">
 
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
 <meta name="description" content="">
 
 <meta name="author" content="">
 
 <title>Secure File Storage</title>
 
 <!-- Bootstrap core CSS-->
 
 <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 
 <!-- Custom fonts for this template-->
 
 <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
 
 <!-- Custom styles for this template-->
 
 <link href="css/sb-admin.css" rel="stylesheet">
 
</head>
 
<body class="bg-danger">
 
 <div class="container">
 
   <div class="card card-login mx-auto mt-5 bg-danger ">
 
     <div class="card-header text-center text-bold"><img src="login.png" width="60px" height="60px"></div>
 
     <div class="card-body">
 
       <form method="post" action="login.php">
 
          <?php include('errors.php'); ?>
 
         <div class="form-group">
 
           <label for="exampleInputEmail1" style="color:white;">Username</label>
 
           <input class="form-control"  type="text" name="username">
 
         </div>
 
         <div class="form-group">
 
           <label for="exampleInputPassword1" style="color:white;">Password</label>
 
           <input class="form-control"  type="password" name="password">
 
         </div>
 
       
 
         <button type="submit" class="btn btn-warning btn-block" name="login_user">Login</button>
 
       </form>
 
       <div class="text-center">
 
         <a class="d-block small mt-3" href="register.php" style="color:white;">Register an Account</a>
 
       </div>
 
     </div>
 
   </div>
 
 </div>
 
 <!-- Bootstrap core JavaScript-->
 
 <script src="vendor/jquery/jquery.min.js"></script>
 
 <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
 
 <!-- Core plugin JavaScript-->
 
 <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
 
</body>
 
</html>
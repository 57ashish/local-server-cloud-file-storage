<?php
include"header.php";
 $files = mysqli_fetch_array(mysqli_query($conn,"SELECT count(*) as fcount FROM files where owner='".$_SESSION['username']."';")); 
 $file = mysqli_fetch_array(mysqli_query($conn,"SELECT sum(size) as fsize FROM files where owner='".$_SESSION['username']."';")); 
 $users = mysqli_fetch_array(mysqli_query($conn,"SELECT count(*) as ucount FROM users")); 
 $filea = mysqli_fetch_array(mysqli_query($conn,"SELECT count(*) as fcount FROM files;")); 

echo $_SESSION['role'];
?>
<div class="row">
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-warning o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fas fa-fw fa-database"></i>
        </div>
        <div class="mr-5"><i class="fas fa-file fa-fw"></i><?php echo $files['fcount']; ?>+Files</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="file.php">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-info o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fas fa-fw fa-file"></i>
        </div>
        <div class="mr-5"><i class="fas fa-database fa-fw"></i><?php echo $file['fsize']; ?> Kb</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="file.php">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  
  <?php if($_SESSION['role'] != 'user') { ?>

  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-success o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fas fa-fw fa-user"></i>
        </div>
        <div class="mr-5"><i class="fas fa-user fa-fw"></i><?php echo $users['ucount']; ?>+ Users</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="users.php">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-danger o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fas fa-fw fa-list"></i>
        </div>
        <div class="mr-5"><i class="fas fa-file fa-fw"></i><?php echo $filea['fcount']; ?> Total Files</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="all_files.php">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>

  <?php } ?>

</div>



<script src="vendor/chart.js/Chart.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>

 <?php
include"footer.php"
 ?>


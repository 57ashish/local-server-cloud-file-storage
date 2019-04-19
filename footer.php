 </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer bg-dark">
          <div class="container my-auto">
            <div class="copyright text-center text-white my-auto">
              <span>Created by Ashish Kumar, Aditya Dhomne & Athrav Partap singh | &copy; April 2019
</span>
            </div>
          </div>
        </footer>
 <?php foreach($errors as $value) {
  print "<a class=\"dropdown-item\" href=\"profile.php\">".$value." </a><div class=\"dropdown-divider\"></div>";
} ?>
      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog"  role="document">
        <div class="modal-content bg-danger" style="border-radius: 15px;">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are You sure?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
         
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-warning" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="js/sb-admin.min.js"></script>
    <!-- <script src="js/demo/datatables-demo.js"></script>-->
   
   <!--  <script src="js/demo/chart-area-demo.js"></script>-->
  </body>

</html>

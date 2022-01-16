<?php 

require_once 'require/database.php';
$db = new Database();

// if (isset($_SESSION['user'])) {
//   if ($_SESSION['user']['role_id'] == 1) {
//     header("location:home.php");
//     exit;
//   }
//   else if ($_SESSION['user']['role_id'] == 2) {
//     header("location:driver_home.php");
//     exit;
//   }
//   else if ($_SESSION['user']['role_id'] == 3) {
//     header("location:client_home.php");
//     exit;
//   }
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Halo Ride</title>

  <link rel="stylesheet" type="text/css" href="css/w3.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">

<?php
  
  if (isset($_GET['msg']) && $_GET['msg'] == "logout") {
    unset($_SESSION['user']);
    session_destroy();
  }
?>


<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index.php" class="h2"><b>Halo </b>Ride</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Login Yourself ..!</p>
      
        <?php 
          if (isset($_GET['msg'])) {
            echo "<p align='center' style='color:white;padding:10px;' class='btn-warning'>".$_GET['msg']."</p>";
          } 
        ?>
      

      <form action="login_process.php" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
          <div class="col-4">
            <input type="submit" class="btn btn-primary btn-block" value="Sign In" />
            <!-- <button type="submit" class="btn btn-primary btn-block">Sign In</button> -->
          </div>
          <!-- /.col -->
        </div>
      </form>

     

      <p class="ml-4">
        <a href="forgot_password.php">I forgot my password</a>
      </p>
      <p class="ml-4">
        <a href="register.php" class="text-center">Register yourself..!</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>

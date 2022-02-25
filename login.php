<?php 
session_start();
  include "db.php";
  if (isset($_SESSION['UserLogedIn']) && $_SESSION['UserLogedIn']) {
     echo "<script>window.location.replace('dashboard.php');</script>";
  }
  if(isset($_POST['login'])){
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = mysqli_real_escape_string($conn, $_POST['password']);

   $admin_select = "SELECT * FROM admin WHERE email='$email' AND password='$password'" ;
   $run = mysqli_query($conn, $admin_select);
   if(mysqli_num_rows($run)>0){
    $userdata = mysqli_fetch_assoc($run);
    $_SESSION['UserLogedIn']=true;
    $_SESSION['email']=$userdata['email'];
    $_SESSION['full_name']=$userdata['full_name'];
   
    /*if($email){
      echo "<script>window.location.replace('index.php');</script>";
    }else{
      echo "<script>window.location.replace('login.php');</script>";
    }*/
    //echo "<script>alert('user exist');</script>";
    echo "<script>window.location.replace('dashboard.php');</script>";
   }else{
    echo "<script>alert('Incorect Email Id/Password');</script>";
   }
  }
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <p><b>Login</b> Form</p>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <!-- <p class="login-box-msg">Sign in to start your session_start</p> -->
      <div class="text-center mb-3">
        <img src="img/lock.png" width="30%" alt="">
      </div>

      <form method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email Id" autofocus required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" autofocus required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="login" class="btn btn-primary btn-block">Log In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->  
  </div>
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

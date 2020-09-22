<?php
session_start();

$_SESSION['autorizado']=false;


$password = '';
$email = '';

if (isset($_POST['email']) && isset($_POST['password'])) {

  if ($_POST['email'] == '') {
    $msg.='El email es requerido! <br>';
  }

  if ($_POST['password'] == '') {
    $msg.='La contraseña es requerida! <br>';
  }

  $email = strip_tags($_POST['email']);
  $password = strip_tags($_POST['password']);


  try {

    $password = sha1($password);

    $connection_bd = new PDO('mysql:host=localhost; dbname=clase_fray', 'root', '');
    $connection_bd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection_bd -> exec('SET CHARACTER SET utf8');

    $sql_users = "SELECT * FROM usuarios WHERE usuarios_email=? AND usuarios_password=?";

    $resultado_query = $connection_bd->prepare($sql_users);

    $resultado_query -> execute(array($email, $password));

    $resultado_query = $resultado_query->fetchAll(PDO:: FETCH_ASSOC);

    $cantidad_usuarios = count($resultado_query);

    if ($cantidad_usuarios == 1) {

      $_SESSION['autorizado']=true;
  
      echo '<meta http-equiv="refresh" content="1,starter.php">';
    }

  } catch (Exception $e) {
    die('Error: '.$e->GetMessage());
  } finally {
    $connection_bd = null;
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
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="login.php" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>

</body>
</html>

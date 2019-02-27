<?php
session_start();
require_once '../includes/class.query.php';

// session redirect
if(isset($_SESSION['slr_login'])) {
  header("Location: appointment.php");
}

// Login submit
if(!empty($_POST)) {

  $data = $_POST;

  if(!empty($data['remember_me'])) {
    setcookie("admin_email",$data['admin_email'],time() + (86400 * 30)); // 1 day
  }
  else {
    setcookie("admin_email","",time()-1);
  }

  $admin_table = new Query();
  $admin_table->access_table = 'slr_admin';

  // Get admin data
  $select['conditions'] = "admin_email = '".$data['admin_email']."' AND admin_password = '".md5($data['admin_password'])."' AND admin_status=1";
  $select['select'] = array('admin_id,admin_name,admin_profile_image');
  $admin_data = $admin_table->select($select);

  if(!empty($admin_data)) {

    $_SESSION['user_id'] = $admin_data[0]['admin_id'];
    $_SESSION['user_name'] = $admin_data[0]['admin_name'];
    $_SESSION['user_profile_image'] = $admin_data[0]['user_profile_image'];
    $_SESSION['slr_login'] = "true";
    header("Location: appointment.php");
  }
  else {
    $err = 'Invalid email id / password';
  }
}

// Get cookie
if(isset($_COOKIE['admin_email']) && empty($data)) {
  $data['admin_email'] = $_COOKIE['admin_email'];
}


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Student Loan Repayment</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="dist/css/custom.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
    .login-logo
    {
      font-size: 27px;
    }
    .login-box, .register-box {
      width: 450px;
      margin: 7% auto;
  }
  .err {
    color: red;
    font-size: 14px;
    text-align: center;
  }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="login.php"><b>SLR</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Login</p>

    <form action="#" method="post">
      <p class="err"> <?php if(!empty($err)) echo $err; ?> </p> 
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="admin_email" value="<?php if(!empty($data['admin_email'])) echo $data['admin_email']; ?> " />
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="admin_password" />
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember_me" value="1" <?php if(!empty($data['remember_me']) || isset($_COOKIE['admin_email'])) echo "checked"; ?> /> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>

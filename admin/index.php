<?php require('global.php'); ?>
<!DOCTYPE html>
<html>
<head>   
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login | autoline.pk</title>

     <!-- Favicon -->
    <link rel="shortcut icon" href="<?=$genrlimgpath?>admin.jpg">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?=$root_path; ?>/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=$root_path; ?>/assets/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?=$root_path; ?>/assets/bower_components/select2/dist/css/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=$root_path; ?>/assets/dist/css/AdminLTE.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?=$root_path; ?>/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?=$root_path; ?>/assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="<?=$root_path; ?>/assets/plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?=$root_path; ?>/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins -->
    <link rel="stylesheet" href="<?=$root_path; ?>/assets/dist/css/skins/_all-skins.min.css">
    <!-- alertify css -->
    <link rel="stylesheet" href="<?=$root_path; ?>/assets/plugins/alertifyjs/css/alertify.min.css">
    <link rel="stylesheet" href="<?=$root_path; ?>/assets/plugins/alertifyjs/css/themes/semantic.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>
<?php //echo $_SERVER['SERVER_NAME']."/autoline/admin/";?>
<body class="hold-transition login-page">
<div class="login-box">
  	<div class="login-box-body">
    	<p class="login-box-msg">Sign in to Admin Panel</p>

    	<form>
      		<div class="form-group has-feedback">
        		<input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      		</div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
      		<div class="row">
    			<div class="col-xs-4">
          			<a class="btn btn-primary btn-block btn-flat" id="btn_login" onclick="loginFunc()" name="login"><i class="fa fa-sign-in"></i> Sign In</a>
        		</div>
      		</div>
    	</form>
      <div id="add_response_msg"></div>
      <br>
      <a href="../"><i class="fa fa-home"></i> Home</a>
  	</div>
</div>
	
<?php include 'includes/scripts.php' ?>
</body>
</html>
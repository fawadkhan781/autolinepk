<?php 
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);
//print_r($uri_segments);
 if($uri_segments[3]=='setting'){
 require('../../global.php'); }else{
    require('../global.php');
 }
session_start();
if( $uri_segments[4] != ''){ $cpath=$uri_segments[3].'/'.$uri_segments[4]; }else{ $cpath=$uri_segments[3]; }
if(!isset($_SESSION['logged_in'])  && $_SESSION['logged_in'] != TRUE)
{ 
    header('Location: ../index.php');
    exit();
}else{
    if($_SESSION['logged_in'] == TRUE) {
        $logined = $_SESSION['logged_in'];
        $adminid = $_SESSION['adminid'];
        $adminphoto = $_SESSION['photo'];
        $admcreated = $_SESSION['created_on'];
        $admfname = $_SESSION['adminfull'];
    } else {
        header('Location: ../'.$cpath);
    }
}

?>
<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
     <?php $query1 = "SELECT * FROM options"; 
    $res_oppt = mysqli_query($connection,$query1);
    if(mysqli_num_rows($res_oppt) > 0){
      while ($row = mysqli_fetch_array($res_oppt)) {?>
  	<title><?=$row['sitetitle']; ?></title>
  <?php } } ?>
  	<!-- Tell the browser to be responsive to screen width -->
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Favicon -->
    <link rel="shortcut icon" href="<?=$genrlimgpath?>admin.jpg">
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
  	<style type="text/css">
  .mt20{margin-top:20px;}
.bold{font-weight:bold;}
      /*chart style*/
      #legend ul {list-style: none;}
      #legend ul li {display: inline;padding-left: 30px;position: relative;margin-bottom: 4px;/* border-radius: 5px;*/padding: 2px 8px 2px 28px;font-size: 14px;cursor: default;-webkit-transition: background-color 200ms ease-in-out;-moz-transition: background-color 200ms ease-in-out;-o-transition: background-color 200ms ease-in-out;transition: background-color 200ms ease-in-out;}
      #legend li span { display: block; position: absolute; left: 0; top: 0; width: 20px; height: 100%;/* border-radius: 5px;*/}
      /* MediaQuery for Desktop or larger screen */
      @media (min-width:  1000px){
        .mrgrgt5{margin-right: 5px !important;}
        .viewsite {margin-right: 4em;}
        .topMenuHover{margin-right: 1em;}
        .viewsite:hover,.topMenuHover:hover{ background-color: #357ca5;}
      }
      /* Media Query for Mobile/Tablet Screen only */
      @media (max-width:  768px){
    
      }
  	</style>
</head>
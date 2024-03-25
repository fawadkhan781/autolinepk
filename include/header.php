<?php 
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);
 //print_r($uri_segments);
 if($uri_segments[2]=='page'){ include '../global.php'; include '../include/dbcon.php';}else{
 	include 'global.php';
 	include 'include/dbcon.php';
 }
      session_start(); ?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <?php $query1 = "SELECT * FROM options"; 
    $res_oppt = mysqli_query($connection,$query1);
    if(mysqli_num_rows($res_oppt) > 0){
      while ($row = mysqli_fetch_array($res_oppt)) {?>
  	<title><?=$row['sitetitle']; ?></title>
  <?php } } ?>
      <!-- Favicon -->
    <link rel="shortcut icon" href="<?=$genrlimgpath?>admin.jpg">
	<link href="https://fonts.googleapis.com/css?family=Muli:400,600,700,800" rel="stylesheet" >
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700" rel="stylesheet" type="text/css">		 
	<link href="https://fonts.googleapis.com/css?family=Handlee" rel="stylesheet">	
	<link rel="stylesheet" href="<?=$root_path;?>assets/css/font-awesome.css" />
	<link rel="stylesheet" href="<?=$root_path;?>assets/css/themify-icons.css" />
	<link rel="stylesheet" href="<?=$root_path;?>assets/css/animate.css" />
	<link rel="stylesheet" href="<?=$root_path;?>assets/css/owl.theme.default.min.css" />
	<link rel="stylesheet" href="<?=$root_path;?>assets/css/owl.carousel.min.css" />
	<link rel="stylesheet" href="<?=$root_path;?>assets/css/meanmenu.min.css?ver=1.0" />
	<link rel="stylesheet" href="<?=$root_path;?>assets/css/remodal.css" />
	<link rel="stylesheet" href="<?=$root_path;?>assets/css/remodal-default-theme.css" />
	<link rel="stylesheet" href="<?=$root_path;?>assets/css/venobox.css" />
	<link rel="stylesheet" href="<?=$root_path;?>assets/css/bootstrap.min.css" />	
	<link rel="stylesheet" href="<?=$root_path;?>assets/css/style.css?ver=1.0" />
	<link rel="stylesheet" href="<?=$root_path;?>assets/css/responsive.css" />
	<!-- alertify css -->
    <link rel="stylesheet" href="<?=$adminpath; ?>assets/plugins/alertifyjs/css/alertify.min.css">
    <link rel="stylesheet" href="<?=$adminpath; ?>assets/plugins/alertifyjs/css/themes/semantic.min.css">
    <style>
    	.mini-cart-wrapper {width: 256px;}#slider_area, .single_slide, .single-slide-item-table{height: 450px !important;}
    	.btntitle{border: none;background: transparent;font-weight: 500;} .addcrtbtn{color: #fff !important;}
    	.product-grid .product-content{padding: 0 !important;bottom: -31px;}
    	.product-grid .rating{padding: 0px 0 7px;}
	/* Mediaqueries for responsive desktop only */
	@media (min-width: 900px){
		a.logo { margin: 0 0px 0 -23px;}
	} 
	/* Mediaqueries for responsive mobile and tablet only */
	@media (max-width: 768px){
		

	}
    </style>	
</head>
<body>

	<!--  Start Header  -->
	<header id="header_area">
		<div class="header_top_area">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<div class="hdr_tp_left">
							<div class="call_area">
								 <?php $query1 = "SELECT * FROM options"; 
								    $res_oppt = mysqli_query($connection,$query1);
								    if(mysqli_num_rows($res_oppt) > 0){
								      while ($row = mysqli_fetch_array($res_oppt)) {?>
								 
								<span class="single_con_add"><i class="ti-mobile"></i> <?=$row['phone']; ?></span>
								<span class="single_con_add"><i class="ti-email"></i> <a href="mailto:<?=$row['email']; ?>" class="__cf_email__" ><?=$row['email']; ?></a></span>
								 <?php } } ?>
							</div>
						</div>
					</div>

					<div class="col-xs-12 col-sm-6">

						<ul class="hdr_tp_right text-right">
						<li class="account_area"><a href="<?=$root_path;?><?=(isset($_SESSION['userlogged_in']) ? 'user.php': 'account.php');?>"><i class="ti-user"></i> <?=(isset($_SESSION['userlogged_in']) ? $_SESSION['userfull'].'<a href="'.$root_path.'logout.php"> -- logout</a>' : 'My Account');?></a></li>
						<li class="adminlogin">
							<a href="<?=$root_path;?>admin/" target="_blank">
								<i class="fa fa-sign-in" aria-hidden="true"></i> Admin Panel
							</a>
						</li>
						</ul>
					</div>
				</div>
			</div>
		</div> <!--  HEADER START  -->

		<div class="header_btm_area">
			<div class="container">
				<div class="row">		
					<div class="col-xs-12 col-sm-12 col-md-3"> 
						<a class="logo" href="<?=$root_path;?>"> 
							<?php $query1 = "SELECT * FROM options"; 
						    $res_oppt = mysqli_query($connection,$query1);
						    if(mysqli_num_rows($res_oppt) > 0){
						      while ($row = mysqli_fetch_array($res_oppt)) {?>
						      	<img alt="" src="<?=$genrlimgpath.'general/'.$row['logo'];?>">
						    <?php }} ?>
					   </a> 
					</div><!--  End Col -->

					<div class="col-xs-12 col-sm-12 col-md-7 text-center">
						<div class="menu_wrap">
							<div class="main-menu">
								<nav>
						      <ul>
						 <?php
                  $query1 = "SELECT * FROM category WHERE cat_status=1 ORDER BY cat_sort ASC";
                    $res_pro = mysqli_query($connection,$query1);
                    if(mysqli_num_rows($res_pro) > 0){
                       while ($row = mysqli_fetch_array($res_pro)) {
                       $hidshow=($row['inmenu'] =='yes' ? 'yes' : 'no');
                       if($hidshow =='no'){ ?>
								      <li class="<?=$hidshow;?>"><a href="<?=($row['cat_slug']=='index' ? $root_path : $page.$row['cat_slug'].'.php'); ?>"><?=$row['name']; ?>
								      <?php $cgid=$row['id']; $query7 = "SELECT * FROM subcategory WHERE category_id='$cgid' AND subcat_status=1";
                        $res_pro7 = mysqli_query($connection,$query7);
                        if(mysqli_num_rows($res_pro7) > 0){?>
                        	<i class="fa fa-angle-down"></i></a>
								      <!-- Sub Menu -->
												<ul class="sub-menu">
													 <?php while ($row7 = mysqli_fetch_array($res_pro7)) {
													 $submnu=($row7['inmenu'] =='yes' ? 'yes' : 'no');
                           if($submnu =='no'){  ?>
													   <li><a href="<?=$page.$row7['subcat_slug'];?>.php?id=<?=$row7['id'];?>"><?=$row7['subcat_name'];?></a></li>
												<?php } }?>
												</ul>
											<?php }else{ ?> </a><?php } ?>
									   </li>	
							<?php  } } } ?>			
									</ul>
								</nav>
							</div> <!--  End Main Menu -->										
						</div>
					</div><!--  End Col -->		

					<div class="col-xs-12 col-sm-12 col-md-2">
						<div class="right_menu pull-right">
							<ul class="nav">
								<li>
									<div class="search_icon">
										<a href="#modal" data-remodal-target="modal"><i class="ti-search search_btn"></i></a>

										<div class="search-box remodal" data-remodal-id="modal">
											<button data-remodal-action="close" class="remodal-close"></button>
											<form action="#" method="Post">
												<div class="input-group">
													<input type="text" class="form-control"  placeholder="enter keyword"/>				
													<button type="submit" class="btn btn-default"><i class="ti-search"></i></button>			
												</div>
											</form>
										</div>
									</div>
								</li>

								<li>
									<div class="cart_menu_area">
										<div class="cart_icon">
											<a href="<?=$root_path;?><?=(isset($_SESSION['userlogged_in']) ? 'checkout.php': 'account.php');?>"><i class="ti-shopping-cart-full" aria-hidden="true"></i></a>
											<span class="cart_number"><?=(isset($_SESSION['userlogged_in']) ? '': '0');?></span>
										</div>
											<?php 
												if(isset($_SESSION['userlogged_in'])){
											    $sessionid=session_id();
											    $sql = "SELECT * FROM `cart` WHERE `session_id`='$sessionid'";
											    $result = mysqli_query($connection,$sql);
											    $tolcart=0;
											    if(mysqli_num_rows($result) > 0){?>
													<!-- Mini Cart Wrapper -->
												<div class="mini-cart-wrapper">
													<!-- Product List -->
													<div class="mc-pro-list fix">
													<?php
											       while ($rowup = mysqli_fetch_array($result)){ 
											       $tolcart +=$rowup['total_price']; ?>
														 <div class="mc-sin-pro fix">
															<a href="#" class="mc-pro-image float-left"><img src="<?=$productimgpath.$rowup['image'];?>" style="width: 50px;" alt="" /></a>
															<div class="mc-pro-details">
																<a><?=$rowup['name'];?></a>
																<span><?=$rowup['qty'];?>x$<?=number_format($rowup['price']);?></span>
																<!--<a class="pro-del" href="#"><i class="fa fa-times-circle"></i></a>-->
															</div>
														</div>
													 <?php } ?>
													</div>
													<!-- Sub Total -->
													<div class="mc-subtotal fix">
														<h4>Subtotal <span>$<?=number_format($tolcart);?></span></h4>												
													</div>
													<!-- Cart Button -->
													<div class="mc-button">
														<a href="<?=$root_path?>checkout.php" class="checkout_btn">checkout</a>
													</div>
												</div>
												<?php } } ?>												
									</div>	

								</li>
							</ul>
						</div>	
					</div><!--  End Col -->	

				</div>
			</div>
		</div>
	</header>
<!--  End Header  -->
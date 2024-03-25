<!--  FOOTER START  -->
<footer class="footer_area">
	<div class="footer-top">
		<div class="container">
			<div class="row">				
				<div class="col-lg-6">
					<div class="single_ftr footer-contact-info">
						<h4 class="sf_title">Contacts</h4>
						<ul>
					    <?php $query1 = "SELECT * FROM options"; 
					    $res_oppt = mysqli_query($connection,$query1);
					    if(mysqli_num_rows($res_oppt) > 0){
					      while ($row = mysqli_fetch_array($res_oppt)) {?>
							<li><i class="ti-location-pin"></i> <?=$row['address']; ?></li>
							<li><i class="ti-mobile"></i> <?=$row['phone']; ?></li>
							<li><i class="ti-email"></i> <a href="mailto:<?=$row['email']; ?>" class="__cf_email__"> <?=$row['email']; ?></a> </li>
							<?php } } ?>
						</ul>
					</div>
				</div> <!--  End Col -->

				<div class="col-lg-6">
					<div class="single_ftr">
						<h4 class="sf_title">Follow us</h4>
						<div class="ftr_social_icon">
						<ul>
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
							<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram"></i></a></li>
						</ul>
					</div>
					</div>
				</div> <!--  End Col -->

			</div>
		</div>
	</div>


	<div class="ftr_btm_area">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<p class="copyright_text text-center">  <?php $query4 = "SELECT * FROM options";$res_oppt4 = mysqli_query($connection,$query4);
					    if(mysqli_num_rows($res_oppt4) > 0){  while ($row4 = mysqli_fetch_array($res_oppt4)) {echo $row4['copyright']; } } ?></p>
				</div>
			</div>
		</div>
	</div>
</footer>
<!--  FOOTER END  -->

<script src="<?=$root_path;?>assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="<?=$root_path;?>include/ajax.js?ver=1.1"></script>
<script src="<?=$root_path;?>assets/js/popper.min.js"></script>
<script src="<?=$root_path;?>assets/js/bootstrap.min.js"></script>
<script src="<?=$root_path;?>assets/js/jquery.meanmenu.min.js"></script>
<script src="<?=$root_path;?>assets/js/jquery.mixitup.js"></script>
<script src="<?=$root_path;?>assets/js/jquery.counterup.min.js"></script>
<script src="<?=$root_path;?>assets/js/remodal.js"></script>
<script src="<?=$root_path;?>assets/js/waypoints.min.js"></script>
<script src="<?=$root_path;?>assets/js/wow.min.js"></script>
<script src="<?=$root_path;?>assets/js/jquery.countdown.js"></script>
<script src="<?=$root_path;?>assets/js/venobox.min.js"></script>
<script src="<?=$root_path;?>assets/js/owl.carousel.min.js"></script>
<script src="<?=$root_path;?>assets/js/simplePlayer.js"></script>
<script src="<?=$root_path;?>assets/js/scrolltopcontrol.js"></script>
<script src="<?=$root_path;?>assets/js/main.js?ver=1.0"></script>
<!--alertify-->
<script src="<?=$adminpath;?>assets/plugins/alertifyjs/alertify.js"></script>
</body>
</html>
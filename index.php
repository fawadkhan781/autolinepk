<?php include 'include/header.php' ?>
<!-- Start Slider Area -->
<section id="slider_area" class="text-center">
	<div class="slider_active owl-carousel">
	 <?php
           $query0 = "SELECT * FROM slider WHERE status=1";
            $res_cat = mysqli_query($connection,$query0);
            if(mysqli_num_rows($res_cat) > 0)
            {
              $total = 0;
               while ($srow = mysqli_fetch_array($res_cat)) {?>
		<div class="single_slide" style="background-image: url(admin/assets/images/slider/<?php echo $srow['image'];?>); background-size: cover; background-position: center;">
			<div class="container">	
				<div class="single-slide-item-table">
					<div class="single-slide-item-tablecell">
						<div class="slider_content text-left slider-animated-1">						
							<p class="animated"><?=$srow['categoryname'];?></p>
							<h1 class="animated"><?=$srow['title'];?></h1>
							<h4 class="animated"><?=$srow['subtitle'];?></h4>
						<a href="#" class="btn main_btn animated">Shop Now</a>
							<a href="<?=$srow['link'];?>" class="btn main_btn coll_btn animated">Collection</a>
						</div>
					</div>
				</div>						
			</div>
		</div>
	<?php } } ?>	
	</div>
</section>
<!-- End Slider Area -->		

<!--  Promo ITEM STRAT  -->
<section id="promo_area" class="section_padding">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-6 col-sm-12">							
				<div class="single_promo">
					<img src="assets/img/promo/1.jpg" alt="promo image">
					<div class="box-content">
						<div class="promo-content">
							<h3 class="title">Cars</h3>
							<span class="post">Body Parts Collection</span>
							<p>You Will Love Upto 60% Off</p>
						</div>
					</div>
				</div>													
			</div><!--  End Col -->						
			
			<div class="col-lg-4 col-md-6 col-sm-12">							
				<div class="single_promo">
					<img src="assets/img/promo/2.jpg" alt="promo image">
					<div class="box-content">
						<div class="promo-content">
							<h3 class="title">Vehicle Accessories</h3>
							<span class="post">Different Parts Available</span>
							<p>With Good Quality and Price</p>
						</div>
					</div>
				</div>														
			</div><!--  End Col -->					

			<div class="col-lg-4 col-md-6 col-sm-12">					
				<div class="single_promo">
					<img src="assets/img/promo/3.jpg" alt="promo image">
					<div class="box-content">
						<div class="promo-content">
							<h3 class="title">Vehicle Engine</h3>
							<span class="post">All Engine Parts Available</span>
							<p>You Will Get with genie</p>
						</div>
					</div>
				</div>									
			</div><!--  End Col -->					
		</div>			
	</div>		
</section>
<!--  Promo ITEM END -->	


<!-- Start product Area -->
<section id="product_area" class="section_padding">
	<div class="container">		
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="section_title">	
					<span class="sub-title">Check Our All Products</span>
					<h2>Our Products</h2>
					<div class="divider"></div>							
				</div>
			</div>
		</div>
	
		<div class="text-center">
			<div class="product_filter">
				<ul>
						<li class=" active filter" data-filter="all">All</li>
						<?=(isset($row['inmenu'])=='yes' ? 'checked' : '' ); ?>
		    <?php 
          $querycat = "SELECT * FROM category WHERE cat_status=1";
           $res_cat = mysqli_query($connection,$querycat);
            if(mysqli_num_rows($res_cat) > 0){
               while ($catrow = mysqli_fetch_array($res_cat)) {?>
					     <li class="filter <?=($catrow['infilter'] ? $catrow['cat_slug'] : '');?>" data-filter=".<?=($catrow['infilter'] !='yes' ? $catrow['cat_slug'] : '');?>"><?=($catrow['infilter'] !='yes' ? $catrow['name'] : '');?></li>
				 <?php } } ?>
				</ul>
			</div>
		
			<div class="product_item">
				<div class="row">					
				<?php $queryp = "SELECT products.id as postid, products.name as prodtitle, products.description, products.slug as prodslug, products.price as
				 prodprice, products.model_id, products.image as prodimage, products.product_qty as product_qty, products.created_at, subcategory.id, category.id, subcategory.subcat_name, model.name as modelname,category.name as catname,category.cat_slug as catslug FROM products INNER JOIN category ON products.category_id=category.id  INNER JOIN subcategory ON products.subcategory_id=subcategory.id INNER JOIN model ON products.model_id=model.id WHERE products.product_status=1";
        $res_prd = mysqli_query($connection,$queryp);
        if(mysqli_num_rows($res_prd) > 0)
        {
          $total = 0;
          while ($prow = mysqli_fetch_array($res_prd)) {?>
						<div class="col-lg-3 col-md-4 col-sm-6 mix sale <?=$prow['catslug'];?>">
							<div class="product-grid">
								<div class="product-image">
									<a href="#">
										<img class="pic-1" src="<?=$productimgpath.$prow['prodimage'];?>" alt="product image">
									</a>
									<ul class="social">
										<!--<li><a href="#" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>-->
									</ul>
									<span class="product-new-label">Sale</span>
								</div>
								<ul class="rating">
									<li class="fa fa-star"></li>
									<li class="fa fa-star"></li>
									<li class="fa fa-star"></li>
									<li class="fa fa-star"></li>
									<li class="fa fa-star"></li>
								</ul>
							
								<?=($prow['product_qty'] > 0 ? '<h4 class="text-success" style="font-size:12px">In stock <i class="fa fa-check-circle text-success" aria-hidden="true"></i></h4>' : '<h4 class="text-danger" style="font-size:12px">Out stock <i class="fa fa-times-circle text-danger" aria-hidden="true"></i></h4>');?> 

								<div class="product-content">
									<form action="single-product.php" method="post">
									<h3 class="title">
										<button type="submit" class="btntitle">
										<?php
											$title = $prow['prodtitle'];
											$limit = 30;

											if (mb_strlen($title) > $limit) {
												$limitedTitle = mb_substr($title, 0, $limit) . '...';
											} else {
												$limitedTitle = $title;
											}

											echo $limitedTitle;
											?>

										
										</a><input type="hidden" name="postid" value="<?=$prow['postid'];?>"></h3>
									<div class="price">$<?=number_format($prow['prodprice'],2);?>
									
									</div>
									<button type="submit" class="add-to-cart btn btn-sm btn-primary addcrtbtn">+ View</button>
								<input type="hidden" name="postid" value="<?=$prow['postid'];?>"></form>
								</div>
							</div>
			     </div><!-- End Col -->	
				<?php } } ?>		

				</div>
			</div>
		</div>
	</div>
</section>
<!-- End product Area -->


<!--  Process -->
<section class="process_area section_padding">
	<div class="container">
		<div class="row text-center">		
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="single-process">
					<!-- process Icon -->
					<div class="picon"><i class="ti-truck"></i></div>
					<!-- process Content -->
					<div class="process_content">
						<h3>Free Shipping</h3>
						<p>Best Shipping Service</p>
					</div>
				</div>	
			</div>	<!-- End Col -->				

			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="single-process">
					<!-- process Icon -->
					<div class="picon"><i class="ti-credit-card"></i></div>
					<!-- process Content -->
					<div class="process_content">
						<h3>Cash On Delivery</h3>
						<p>Fast Delivery Method</p>
					</div>
				</div>	
			</div>	<!-- End Col -->				
			

			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="single-process">
					<!-- process Icon -->
					<div class="picon"><i class="ti-headphone-alt"></i></div>
					<!-- process Content -->
					<div class="process_content">
						<h3>Support 24/7</h3>
						<p>24 Hours a Day</p>
					</div>
				</div>	
			</div>	<!-- End Col -->				

			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="single-process">
					<!-- process Icon -->
					<div class="picon"><i class="ti-alarm-clock"></i></div>
					<!-- process Content -->
					<div class="process_content">
						<h3>30 Days Return</h3>
						<p>Simply Return 30 Days</p>
					</div>
				</div>	
			</div>	<!-- End Col -->
			
		</div>
	</div>
</section>
<!--  End Process -->

<?php include 'include/footer.php' ?>
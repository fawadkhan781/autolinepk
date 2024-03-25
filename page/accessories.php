<?php 
include '../include/header.php'; ?>
 <?php $string=$uri_segments[3];
    $title1 = str_replace("-", " ", $string);
    $titlefinal = str_replace(".php", " ", $title1); ?>
 <!-- Page item Area -->
    <div id="page_item_area">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 text-left">
              <?php $id = $_GET['id'];
           $querypc = "SELECT subcategory.id, category.id, subcategory.subcat_name, category.name as catname,category.cat_slug as catslug FROM subcategory INNER JOIN category ON subcategory.category_id=category.id WHERE subcategory.id='$id'";
              $res_prdc = mysqli_query($connection,$querypc);
              if(mysqli_num_rows($res_prdc) > 0){
                while ($pcrow = mysqli_fetch_array($res_prdc)) {?>
            <h3 style="text-transform: capitalize;"><?=$pcrow['catname'].' - '.$titlefinal;?></h3>
          <?php } } ?>
          </div>    

          <div class="col-sm-6 text-right">
            <ul class="p_items">
              <li><a href="<?=$root_path;?>">home</a></li>
              <li><span><?=$titlefinal;?></span></li>
            </ul>         
          </div>  

        </div>
      </div>
    </div>
    
    <?php
           $logined = (isset($_SESSION['userlogged_in']) ? $_SESSION['userlogged_in'] : '');
           $id = $_GET['id'];
           $queryp = "SELECT products.id as postid, products.name as prodtitle, products.description as proddescp, products.slug as prodslug, products.price as prodprice, products.model_id, products.image as prodimage, products.product_qty, products.created_at, subcategory.id, category.id, subcategory.subcat_name, model.name as modelname,category.name as catname,category.cat_slug as catslug FROM products INNER JOIN category ON products.category_id=category.id  INNER JOIN subcategory ON products.subcategory_id=subcategory.id INNER JOIN model ON products.model_id=model.id WHERE products.product_status=1 AND products.subcategory_id='$id'";
              $res_prd = mysqli_query($connection,$queryp);
              if(mysqli_num_rows($res_prd) > 0){?>
              <!-- Shop Product Area -->
              <div class="shop_page_area">
                <div class="container">
                  <div class="shop_details text-center">
                    <div class="row">       
                      <?php 
                          while ($prow = mysqli_fetch_array($res_prd)) {?>
                      <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product-grid">
                          <div class="product-image">
                            <a href="#">
                              <img class="pic-1" src="<?=$productimgpath.$prow['prodimage'];?>" alt="product image">
                            </a>
                            <ul class="social">
                              
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
                          <div class="product-content">
                              <form action="../single-product.php" method="post">
                              <h3 class="title">
                                <button type="submit" class="btntitle"><?=$prow['prodtitle'];?></a><input type="hidden" name="postid" value="<?=$prow['postid'];?>"></h3>
                              <div class="price">$<?=number_format($prow['prodprice'],2);?>
                              </div>
                              <button type="submit" class="add-to-cart btn btn-sm btn-primary addcrtbtn">+ View</button>
                            <input type="hidden" name="postid" value="<?=$prow['postid'];?>"></form>
                          </div>
                        </div>
                      </div><!-- End Col -->  
                    <?php } ?>
                    </div>
                  </div> 
                </div>
              </div>

          <?php } ?>


    </div>
    <?php include '../include/footer.php'; ?>
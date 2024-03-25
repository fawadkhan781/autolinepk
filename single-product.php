<style>.singleproduct .pd_price_dtls{margin-bottom: 0px !important;}
.singleproduct .pd_price .new{margin-top: 20px !important;}</style>
<?php
	include "include/header.php";

    $logined = (isset($_SESSION['userlogged_in']) ? $_SESSION['userlogged_in'] : '');
	$id = $_POST['postid'];
    $queryp = "SELECT products.name as prodtitle, products.description as proddescp, 
    products.slug as prodslug, products.price as prodprice, 
    products.model_id, products.image as prodimage, products.product_qty as pqty, 
    products.created_at, subcategory.id, category.id, subcategory.subcat_name, 
    model.name as modelname,category.name as catname,category.cat_slug as catslug
     FROM products INNER JOIN category ON products.category_id=category.id  
     INNER JOIN subcategory ON products.subcategory_id=subcategory.id 
     INNER JOIN model ON products.model_id=model.id WHERE products.product_status=1 
     AND products.id='$id'";
        $res_prd = mysqli_query($connection,$queryp);
        if(mysqli_num_rows($res_prd) > 0)
        {
        	while ($prow = mysqli_fetch_array($res_prd)) {?>
        		<!-- Page item Area -->
        		<div id="page_item_area">
        			<div class="container">
        				<div class="row">
        					<div class="col-sm-6 text-left">
        						<h3>Product Details</h3>
        					</div>		

        					<div class="col-sm-6 text-right">
        						<ul class="p_items">
        							<li><a href="<?=$root_path;?>">home</a></li>
        							<li><a href="<?=$page.$prow['catslug'];?>.php"><?=$prow['catname'];?></a></li>
        							<li><span><?=$prow['prodtitle'];?></span></li>
        						</ul>					
        					</div>
        				</div>
        			</div>
        		</div>

        		<!-- Product Details Area  -->
        		<div class="prdct_dtls_page_area singleproduct">
        			<div class="container">
        				<div class="row">
        					<!-- Product Details Image -->
        					<div class="col-md-6 col-xs-12">
        						<div class="pd_img fix">
        							<a class="venobox" href="<?=$productimgpath.$prow['prodimage'];?>"><img src="<?=$productimgpath.$prow['prodimage'];?>" alt=""/></a>
        						</div>
        					</div>
        					<!-- Product Details Content -->
        					<div class="col-md-6 col-xs-12">
        						<div class="prdct_dtls_content">
                                    <div class="pd_price_dtls fix">
        							<a class="pd_title" href="#"><?=$prow['prodtitle'];?></a>
                                    <!-- Product Ratting -->
                                        <div class="pd_ratng">
                                            <div class="rtngs">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pd_text">
                                        <h4>Categories:</h4>
                                        <p><?=$prow['catname'];?> - <?=$prow['subcat_name'];?></p>
                                    </div>
                                   
        							<div class="pd_price_dtls row">
        								<!-- Product Price -->
                                        
        								<div class="pd_price col-md-4">
                                            <h4>Price:</h4>
                                            <br><br>
        									<span class="new">$ <?=number_format($prow['prodprice']);?></span>
        								</div>
                                    <div class="pd_text col-md-4">
                                        <h4>Model:</h4>
                                        <p><?=$prow['modelname'];?></p>
                                    </div>
                                    <div class="pd_text col-md-4">
                                    <?=($prow['pqty'] > 0 ? '<h4 class="text-success">In stock <i class="fa fa-check-circle text-success" aria-hidden="true"></i></h4>' : '<h4 class="text-danger">Out stock <i class="fa fa-times-circle text-danger" aria-hidden="true"></i></h4>');?> 
                                    <p>Available Quantity: <b> <?=$prow['pqty']; ?></b></p>
                                </div>
        							</div>
        							<div class="pd_clr_qntty_dtls fix">
        								<div class="pd_qntty_area">
        									<h4>quantity:</h4>
        									<div class="pd_qty fix">
        										<input value="1" name="qttybutton" id="qty" class="cart-plus-minus-box" type="number">
        									</div>
        								</div>
        							</div>
        							<!-- Product Action -->
        							<div class="pd_btn fix">
        								<a class="btn btn-default acc_btn" id="addtocart"  <?=($prow['pqty'] > 0 ? 'onclick="AddToCart('.$id.')"' : '');?>  data-id="<?=$id;?>"><?=($prow['pqty'] > 0 ? 'Add To Cart' : 'Out of Stock' )?></a>
        								<a href="<?=$root_path;?>" class="btn btn-default acc_btn btn_icn"><i class="fa fa-backward"></i> Back To Home</a>
        							</div>
        							
        						</div>
        					</div>
        				</div>

        				<div class="row">
        					<div class="col-xs-12">					
        						<div class="pd_tab_area fix">									
        							<ul class="pd_tab_btn nav nav-tabs" role="tablist">
        								<li>
        									<a class="active" href="#description" role="tab" data-toggle="tab">Description</a>
        								</li>
                                        <li>
                                            <a class="" href="#feedback" role="tab" data-toggle="tab">Feedback</a>
                                        </li>
        							</ul>

        							<!-- Tab panes -->
        							<div class="tab-content">
        								<div role="tabpanel" class="tab-pane fade show active" id="description">
        									<p><?=$prow['proddescp'];?></p>			  
        								</div>
                                        <div role="tabpanel" class="tab-pane" id="feedback">
                                            <ul>
                                            <?php $fedqry = "SELECT orders_item.feedback,orders.user_name FROM orders_item INNER JOIN products ON orders_item.product_id=products.id  INNER JOIN orders ON orders_item.order_id=orders.id WHERE orders_item.product_id='$id'";
                                                $res_prdf = mysqli_query($connection,$fedqry);
                                                if(mysqli_num_rows($res_prdf) > 0)
                                                {
                                                    while ($fdrow = mysqli_fetch_array($res_prdf)) {?>
                                                        <li><?=($fdrow['feedback'] ? 'By:- '.$fdrow['user_name'].' : '.$fdrow['feedback'] : '');?></li>    
                                                <?php } }?>
                                            </ul>         
                                        </div>
        							</div>
        						</div>
        					</div>
        				</div>
        			</div>
        		</div>

<div class="modal fade sitedatamdl" id="placeorders">
    <div class="modal-dialog mrgtop1">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Item Added to Cart Successfully!</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <p class="text-center">
                    <a href="<?=$root_path;?>" class="btn btn-success"><i class="fa fa-arrow-left"></i> Continue Shopping</a>&nbsp;&nbsp;
                    <a href="<?=$root_path;?>checkout.php" class="btn btn-warning">View Cart &amp; Checkout <i class="fa fa-arrow-right"></i></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

$_SESSION['pimg']=$prow['prodimage'];
$_SESSION['pname']=$prow['prodtitle'];
$_SESSION['pmount']=$prow['prodprice'];
    } }
	include "include/footer.php";
?>

<script>
    //check login
function AddToCart(id){

    //basic detail
   // var id = $(this).attr('data-id');
    var sessionid ="<?=session_id();?>";
    var qty = document.getElementById("qty").value;
    var pimg ="<?=$_SESSION['pimg'];?>";
    var pname ="<?=$_SESSION['pname'];?>";
    var pmount ="<?=$_SESSION['pmount'];?>";
    var userid = "<?=$logined;?>";
    if(userid ==''){
        alertify.error('Please Login for Add to Cart').dismissOthers();
         setTimeout(mytimefun, 700);
         function mytimefun(){ window.location.href="account.php";}
        return;
    }

    var data = new FormData();
    data.append('action', 'addtocart');
    data.append('id', id);
    data.append('sessionid', sessionid);
    data.append('qty', qty);
    data.append('pimg', pimg);
    data.append('pname', pname);
    data.append('pmount', pmount);

    var a = function () { $("#qty").val(''); }
    var b = function () { popupfunc(); }
    var arr = [a,b];

    call_ajax_with_functions('', 'include/ajax_single_product.php',data,arr);

}

function popupfunc(){
   $("#placeorders").modal();
     $(".sitedatamdl").css({ "z-index":"9999999", "opacity":"1", "display": "block"});
    $("#getsltordr").val(placeordr.join(", "));   
    //$('#bodygpc').addClass('modal-open');
}
</script>
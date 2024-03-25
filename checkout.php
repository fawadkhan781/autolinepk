<?php include "include/header.php";?>
			
		<!-- Page item Area -->
		<div id="page_item_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 text-left">
						<h3>Checkout Details</h3>
					</div>		

					<div class="col-sm-6 text-right">
						<ul class="p_items">
							<li><a href="<?=$root_path;?>">home</a></li>
							<li><span>Checkout</span></li>
						</ul>					
					</div>	
				</div>
			</div>
		</div>
		
		

	<!-- Checkout Page -->
	<section class="checkout_page">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="title">
                            <h3>Shipping Address</h3>
                        </div>
                        <form class="checkout_form">
							<div class="form-row">
								<div class="form-group col-md-12">
									<input name="first_name" id="fname" placeholder="Full Name *" class="form-control" value="<?=(isset($_SESSION['userfull']) ?  $_SESSION['userfull'] : '');?>" type="text">
									<input type="hidden" id="userid" value="<?=$_SESSION['userid'];?>" name="userid">
								</div>
							</div>
							
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input name="email" id="email" disabled readonly placeholder="Email address Optional" class="form-control" value="<?=(isset($_SESSION['userlogged_in']) ?  $_SESSION['userlogged_in'] : '');?>" type="email">
                                </div>
                           
      
                                <div class="form-group col-md-6">
                                    <input name="phone" id="phone" placeholder="Phone number *" class="form-control" value="<?=(isset($_SESSION['userphone']) ?  $_SESSION['userphone'] : '');?>" type="text">
                                </div>
							</div>
							
                            <div class="form-group">
								<label for="address">Address: *</label>    
								<textarea rows="3" name="street" id="address" placeholder="Street address. Apartment, suite, unit , City etc. *" class="form-control"><?=(isset($_SESSION['useraddress']) ?  $_SESSION['useraddress'] : '');?></textarea>
                            </div>
                    
                        </form>
                          <div class="payment_method">           
							<ul>
								<li>
									<div class="custom-control custom-radio">
										<input type="radio" checked="" id="customRadio1" name="customRadio" class="custom-control-input">
										<label class="custom-control-label" for="customRadio1">Cash on delivery</label>
									</div>						
								</li>
							</ul>     
                        </div>
						
                        <div class="qc-button">
                            <a class="btn border-btn placeorder" id="placeorder" onclick="orderplace()" tabindex="0">Proceed to Checkout</a>
                        </div>
                       
                    </div>
					
					
                    <div class="col-md-6">
                        <div class="title">
                            <h3>your order</h3>
                        </div>
					<?php if(isset($_SESSION['userlogged_in'])){?>   	
						<div class="your-order-table table-responsive">
							<table class="table table-bordered table-condensed">
								<thead>
									<tr>
										<th class="product-name">Product Name</th>
										<th class="product-qty">Qty</th>
										<th class="product-price">Price</th>
										<th class="product-total">Total</th>
									</tr>
								</thead>
								<tbody>
								<?php $sessionid=session_id();
							      $sql = "SELECT * FROM `cart` WHERE `session_id`='$sessionid'";
							      $result = mysqli_query($connection,$sql);
							      $granttoal=0;
							      if(mysqli_num_rows($result) > 0){
								       while ($rowup = mysqli_fetch_array($result)){
											$granttoal +=$rowup['total_price'];
								       	?>
											<tr class="productidsold" data-ids="<?=$rowup['product_id'];?>">
												<input type="hidden" class="productids" value="<?=$rowup['product_id'];?>">
												<input type="hidden" class="prdname" value="<?=$rowup['name'];?>">
												<input type="hidden" class="prodqty" value="<?=$rowup['qty'];?>">
												<input type="hidden" class="price" value="<?=$rowup['price'];?>">
												<input type="hidden" class="prodtotal" value="<?=$rowup['total_price'];?>">
												<td class="product-name"><?=$rowup['name'];?></td>
												<td class="qty"><?=$rowup['qty'];?></td>
												<td class="pricedd" data-val="$<?=$rowup['price'];?>">$<?=number_format($rowup['price']);?></td>
												<td class="product-total" data-val="<?=$rowup['total_price']; ?>"><span>$<?=number_format($rowup['total_price']); ?></span></td>
											</tr>
									<?php } } ?>
								</tbody>
								<tfoot class="table-striped">
									<tr>
										<th colspan="3">Grand Total</th>
										<th><span id="grandtotal" data-val="<?=$granttoal;?>" class="amount">$<?=number_format($granttoal);?></span></th>
									</tr>
								</tfoot>
							</table>  
							   <div class="cnc-button">
                            <a class="btn btn-danger cancelorder" id="cancelorder" onclick="ordercancel()">Cancel Order</a>
                        </div>
						</div>
					<?php }else{ ?>	
                    	<p>Already member? <a href="account.php">Login here</a></p>
                    <?php } ?>
                    </div>
					
                </div>
            </div>
        </section>


<?php include "include/footer.php";?>

<script>
//Place order
function orderplace(){

    //basic detail
    var fname =  document.getElementById('fname').value;
    var phone =  document.getElementById('phone').value;
    var email =  document.getElementById('email').value;
    var address =  document.getElementById('address').value;
    var userid =  document.getElementById('userid').value;
    //var grandtotal =  $("#grandtotal").attr("data-val");
    //let grandtotal =  document.getElementById("grandtotal").dataset.val;
    let grandtotal =  document.getElementById("grandtotal").getAttribute('data-val');
    var productids = document.getElementsByClassName("productids");
    var prdname = document.getElementsByClassName("prdname");
    var prodqty = document.getElementsByClassName("prodqty");
    var price = document.getElementsByClassName("price");
    var prodtotal = document.getElementsByClassName("prodtotal");

    // check
     if(fname == ''){
        alertify.error('Name is required ').dismissOthers();
        document.getElementById('fname').focus();
        return;
     }
     if(address == ''){
        alertify.error('Address is required ').dismissOthers();
        document.getElementById('address').focus();
        return;
     }

      if(phone == ''){
        alertify.error('Phone is required ').dismissOthers();
        document.getElementById('phone').focus();
        return;
     }


    var data = new FormData();
    data.append('action', 'placeorders');
    data.append('userid', userid);
    data.append('fname', fname);
    data.append('phone', phone);
    data.append('email', email);
    data.append('address', address);
    data.append('grandtotal', grandtotal);

    for(i=0; i<productids.length; i++){
    	data.append('productids[]', productids[i].value);
    	data.append('prdname[]', prdname[i].value);
    	data.append('prodqty[]', prodqty[i].value);
    	data.append('price[]', price[i].value);
    	data.append('prodtotal[]', prodtotal[i].value);

    }

    call_ajax('', 'include/ajax_single_product.php',data);

}

//Place order
function ordercancel(){

    //basic detail
     var grandtotal = document.getElementById("grandtotal").dataset.value;
     if(grandtotal==0){
     	 alertify.error('Cart is Already Empty').dismissOthers();
        return;
     }
     var data = new FormData();
    data.append('action', 'cancelorder');

    call_ajax('', 'include/ajax_single_product.php',data);
}
</script>
<?php include 'include/header.php' ?>
	<style>
		.fullcontainer{padding-left: 25px;padding-right: 25px;}
	</style>
	<!-- Page item Area -->
	<div id="page_item_area">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 text-left">
					<h3>User Profile</h3>
				</div>		

				<div class="col-sm-6 text-right">
					<ul class="p_items">
						<li><a href="<?=$root_path;?>">home</a></li>
						<li><span>User</span></li>
					</ul>					
				</div>	
			</div>
		</div>
	</div>
	
	
	<!-- Login Page -->
	<div class="login_page_area">
		<div class="container1 fullcontainer">
			<div class="row">
				<div class="col-md-4 col-sm-12 col-xs-12">
					<div class="create_account_area caa_pdngbtm">
						<h2 class="caa_heading">User Profile</h2>
						<div class="caa_form_area">
							<div class="caa_form_group">
								<div class="caf_form">
									<div class="login_email">
										<label>Name</label>
										<div class="input-area"><input type="text" class="clrfield" value="<?=(isset($_SESSION['userfull']) ?  $_SESSION['userfull'] : '');?>" id="fname" /></div>
									</div>
									<div class="login_email">
										<label>Phone</label>
										<div class="input-area"><input type="text" class="clrfield" value="<?=(isset($_SESSION['userphone']) ?  $_SESSION['userphone'] : '');?>" id="phone" /></div>
									</div>
									<div class="login_email">
										<label>Email</label>
										<div class="input-area"><input type="email" placeholder="user@gmail.com" disabled="disabled" readonly="" class="clrfield" value="<?=(isset($_SESSION['userlogged_in']) ?  $_SESSION['userlogged_in'] : '');?>" id="email" /></div>
									</div>
									<div class="login_email">
										<label>Addresss</label>
										<div class="input-area"><textarea name="address" id="address" class="clrfied" rows="2"><?=(isset($_SESSION['useraddress']) ?  $_SESSION['useraddress'] : '');?></textarea></div>
								</div>
								</div>
								<input type='hidden' class="hidden" value="<?=$_SESSION['userid'];?>" id="userid">
								<a class="btn btn-default acc_btn" id="update_user" onclick="upd_user()"> 
									<span> <i class="fa fa-user btn_icon"></i> Update </span> 
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-8 col-sm-12 col-xs-12">
					<div class="create_account_area caa_pdngbtm">
						<h2 class="caa_heading">My Purchased Products List</h2>
						<div class="caa_form_area">
							 <table id="myproductlist" class="table table-bordered table-condensed">
			                <thead>
			                  <th>OrderDate</th>
			                  <th>Prodcut Title</th>
			                  <th>Qty</th>
			                  <th>Price</th>
			                  <th>Amount</th>
			                  <th>Status</th>
			                  <th>FeedBack</th>
			                </thead>

			                <tbody>
			                	<?php 
			                	$usrid=$_SESSION['userid'];
			                	  $query1 = "SELECT a.id,a.user_id,a.user_name,a.email,a.phone,a.ship_address,a.total_amount,a.order_status,a.created_at,b.id as pitemid,b.order_id,b.product_id,b.product_title,b.qty,b.price,b.total_price,b.feedback,c.id as satusid,c.title  FROM orders as a INNER JOIN orders_item as b ON a.id=b.order_id INNER JOIN orders_status as c ON a.order_status=c.id WHERE a.user_id='$usrid'";
                       			$res_pro = mysqli_query($connection,$query1);
                        		if(mysqli_num_rows($res_pro) > 0)
                        		{
                          		$total = 0;
                           	while ($row = mysqli_fetch_array($res_pro)) {
                            	$total += $row['total_price'];
								$fb_id=$row['pitemid'];
                            	?>
		                          <tr>
		                            <td><?=$row['created_at'];?></td>
		                            <td><?=$row['product_title'];?></td>
		                            <td><?=$row['qty'];?></td>
		                            <td>$<?=$row['price'];?></td>
		                            <td>$<?=number_format($row['total_price']);?></td>
		                            <td><?=$row['title'];?></td>
		                            <td>	<?=($row['feedback']!='' ? '<a class="btn btn-sm btn-success" id="postedfeedback" onclick="PostedFeedBack('.$fb_id.')" data-id="'.$row['pitemid'].'">Already Posted</a>' : ($row['satusid']==5 ? '<a class="btn btn-sm btn-primary " id="feedback" onclick="feedBack('.$fb_id.')"  data-id="'.$row['pitemid'].' ">Post Comments</a>' : 'Not Completed Yet'));?></td>
		                          </tr>
		                  	
		                 			<?php } } ?>
			                </tbody>
			             </table>   
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>			
  
<?php include 'include/footer.php' ?>

<script>
//register user
function upd_user(){

    // category basic detail
    var userid = document.getElementById('userid').value;
    var fname = document.getElementById('fname').value;
    var phone = document.getElementById('phone').value;
    var email = document.getElementById('email').value;
    var address = document.getElementById('address').value;

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
    data.append('action', 'updateuser');
    data.append('userid', userid);
    data.append('fname', fname);
    data.append('phone', phone);
    data.append('email', email);
    data.append('address', address);

    var a = function () { reloadpage(); }
	var arr = [];

    call_ajax_with_functions('', 'include/ajaxreq_front.php',data,arr);

}
//call Feedback modal
function feedBack(id){
	//var id=$(this).attr('data-id');
   data = new FormData();
    data.append('action', 'feedbackmodal');
    data.append('id', id);
     var a = function () { $("#processing").removeClass('fade'); }
    var arr = [a];
    call_ajax_modal_with_functions('include/ajaxreq_front.php',data, 'Feedback',arr);
} 
function PostFeedBack(id){
    //var id=$(this).attr('data-id');
    var comnt=document.getElementById('comments').value;
     if(comnt == ''){
        alertify.error('Feedback is required ').dismissOthers();
        document.getElementById('comments').focus();
        return;
     }

    var data = new FormData();
    data.append('action', 'addfeedback');
    data.append('id', id);
    data.append('comnt', comnt);
   
    call_ajax('', 'include/ajaxreq_front.php',data);
 
  }

//call Feedback modal
function PostedFeedBack(id){
	//var id=$(this).attr('data-id');
   data = new FormData();
   data.append('action', 'alreadypostedmodal');
   data.append('id', id);
   var a = function () { $("#processing").removeClass('fade'); }
   var arr = [a];
   call_ajax_modal_with_functions('include/ajaxreq_front.php',data, 'Posted Feedback',arr);
}
</script>
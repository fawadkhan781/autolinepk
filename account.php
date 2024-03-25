<?php include 'include/header.php' ?>
	
	<!-- Page item Area -->
	<div id="page_item_area">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 text-left">
					<h3>Create Account / Login</h3>
				</div>		

				<div class="col-sm-6 text-right">
					<ul class="p_items">
						<li><a href="<?=$root_path;?>">home</a></li>
						<li><span>Register / Login</span></li>
					</ul>					
				</div>	
			</div>
		</div>
	</div>
	
	
	<!-- Login Page -->
	<div class="login_page_area">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="create_account_area caa_pdngbtm">
						<h2 class="caa_heading">Create an account</h2>
						<div class="caa_form_area">
							<p>Please enter your detail to create an account.</p>
							<div class="caa_form_group">
								<div class="caf_form">
									<div class="login_email">
										<label>Name</label>
										<div class="input-area"><input type="text" class="clrfield" id="fname" /></div>
									</div>
									<div class="login_email">
										<label>Phone</label>
										<div class="input-area"><input type="text" class="clrfield" id="phone" /></div>
									</div>
									<div class="login_email">
										<label>Email</label>
										<div class="input-area"><input type="email" placeholder="user@gmail.com" class="clrfield" id="email" /></div>
									</div>
									<div class="login_password">
										<label>Password</label>
										<div class="input-area"><input type="password" class="clrfield" id="password" /></div>
									</div>
									<div class="login_email">
										<label>Addresss</label>
										<div class="input-area"><textarea name="address" id="address" class="clrfied" rows="2"></textarea></div>
								</div>
								</div>
								<a class="btn btn-default acc_btn" id="acc_create" onclick="Acc_Create()"> 
									<span> <i class="fa fa-user btn_icon"></i> Create an account </span> 
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="create_account_area">
						<h2 class="caa_heading">Already registered? then Login Here</h2>
						<div class="caa_form_area">
							<div class="caa_form_group">
								<div class="login_email">
									<label>UserName</label>
									<div class="input-area"><input type="email" placeholder="user@gmail.com" id="useremail" required="" /></div>
								</div>
								<div class="login_password">
									<label>Password</label>
									<div class="input-area"><input type="password" id="userpassword" /></div>
								</div>
								<button type="submit" id="user_Login" onclick="User_Login()" class="btn btn-default acc_btn"> 
									<span> <i class="fa fa-lock btn_icon"></i> Sign in </span> 
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>			
  
<?php include 'include/footer.php' ?>

<script>
	//check login
$(document).on('click','#acc_Login',function(){

    //basic detail
    var email = $('#email').val();
    var password = $('#password').val();

    // check
     if(email == ''){
        alertify.error('Email is required ').dismissOthers();
        document.getElementById('email').focus();
        return;
     }
     if(password == ''){
        alertify.error('Password is required ').dismissOthers();
        document.getElementById('password').focus();
        return;
     }

    var data = new FormData();
    data.append('action', 'logincheck');
    data.append('email', email);
    data.append('password', password);

    var a = function () { clearfield(); }
	var arr = [];

    call_ajax_with_functions('', 'include/ajaxreq_front.php',data,arr);

});
	//register user
function Acc_Create(){

    // category basic detail
    var fname = document.getElementById('fname').value;
    var phone = document.getElementById('phone').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var address = document.getElementById('address').value;

    // check
     if(fname == ''){
        alertify.error('Name is required ').dismissOthers();
        document.getElementById('fname').focus();
        return;
     }
     if(email == ''){
        alertify.error('Email is required ').dismissOthers();
        document.getElementById('email').focus();
        return;
     }
     if(password == ''){
        alertify.error('Password is required ').dismissOthers();
        document.getElementById('password').focus();
        return;
     }

    var data = new FormData();
    data.append('action', 'createaccount');
    data.append('fname', fname);
    data.append('phone', phone);
    data.append('email', email);
    data.append('password', password);
    data.append('address', address);

    var a = function () { clearfield(); }
	var arr = [a];

    call_ajax_with_functions('', 'include/ajaxreq_front.php',data,arr);

}
function User_Login(){

 // client basic detail
 var email = document.getElementById('useremail').value;
 var password = document.getElementById('userpassword').value;

 // check client contact
  if(email == ''){
     alertify.error('Username is required For Login').dismissOthers();
     document.getElementById('useremail').focus();
     return;
  }

  if(password == ''){
     alertify.error('Password is required').dismissOthers();
     document.getElementById('userpassword').focus();
     return;
 }
 
 var data = new FormData();
 data.append('action', 'userlogin');
 data.append('email', email);
 data.append('password', password);

 call_ajax('', 'include/ajaxreq_front.php',data);

}

function clearfield(){
	$(".clrfield").val('');
}
    </script>
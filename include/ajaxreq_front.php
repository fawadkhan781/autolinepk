<?php
session_start();
include("dbcon.php");

// check login
if($_POST["action"] == 'userlogin'){
    function encrypt_pass($pass){
        $encript_password = md5($pass);
        return $encript_password;
   }
   $uname=$_POST["email"];
   $password=$_POST["password"];
    if($uname=="" || $password=="")
    {
        echo "UserName and Password is required";
        exit();
    }
    $pass_encrypted = encrypt_pass($password);
    $sql_users = "SELECT * FROM `users` WHERE `email` = '$uname' AND `password`='$pass_encrypted' AND status=1 AND role=0";
    //echo $sql_users;
    $res_users = mysqli_query($connection,$sql_users);
    $row_users = mysqli_fetch_array($res_users);
    //print_r(mysqli_num_rows($res_users));exit();
    if(mysqli_num_rows($res_users) > 0)
    {
        $_SESSION['userlogged_in']=$_POST['email'];
        $_SESSION['userid']=$row_users['id'];
        $_SESSION['useraddress']=$row_users['address'];
        $_SESSION['userphoto']=$row_users['photo'];
        $_SESSION['usercreated']=$row_users['created_on'];
        $_SESSION['userfull']=$row_users['firstname'];
        $_SESSION['userphone']=$row_users['phone'];
        $_SESSION['sessionid']=session_id();
        //echo $_SESSION['logged_in']; exit();
            if($_SESSION['userlogged_in'] == TRUE){
                 $sql ='TRUNCATE TABLE cart';
                 mysqli_query($connection, $sql);
                //header('Location: ../dashboard');
                echo "userloginsuccess";
                exit();
            }    
    }else{
        echo "Please try with correct credential";
    }
}

// create account
if($_POST["action"] == 'createaccount'){
    function encrypt_pass($pass){
        $encript_password = md5($pass);
        return $encript_password;
   }
   $fname=$_POST["fname"];
   $phone=$_POST["phone"];
   $email=$_POST["email"];
   $password=$_POST["password"];
   $address=$_POST["address"];
    if($email=="" && $password=="")
    {
        echo "UserName and Password is required";
        exit();
    }
    $pass_encrypted = encrypt_pass($password);
    $sql_users = "SELECT * FROM `users` WHERE `email` = '$email'";
    $res_users = mysqli_query($connection,$sql_users);
    $row_users = mysqli_fetch_array($res_users);
    if(mysqli_num_rows($res_users) > 0)
    {
      echo "email already registered";
      exit();  
    }else{
        $insert="INSERT INTO `users` (`email`, `password`, `firstname`, `phone`, `address`) VALUES ('$email','$pass_encrypted','$fname','$phone','$address')";
        mysqli_query($connection,$insert);
        if(mysqli_affected_rows($connection)>0)
        {
            echo "Registered Successfully";
        } 
    }
 }

// update user
if($_POST["action"] == 'updateuser'){
 
   $userid=$_POST["userid"];
   $fname=$_POST["fname"];
   $phone=$_POST["phone"];
   $address=$_POST["address"];

    $update="UPDATE `users` SET `firstname`='$fname', `phone`='$phone', `address`='$address' WHERE id='$userid' AND status=1 AND role=0";
    //echo $update;
    mysqli_query($connection,$update);
    if(mysqli_affected_rows($connection)>0)
    {   echo "Updated"; }else{ echo "Failure";}
 }

// Call modal after product added
if($_POST["action"] == 'feedbackmodal'){ 
   $id=$_POST["id"];
    ?>
<div class="row">
    <textarea name="comments" id="comments" placeholder="Feedback" class="form-control col-lg-10" rows="3"></textarea>

    <div class="modal-footer">
        <a class="btn btn-primary pull-left" data-id="<?=$id;?>" id="postfeedback" onclick="PostFeedBack(<?=$id;?>)">Post</a>
         <button type="button" class="btn btn-danger pull-right" onclick="$('#background_fade').fadeOut(function() { $(this).remove(); });" aria-hidden="true">Cancel</button>
    </div>
</div>
<?php }

// create account
if($_POST["action"] == 'addfeedback'){
   $id=$_POST["id"];
   $comnt=$_POST["comnt"];
   if($comnt=="")
   {
     echo "Feedback is required";
     exit();
   }
  
   $update="UPDATE `orders_item` SET `feedback`='$comnt' WHERE id='$id'";
   mysqli_query($connection,$update);
   if(mysqli_affected_rows($connection)>0)
    {   echo "Successfully"; }else{ echo "Failure";} 
 }

 // Already Posted Feedback
if($_POST["action"] == 'alreadypostedmodal'){
   $id=$_POST["id"];
  
    $sql_feedbk = "SELECT * FROM `orders_item` WHERE id='$id'";
    $res_feedbk = mysqli_query($connection,$sql_feedbk);
    if(mysqli_num_rows($res_feedbk) > 0)
    { 
      while ($row = mysqli_fetch_array($res_feedbk)) {?>
    <div class="row">
        <textarea name="comments" id="comments" disabled="" readonly="" class="form-control col-lg-10" rows="3"><?=$row['feedback'];?></textarea>

        <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-right" onclick="$('#background_fade').fadeOut(function() { $(this).remove(); });" aria-hidden="true">Cancel</button>
        </div>
    </div>
    <?php } }else{ echo "Failure";} 
 }
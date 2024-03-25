<?php
session_start();
include '../global.php';
require_once('../includes/dbcon.php');

// order status
if($_POST["action"] == 'orderStatus'){
	$id=$_POST['id'];
	$orderstatus=$_POST['orderstatus'];
	$query2 = "UPDATE `orders` SET `order_status`='$orderstatus'  WHERE `id`='$id' AND `deleted_status`=0";
	//echo $query2;
    mysqli_query($connection,$query2);
   if(mysqli_affected_rows($connection)>0){
		echo "Order Status updated Successfully";
	}else{
		echo "Failure";
	}

}

// Delete Order
if($_POST["action"] == 'deleteOrder'){
	$id=$_POST["id"];

	$sql = "UPDATE `orders` SET `deleted_status`=1 WHERE `id`='$id'";
	mysqli_query($connection,$sql);
	if(mysqli_affected_rows($connection)>0){
		echo "Deleted Successfully";
	}else{

		echo "Failure";
	}

}
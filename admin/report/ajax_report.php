<?php 
session_start();
include '../global.php';
require_once('../includes/dbcon.php');

//search by date
if($_POST['action']=='searchbydt'){
  $dtstrt=$_POST["dtstrt"];
  $dtend=$_POST["dtend"];

  //echo $dtstrt;
  $date1 = str_replace('/', '-', $dtstrt);
  $cdate = date('Y-d-m', strtotime($date1));
  $rptdate = date('d-M-Y', strtotime($date1));
  $date2 = str_replace('/', '-', $dtend);
  $cdate2 = date('Y-d-m', strtotime($date2));
  $rptdate2 = date('d-M-Y', strtotime($date2));
  //echo $cdate;exit();

  $rpsql = "SELECT a.id,a.user_id,a.user_name,a.email,a.phone,a.ship_address,a.total_amount,a.order_status,a.created_at,b.order_id,b.product_id,b.product_title,b.qty,b.price,b.total_price  FROM orders as a INNER JOIN orders_item as b ON a.id=b.order_id WHERE (a.created_at BETWEEN '$cdate' AND '$cdate2') AND a.order_status=3";
  //echo $rpsql;
  $result_report  = mysqli_query($connection, $rpsql);
  if(mysqli_num_rows($result_report) > 0){
    $total = 0;?>
    <thead>
      <tr><th colspan="7" style="font-weight: bold;text-align: center">Sales Report From <?=$rptdate;?> To <?=$rptdate2;?>  By Autolines.pk</th></tr>
        <th class="hidden"></th>
        <th>Date</th>
        <th>Buyer Name/Email</th>
        <th>Full Details</th>
        <th>Prodcut Title</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Amount</th>
        <th>Action</th>

      </thead>
  <?php while ($row = mysqli_fetch_array($result_report)) {
       $total += $row['total_price'];?>
      <tr>
        <td><?=$row['created_at'];?></td>
        <td><?=$row['user_name'];?> / <?=$row['email'];?></td>
        <td><?=$row['ship_address'];?></td>
        <td><?=$row['product_title'];?></td>
        <td><?=$row['qty'];?></td>
        <td>$<?=$row['price'];?></td>
        <td>$<?=number_format($row['total_price']);?></td>
      </tr>
  <?php  } ?>
<tr><th colspan="6">Grand Total:</th><th>$<?=number_format($total);?></th></tr>
<?php }else{
    echo "Failer";
  }
}

//search by User
if($_POST['action']=='searchbyuser'){
  $gtusr=$_POST["gtusr"];
  $usrnme=$_POST["usrnme"];

  $rpsql = "SELECT a.id,a.user_id,a.user_name,a.email,a.phone,a.ship_address,a.total_amount,a.order_status,a.created_at,b.order_id,b.product_id,b.product_title,b.qty,b.price,b.total_price  FROM orders as a INNER JOIN orders_item as b ON a.id=b.order_id WHERE a.user_id='$gtusr' AND a.order_status=3";
  //echo $rpsql;
  $result_report  = mysqli_query($connection, $rpsql);
  if(mysqli_num_rows($result_report) > 0){
    $total = 0;?>
    <thead>
      <tr><th colspan="7" style="font-weight: bold;text-align: center">Sales Report By <?=$usrnme;?></th></tr>
        <th class="hidden"></th>
        <th>Date</th>
        <th>Buyer Name/Email</th>
        <th>Full Details</th>
        <th>Prodcut Title</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Amount</th>
        <th>Action</th>

      </thead>
    <?php while ($row = mysqli_fetch_array($result_report)) {
       $total += $row['total_price'];?>
      <tr>
        <td><?=$row['created_at'];?></td>
        <td><?=$row['user_name'];?> / <?=$row['email'];?></td>
        <td><?=$row['ship_address'];?></td>
        <td><?=$row['product_title'];?></td>
        <td><?=$row['qty'];?></td>
        <td>$<?=$row['price'];?></td>
        <td>$<?=number_format($row['total_price']);?></td>
      </tr>
  <?php  } ?>
<tr><th colspan="6">Grand Total:</th><th>$<?=number_format($total);?></th></tr>
<?php }else{
    echo "Failer / No Data Found";
  }
}

//search by date
if($_POST['action']=='searchbytime'){
  $gtime=$_POST["gtime"];
  $reportyby="";
  
  if($gtime=='today'){
    $reportyby="Today";
    $today = date("Y-m-d");
    $tomorrow = date("Y-m-d", strtotime("+ 1 day"));

     $rsql = "SELECT a.id,a.user_id,a.user_name,a.email,a.phone,a.ship_address,a.total_amount,a.order_status,a.created_at,b.order_id,b.product_id,b.product_title,b.qty,b.price,b.total_price FROM orders as a INNER JOIN orders_item as b ON a.id=b.order_id WHERE (a.created_at >= '$today' AND a.created_at <'$tomorrow') AND a.order_status=3";
        //echo $rsql;
      //exit();
    //$rsql="SELECT * FROM `orders` WHERE (`created_at` > DATE_SUB(now(), INTERVAL 1 DAY))";
  }else if($gtime=='weekly'){
    $reportyby="Weekly";
    $rsql="SELECT a.id,a.user_id,a.user_name,a.email,a.phone,a.ship_address,a.total_amount,a.order_status,a.created_at,b.order_id,b.product_id,b.product_title,b.qty,b.price,b.total_price FROM orders as a INNER JOIN orders_item as b ON a.id=b.order_id WHERE YEARWEEK(a.created_at, 1) = YEARWEEK(CURDATE(), 1) AND a.order_status=3";
    //echo $rsql;
  }else if($gtime=='monthly'){
    $reportyby="Monthly";
    $rsql="SELECT a.id,a.user_id,a.user_name,a.email,a.phone,a.ship_address,a.total_amount,a.order_status,a.created_at,b.order_id,b.product_id,b.product_title,b.qty,b.price,b.total_price FROM orders as a INNER JOIN orders_item as b ON a.id=b.order_id WHERE MONTH(a.created_at) = MONTH(CURRENT_DATE()) AND YEAR(a.created_at) = YEAR(CURRENT_DATE()) AND a.order_status=3";
  }
  else if($gtime=='yearly'){
    $reportyby="Yearly";
    $rsql="SELECT a.id,a.user_id,a.user_name,a.email,a.phone,a.ship_address,a.total_amount,a.order_status,a.created_at,b.order_id,b.product_id,b.product_title,b.qty,b.price,b.total_price FROM orders as a INNER JOIN orders_item as b ON a.id=b.order_id WHERE YEAR(a.created_at) = YEAR(CURRENT_DATE()) AND a.order_status=3";
    //echo $rsql;
  }
  $result_report  = mysqli_query($connection, $rsql);
  if(mysqli_num_rows($result_report) > 0){
    $total = 0;?>
    
     <thead>
      <tr><th colspan="7" style="font-weight: bold;text-align: center">Sales <?=$reportyby;?> Report By Autolines.pk</th></tr>
        <th class="hidden"></th>
        <th>Date</th>
        <th>Buyer Name/Email</th>
        <th>Full Details</th>
        <th>Prodcut Title</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Amount</th>
        <th>Action</th>

      </thead>
    <?php while ($row = mysqli_fetch_array($result_report)) {
       $total += $row['total_price'];?>
      <tr>
        <td><?=$row['created_at'];?></td>
        <td><?=$row['user_name'];?> / <?=$row['email'];?></td>
        <td><?=$row['ship_address'];?></td>
        <td><?=$row['product_title'];?></td>
        <td><?=$row['qty'];?></td>
        <td>$<?=$row['price'];?></td>
        <td>$<?=number_format($row['total_price']);?></td>
      </tr>
  <?php  } ?>
<tr><th colspan="6">Grand Total:</th><th>$<?=number_format($total);?></th></tr>
<?php }else{
    echo "Failer / No Data Found";
  }

}

// Delete report
if($_POST["action"] == 'reportdelete'){ 

	$id=$_POST["id"];
	$sql = "UPDATE `orders` SET `order_status` = 1 WHERE id='$id'";
	$res = mysqli_query($connection,$sql);
	if(mysqli_affected_rows($connection)>0)
	{
		echo "success";
	}else{ echo "Failure";}

}

// Reload Category
if($_POST["action"] == 'reportreload'){ 
  $query1 = "SELECT a.id,a.user_id,a.user_name,a.email,a.phone,a.ship_address,a.total_amount,a.order_status,a.created_at,b.order_id,b.product_id,b.product_title,b.qty,b.price,b.total_price  FROM orders as a INNER JOIN orders_item as b ON a.id=b.order_id WHERE a.order_status=3";
	$res_pro = mysqli_query($connection,$query1);
	if(mysqli_num_rows($res_pro) > 0){
		while ($row = mysqli_fetch_array($res_pro)) {?>
			<tr>
                            <td><?=$row['created_at'];?></td>
                            <td><?=$row['user_name'];?> / <?=$row['email'];?></td>
                            <td><?=$row['ship_address'];?></td>
                            <td><?=$row['product_title'];?></td>
                            <td><?=$row['qty'];?></td>
                            <td>$<?=$row['price'];?></td>
                            <td>$<?=number_format($row['total_price']);?></td>

                            <td>
                            
                            <button class='btn btn-danger btn-sm delete btn-flat' id="reportdelete" onclick="delReport(<?=$row['id'] ?>)" data-id='<?=$row['id'] ?>"'><i class='fa fa-trash'></i> Delete</button>
                            </td>
                          </tr>
		<?php } 
	}
}

?>

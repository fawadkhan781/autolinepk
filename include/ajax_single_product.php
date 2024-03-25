<?php
session_start();
include("dbcon.php");
include("../global.php");

// Add Product to Cart
if($_POST["action"] == 'addtocart'){
    $id=$_POST["id"];
    $sessionid=$_POST["sessionid"];
    $qty=$_POST["qty"];
    $pimg=$_POST["pimg"];
    $pname=$_POST["pname"];
    $pmount=$_POST["pmount"];
    $tolprice = $pmount*$qty;
    $ptotal=0;
         $ptotal=$qty*$pmount;
    $sql = "SELECT * FROM `cart` WHERE `session_id`='$sessionid' AND `product_id`='$id'";
    $result = mysqli_query($connection,$sql);
    //$gtqty = mysqli_fetch_array($result);
    if(mysqli_num_rows($result) > 0){
        while ($rowup = mysqli_fetch_array($result)) {
            $tolqty=$qty+$rowup['qty'];
            $tolamout=$tolqty*$rowup['total_price'];
            $update="UPDATE `cart` SET `qty`='$tolqty',`total_price`='$tolamout' WHERE `session_id`='$sessionid' AND product_id='$id'";
            mysqli_query($connection,$update);
            if(mysqli_affected_rows($connection)>0)
                {   echo "Added to Cart"; }else{ echo "Failure";}
       }
    }else{
        $insert="INSERT INTO `cart`(`session_id`, `product_id`, `name`, `qty`, `image`, `price`, `total_price`)
         VALUES ('$sessionid','$id','$pname','$qty','$pimg','$pmount','$tolprice')";
         echo 'here inside insert'.'query - '.$insert;
        mysqli_query($connection,$insert);
        if(mysqli_affected_rows($connection)>0)
        {
            echo "Added to Cart Successfully";
        } 
    }    

} 

// Call modal after product added
if($_POST["action"] == 'afteraddtocart'){ ?>
<div class="row">
    <p class="text-center">
        <button data-dismiss="modal" class="btn btn-green" type="button"><i class="fa fa-arrow-left"></i> Continue Shopping</button>&nbsp;&nbsp;
        <a href="/checkout.php" class="btn btn-orange">View Cart &amp; Checkout <i class="fa fa-arrow-right"></i></a>
    </p>
</div>
<?php }

if($_POST["action"] == 'placeorders'){

   $userid = $_POST['userid']; 
   $fname = $_POST['fname']; 
   $phone = $_POST['phone']; 
   $email = $_POST['email']; 
   $address = $_POST['address']; 
   $grandtotal = $_POST['grandtotal']; 
   $productids = $_POST['productids']; 
   $prdname = $_POST['prdname']; 
   $prodqty = $_POST['prodqty']; 
   $price = $_POST['price']; 
   $prodtotal = $_POST['prodtotal']; 

   if($userid !='' && $email !=''){
   $sqlorder="INSERT INTO `orders`(`user_id`, `user_name`, `email`, `phone`, `ship_address`, `total_amount`) VALUES ('$userid','$fname','$email','$phone','$address','$grandtotal')";
    mysqli_query($connection,$sqlorder);
    if(mysqli_affected_rows($connection)>0){
        //$sqlsltordrid="SELECT id from ORDERS";
         $last_id = mysqli_insert_id($connection);
        for($i=0;$i<count($productids);$i++){
            $updated_qty_sql = "UPDATE `products` SET product_qty=product_qty-$prodqty[$i] WHERE id=$productids[$i]";
            mysqli_query($connection,$updated_qty_sql);
            if(mysqli_affected_rows($connection)>0){   echo "Product Quantity Updated"; }

            // insert order items into ordertables
            $sqlorderitem ="INSERT INTO `orders_item`(`order_id`, `product_id`, `product_title`, `qty`, `price`, `total_price`) VALUES ('$last_id','$productids[$i]','$prdname[$i]','$prodqty[$i]','$price[$i]','$prodtotal[$i]')";
            mysqli_query($connection,$sqlorderitem);
            if(mysqli_affected_rows($connection)>0){
                $sqtrunc ='TRUNCATE TABLE cart';
                mysqli_query($connection, $sqtrunc);
                echo "Order Placed Success";
            }else{ echo "Failer"; }
        }
   }else{
      echo "Please check Orders. Failer";
   }
 }else{
      echo "Please Login and check your require details";
  }
}

if($_POST["action"] == 'cancelorder'){
    $sqtrunc ='TRUNCATE TABLE cart';
    mysqli_query($connection, $sqtrunc);
        echo "Order is cancelled";;

}

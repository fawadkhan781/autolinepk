<?php include '../includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include '../includes/navbar.php'; ?>
  <?php include '../includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Order Details
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Order</li>
        <li class="active">Details</li>
      </ol>
    </section>   
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <div class="full">
                <h3>Products Details</h3>
              <table id="producttable" class="table table-bordered">
                <thead>
                  <th>Product Title</th>
                  <th>Qty</th>
                  <th>Price</th>
                  <th>Total Price</th>
                  <th>Feedback</th>
                </thead>
                <tbody class="productdata" id="productdata">
              <?php
                $id=$_GET["id"];
                $now = date('Y-m-d');
                $query1 = "SELECT * FROM orders_item WHERE order_id='$id'";
                    $res_pro = mysqli_query($connection,$query1);
                    if(mysqli_num_rows($res_pro) > 0)
                    {
                    $now = date('Y-m-d');
                     while ($row = mysqli_fetch_array($res_pro)) {?>
                          <tr>
                            <td><?=$row['product_title']; ?></td>
                            <td><?=$row['qty']; ?></td>
                            <td>$<?=number_format($row['price']); ?></td>
                            <td>$<?=number_format($row['total_price']);?></td>
                            <td><?=$row['feedback'];?></td>
                          </tr>
                     <?php } } ?>
                </tbody>
              </table>

              <h3>User Details</h3>
              <table id="producttable" class="table table-bordered">
                <thead>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Order Status</th>
                </thead>
                <tbody class="productdata" id="productdata">
               <?php
                    $now = date('Y-m-d');
                    $query3 = "SELECT * FROM orders WHERE id='$id'";
                        $res_pro3 = mysqli_query($connection,$query3);
                        if(mysqli_num_rows($res_pro3) > 0)
                        {
                           while ($row3 = mysqli_fetch_array($res_pro3)) {?>
                          <tr>
                            <td><?=$row3['user_name']; ?></td>
                            <td><?=$row3['phone']; ?></td>
                            <td><?=$row3['email']; ?></td>
                            <td><?=$row3['ship_address'];?></td>
                            <td>
                            <?php
                                $query2 = "SELECT * FROM orders_status WHERE status=1";
                                $res_pro2 = mysqli_query($connection,$query2);
                                if(mysqli_num_rows($res_pro2) > 0){
                                   while ($row2 = mysqli_fetch_array($res_pro2)) {
                                ?>
                                <?=($row3['order_status']==$row2['id'] ? $row2['title'] : '');?>
                              <?php } } ?>
                           </td>
                          </tr>
                     <?php } }  ?>
                </tbody>
              </table>
              </div>  
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  	<?php include '../includes/footer.php'; ?>

</div>
<!-- ./wrapper -->

<?php include '../includes/scripts.php'; ?>
<script src="<?=$root_path;?>/products/product.js?ver=2.6"></script>
</body>
</html>

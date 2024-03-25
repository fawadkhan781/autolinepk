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
        Order List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Orders</li>
        <li class="active">Order List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <table id="producttable" class="table table-bordered">
                <thead>
                  <th>UserName</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>Total Price</th>
                  <th>Status</th>
                  <th>Actions</th>
                </thead>
                <tbody class="productdata" id="productdata">
                  <?php
                    $now = date('Y-m-d');
                    $query1 = "SELECT * FROM orders WHERE deleted_status=0 ORDER BY id DESC";
                        $res_pro = mysqli_query($connection,$query1);
                        if(mysqli_num_rows($res_pro) > 0)
                        {
                          $total = 0;
                           while ($row = mysqli_fetch_array($res_pro)) {
                            //$image = (!empty($row['image'])) ? $root_path.'/assets/images/products/'.$row['image'] : $root_path.'/assets/images/noimage.jpg'; ?>
                          <tr>
                            <td><?=$row['user_name']; ?></td>
                            <td><?=$row['phone']; ?></td>
                            <td><?=$row['ship_address']; ?></td>
                            <td><?=$row['total_amount'];?></td>
                            <td data-oid="<?=$row['id'];?>"><select class="form-control" id="orders_status" onchange="orderStatus(<?=$row['id'];?>)">
                            <?php
                                $query2 = "SELECT * FROM orders_status WHERE status=1";
                                $res_pro2 = mysqli_query($connection,$query2);
                                if(mysqli_num_rows($res_pro2) > 0){
                                   while ($row2 = mysqli_fetch_array($res_pro2)) {
                                ?><option <?=($row2['id']==$row['order_status'] ? 'selected' : '');?> value="<?=$row2['id'];?>"><?=$row2['title'];?></option>
                              <?php } } ?>
                              </select></td>
                            <td>
                              <a href="order-detail.php?id=<?=$row['id']; ?>" id="vieworder" class='btn btn-success btn-sm btn-flat desc' data-id="<?=$row['id']; ?>"><i class='fa fa-eye'></i> View</a>
                               <button class='btn btn-danger btn-sm delete btn-flat' id="deleteOrder" onclick="deleteOrder(<?=$row['id']; ?>)" data-id="<?=$row['id']; ?>"><i class='fa fa-trash'></i> Delete</button>
                            </td>
                          </tr>
                     <?php } }  ?>
                </tbody>
              </table>
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
<script src="<?=$root_path;?>/order/order.js?ver=4.9"></script>
</body>
</html>

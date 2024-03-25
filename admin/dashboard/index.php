<?php 
 include '../includes/header.php';
  include '../includes/format.php'; 
?>
<?php 
  $today = date('Y-m-d');
  $year = date('Y');
 //$month = date('M');
  if(isset($_GET['year'])){
    $year = $_GET['year'];
  }
?>
<?php //include '../includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include '../includes/navbar.php'; ?>
  <?php include '../includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <?php
                $query = "SELECT *, COUNT(*) AS numrows FROM products";
                $result = mysqli_query($connection,$query);
                $prow = mysqli_fetch_array($result);
                if(mysqli_num_rows($result) > 0)
                {
                  echo "<h3>".$prow['numrows']."</h3>";
                }
              ?>
          
              <p>Number of Products</p>
            </div>
            <div class="icon">
              <i class="fa fa-barcode"></i>
            </div>
            <a href="<?=$root_path;?>/products" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <?php
                $query1 = "SELECT *, COUNT(*) AS numrows FROM users WHERE role=0 AND status=1";
                $resuser = mysqli_query($connection,$query1);
                $urow = mysqli_fetch_array($resuser);
                if(mysqli_num_rows($resuser) > 0){
                  echo "<h3>".$urow['numrows']."</h3>";
                }
              ?>
             
              <p>Number of Users</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?=$root_path;?>/user" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <?php
                 $query2 = "SELECT *, COUNT(*) AS numrows FROM orders WHERE deleted_status=0";
                $res_order = mysqli_query($connection,$query2);
                if(mysqli_num_rows($res_order) > 0)
                {
                  $total = 0;
                   while ($trow = mysqli_fetch_array($res_order)) {
                       $orders = $trow['numrows'];
                   }
                }   
                echo "<h3> ".$orders."</h3>";
                
              ?>

              <p>Orders</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="<?=$root_path?>/order" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <?php
                 $query1 = "SELECT a.id,a.user_id,a.user_name,a.email,a.phone,a.ship_address,a.total_amount,a.order_status,a.created_at,b.order_id,b.product_id,b.product_title,b.qty,b.price,b.total_price  FROM orders as a INNER JOIN orders_item as b ON a.id=b.order_id WHERE a.order_status=3";
                   $res_pro = mysqli_query($connection,$query1);
                   if(mysqli_num_rows($res_pro) > 0){
                    $total = 0;
                     while ($row = mysqli_fetch_array($res_pro)) {
                      $total += $row['total_price'];
                   }
                }   
                echo "<h3> $".number_format($total, 2)."</h3>";
                
              ?>

              <p>Total Sales</p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <a href="<?=$root_path?>/report" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- /.row -->
   

      </section>
      <!-- right col -->
    </div>
  	<?php include '../includes/footer.php'; ?>

</div>
<!-- ./wrapper -->


<?php include '../includes/scripts.php'; ?>


</body>
</html>

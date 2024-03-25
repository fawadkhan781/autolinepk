<?php
  $where = '';
  if(isset($_GET['category'])){
    $catid = $_GET['category'];
    $where = 'WHERE category_id ='.$catid;
  }

?>
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
        Add Product Items
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Add Products</li>
        <li class="active">Add Product</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <div class="full">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="name" class="col-sm-1 col-md-1 control-label">Title</label>
                    <div class="col-sm-5 col-md-5">
                      <input type="text" class="form-control clrfield" id="name" name="name" required>
                    </div>
                    <label for="price" class="col-sm-1 col-md-1 control-label">Quantity</label>
                    <div class="col-sm-2 col-md-2">
                      <input type="number" class="form-control clrfield" id="qty" name="qty" required>
                    </div>
                    <label for="price" class="col-sm-1 col-md-1 control-label">Price</label>
                    <div class="col-sm-2 col-md-2">
                      <input type="number" class="form-control clrfield" id="price" name="price" required>
                    </div>
                  </div>
                  <div class="form-group">
                     <label for="category" class="col-sm-1 col-md-1 control-label">Category</label>
                    <div class="col-sm-5 col-md-5">
                      <select class="form-control clrfield" id="productcategory" onchange="productCategory(this.value)" name="category" required>
                        <option value="" selected>- Select -</option>
                        <?php 
                        $qcat = "SELECT * FROM category WHERE cat_status=1";
                        $result_item  = mysqli_query($connection, $qcat);
                        while ($row_item = mysqli_fetch_array($result_item)) {
                          echo "<option value='".$row_item['id']."'>".$row_item['name']."</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <label for="category" class="col-sm-1 col-md-1 control-label">SubCategory</label>
                    <div class="col-sm-5 col-md-5">
                      <select class="form-control clrfield" id="prodsubcategory" name="category" required>
                        <option value="" selected>- Select Subcatgory-</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="category" class="col-sm-1 col-md-1 control-label">Model</label>
                    <div class="col-sm-5 col-md-5">
                      <select class="form-control clrfield" id="productmodel" name="productmodel" required>
                        <option value="" selected>- Select Model-</option>
                        <?php 
                        $qcat = "SELECT * FROM model WHERE status=1";
                        $result_item  = mysqli_query($connection, $qcat);
                        while ($row_item = mysqli_fetch_array($result_item)) {
                          echo "<option value='".$row_item['id']."'>".$row_item['name']."</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <label for="photo" class="col-sm-1 col-md-1 control-label">Photo</label>
                    <div class="col-sm-4">
                     <input type="file" id="productimg" onchange="previewfiles(this);" class="clrfield" name="productimg">
                    </div>
                  </div>  
                  <p><b>Description</b></p>
                  <div class="form-group">
                    <div class="col-sm-1 col-md-6">
                      <textarea id="description" class="form-control clrfield" name="description" rows="5" cols="80" style="visibility: visible;"></textarea>
                    </div>
                    <div class="col-sm-1 col-md-6">
                       <img id="newimgprevw" class="img-responsive">
                    </div>
                  </div>
                  <a class="btn btn-primary btn-flat" id="addproduct" onclick="addProduct()"><i class="fa fa-save"></i> Save</a>
                  <a href="index.php" class="btn btn-info pull-right btn-med btn-flat"><i class="fa fa-eye"></i> Products List</a>
                </form>
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
<script src="<?=$root_path;?>/products/product.js?ver=1.7"></script>
</body>
</html>

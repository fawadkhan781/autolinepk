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
        Edit Product Items
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Edit Products</li>
        <li class="active">Edit Product</li>
      </ol>
    </section>
  <?php $id=$_GET["id"];
  $now = date('Y-m-d');
  $query1 = "SELECT products.name, products.description, products.price, products.model_id, products.image, products.product_qty, products.created_at, products.category_id, subcategory.id as subcatid, category.id, products.subcategory_id, subcategory.subcat_name, model.name as modelname,category.name as catname FROM products INNER JOIN category ON products.category_id=category.id  INNER JOIN subcategory ON products.subcategory_id=subcategory.id INNER JOIN model ON products.model_id=model.id WHERE products.id='$id'";
      $res_pro = mysqli_query($connection,$query1);
      if(mysqli_num_rows($res_pro) > 0)
      {
        while ($row = mysqli_fetch_array($res_pro)) {
        $image = (!empty($row['image'])) ? $root_path.'/assets/images/products/'.$row['image'] : $root_path.'/assets/images/noimage.jpg';?>
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
                      <input type="text" class="form-control clrfield" value="<?=$row['name']?>" id="name" name="name" required>
                    </div>
                    <label for="price" class="col-sm-1 col-md-1 control-label">Quantity</label>
                    <div class="col-sm-2 col-md-2">
                      <input type="number" class="form-control clrfield" id="qty" value="<?=$row['product_qty']?>" name="qty" required>
                    </div>
                    <label for="price" class="col-sm-1 col-md-1 control-label">Price</label>
                    <div class="col-sm-2 col-md-2">
                      <input type="text" class="form-control clrfield" value="<?=$row['price']; ?>" id="price" name="price" required>
                    </div>
                  </div>
                  <div class="form-group">
                     <label for="category" class="col-sm-1 col-md-1 control-label">Category</label>
                    <div class="col-sm-5 col-md-5">
                      <select class="form-control clrfield" id="productcategory" name="category" required>
                        <option value="" selected>- Select -</option>
                        <?php 
                        $qcat = "SELECT * FROM category WHERE cat_status=1";
                        $result_item  = mysqli_query($connection, $qcat);
                        while ($row_item = mysqli_fetch_array($result_item)) { ?>
                          <option <?=($row['category_id']==$row_item['id'] ? 'selected' : '');?> value="<?=$row_item['id'];?>"><?=$row_item['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <label for="category" class="col-sm-1 col-md-1 control-label">SubCategory</label>
                    <div class="col-sm-5 col-md-5">
                      <select class="form-control clrfield" id="prodsubcategory" name="category" required>
                        <option value="<?=$row['subcatid']; ?>" selected><?=$row['subcat_name']; ?></option>
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
                        while ($row_item = mysqli_fetch_array($result_item)) {?>
                         <option <?=($row['subcategory_id']==$row_item['id'] ? 'selected' : '');?> value="<?=$row_item['id'];?>"><?=$row_item['name'];?></option>
                       <?php } ?>
                      </select>
                    </div>
                  </div>  
                  <p><b>Description</b></p>
                  <div class="form-group">
                    <div class="col-sm-1 col-md-12">
                      <textarea id="description" class="form-control clrfield" name="description" rows="5" cols="80" style="visibility: visible;"><?=$row['description']?></textarea>
                    </div>
                  </div>
                  <a class="btn btn-success btn-flat" data-id="<?=$id;?>" id="updateproduct" onclick="updproduct(<?=$id;?>)"> <i class="fa fa-save"></i> Update</a>
                  <a href="index.php" class="btn btn-primary pull-right btn-med btn-flat"><i class="fa fa-eye"></i> Products List</a>
                </form>
              </div>  
            </div>
          </div>
        </div>
      </div>
    </section>
     <?php } } ?>
  </div>
  	<?php include '../includes/footer.php'; ?>

</div>
<!-- ./wrapper -->

<?php include '../includes/scripts.php'; ?>
<script src="<?=$root_path;?>/products/product.js?ver=2.1"></script>
</body>
</html>

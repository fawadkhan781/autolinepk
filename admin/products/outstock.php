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
        Product List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Products</li>
        <li class="active">Product List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <a href="products.php" class="btn btn-primary btn-sm btn-flat" onclick="productModel()" id="prodmodal1"><i class="fa fa-plus"></i> Add item</a>
              <div class="pull-right">
                <form class="form-inline">
                  <div class="form-group">
                    <label>Category: </label>
                    <select class="form-control input-sm" id="select_category">
                      <option value="0">ALL</option>
                      <?php
                       $query0 = "SELECT * FROM category";
                        $res_cat = mysqli_query($connection,$query0);
                        if(mysqli_num_rows($res_cat) > 0)
                        {
                          $total = 0;
                           while ($crow = mysqli_fetch_array($res_cat)) {
                             $selected = ($crow['id'] == $catid) ? 'selected' : ''; 
                            echo "
                            <option value='".$crow['id']."' ".$selected.">".$crow['name']."</option>
                          ";
                          }
                        }  
                      ?>
                    </select>
                  </div>
                </form>
              </div>
            </div>
            <div class="box-body">
              <table id="producttable" class="table table-bordered">
                <thead>
                  <th>Name</th>
                  <th>Photo</th>
                  <th>View</th>
                  <th>Price</th>
                  <th>Qty</th>
                  <th>Category/Subcat / Modal</th>
                  <th>Actions</th>
                </thead>
                <tbody class="productdata" id="productdata">
                  <?php
                    $now = date('Y-m-d');
                    $query1 = "SELECT products.id as prodid,products.name as productname, products.description, products.price, products.model_id, products.image, products.product_qty AS pqty, products.created_at, subcategory.id, category.id, subcategory.subcat_name, model.name as modelname,category.name as catname FROM products INNER JOIN category ON products.category_id=category.id  INNER JOIN subcategory ON products.subcategory_id=subcategory.id INNER JOIN model ON products.model_id=model.id WHERE products.product_status=1 AND products.product_qty < 1 ORDER BY products.id DESC";
                        $res_pro = mysqli_query($connection,$query1);
                        if(mysqli_num_rows($res_pro) > 0)
                        {
                          $total = 0;
                           while ($row = mysqli_fetch_array($res_pro)) {
                            $pid=$row['prodid'];
                            $image = (!empty($row['image'])) ? $root_path.'/assets/images/products/'.$row['image'] : $root_path.'/assets/images/noimage.jpg'; ?>
                          <tr class="<?=($row['pqty'] < 1 ? 'bg-danger' : '');?>">
                            <td><?=$row['productname']; ?></td>
                            <td>
                              <img src="<?=$image; ?>" height='30px' width='30px'>
                              <span class='pull-right'><a class='photo' id='editprodimage' onclick='editProdImg("<?=$pid;?>")' data-id="<?=$row['prodid']; ?>"><i class='fa fa-edit'></i></a></span>
                            </td>
                            <td><a id="viewproduct" onclick='viewproduct("<?=$pid;?>")' class='btn btn-info btn-sm btn-flat desc' data-id="<?=$row['prodid']; ?>"><i class='fa fa-eye'></i>  View</a></td>
                            <td>$ <?=number_format($row['price'], 2); ?></td>
                            <td><?=$row['pqty']; ?></td>
                            <td><?=$row['catname'].' / '.$row['subcat_name'].'<br>'.$row['modelname'] ?></td>
                            <td>
                              <a href="products_edit.php?id=<?=$row['prodid']; ?>" id="editproducts" class='btn btn-success btn-sm edit dit btn-flat' data-id="<?=$row['prodid']; ?>"><i class='fa fa-edit'></i> Edit</a>
                              <button class='btn btn-danger btn-sm delete btn-flat' id="deleteproduct" onclick="deleteProduct(<?=$row['prodid']; ?>)" data-id="<?=$row['prodid']; ?>"><i class='fa fa-trash'></i> Delete</button>
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
<script src="<?=$root_path;?>/products/product.js?ver=4.6"></script>
</body>
</html>

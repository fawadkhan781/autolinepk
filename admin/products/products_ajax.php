<?php
session_start();
include '../global.php';
require_once('../includes/dbcon.php');

// fetch product sub category
if($_POST["action"] == 'prodsubcategory'){
	$id=$_POST["id"];
	$qcat = "SELECT * FROM subcategory WHERE category_id=$id AND subcat_status=1";
	$result_item  = mysqli_query($connection, $qcat);
	if(mysqli_num_rows($result_item) > 0){
		echo "<option value='selected'>- Select Subcategory -</option>";
		while ($row_item = mysqli_fetch_array($result_item)) {
		  echo "<option value='".$row_item['id']."'>".$row_item['subcat_name']."</option>";
		}
	}else{
		echo "<option value='selected'>- Subcategory Not found -</option>";
	}

}

// Insert product
if($_POST["action"] == 'addproduct'){
	$name=$_POST["name"];
	$qty=$_POST["qty"];
	$price=$_POST["price"];
	$pcateg=$_POST["pcateg"];
	$psubcateg=$_POST["psubcateg"];
	$pmodel=$_POST["pmodel"];
	$description=$_POST["description"];
	$fileName="";
	$fileName = rand().'_'.$_FILES['pimg']['name'];
	$tmpName = $_FILES['pimg']['tmp_name'];
	$result = move_uploaded_file($tmpName, '../assets/images/products/'.$fileName);
  	
  	$delimiter='-';
  	$str=$name;
  	$slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
		
	$sql = "INSERT INTO `products` (`category_id`, `subcategory_id`, `model_id`, `name`, `description`, `slug`, `price`, `image`, `product_qty`) VALUES ('$pcateg', '$psubcateg', '$pmodel', '$name', '$description', '$slug', '$price', '$fileName', '$qty')";
	mysqli_query($connection,$sql);
	if(mysqli_affected_rows($connection)>0){
		echo "Added success";
	}else{
		echo "Failure";
	}

}

//Edit Product image
if($_POST["action"] == 'editprodimage'){ 
	$id=$_POST["id"];
	$query1 = "SELECT * FROM products WHERE id=$id";
    $res_pro = mysqli_query($connection,$query1);
    if(mysqli_num_rows($res_pro) > 0){ 
    	while ($row = mysqli_fetch_array($res_pro)) {?>
		  <div class="row"><div class="col-md-6">
			 <img src="<?=$productimgpath.$row['image']; ?>" id="newimgprevw" class="img-responsive">
		   </div>
		   <div class="col-md-6 pull-right">
		   <label for="photo" class="control-label">Upload New Image</label>
	       <input type="file" name="updatenewprodimg" onchange="previewfiles(this);" id="updatenewprodimg" required>
	            <br><br>
			 <a class='btn btn-sm btn-primary btn-flat' id='updateprodimage' onclick='updprodimg(<?=$row["id"];?>)' data-id="<?=$row['id'];?>"><i class="fa fa-save"></i>Update</a>
			 </div>
		   </row>
	<?php
   	} }
}

//update product image
if($_POST["action"] == 'updateprodimage'){ 
	$id=$_POST["id"];
	$fileName="";
	$fileName = rand().'_'.$_FILES['pimg']['name'];
	$tmpName = $_FILES['pimg']['tmp_name'];
	$result = move_uploaded_file($tmpName, '../assets/images/products/'.$fileName);
	
	$sql = "UPDATE `products` SET `image` = '$fileName' WHERE id='$id' AND product_status=1";
	$res = mysqli_query($connection,$sql);
	if(mysqli_affected_rows($connection)>0)
	{   echo "Updated"; }else{ echo "Failure";}
}

//view product
if($_POST["action"] == 'viewproduct'){ 
	$id=$_POST["id"];
  $now = date('Y-m-d');
  $query1 = "SELECT products.name, products.description, products.price, products.model_id, products.image, products.product_qty, products.created_at, subcategory.id, category.id, subcategory.subcat_name, model.name as modelname,category.name as catname FROM products INNER JOIN category ON products.category_id=category.id  INNER JOIN subcategory ON products.subcategory_id=subcategory.id INNER JOIN model ON products.model_id=model.id WHERE products.id='$id'";
      $res_pro = mysqli_query($connection,$query1);
      if(mysqli_num_rows($res_pro) > 0)
      {
        $total = 0;
         while ($row = mysqli_fetch_array($res_pro)) {
          $image = (!empty($row['image'])) ? $root_path.'/assets/images/products/'.$row['image'] : $root_path.'/assets/images/noimage.jpg'; ?>
        <div class="row">
          <div class="col-md-6"><label>Name:</label> <?=$row['name']; ?><br><br><label>Category:</label> <?=$row['catname'];?><br><br><label>SubCategory: </label> <?=$row['subcat_name'];?> <br><br><label>Model:</label> <?=$row['modelname'];?><br><br><label>Price:</label> $ <?=number_format($row['price'], 2); ?><br><br><label>Quantity:</label> <?=$row['product_qty'];?><br><br><label>Date:</label> <?=$row['created_at'];?><br><br><label>Description:</label> <?=$row['description'];?>
        </div>
          <div class="col-md-6"><label>Image:</label> <img src="<?=$productimgpath.$row['image'];?>" class="img-responsive"></div>
        </div>
   <?php } }  
}

//Edit product
if($_POST["action"] == 'editproduct'){ 
	$id=$_POST["id"];
  $now = date('Y-m-d');
  $query1 = "SELECT products.name, products.description, products.price, products.model_id, products.image, products.product_qty, products.created_at, subcategory.id, category.id, subcategory.subcat_name, model.name as modelname,category.name as catname FROM products INNER JOIN category ON products.category_id=category.id  INNER JOIN subcategory ON products.subcategory_id=subcategory.id INNER JOIN model ON products.model_id=model.id WHERE products.id='$id'";
      $res_pro = mysqli_query($connection,$query1);
      if(mysqli_num_rows($res_pro) > 0)
      {
        $total = 0;
         while ($row = mysqli_fetch_array($res_pro)) {
          $image = (!empty($row['image'])) ? $root_path.'/assets/images/products/'.$row['image'] : $root_path.'/assets/images/noimage.jpg'; ?>
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
		          <select class="form-control clrfield" id="productcategory" onchange="productCategory()" name="category" required>
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
		      <a class="btn btn-primary btn-flat" id="addproduct"><i class="fa fa-save"></i> Save</a>
		      <a href="index.php" class="btn btn-info pull-right btn-med btn-flat"><i class="fa fa-eye"></i> Products List</a>
		    </form>
   <?php } }  
}

// Reload orderstatus
if($_POST["action"] == 'orderstatusreload'){ 
	$query1 = "SELECT * FROM orders_status WHERE status=1";
	$res_pro = mysqli_query($connection,$query1);
	if(mysqli_num_rows($res_pro) > 0){
		while ($row = mysqli_fetch_array($res_pro)) {?>
			<tr>
				<td><?=$row['title'] ?></td>
				<td>
					<button class='btn btn-success btn-sm edit btn-flat' id="orderstatusedit" data-id='<?=$row['id'] ?>"'><i class='fa fa-edit'></i> Edit</button>
					<button class='btn btn-danger btn-sm delete btn-flat' id="orderstatusdelete" data-id='<?=$row['id'] ?>"'><i class='fa fa-trash'></i> Delete</button>
				</td>
			</tr>
		<?php } 
	}
}

// Reload products
if($_POST["action"] == 'reloadproducts'){ 
	$query1 = "SELECT products.id as prodid,products.name as productname, products.description, products.price, products.model_id, products.image, products.product_qty, products.created_at, subcategory.id, category.id, subcategory.subcat_name, model.name as modelname,category.name as catname FROM products INNER JOIN category ON products.category_id=category.id  INNER JOIN subcategory ON products.subcategory_id=subcategory.id INNER JOIN model ON products.model_id=model.id WHERE products.product_status=1 ORDER BY products.id DESC";
    $res_pro = mysqli_query($connection,$query1);
    if(mysqli_num_rows($res_pro) > 0)
    {
      $total = 0;
       while ($row = mysqli_fetch_array($res_pro)) {
        $image = (!empty($row['image'])) ? $productimgpath.$row['image'] : '/admin/assets/images/noimage.jpg';
    //$counter = ($row['date_view'] == $now) ? $row['counter'] : 0;
    echo "
      <tr>
        <td>".$row['productname']."</td>
        <td>
          <img src='".$image."' height='30px' width='30px'>
          <span class='pull-right'><a class='photo fawad' id='editprodimage' onclick='editProdImg(".$row['prodid'].")' data-id='".$row['prodid']."'><i class='fa fa-edit'></i></a></span>
        </td>
        <td><a href='#description' data-toggle='modal' class='btn btn-info btn-sm btn-flat desc' data-id='".$row['prodid']."'><i class='fa fa-search'></i> View</a></td>
        <td>&#36; ".number_format($row['price'], 2)."</td>
        <td></td>
        <td>
          <button class='btn btn-success btn-sm edit dit btn-flat' data-id='".$row['prodid']."'><i class='fa fa-edit'></i> Edit</button>
          <button class='btn btn-danger btn-sm delete btn-flat' onclick='deleteProduct('".$row['prodid']."')'  data-id='".$row['prodid']."'><i class='fa fa-trash'></i> Delete</button>
        </td>
      </tr>
    ";
      }
    }  
}

// Update product
if($_POST["action"] == 'updateproduct'){
	$id=$_POST["id"];
	$name=$_POST["name"];
	$qty=$_POST["qty"];
	$price=$_POST["price"];
	$pcateg=$_POST["pcateg"];
	$psubcateg=$_POST["psubcateg"];
	$pmodel=$_POST["pmodel"];
	$description=$_POST["description"];
		
	$sql = "UPDATE `products`  SET `category_id`='$pcateg', `subcategory_id`='$psubcateg', `model_id`='$pmodel', `name`='$name', `description`='$description', `price`='$price', `product_qty`='$qty' WHERE `id`='$id' AND `product_status`=1";
	mysqli_query($connection,$sql);
	if(mysqli_affected_rows($connection)>0){
		echo "Successfully";
	}else{
		echo "Failure";
	}

}

// Delete product
if($_POST["action"] == 'deleteproduct'){
	$id=$_POST["id"];

	$sql = "UPDATE `products` SET `product_status`=0 WHERE `id`='$id'";
	mysqli_query($connection,$sql);
	if(mysqli_affected_rows($connection)>0){
		echo "success";
	}else{
		echo "Failure";
	}

}
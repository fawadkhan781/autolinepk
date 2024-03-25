<?php 
session_start();
require_once('../../includes/dbcon.php');
// call modal for category

if($_POST["action"] == 'categorymodal'){ ?>

	<form class="form-horizontal">
		<div class="form-group">
			<label for="name" class="col-sm-3 control-label">Name</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="catname" name="name">
			</div>
		</div>
		<div class="form-group">
			<label for="name" class="col-sm-3 control-label">Order</label>
			<div class="col-sm-9">
				<input type="number" class="form-control" id="order" name="order">
			</div>
		</div>
		<div class="form-group">
			<label for="name" class="col-sm-3 control-label">Description</label>
			<div class="col-sm-9">
				<textarea name="description" id="description" class="form-control" rows="3"></textarea>
			</div>
		</div>

	</form>
	 <div class="modal-footer">
		<button type="button" class="btn btn-danger btn-flat pull-left" onclick="$('#background_fade').fadeOut(function() { $(this).remove(); });" aria-hidden="true"><i class="fa fa-close"></i>Close</button>
		<a class="btn btn-primary btn-flat" name="add" id="categoryadd" onclick="addcategory()"><i class="fa fa-save"></i> Save</a>
	</div>
<?php }

// Insert/add category
if($_POST["action"] == 'addcategory'){ 

	$name=$_POST["name"];
	$order=$_POST["order"];
	$description=$_POST["description"];
	$qcat = "SELECT * FROM category WHERE name='$name' AND cat_status=1";
	$result_item  = mysqli_query($connection, $qcat);
	if(mysqli_num_rows($result_item) > 0){
		 die("Already Exists"."<br>"."Category Name must be unique");
	}else{
		$sql = "INSERT INTO `category` (`name`, `cat_sort`, `cat_description`) VALUES ('$name', '$order',' $description')";
			mysqli_query($connection,$sql);
			if(mysqli_affected_rows($connection)>0){
				$query1 = "SELECT * FROM category WHERE cat_status=1";
                        $res_pro = mysqli_query($connection,$query1);
                        if(mysqli_num_rows($res_pro) > 0){
                           while ($row = mysqli_fetch_array($res_pro)) {?>
                          <tr>
                            <td><?=$row['name'] ?></td>
                            <td>
                              <button class='btn btn-success btn-sm edit btn-flat' id="categoryedit" data-id='<?=$row['id'] ?>"'><i class='fa fa-edit'></i> Edit</button>
                              <button class='btn btn-danger btn-sm delete btn-flat' id="categorydelete" data-id='<?=$row['id'] ?>"'><i class='fa fa-trash'></i> Delete</button>
                            </td>
                          </tr>
                      <?php } }
			}else{
				echo "Failure";
			}
	}

}

// Edit category

if($_POST["action"] == 'categoryedit'){ 

	$id=$_POST["id"];
	$query1 = "SELECT * FROM category WHERE id='$id' AND cat_status=1";
    $res_pro = mysqli_query($connection,$query1);
    if(mysqli_num_rows($res_pro) > 0){
       while ($row = mysqli_fetch_array($res_pro)) {?>
       	<form class="form-horizontal">
			<div class="form-group">
				<label for="name" class="col-sm-3 control-label">Name</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="catname" value="<?=$row['name'] ?>" name="name">
				</div>
			</div>
			<div class="form-group">
				<label for="name" class="col-sm-3 control-label">Order</label>
				<div class="col-sm-9">
					<input type="number" class="form-control" id="order" value="<?=$row['cat_sort'] ?>" name="order">
				</div>
			</div>
			<div class="form-group">
				<label for="name" class="col-sm-3 control-label">Description</label>
				<div class="col-sm-9">
					<textarea name="description" id="description" class="form-control" rows="3"><?=$row['cat_description'] ?></textarea>
				</div>
			</div>

		</form>
		 <div class="modal-footer">
			<button type="button" class="btn btn-danger btn-flat pull-left" onclick="$('#background_fade').fadeOut(function() { $(this).remove(); });" aria-hidden="true"><i class="fa fa-close"></i>Close</button>
			<a class="btn btn-primary btn-flat update" data-id="<?=$row['id']; ?>" id="categoryupdate"><i class="fa fa-save"></i> Update</a>
		</div>
   <?php }
  }else{ echo "Failure";}

}

// Update category
if($_POST["action"] == 'categoryupdate'){ 

	$id=$_POST["id"];
	$name=$_POST["name"];
	$order=$_POST["order"];
	$description=$_POST["description"];
	$sql = "UPDATE `category` SET `name` = '$name', `cat_sort`='$order', `cat_description`='$description'  WHERE id='$id' AND cat_status=1";
	$res = mysqli_query($connection,$sql);
	if(mysqli_affected_rows($connection)>0)
	{
		$query1 = "SELECT * FROM category WHERE cat_status=1";
        $res_pro = mysqli_query($connection,$query1);
        if(mysqli_num_rows($res_pro) > 0){
           while ($row = mysqli_fetch_array($res_pro)) {?>
          <tr>
            <td><?=$row['name'] ?></td>
            <td>
              <button class='btn btn-success btn-sm edit btn-flat' id="categoryedit" data-id='<?=$row['id'] ?>"'><i class='fa fa-edit'></i> Edit</button>
              <button class='btn btn-danger btn-sm delete btn-flat' id="categorydelete" data-id='<?=$row['id'] ?>"'><i class='fa fa-trash'></i> Delete</button>
            </td>
          </tr>
      <?php } }
	}else{ echo "Failure";}

}

// Delete category
if($_POST["action"] == 'categorydelete'){ 

	$id=$_POST["id"];
	$sql = "UPDATE `category` SET `cat_status` = 0 WHERE id='$id'";
	$res = mysqli_query($connection,$sql);
	if(mysqli_affected_rows($connection)>0)
	{
		echo "success";
	}else{ echo "Failure";}

}

// Reload Category
if($_POST["action"] == 'categoryreload'){ 
	$query1 = "SELECT * FROM category WHERE cat_status=1";
	$res_pro = mysqli_query($connection,$query1);
	if(mysqli_num_rows($res_pro) > 0){
		while ($row = mysqli_fetch_array($res_pro)) {?>
			<tr>
				<td><?=$row['name'] ?></td>
				<td>
					<button class='btn btn-success btn-sm edit btn-flat' id="categoryedit" data-id='<?=$row['id'] ?>"'><i class='fa fa-edit'></i> Edit</button>
					<button class='btn btn-danger btn-sm delete btn-flat' id="categorydelete" data-id='<?=$row['id'] ?>"'><i class='fa fa-trash'></i> Delete</button>
				</td>
			</tr>
		<?php } 
	}
}


/**********************Subcategory****************************/

// call modal for Subcategory

if($_POST["action"] == 'subcategorymodal'){ ?>

	<form class="form-horizontal">
		<div class="form-group">
			<label for="name" class="col-sm-3 control-label">Name</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="catname" name="name">
			</div>
		</div>
		<div class="form-group">
			<label for="name" class="col-sm-3 control-label">Category</label>
			<div class="col-sm-9">
				<select name="category" id="parentcategory" class="form-control" required="required">
					<option value="">---Select Parent Category---</option>
					<?php 
            $qcat = "SELECT * FROM category WHERE cat_status=1";
            $result_item  = mysqli_query($connection, $qcat);
            while ($row_item = mysqli_fetch_array($result_item)) {
              echo "<option value='".$row_item['id']."'>".$row_item['name']."</option>";
            }
            ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="name" class="col-sm-3 control-label">Order</label>
			<div class="col-sm-9">
				<input type="number" class="form-control" id="order" name="order">
			</div>
		</div>
		<div class="form-group">
			<label for="name" class="col-sm-3 control-label">Description</label>
			<div class="col-sm-9">
				<textarea name="description" id="description" class="form-control" rows="3"></textarea>
			</div>
		</div>

	</form>
	 <div class="modal-footer">
		<button type="button" class="btn btn-danger btn-flat pull-left" onclick="$('#background_fade').fadeOut(function() { $(this).remove(); });" aria-hidden="true"><i class="fa fa-close"></i>Close</button>
		<a class="btn btn-primary btn-flat" name="add" id="subcategoryadd"><i class="fa fa-save"></i> Save</a>
	</div>
<?php }

// Insert/add category
if($_POST["action"] == 'addsubcategory'){ 

	$name=$_POST["name"];
	$pcategory=$_POST["pcategory"];
	$order=$_POST["order"];
	$description=$_POST["description"];
	$qcat = "SELECT * FROM subcategory WHERE subcat_name='$name' AND category_id='$pcategory' AND 	subcat_status=1";
	$result_item  = mysqli_query($connection, $qcat);
	if(mysqli_num_rows($result_item) > 0){
		 die("Already Exists"."<br>"."SubCategory Name must be unique");
	}else{
		$sql = "INSERT INTO `subcategory` (`category_id`, `subcat_name`,  `subcat_sort`, `subcat_description`) VALUES ('$pcategory', '$name', '$order', '$description')";
			mysqli_query($connection,$sql);
			if(mysqli_affected_rows($connection)>0){
				$query1 = "SELECT subcategory.id, subcategory.subcat_name, category.name FROM subcategory INNER JOIN category WHERE subcategory.subcat_status=1 AND category.cat_status=1 AND subcategory.category_id=category.id";
          $res_pro = mysqli_query($connection,$query1);
          if(mysqli_num_rows($res_pro) > 0){
             while ($row = mysqli_fetch_array($res_pro)) {?>
            <tr>
              <td><?=$row['subcat_name'] ?></td>
              <td><?=$row['name'] ?></td>
              <td>
                <button class='btn btn-success btn-sm edit btn-flat' id="subcategoryedit" data-id='<?=$row['id'] ?>"'><i class='fa fa-edit'></i> Edit</button>
                <button class='btn btn-danger btn-sm delete btn-flat' id="subcategorydelete" data-id='<?=$row['id'] ?>"'><i class='fa fa-trash'></i> Delete</button>
              </td>
            </tr>
        <?php } }
			}else{
				echo "Failure";
			}
	}

}

// Edit Subcategory

if($_POST["action"] == 'subcategoryedit'){ 

	$id=$_POST["id"];
	$query1 = "SELECT * FROM subcategory WHERE id='$id' AND subcat_status=1";
    $res_pro = mysqli_query($connection,$query1);
    if(mysqli_num_rows($res_pro) > 0){
      $row = mysqli_fetch_array($res_pro);?>
       	<form class="form-horizontal">
			<div class="form-group">
				<label for="name" class="col-sm-3 control-label">Name</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="catname" value="<?=$row['subcat_name'] ?>" name="name">
				</div>
			</div>
			<div class="form-group">
			<label for="name" class="col-sm-3 control-label">Category</label>
			<div class="col-sm-9">
				<select name="category" id="parentcategory" class="form-control" required="required">
					<option value="">---Select Parent Category---</option>
					<?php 
            $qcat = "SELECT * FROM category WHERE cat_status=1";
            $result_item  = mysqli_query($connection, $qcat);
            while ($row_item = mysqli_fetch_array($result_item)) {?>
              <option <?=($row_item['id']==$row['category_id'] ? 'selected' : ''); ?> value="<?=$row_item['id'];?>"><?=$row_item['name'];?></option>
           <?php } ?>
				</select>
			</div>
		</div>
			<div class="form-group">
				<label for="name" class="col-sm-3 control-label">Order</label>
				<div class="col-sm-9">
					<input type="number" class="form-control" id="order" value="<?=$row['subcat_sort'] ?>" name="order">
				</div>
			</div>
			<div class="form-group">
				<label for="name" class="col-sm-3 control-label">Description</label>
				<div class="col-sm-9">
					<textarea name="description" id="description" class="form-control" rows="3"><?=$row['subcat_description'] ?></textarea>
				</div>
			</div>

		</form>
		 <div class="modal-footer">
			<button type="button" class="btn btn-danger btn-flat pull-left" onclick="$('#background_fade').fadeOut(function() { $(this).remove(); });" aria-hidden="true"><i class="fa fa-close"></i>Close</button>
			<a class="btn btn-primary btn-flat update" data-id="<?=$row['id']; ?>" id="subcategoryupdate"><i class="fa fa-save"></i> Update</a>
		</div>
   <?php }else{ echo "Failure";}

}

// Update subcategory
if($_POST["action"] == 'subcategoryupdate'){ 

	$id=$_POST["id"];
	$name=$_POST["name"];
	$pcat=$_POST["pcateg"];
	$order=$_POST["order"];
	$description=$_POST["description"];
	$sql = "UPDATE `subcategory` SET `category_id` = '$pcat', `subcat_name` = '$name', `subcat_description`='$description', `subcat_sort`='$order'  WHERE id=$id AND subcat_status=1";
	echo $sql;
	$res = mysqli_query($connection,$sql);
	if(mysqli_affected_rows($connection)>0)
	{
		$query1 = "SELECT * FROM subcategory WHERE subcat_status=1";
        $res_pro = mysqli_query($connection,$query1);
        if(mysqli_num_rows($res_pro) > 0){
           while ($row = mysqli_fetch_array($res_pro)) {?>
          <tr>
            <td><?=$row['subcat_name'] ?></td>
            <td><?=$row['category_id'] ?></td>
            <td>
              <button class='btn btn-success btn-sm edit btn-flat' id="categoryedit" data-id='<?=$row['id'] ?>"'><i class='fa fa-edit'></i> Edit</button>
              <button class='btn btn-danger btn-sm delete btn-flat' id="categorydelete" data-id='<?=$row['id'] ?>"'><i class='fa fa-trash'></i> Delete</button>
            </td>
          </tr>
      <?php } }
	}else{ echo "Failure";}

}

// Reload SubCategory
if($_POST["action"] == 'subcategoryreload'){ 
	$query1 = "SELECT * FROM category WHERE cat_status=1";
	$res_pro = mysqli_query($connection,$query1);
	if(mysqli_num_rows($res_pro) > 0){
		while ($row = mysqli_fetch_array($res_pro)) {?>
			<tr>
				<td><?=$row['name'] ?></td>
				<td>
					<button class='btn btn-success btn-sm edit btn-flat' id="categoryedit" data-id='<?=$row['id'] ?>"'><i class='fa fa-edit'></i> Edit</button>
					<button class='btn btn-danger btn-sm delete btn-flat' id="categorydelete" data-id='<?=$row['id'] ?>"'><i class='fa fa-trash'></i> Delete</button>
				</td>
			</tr>
		<?php } 
	}
}
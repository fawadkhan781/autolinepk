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
			<label for="name" class="col-sm-3 control-label">Menu</label>
			<div class="col-sm-9">
			  <div class="form-check">
			    <input class="form-check-input inmenu" type="checkbox" value="yes" id="inmenu">
			    <label class="form-check-label" for="defaultCheck1">
			     	Disable from Menu
			    </label>
			  </div>
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
		<a class="btn btn-primary btn-flat" onclick="addcategory()" name="add" id="categoryadd"><i class="fa fa-save"></i> Save</a>
	</div>
<?php }

// Insert/add category
if($_POST["action"] == 'addcategory'){ 

	$name=$_POST["name"];
	$order=$_POST["order"];
	$inmenu=$_POST["inmenu"];
	$infilter=$_POST["infilter"];
	$description=$_POST["description"];

		$delimiter='-';
  	$str=$name;
  	$slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter)); 

	$qcat = "SELECT * FROM category WHERE name='$name' AND cat_status=1";
	$result_item  = mysqli_query($connection, $qcat);
	if(mysqli_num_rows($result_item) > 0){
		 die("Already Exists"."<br>"."Category Name must be unique");
	}else{
		$sql = "INSERT INTO `category` (`name`, `cat_slug`, `inmenu`, `infilter`, `cat_sort`, `cat_description`) VALUES ('$name', '$slug', '$inmenu', '$infilter', '$order', '$description')";
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
				<label for="name" class="col-sm-3 control-label">Menu</label>
				<div class="col-sm-9">
				  <div class="form-check">
				    <input class="form-check-input inmenu" type="checkbox" value="yes" id="inmenu" <?=($row['inmenu']=='yes' ? 'checked' : '' ); ?>>
				    <label class="form-check-label" for="defaultCheck1">
				     	Disable from Main Menu
				    </label>
				  </div>
				</div>
			</div>
			<div class="form-group">
				<label for="name" class="col-sm-3 control-label">Filter</label>
				<div class="col-sm-9">
				  <div class="form-check">
				    <input class="form-check-input infilter" type="checkbox" value="yes" id="infilter" <?=($row['infilter']=='yes' ? 'checked' : '' ); ?>>
				    <label class="form-check-label" for="defaultCheck1">
				     	Disable from Filter
				    </label>
				  </div>
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
			<a class="btn btn-primary btn-flat update" data-id="<?=$row['id']; ?>" id="categoryupdate" onclick="updatecategory(<?=$row['id']; ?>)"><i class="fa fa-save"></i> Update</a>
		</div>
   <?php }
  }else{ echo "Failure";}

}

// Update category
if($_POST["action"] == 'categoryupdate'){ 

	$id=$_POST["id"];
	$name=$_POST["name"];
	$inmenu=$_POST["inmenu"];
	$infilter=$_POST["infilter"];
	$order=$_POST["order"];
	$description=$_POST["description"];
	$delimiter='-';
  	$str=$name;
  	$slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));

	$sql = "UPDATE `category` SET `name` = '$name', `inmenu`='$inmenu', `infilter`='$infilter', `cat_slug` = '$slug', `cat_sort`='$order', `cat_description`='$description'  WHERE id='$id' AND cat_status=1";
	$res = mysqli_query($connection,$sql);
	if(mysqli_affected_rows($connection)>0)
	{
		$query1 = "SELECT * FROM category WHERE cat_status=1";
        $res_pro = mysqli_query($connection,$query1);
        if(mysqli_num_rows($res_pro) > 0){
           while ($row = mysqli_fetch_array($res_pro)) {?>
          <tr>
            <td><?=$row['name'] ?></td>
            <td><?=$row['inmenu'] ?></td>
            <td><?=$row['infilter'] ?></td>
            <td>
              <button class='btn btn-success btn-sm edit btn-flat' onclick="editcategory(<?=$row['id'] ?>)"  id="categoryedit" data-id='<?=$row['id'] ?>"'><i class='fa fa-edit'></i> Edit</button>
              <button class='btn btn-danger btn-sm delete btn-flat' id="categorydelete" onclick="deletcategory(<?=$row['id'] ?>)" data-id='<?=$row['id'] ?>"'><i class='fa fa-trash'></i> Delete</button>
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
				<td><?=$row['inmenu'] ?></td>
				<td><?=$row['infilter'] ?></td>
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
				<label for="name" class="col-sm-3 control-label">Menu</label>
				<div class="col-sm-9">
				  <div class="form-check">
				    <input class="form-check-input inmenu" type="checkbox" value="yes" id="inmenu">
				    <label class="form-check-label" for="defaultCheck1">
				     	Disable from Main subMenu
				    </label>
				  </div>
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
		<a class="btn btn-primary btn-flat" name="add" id="subcategoryadd" onclick="addsubcateg()"><i class="fa fa-save"></i> Save</a>
	</div>
<?php }

// Insert/add category
if($_POST["action"] == 'addsubcategory'){ 

	$name=$_POST["name"];
	$pcategory=$_POST["pcategory"];
	$inmenu=$_POST["inmenu"];
	$order=$_POST["order"];
	$description=$_POST["description"];

	$delimiter='-';
  $str=$name;
  $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter)); 
	$qcat = "SELECT * FROM subcategory WHERE subcat_name='$name' AND category_id='$pcategory' AND 	subcat_status=1";
	$result_item  = mysqli_query($connection, $qcat);
	if(mysqli_num_rows($result_item) > 0){
		 die("Already Exists"."<br>"."SubCategory Name must be unique");
	}else{
		$sql = "INSERT INTO `subcategory` (`category_id`, `subcat_name`, `subcat_slug`, `inmenu`,  `subcat_sort`, `subcat_description`) VALUES ('$pcategory', '$name', '$slug', '$inmenu', '$order', '$description')";
			mysqli_query($connection,$sql);
			if(mysqli_affected_rows($connection)>0){
				echo "success";
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
				<label for="name" class="col-sm-3 control-label">Menu</label>
				<div class="col-sm-9">
				  <div class="form-check">
				    <input class="form-check-input inmenu" type="checkbox" value="yes" id="inmenu" <?=($row['inmenu']=='yes' ? 'checked' : '' ); ?>>
				    <label class="form-check-label" for="defaultCheck1">
				     	Disable from Main Menu
				    </label>
				  </div>
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
			<a class="btn btn-primary btn-flat update" data-id="<?=$row['id']; ?>" id="subcategoryupdate" onclick="ubdsubcategory(<?=$row['id']; ?>)"><i class="fa fa-save"></i> Update</a>
		</div>
   <?php }else{ echo "Failure";}

}

// Update subcategory
if($_POST["action"] == 'subcategoryupdate'){ 

	$id=$_POST["id"];
	$name=$_POST["name"];
	$pcat=$_POST["pcateg"];
	$inmenu=$_POST["inmenu"];
	$order=$_POST["order"];
	$description=$_POST["description"];
	$delimiter='-';
  $str=$name;
  $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter)); 

	$sql = "UPDATE `subcategory` SET `category_id` = '$pcat', `subcat_name` = '$name', `subcat_slug` = '$slug', `inmenu`='$inmenu', `subcat_description`='$description',  `subcat_sort`='$order'  WHERE id=$id AND subcat_status=1";
	$res = mysqli_query($connection,$sql);
	if(mysqli_affected_rows($connection)>0)
	{
		echo "success";
	}else{ echo "Failure";}

}

// Reload SubCategory
if($_POST["action"] == 'subcategoryreload'){ 
	$query1 = "SELECT subcategory.id, subcategory.subcat_name, subcategory.inmenu as menu, category.name FROM subcategory INNER JOIN category WHERE subcategory.subcat_status=1 AND category.cat_status=1 AND subcategory.category_id=category.id";
          $res_pro = mysqli_query($connection,$query1);
          if(mysqli_num_rows($res_pro) > 0){
             while ($row = mysqli_fetch_array($res_pro)) {?>
            <tr>
              <td><?=$row['subcat_name'] ?></td>
              <td><?=$row['name'] ?></td>
              <td><?=$row['menu'] ?></td>
              <td>
                <button class='btn btn-success btn-sm edit btn-flat' id="subcategoryedit" onclick="editsubcateg()" data-id='<?=$row['id'] ?>"'><i class='fa fa-edit'></i> Edit</button>
                <button class='btn btn-danger btn-sm delete btn-flat' id="subcategorydelete" data-id='<?=$row['id'] ?>"'><i class='fa fa-trash'></i> Delete</button>
              </td>
            </tr>
        <?php } 
      }
}

// Delete subcategory
if($_POST["action"] == 'subcategorydelete'){ 

	$id=$_POST["id"];
	$sql = "UPDATE `subcategory` SET `subcat_status` = 0 WHERE id='$id'";
	$res = mysqli_query($connection,$sql);
	if(mysqli_affected_rows($connection)>0)
	{
		echo "success";
	}else{ echo "Failure";}

}


/**********model***********/

// call modal for model

if($_POST["action"] == 'modelmodal'){ ?>

	<form class="form-horizontal">
		<div class="form-group">
			<label for="name" class="col-sm-3 control-label">Model Name</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="modelname" name="name">
			</div>
		</div>

	</form>
	 <div class="modal-footer">
		<button type="button" class="btn btn-danger btn-flat pull-left" onclick="$('#background_fade').fadeOut(function() { $(this).remove(); });" aria-hidden="true"><i class="fa fa-close"></i>Close</button>
		<a class="btn btn-primary btn-flat" name="add" id="modeladd" onclick="addmodel()"><i class="fa fa-save"></i> Save</a>
	</div>
<?php }

// Insert/add model
if($_POST["action"] == 'addmodel'){ 

	$name=$_POST["name"];
	$qcat = "SELECT * FROM model WHERE name='$name' AND status=1";
	$result_item  = mysqli_query($connection, $qcat);
	if(mysqli_num_rows($result_item) > 0){
		 die("Already Exists"."<br>"."model Name must be unique");
	}else{
		$sql = "INSERT INTO `model` (`name`) VALUES ('$name')";
			mysqli_query($connection,$sql);
			if(mysqli_affected_rows($connection)>0){
				$query1 = "SELECT * FROM model WHERE status=1";
            echo "Inserted";
			}else{
				echo "Failure";
			}
	}

}

// Edit model

if($_POST["action"] == 'modeledit'){ 

	$id=$_POST["id"];
	$query1 = "SELECT * FROM model WHERE id='$id' AND status=1";
    $res_pro = mysqli_query($connection,$query1);
    if(mysqli_num_rows($res_pro) > 0){
       while ($row = mysqli_fetch_array($res_pro)) {?>
       	<form class="form-horizontal">
			<div class="form-group">
				<label for="name" class="col-sm-3 control-label">Name</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="modelname" value="<?=$row['name'] ?>" name="name">
				</div>
			</div>
		</form>
		 <div class="modal-footer">
			<button type="button" class="btn btn-danger btn-flat pull-left" onclick="$('#background_fade').fadeOut(function() { $(this).remove(); });" aria-hidden="true"><i class="fa fa-close"></i>Close</button>
			<a class="btn btn-primary btn-flat update" data-id="<?=$row['id']; ?>" id="modelupdate" onclick="updatemodel(<?=$row['id']; ?>)"><i class="fa fa-save"></i> Update</a>
		</div>
   <?php }
  }else{ echo "Failure";}

}

// Update model
if($_POST["action"] == 'modelupdate'){ 

	$id=$_POST["id"];
	$name=$_POST["name"];
	$sql = "UPDATE `model` SET `name` = '$name' WHERE id='$id' AND status=1";
	$res = mysqli_query($connection,$sql);
	if(mysqli_affected_rows($connection)>0)
	{
		$query1 = "SELECT * FROM model WHERE status=1";
    $res_pro = mysqli_query($connection,$query1);
    if(mysqli_num_rows($res_pro) > 0){
    echo "Updated";
		}else{ echo "Failure";}
	}
}

// Delete model
if($_POST["action"] == 'modeldelete'){ 

	$id=$_POST["id"];
	$sql = "UPDATE `model` SET `status` = 0 WHERE id='$id'";
	$res = mysqli_query($connection,$sql);
	if(mysqli_affected_rows($connection)>0){ 
		echo "success";
	}else{ echo "Failure";}

}

// Reload model
if($_POST["action"] == 'modelreload'){ 
	$query1 = "SELECT * FROM model WHERE status=1";
	$res_pro = mysqli_query($connection,$query1);
	if(mysqli_num_rows($res_pro) > 0){
		while ($row = mysqli_fetch_array($res_pro)) {?>
			<tr>
				<td><?=$row['name'] ?></td>
				<td>
					<button class='btn btn-success btn-sm edit btn-flat' id="modeledit" data-id='<?=$row['id'] ?>"'><i class='fa fa-edit'></i> Edit</button>
					<button class='btn btn-danger btn-sm delete btn-flat' id="modeldelete" data-id='<?=$row['id'] ?>"'><i class='fa fa-trash'></i> Delete</button>
				</td>
			</tr>
		<?php } 
	}
}


/**********OrderStatus***********/

// call modal for orderstatus

if($_POST["action"] == 'orderstatusmodal'){ ?>

	<form class="form-horizontal">
		<div class="form-group">
			<label for="name" class="col-sm-3 control-label">Name</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="orderstatusname" name="name">
			</div>
		</div>

	</form>
	 <div class="modal-footer">
		<button type="button" class="btn btn-danger btn-flat pull-left" onclick="$('#background_fade').fadeOut(function() { $(this).remove(); });" aria-hidden="true"><i class="fa fa-close"></i>Close</button>
		<a class="btn btn-primary btn-flat" name="add" id="orderstatusadd" onclick="addorderstatus()"><i class="fa fa-save"></i> Save</a>
	</div>
<?php }

// Insert/add orderstatus
if($_POST["action"] == 'addorderstatus'){ 

	$name=$_POST["name"];
	$qcat = "SELECT * FROM orders_status WHERE title='$name' AND status=1";
	$result_item  = mysqli_query($connection, $qcat);
	if(mysqli_num_rows($result_item) > 0){
		 die("Already Exists"."<br>"."orderstatus Name must be unique");
	}else{
		$sql = "INSERT INTO `orders_status` (`title`) VALUES ('$name')";
			mysqli_query($connection,$sql);
			if(mysqli_affected_rows($connection)>0){
				$query1 = "SELECT * FROM orderstatus WHERE status=1";
            echo "Inserted";
			}else{
				echo "Failure";
			}
	}

}

// Edit orderstatus

if($_POST["action"] == 'orderstatusedit'){ 

	$id=$_POST["id"];
	$query1 = "SELECT * FROM orders_status WHERE id='$id' AND status=1";
    $res_pro = mysqli_query($connection,$query1);
    if(mysqli_num_rows($res_pro) > 0){
       while ($row = mysqli_fetch_array($res_pro)) {?>
       	<form class="form-horizontal">
			<div class="form-group">
				<label for="name" class="col-sm-3 control-label">Name</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="orderstatusname" value="<?=$row['title'] ?>" name="name">
				</div>
			</div>
		</form>
		 <div class="modal-footer">
			<button type="button" class="btn btn-danger btn-flat pull-left" onclick="$('#background_fade').fadeOut(function() { $(this).remove(); });" aria-hidden="true"><i class="fa fa-close"></i>Close</button>
			<a class="btn btn-primary btn-flat update" data-id="<?=$row['id']; ?>" id="orderstatusupdate" onclick="updorderstatus(<?=$row['id']; ?>)"><i class="fa fa-save"></i> Update</a>
		</div>
   <?php }
  }else{ echo "Failure";}

}

// Update orderstatus
if($_POST["action"] == 'orderstatusupdate'){ 

	$id=$_POST["id"];
	$name=$_POST["name"];
	$sql = "UPDATE `orders_status` SET `title` = '$name' WHERE id='$id' AND status=1";
	$res = mysqli_query($connection,$sql);
	if(mysqli_affected_rows($connection)>0)
	{
		$query1 = "SELECT * FROM orders_status WHERE status=1";
    $res_pro = mysqli_query($connection,$query1);
    if(mysqli_num_rows($res_pro) > 0){
    echo "Updated";
		}else{ echo "Failure";}
	}
}

// Delete orderstatus
if($_POST["action"] == 'orderstatusdelete'){ 

	$id=$_POST["id"];
	$sql = "UPDATE `orders_status` SET `status` = 0 WHERE id='$id'";
	$res = mysqli_query($connection,$sql);
	if(mysqli_affected_rows($connection)>0){ 
		echo "success";
	}else{ echo "Failure";}

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



/**********slider***********/

// call modal for slider

if($_POST["action"] == 'slidermodal'){ ?>

	<form class="form-horizontal">
		<div class="form-group col-lg-6 mrgrgt5">
			<label for="imgname" class="control-label">Title</label>
				<input type="text" class="form-control" id="slidertitle" name="slidertitle">
			</div>
		</div>
		<div class="form-group col-lg-6">
			<label for="imgname" class="control-label">SubTitle</label>
				<input type="text" class="form-control" id="slidersubtitle">
		</div>
		<div class="form-group col-lg-6 mrgrgt5">
			<label for="imgname" class="control-label">link</label>
				<input type="text" class="form-control" id="sliderlink">
		</div>
		<div class="form-group col-lg-6">
			<label for="imgname" class="control-label">Categorname</label>
				<input type="text" class="form-control" id="slidercategory">
		</div>
	<div class="form-group">
		<label for="imgname" class="col-sm-3 control-label">Slider image</label>
    <input type="file" id="sliderimg" onchange="previewfiles(this);" class="clrfield" name="sliderimg">
    <img id="newimgprevw" class="img-responsive">
    </div>
	</div>
	</form>
	 <div class="modal-footer">
		<button type="button" class="btn btn-danger btn-flat pull-left" onclick="$('#background_fade').fadeOut(function() { $(this).remove(); });" aria-hidden="true"><i class="fa fa-close"></i>Close</button>
		<a class="btn btn-primary btn-flat" name="add" id="slideradd" onclick="addslider()"><i class="fa fa-save"></i> Save</a>
	</div>
<?php }

// Insert/add slider
if($_POST["action"] == 'addslider'){ 

	$name=$_POST["name"];
	$slidersubtitle=$_POST["slidersubtitle"];
	$sliderlink=$_POST["sliderlink"];
	$slidercategory=$_POST["slidercategory"];
	$fileName="";
	$fileName = rand().'_'.$_FILES['pimg']['name'];
	$tmpName = $_FILES['pimg']['tmp_name'];
	$result = move_uploaded_file($tmpName, '../../assets/images/slider/'.$fileName);
	$qcat = "SELECT * FROM slider WHERE title='$name' AND status=1";
	$result_item  = mysqli_query($connection, $qcat);
	if(mysqli_num_rows($result_item) > 0){
		 die("Already Exists"."<br>"."slider Title must be unique");
	}else{
		$sql = "INSERT INTO `slider` (`title`,`subtitle`,`categoryname`,`image`,`link`) VALUES ('$name','$slidersubtitle','$slidercategory','$fileName','$sliderlink')";
			mysqli_query($connection,$sql);
			if(mysqli_affected_rows($connection)>0){
				//$query1 = "SELECT * FROM slider WHERE status=1";
            echo "Inserted";
			}else{
				echo "Failure";
			}
	}

}

// Edit slider

if($_POST["action"] == 'slideredit'){ 

	$id=$_POST["id"];
	$query1 = "SELECT * FROM slider WHERE id='$id' AND status=1";
    $res_pro = mysqli_query($connection,$query1);
    if(mysqli_num_rows($res_pro) > 0){
       while ($row = mysqli_fetch_array($res_pro)) {?>
		   <form class="form-horizontal">
				<div class="form-group col-lg-6 mrgrgt5">
					<label for="imgname" class="control-label">Title</label>
						<input type="text" class="form-control" value="<?=$row['title']?>" id="slidertitle" name="slidertitle">
					</div>
				</div>
				<div class="form-group col-lg-6">
					<label for="imgname" class="control-label">SubTitle</label>
						<input type="text" class="form-control" value="<?=$row['subtitle']?>" id="slidersubtitle">
				</div>
				<div class="form-group col-lg-6 mrgrgt5">
					<label for="imgname" class="control-label">link</label>
						<input type="text" class="form-control" value="<?=$row['link']?>" id="sliderlink">
				</div>
				<div class="form-group col-lg-6">
					<label for="imgname" class="control-label">Categorname</label>
						<input type="text" class="form-control" value="<?=$row['categoryname']?>" id="slidercategory">
				</div>
			<div class="form-group">
				<label for="imgname" class="col-sm-3 control-label">Slider image</label>
		    <input type="file" id="sliderimg" onchange="previewfiles(this);" class="clrfield" name="sliderimg">
		    <img id="newimgprevw" data-img="<?=$row['image'] ?>" class="img-responsive" src="../../assets/images/slider/<?=$row['image'] ?>">
		    </div>
			</div>
			</form>
		 <div class="modal-footer">
			<button type="button" class="btn btn-danger btn-flat pull-left" onclick="$('#background_fade').fadeOut(function() { $(this).remove(); });" aria-hidden="true"><i class="fa fa-close"></i>Close</button>
			<a class="btn btn-primary btn-flat update" data-id="<?=$row['id']; ?>" id="sliderupdate" onclick="updslider(<?=$row['id']; ?>)"><i class="fa fa-save"></i> Update</a>
		</div>
   <?php }
  }else{ echo "Failure";}

}

// Update slider
if($_POST["action"] == 'sliderupdate'){ 

	$id=$_POST["id"];
	$name=$_POST["name"];
	$slidersubtitle=$_POST["slidersubtitle"];
	$sliderlink=$_POST["sliderlink"];
	$slidercategory=$_POST["slidercategory"];
	$fileName="";
	if($_POST["imgupdte"] == "yes"){
	$fileName = rand().'_'.$_FILES['pimg']['name'];
	$tmpName = $_FILES['pimg']['tmp_name'];
	$result = move_uploaded_file($tmpName, '../../assets/images/slider/'.$fileName);
   }else{
   	$fileName=$_POST["pimg"];
   }
	$sql = "UPDATE `slider` SET `title` = '$name',`subtitle` = '$slidersubtitle',`categoryname` = '$slidercategory',`image` = '$fileName',`link` = '$sliderlink' WHERE id='$id' AND status=1";
	$res = mysqli_query($connection,$sql);
	if(mysqli_affected_rows($connection)>0)
	{
		$query1 = "SELECT * FROM slider WHERE status=1";
    $res_pro = mysqli_query($connection,$query1);
    if(mysqli_num_rows($res_pro) > 0){
    echo "Updated";
		}else{ echo "Failure";}
	}
}

// Delete slider
if($_POST["action"] == 'sliderdelete'){ 

	$id=$_POST["id"];
	$sql = "UPDATE `slider` SET `status` = 0 WHERE id='$id'";
	$res = mysqli_query($connection,$sql);
	if(mysqli_affected_rows($connection)>0){ 
		echo "success";
	}else{ echo "Failure";}

}

// Reload slider
if($_POST["action"] == 'sliderreload'){ 
	$genrlimgpath=
	$query1 = "SELECT * FROM slider WHERE status=1";
	$res_pro = mysqli_query($connection,$query1);
	if(mysqli_num_rows($res_pro) > 0){
		while ($row = mysqli_fetch_array($res_pro)) {?>
			<tr>
          <td><?=$row['title'] ?></td>
          <td class="subtilte"><?=$row['subtitle'] ?></td>
          <td><?=$row['categoryname'] ?></td>
          <td><img src="../../assets/images/slider/<?=$row['image'] ?>" class="img-responsive imgcustm" /></td>
          <td>
            <button class='btn btn-success btn-sm edit btn-flat' id="slideredit" data-id='<?=$row['id'] ?>"'><i class='fa fa-edit'></i> Edit</button>
            <button class='btn btn-danger btn-sm delete btn-flat' id="sliderdelete" data-id='<?=$row['id'] ?>"'><i class='fa fa-trash'></i> Delete</button>
          </td>
        </tr>
		<?php } 
	}
}

//Theme options

if($_POST["action"] == 'themeoptions'){ 

	$opttitle=$_POST["opttitle"];
	$optemail=$_POST["optemail"];
	$optphone=$_POST["optphone"];
	$optcopyaddress=$_POST["optcopyaddress"];
	$optcopyright=$_POST["optcopyright"];
	if($_POST["imgupdte"] == "yes"){
	$fileName = rand().'_'.$_FILES['optlogo']['name'];
	$tmpName = $_FILES['optlogo']['tmp_name'];
	$result = move_uploaded_file($tmpName, '../../assets/images/general/'.$fileName);
   }else{
   	$fileName=$_POST["optlogo"];
   }

	$sql = "UPDATE `options` SET `logo`='$fileName', `sitetitle`='$opttitle', `email`='$optemail', `phone`='$optphone', `address`='$optcopyaddress', `copyright`='$optcopyright' WHERE id=1 AND status=1";
		mysqli_query($connection,$sql);
		if(mysqli_affected_rows($connection)>0){
			echo "Successfully";
		}else{
			echo "Failure";
		}

}
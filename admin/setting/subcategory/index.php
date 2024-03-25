<?php 
include '../../includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include '../../includes/navbar.php'; ?>
  <?php include '../../includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sub Category
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Setting</li>
        <li class="active">Sub Category</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <a class="btn btn-primary btn-sm btn-flat" id="subcategorymodal" onclick="subcategmodal()"><i class="fa fa-plus"></i> Add Subcategory</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Subcategory Name</th>
                  <th>Parent Category</th>
                  <th>Disable Menu</th>
                  <th>Actions</th>
                </thead>
                <tbody id="subcategorydata">
                  <?php
                      $query1 = "SELECT subcategory.id, subcategory.subcat_name, subcategory.inmenu as menu, category.name FROM subcategory INNER JOIN category WHERE subcategory.subcat_status=1 AND category.cat_status=1 AND subcategory.category_id=category.id";
                        $res_pro = mysqli_query($connection,$query1);
                        if(mysqli_num_rows($res_pro) > 0){
                           while ($row = mysqli_fetch_array($res_pro)) {?>
                          <tr>
                            <td><?=$row['subcat_name'] ?></td>
                            <td><?=$row['name'] ?></td>
                            <td><?=$row['menu'] ?></td>
                            <td>
                              <button class='btn btn-success btn-sm edit btn-flat' id="subcategoryedit" onclick="editsubcateg(<?=$row['id'] ?>)" data-id='<?=$row['id'] ?>"'><i class='fa fa-edit'></i> Edit</button>
                              <button class='btn btn-danger btn-sm delete btn-flat' id="subcategorydelete" onclick="deletsubcateg(<?=$row['id'] ?>)" data-id='<?=$row['id'] ?>"'><i class='fa fa-trash'></i> Delete</button>
                            </td>
                          </tr>
                      <?php } } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
     
  </div>
  	<?php include '../../includes/footer.php'; ?>
    <?php include '../../includes/category_modal.php'; ?>

</div>
<!-- ./wrapper -->

<?php include '../../includes/scripts.php'; ?>
<script src="<?=$root_path;?>/setting/includes/functions.js?ver=1.1.6"></script>
</body>
</html>

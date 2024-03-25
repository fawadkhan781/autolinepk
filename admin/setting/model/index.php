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
        Model
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Setting</li>
        <li class="active">Model</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <a class="btn btn-primary btn-sm btn-flat" id="modelmodal" onclick="calmodel()"><i class="fa fa-plus"></i> Add Model</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Model Name</th>
                  <th>Actions</th>
                </thead>
                <tbody id="modeldata">
                  <?php
                      $query1 = "SELECT * FROM model WHERE status=1";
                        $res_pro = mysqli_query($connection,$query1);
                        if(mysqli_num_rows($res_pro) > 0){
                           while ($row = mysqli_fetch_array($res_pro)) {?>
                          <tr>
                            <td><?=$row['name'] ?></td>
                            <td>
                              <button class='btn btn-success btn-sm edit btn-flat' id="modeledit" onclick="editmodel(<?=$row['id'] ?>)" data-id='<?=$row['id'] ?>"'><i class='fa fa-edit'></i> Edit</button>
                              <button class='btn btn-danger btn-sm delete btn-flat' id="modeldelete" onclick="deletemodel(<?=$row['id'] ?>)" data-id='<?=$row['id'] ?>"'><i class='fa fa-trash'></i> Delete</button>
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

</div>
<!-- ./wrapper -->

<?php include '../../includes/scripts.php'; ?>
<script src="<?=$root_path;?>/setting/includes/functions.js?ver=1.1"></script>
</body>
</html>

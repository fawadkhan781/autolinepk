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
          General Setting
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Setting</li>
        <li class="active">General Setting</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
            </div>
            <div class="box-body">
              <?php $query1 = "SELECT * FROM options"; 
                $res_oppt = mysqli_query($connection,$query1);
                //echo $res_oppt;
                if(mysqli_num_rows($res_oppt) > 0){
                  while ($row = mysqli_fetch_array($res_oppt)) {?>
                   <form class="form-horizontal">     
                     <div class="form-group col-lg-6">
                        <label for="title" class="control-label">Title-Tage</label>
                          <input type="text" class="form-control" value="<?=($row['sitetitle'] ? $row['sitetitle'] : '' );?>" id="opttitle">
                      </div>           
                      <div class="form-group col-lg-6">
                        <label for="email" class="control-label">Email</label>
                          <input type="text" class="form-control" value="<?=($row['email'] ? $row['email'] : '' );?>" id="optemail">
                      </div>
                      <div class="form-group col-lg-6">
                        <label for="imgname" class="control-label">Phone</label>
                          <input type="text" class="form-control" value="<?=($row['phone'] ? $row['phone'] : '' );?>" id="optphone">
                      </div>
                      <div class="form-group col-lg-6">
                        <label for="imgname" class="control-label">Address</label>
                          <textarea name="" id="optcopyaddress" class="form-control" rows="3" required="required"><?=($row['address'] ? $row['address'] : '' );?></textarea>
                      </div>
                      <div class="form-group col-lg-6">
                        <label for="imgname" class="control-label">CopyRight</label>
                          <textarea name="" id="optcopyright" class="form-control" rows="3" required="required"><?=($row['copyright'] ? $row['copyright'] : '' );?></textarea>
                      </div>
                        <div class="form-group col-lg-6">
                      <label for="imgname" class="control-label">Logo</label>
                      <input type="file" id="optlogo" onchange="previewfiles(this);" class="clrfield" name="sliderimg">
                      <img id="newimgprevw" data-img="<?=($row['logo'] ? $row['logo'] : '' );?>" width="250" class="img-responsive" src="../../assets/images/general/<?=($row['logo'] ? $row['logo'] : '' );?>">
                      </div>
                    </form>
                   <div class="footer col-lg-6"><br><br>
                    <a class="btn btn-primary btn-flat update" id="savethemeoption" onclick="SaveThemeOption()"><i class="fa fa-save"></i> Save</a>
                  </div>
                <?php } } ?>
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
<script src="<?=$root_path;?>/setting/includes/functions.js?ver=1.6"></script>
</body>
</html>

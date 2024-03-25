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
        Users
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
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
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Email</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Date Added</th>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT * FROM users WHERE status=1 AND role=0";
                        $res_cat = mysqli_query($connection,$sql);
                        if(mysqli_num_rows($res_cat) > 0){
                            while ($row = mysqli_fetch_array($res_cat)) {
                        
                        $status = ($row['status']) ? '<span class="label label-success">active</span>' : '<span class="label label-danger">not verified</span>';
                        $active = (!$row['status']) ? '<span class="pull-right"><a href="#activate" class="status" data-toggle="modal" data-id="'.$row['id'].'"><i class="fa fa-check-square-o"></i></a></span>' : '';
                        echo "
                          <tr>
                           
                            <td>".$row['email']."</td>
                            <td>".$row['firstname'].' '.$row['lastname']."</td>
                            <td>
                              ".$status."
                              ".$active."
                            </td>
                            <td>".date('M d, Y', strtotime($row['created_on']))."</td>
                            
                          </tr>
                        ";
                      }
                    }?>
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
<script>
$(function(){

  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.photo', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.status', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'users_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.userid').val(response.id);
      $('#edit_email').val(response.email);
      $('#edit_password').val(response.password);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#edit_address').val(response.address);
      $('#edit_contact').val(response.contact_info);
      $('.fullname').html(response.firstname+' '+response.lastname);
    }
  });
}
</script>
</body>
</html>

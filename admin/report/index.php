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
          Sales History
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Report</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header with-border">
                <div class="pull-left">
                  <a class="btn btn-warning btn-sm" onclick="location.reload();" style="margin-right:10px ;"><i class="fa fa-refresh"></i></a>
                </div>
                <div class="allbyuser pull-left">
                  <select name="byuser" id="byuser" class="form-control" required="required">
                    <option value="all">Select By User</option>
                    <?php
                    $sql = "SELECT * FROM users WHERE status=1 AND role=0";
                    $res_cat = mysqli_query($connection, $sql);
                    if (mysqli_num_rows($res_cat) > 0) {
                      while ($row = mysqli_fetch_array($res_cat)) { ?>
                        <option data-nam="<?= $row['firstname'] . ' ' . $row['lastname']; ?>" value="<?= $row['id']; ?>"><?= $row['firstname']; ?> <?= $row['lastname']; ?></option>
                    <?php }
                    } ?>
                  </select>
                </div>
                <div class="allbytime pull-left" style="margin-left: 20px;">
                  <select name="bytime" id="bytime" class="form-control" required="required">
                    <option value="all">Generate Reportby </option>
                    <option value="today">Today</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                    <option value="yearly">Yearly</option>
                  </select>
                </div>
                <div class="pull-right">
                  <form class="form-inline">
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right col-sm-8" id="reservation" name="date_range">
                    </div>
                    <a href="javascript:;" class="btn btn-success btn-sm btn-flat" onclick="printDiv('report_print');" name="print"><span class="glyphicon glyphicon-print"></span> Print</a>
                  </form>
                </div>
              </div>
              <div class="box-body" id="report_print">
                <div class="container" id="printTitle" style="display: none;">
                  <div class="row mt-5">
                    <div class="col-md-12 text-center">
                      <?php
                      $query4 = "SELECT * FROM options";
                      $res_oppt4 = mysqli_query($connection, $query4);
                      if (mysqli_num_rows($res_oppt4) > 0) {
                        while ($row4 = mysqli_fetch_array($res_oppt4)) { ?>

                          <img src="<?= $logopahth . $row4['logo']; ?>" class="img-circle" alt="User Image">
                          <br>
                          <p><?= $row4['sitetitle']; ?></p>
                          <p><?= $row4['phone']; ?></p>
                          <p><?= $row4['address']; ?></p>
                      <?php }
                      } ?>
                    </div>
                  </div>
                </div>

                <hr class="my-4">

                <table id="reportdata" class="table table-bordered">
                  <thead>
                    <th class="hidden"></th>
                    <th>Date</th>
                    <th>Buyer Name/Email</th>
                    <th>Full Details</th>
                    <th>Prodcut Title</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Amount</th>
                    <th id="hDelReport">Action</th>
                  </thead>
                  <tbody id="responseDataReport">
                    <?php
                    $query1 = "SELECT a.id,a.user_id,a.user_name,a.email,a.phone,a.ship_address,a.total_amount,a.order_status,a.created_at,b.order_id,b.product_id,b.product_title,b.qty,b.price,b.total_price  FROM orders as a INNER JOIN orders_item as b ON a.id=b.order_id WHERE a.order_status=3";
                    $res_pro = mysqli_query($connection, $query1);
                    if (mysqli_num_rows($res_pro) > 0) {
                      $total = 0;
                      while ($row = mysqli_fetch_array($res_pro)) {
                        $total += $row['total_price'];
                    ?>
                        <tr>
                          <td><?= $row['created_at']; ?></td>
                          <td><?= $row['user_name']; ?> / <?= $row['email']; ?></td>
                          <td><?= $row['ship_address']; ?></td>
                          <td><?= $row['product_title']; ?></td>
                          <td><?= $row['qty']; ?></td>
                          <td>$<?= $row['price']; ?></td>
                          <td>$<?= number_format($row['total_price']); ?></td>

                          <td class="delReport">

                            <button class='btn btn-danger btn-sm delete btn-flat' id="reportdelete" onclick="delReport(<?= $row['id'] ?>)" data-id='<?= $row['id'] ?>"'><i class='fa fa-trash'></i> Delete</button>
                          </td>
                        </tr>


                      <?php } ?>
                      <tr>
                        <th colspan="6">Grand Total:</th>
                        <th>$<?= number_format($total); ?></th>
                      </tr>
                    <?php } ?>
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
  <!-- Date Picker -->
  <script>
    $(function() {
      //Date picker
      $("input[name='daterangepicker_start']").datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
      })
      $("input[name='daterangepicker_end']").datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
      })

      //Timepicker
      $('.timepicker').timepicker({
        showInputs: true,
        dateFormat: 'yyyyy-mm-dd'
      })

      //Date range picker
      $('#reservation').daterangepicker();
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        format: 'YYYY-DD-MM h:mm A'
      })
      //Date range as a button
      $('#daterange-btn').daterangepicker({
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function(start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
      )

    });
  </script>
  <script>
    //document.getElementsByClassName('applyBtn').addEventListener('click',getDateClinder);
    $(document).on('click', '.applyBtn', function(e) {
      e.preventDefault();
      var dtstrt = $("input[name='daterangepicker_start']").val();
      var dtend = $("input[name='daterangepicker_end']").val();

      var data = new FormData();
      data.append('action', 'searchbydt');
      data.append('dtstrt', dtstrt);
      data.append('dtend', dtend);

      call_ajax('reportdata', 'ajax_report.php', data);
    });


    //});

    $(document).on('change', '#byuser', function() {
      var gtusr = $(this).val();
      var usrnme = $('option:selected', this).attr('data-nam');
      if (gtusr == 'all') {
        location.reload();
        return;
      }
      var data = new FormData();
      data.append('action', 'searchbyuser');
      data.append('gtusr', gtusr);
      data.append('usrnme', usrnme);

      call_ajax('reportdata', 'ajax_report.php', data);

    });

    $(document).on('change', '#bytime', function() {
      var gtime = $(this).val();
      if (gtime == 'all') {
        location.reload();
        return;
      }
      var data = new FormData();
      data.append('action', 'searchbytime');
      data.append('gtime', gtime);

      call_ajax('reportdata', 'ajax_report.php', data);

    });
  </script>
  <script language="javascript" type="text/javascript">
    function printDiv(print_target) {
      //Get the HTML of div
      document.getElementById('printTitle').style.display = 'block';
       document.getElementById('hDelReport').style.display = 'none'; 
      //document.getElementById('delReport').style.display = 'none'; 
      var delBtn = document.getElementsByClassName('delReport');
      for (var i = 0; i < delBtn.length; i++) {
        delBtn[i].style.display = 'none';
      }

      var divElements = document.getElementById(print_target).innerHTML;
      newpage_print = window.open('', '_blank');
      data = "<link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>"

      var script = newpage_print.document.createElement('script');
      script.setAttribute('type', 'text/javascript');
      script.innerHTML = "function none_it() { try { document.getElementById('sample_1_filter').style.display = 'none'; document.getElementById('sample_1_length').style.display = 'none';  document.getElementById('sample_1_paginate').style.display = 'none'; document.getElementById('sample_1_info').style.display = 'none'; } catch(ex)  {  return false; } } setInterval(function(){ none_it(); window.print(); window.close(); }, 1000);";
      newpage_print.document.body.innerHTML = data + divElements;
      newpage_print.document.body.appendChild(script);
    }

    //Delete report
    function delReport(id) {
      //var id = $(this).attr('data-id');
      data = new FormData();
      data.append('action', 'reportdelete');
      data.append('id', id);
      alertify.confirm("Do you really want to Delete..?",
        function() {
          var a = function() {
            repReload();
          }
          var my_methods = [a];
          call_ajax_notify('ajax_report.php', data, 'Item Deleted Successfully', '', my_methods);
        },
        function() {
          alertify.error('Cancel');
        });
    }

    // Reload model
    function repReload() {
      data = new FormData();
      data.append('action', 'reportreload');

      call_ajax('responseDataReport', 'ajax_report.php', data);
    }
  </script>
</body>

</html>
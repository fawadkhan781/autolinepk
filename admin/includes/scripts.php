<!-- jQuery 3 -->
<script src="<?=$root_path; ?>/assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=$root_path; ?>/assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=$root_path; ?>/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?=$root_path; ?>/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- Moment JS -->
<script src="<?=$root_path; ?>/assets/bower_components/moment/moment.js"></script>
<!-- DataTables -->
<script src="<?=$root_path; ?>/assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=$root_path; ?>/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- ChartJS -->
<script src="<?=$root_path; ?>/assets/bower_components/chart.js/Chart.js"></script>
<!-- daterangepicker -->
<script src="<?=$root_path; ?>/assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?=$root_path; ?>/assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?=$root_path; ?>/assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?=$root_path; ?>/assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!--alertify-->
<script src="<?=$root_path; ?>/assets/plugins/alertifyjs/alertify.js"></script>
<!-- Slimscroll -->
<script src="<?=$root_path; ?>/assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=$root_path; ?>/assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=$root_path; ?>/assets/dist/js/adminlte.min.js"></script>
<!-- CK Editor -->
<script src="<?=$root_path; ?>/assets/bower_components/ckeditor/ckeditor.js"></script>
<!-- custom js functions -->
<script src="<?=$root_path; ?>/includes/ajax.js?ver=1.10"></script>
<script src="<?=$root_path; ?>/includes/functions.js?ver=1.4"></script>
<!-- Active Script -->
<script>
$(function(){
	/** add active class and stay opened when selected */
	var url = window.location;
  
	// for sidebar menu entirely but not cover treeview
	$('ul.sidebar-menu a').filter(function() {
	    return this.href == url;
	}).parent().addClass('active');

	// for treeview
	$('ul.treeview-menu a').filter(function() {
	    return this.href == url;
	}).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');

});
</script>
<!-- Data Table Initialize -->
<script>
  $(function () {
    $('#example1').DataTable({
      responsive: true
    })
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script>
  $(function(){
    //Initialize Select2 Elements
    $('.select2').select2()

    //CK Editor
    CKEDITOR.replace('editor1')
    CKEDITOR.replace('editor2')
  });
</script>



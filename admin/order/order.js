//change ordre status
function orderStatus(id){

    var orderstatus = document.getElementById('orders_status').value;
    var data = new FormData();
    data.append('action', 'orderStatus');
    data.append('id', id);
    data.append('orderstatus', orderstatus);

     call_ajax('', 'order_ajax.php',data);
}

function deleteOrder(id){
   
    data = new FormData();
    data.append('action','deleteOrder');
    data.append('id',id);
    $(this).closest('tr').addClass("removed");
    alertify.confirm("Do you really want to Delete..?",
    function () {
      var a = function(){ $('.removed').css("background-color", "red"); }
      var b = function(){ $('.removed').fadeOut('slow', function () { this.remove();}); }
      var my_methods = [a, b];
     
      call_ajax_notify('order_ajax.php', data, 'Order Deleted Successfully', '', my_methods);
    },
    function () { 
      alertify.error('Cancel');
    });
}
//call product modal
function productModel(){
   data = new FormData();
    data.append('action', 'productmodal');
    call_ajax_modal('products_ajax.php',data, 'Add Prodcuts');
}    

//load subcategory by ajax
function productCategory(id){
   //var id = document.getElementById('productcategory').value;
   //var id = $(this).val();
   var data = new FormData();
   data.append('action', 'prodsubcategory');
   data.append('id', id);

    call_ajax('prodsubcategory', 'products_ajax.php',data);
}

//add product item
function addProduct(){

    // product basic detail
    var name = document.getElementById('name').value;
    var qty = document.getElementById('qty').value;
    var price = document.getElementById('price').value;
    var pcateg = document.getElementById('productcategory');
    var pcateg = pcateg.options[pcateg.selectedIndex].value;
    var psubcateg = document.getElementById('prodsubcategory');
    var psubcateg = psubcateg.options[psubcateg.selectedIndex].value;
    var pmodel = document.getElementById('productmodel');
    var pmodel = pmodel.options[pmodel.selectedIndex].value;
    var pic = document.getElementById('productimg');
    var description = document.getElementById('description').value;

    // check validation
     if(name == ''){
        alertify.error('Product title is required').dismissOthers();
        document.getElementById('name').focus();
        return;
     }
      if(qty == ''){
        alertify.error('Quantity is required').dismissOthers();
        document.getElementById('qty').focus();
        return;
     }
     if(price == ''){
        alertify.error('price is required').dismissOthers();
        document.getElementById('price').focus();
        return;
     }
     
    var data = new FormData();
    data.append('action', 'addproduct');
    data.append('name', name);
    data.append('qty', qty);
    data.append('price', price);
    data.append('pcateg', pcateg);
    data.append('psubcateg', psubcateg);
    data.append('pmodel', pmodel);
    data.append('pimg',pic.files[0]);
    data.append('description', description);
    var a = function () {
        clearfield();
    }
    var arr = [a];

    call_ajax_with_functions('', 'products_ajax.php',data, arr);

}

//call product modal
function editProdImg(id){
    data = new FormData();
    data.append('action', 'editprodimage');
    data.append('id', id);
    call_ajax_modal('products_ajax.php',data, 'Edit Prodcuts image');
}

//call View product modal
function viewproduct(id){
   // var id = $(this).attr('data-id');
    data = new FormData();
    data.append('action', 'viewproduct');
    data.append('id', id);
    call_ajax_lg_modal('products_ajax.php',data, 'View Prodcuts Details');
}

//preview image
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#newimgprevw').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  } else {
    alert('select a file to see preview');
    $('#newimgprevw').attr('src', '');
  }
}
function previewfiles(me) {
  readURL(me);
}

// update product image
function updprodimg(id){
    // client basic detail
    //var id = $(me).attr('data-id');
    var pic = document.getElementById('updatenewprodimg');

    // check validation
     if(pic == ''){
        alertify.error('Product image is required').dismissOthers();
        document.getElementById('updatenewprodimg').focus();
        return;
     }
     
    var data = new FormData();
    data.append('action', 'updateprodimage');
    data.append('id', id);
    data.append('pimg',pic.files[0]);
    var a = function () {
        location.reload();
    }
    var arr = [a];

    call_ajax_with_functions('', 'products_ajax.php',data, arr);
}

//Update product
function updproduct(id){

    // product
    //var id = $(this).attr('data-id');
    var name = document.getElementById('name').value;
    var qty = document.getElementById('qty').value;
    var price = document.getElementById('price').value;
    var pcateg = document.getElementById('productcategory');
    var pcateg = pcateg.options[pcateg.selectedIndex].value;
    var psubcateg = document.getElementById('prodsubcategory');
    var psubcateg = psubcateg.options[psubcateg.selectedIndex].value;
    var pmodel = document.getElementById('productmodel');
    var pmodel = pmodel.options[pmodel.selectedIndex].value;
    var description = document.getElementById('description').value;

    // check validation
     if(name == ''){
        alertify.error('Product title is required').dismissOthers();
        document.getElementById('name').focus();
        return;
     }
      if(qty == ''){
        alertify.error('Quantity is required').dismissOthers();
        document.getElementById('qty').focus();
        return;
     }
     if(price == ''){
        alertify.error('price is required').dismissOthers();
        document.getElementById('price').focus();
        return;
     }
    var data = new FormData();
    data.append('action', 'updateproduct');
    data.append('id', id);
    data.append('name', name);
    data.append('qty', qty);
    data.append('price', price);
    data.append('pcateg', pcateg);
    data.append('psubcateg', psubcateg);
    data.append('pmodel', pmodel);
    data.append('description', description);

    call_ajax('', 'products_ajax.php',data);

}

//Delete Category
function deleteProduct(id){

   data = new FormData();
   data.append('action','deleteproduct');
   data.append('id',id);
   $(this).closest('tr').addClass("removed");
   alertify.confirm("Do you really want to Delete..?",
   function () {
     var a = function(){ $('.removed').css("background-color", "red"); }
     var b = function(){ $('.removed').fadeOut('slow', function () { this.remove();}); }
     let reloadFun =  setTimeout(() => {
      window.reload();
     }, 1000);
    
     var my_methods = [a, b, reloadFun];
    
     call_ajax_notify('products_ajax.php', data, 'Item Deleted Successfully', '', my_methods);
   },
   function () { 
     alertify.error('Cancel');
   });
}


//Reload Prouduct
function reloadproducts(){
   data = new FormData();
   data.append('action', 'reloadproducts');

   call_ajax('productdata', 'products_ajax.php',data);
}

//clear fields
 function clearfield(){
   var inputs = $('.clrfield');
   var inputslect = $('.clrslect');
   var imgg = $('#newimgprevw');
   if(imgg){ $("#newimgprevw").css({display: "none"}); }
   for(i=0; i<inputs.length; i++)
   {
      inputs.val('');
      //allselect[i].selectedIndex = -1;
   }
}

  
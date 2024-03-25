//call Add Category modal
$(document).on('click','#categorymodal',function(){
   data = new FormData();
    data.append('action', 'categorymodal');
    call_ajax_modal('../includes/ajaxreq.php',data, 'Add Category');
}); 

//add category
$(document).on('click','#categoryadd',function(){

    // category basic detail
    var name = $('#catname').val();
    var order = $('#order').val();
    var description = $('#description').val();

    // check
     if(name == ''){
        alertify.error('Category Name is required ').dismissOthers();
        document.getElementById('name').focus();
        return;
     }

    var data = new FormData();
    data.append('action', 'addcategory');
    data.append('name', name);
    data.append('order', order);
    data.append('description', description);

     call_ajax('categorydata', '../includes/ajaxreq.php',data);

});

// Reload Category
function categoryreload(){
   var id = $(this).attr('data-id');
   var id1 =  $(this).data('id')
   data = new FormData();
   data.append('action', 'categoryreload');

   call_ajax('categorydata', '../includes/ajaxreq.php',data);
}

// Edit category
$(document).on('click','#categoryedit',function(){
   var id = $(this).attr('data-id');
   var id1 =  $(this).data('id')
   data = new FormData();
    data.append('action', 'categoryedit');
    data.append('id', id);
  
    call_ajax_modal('../includes/ajaxreq.php',data, 'Edit Category');
}); 

// Update category
$(document).on('click','#categoryupdate',function(){
   var id = $(this).attr('data-id');
   var name = $('#catname').val();
   var order = $('#order').val();
   var description = $('#description').val();

    data = new FormData();
    data.append('action', 'categoryupdate');
    data.append('id', id);
    data.append('name', name);
    data.append('order', order);
    data.append('description', description);
  
    call_ajax('categorydata', '../includes/ajaxreq.php',data);
});

//Delete Category
$(document).on('click','#categorydelete',function(){
   var id = $(this).attr('data-id');
   data = new FormData();
   data.append('action','categorydelete');
   data.append('id',id);
   alertify.confirm("Do you really want to Delete..?",
   function () {
     var a = function(){ categoryreload(); }
     var my_methods = [a];
     call_ajax_notify('../includes/ajaxreq.php', data, 'Item Deleted Successfully', '', my_methods);
   },
   function () {
     alertify.error('Cancel');
   });
});

/*******************SubCategory******************/

//call Add subCategory modal
$(document).on('click','#subcategorymodal',function(){
   data = new FormData();
    data.append('action', 'subcategorymodal');
    call_ajax_modal('../includes/ajaxreq.php',data, 'Add subCategory');
}); 

//add subcategory
$(document).on('click','#subcategoryadd',function(){

    // subcategory basic detail
    var name = $('#catname').val();
    var pcateg = document.getElementById('parentcategory');
    var pcateg = pcateg.options[pcateg.selectedIndex].value;
    var order = $('#order').val();
    var description = $('#description').val();

    // check
     if(name == ''){
        alertify.error('subCategory Name is required ').dismissOthers();
        document.getElementById('catname').focus();
        return;
     }
     if(pcateg == ''){
        alertify.error('Parent Category is required ').dismissOthers();
        document.getElementById('parentcategory').focus();
        return;
     }

    var data = new FormData();
    data.append('action', 'addsubcategory');
    data.append('name', name);
    data.append('pcategory', pcateg);
    data.append('order', order);
    data.append('description', description);

     call_ajax('subcategorydata', '../includes/ajaxreq.php',data);

});

// Reload subCategory
function subcategoryreload(){
   var id = $(this).attr('data-id');
   var id1 =  $(this).data('id')
   data = new FormData();
   data.append('action', 'subcategoryreload');

   call_ajax('subcategorydata', '../includes/ajaxreq.php',data);
}

// Edit subcategory
$(document).on('click','#subcategoryedit',function(){
   var id = $(this).attr('data-id');
   var id1 =  $(this).data('id')
   data = new FormData();
    data.append('action', 'subcategoryedit');
    data.append('id', id);
  
    call_ajax_modal('../includes/ajaxreq.php',data, 'Edit subCategory');
}); 

// Update subcategory
$(document).on('click','#subcategoryupdate',function(){
   var id = $(this).attr('data-id');
   var name = $('#catname').val();
   var pcateg = document.getElementById('parentcategory');
   var pcateg = pcateg.options[pcateg.selectedIndex].value;
   var order = $('#order').val();
   var description = $('#description').val();

    data = new FormData();
    data.append('action', 'subcategoryupdate');
    data.append('id', id);
    data.append('name', name);
    data.append('pcateg', pcateg);
    data.append('order', order);
    data.append('description', description);
  
    call_ajax('subcategorydata', '../includes/ajaxreq.php',data);
});

//Delete subCategory
$(document).on('click','#subcategorydelete',function(){
   var id = $(this).attr('data-id');
   data = new FormData();
   data.append('action','subcategorydelete');
   data.append('id',id);
   alertify.confirm("Do you really want to Delete..?",
   function () {
     var a = function(){ categoryreload(); }
     var my_methods = [a];
     call_ajax_notify('../includes/ajaxreq.php', data, 'Item Deleted Successfully', '', my_methods);
   },
   function () {
     alertify.error('Cancel');
   });
});
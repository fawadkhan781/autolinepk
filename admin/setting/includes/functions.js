//call Add Category modal
function ModalCategory(){
   data = new FormData();
    data.append('action', 'categorymodal');
    call_ajax_modal('../includes/ajaxreq.php',data, 'Add Category');
}

//add category
function addcategory(){

    // category basic detail
    var name = document.getElementById('catname').value;
    var order = document.getElementById('order').value;
    var inmenu ='';
    if ($('input#inmenu').is(':checked')) {
         inmenu = document.getElementById('inmenu').value;
    }
    var infilter ='';
    if ($('input#infilter').is(':checked')) {
         infilter = document.getElementById('infilter').value;
    }
    var description = document.getElementById('description').value;

    // check
     if(name == ''){
        alertify.error('Category Name is required ').dismissOthers();
        document.getElementById('name').focus();
        return;
     }

    var data = new FormData();
    data.append('action', 'addcategory');
    data.append('name', name);
    data.append('inmenu', inmenu);
    data.append('infilter', infilter);
    data.append('order', order);
    data.append('description', description);

     call_ajax('categorydata', '../includes/ajaxreq.php',data);

}

// Reload Category
function categoryreload(){
   data = new FormData();
   data.append('action', 'categoryreload');

   call_ajax('categorydata', '../includes/ajaxreq.php',data);
}

// Edit category
function editcategory(id){
   //var id = $(this).attr('data-id');
   //var id1 =  $(this).data('id')
   data = new FormData();
    data.append('action', 'categoryedit');
    data.append('id', id);
  
    call_ajax_modal('../includes/ajaxreq.php',data, 'Edit Category');
}

// Update category
function updatecategory(id){
   //var id = $(this).attr('data-id');
   var name = document.getElementById('catname').value;
   var inmenu ='';
   if ($('input#inmenu').is(':checked')) {
         inmenu = document.getElementById('inmenu').value;
   }
   var infilter ='';
   if ($('input#infilter').is(':checked')) {
         infilter = document.getElementById('infilter').value;
   }
   var order = document.getElementById('order').value;
   var description = document.getElementById('description').value;

    data = new FormData();
    data.append('action', 'categoryupdate');
    data.append('id', id);
    data.append('name', name);
    data.append('inmenu', inmenu);
    data.append('infilter', infilter);
    data.append('order', order);
    data.append('description', description);
  
    call_ajax('categorydata', '../includes/ajaxreq.php',data);
}

//Delete Category
function deletcategory(id){
   //var id = $(this).attr('data-id');
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
}

/*******************SubCategory******************/

//call Add subCategory modal
function subcategmodal(){
   data = new FormData();
    data.append('action', 'subcategorymodal');
    call_ajax_modal('../includes/ajaxreq.php',data, 'Add subCategory');
}

//add subcategory
function addsubcateg(){

    // subcategory basic detail
    var name = document.getElementById('catname').value;
    var pcateg = document.getElementById('parentcategory');
    var pcateg = pcateg.options[pcateg.selectedIndex].value;
    var order = document.getElementById('order').value;
    var description = document.getElementById('description').value;
    var inmenu = document.getElementById('inmenu').value;

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
    data.append('inmenu', inmenu);
    data.append('description', description);

    var a = function() { subcategoryreload();  }
    var arr = [a];
    call_ajax_with_functions('','../includes/ajaxreq.php', data, arr);

}

// Reload subCategory
function subcategoryreload(){
   data = new FormData();
   data.append('action', 'subcategoryreload');

   call_ajax('subcategorydata', '../includes/ajaxreq.php',data);
}

// Edit subcategory
function editsubcateg(id){
  // var id = $(this).attr('data-id');
   //var id1 =  $(this).data('id')
   data = new FormData();
   data.append('action', 'subcategoryedit');
   data.append('id', id);
  
   call_ajax_modal('../includes/ajaxreq.php',data, 'Edit subCategory');
}

// Update subcategory
function ubdsubcategory(id){
   //var id = $(this).attr('data-id');
   var name = document.getElementById('catname').value;
   var pcateg = document.getElementById('parentcategory');
   var pcateg = pcateg.options[pcateg.selectedIndex].value;
   var order = document.getElementById('order').value;
   var description = $('#description').val();
   var inmenu ='';
    if ($('input#inmenu').is(':checked')) {
         inmenu = document.getElementById('inmenu').val();
    }

    data = new FormData();
    data.append('action', 'subcategoryupdate');
    data.append('id', id);
    data.append('name', name);
    data.append('pcateg', pcateg);
    data.append('inmenu', inmenu);
    data.append('order', order);
    data.append('description', description);
    var a = function() { subcategoryreload();  }
    var arr = [a];
    call_ajax_with_functions('','../includes/ajaxreq.php', data, arr);
}

//Delete subCategory
function deletsubcateg(id){
   //var id = $(this).attr('data-id');
   data = new FormData();
   data.append('action','subcategorydelete');
   data.append('id',id);
   alertify.confirm("Do you really want to Delete..?",
   function () {
     var a = function(){ subcategoryreload(); }
     var my_methods = [a];
     call_ajax_notify('../includes/ajaxreq.php', data, 'Item Deleted Successfully', '', my_methods);
   },
   function () {
     alertify.error('Cancel');
   });
}

/******************model******************/

//call Add Model modal
function calmodel(){
   data = new FormData();
    data.append('action', 'modelmodal');
    call_ajax_modal('../includes/ajaxreq.php',data, 'Add Model');
}

//add model
function addmodel(){

    // model basic detail
    var name = document.getElementById('modelname').value;
    // check
     if(name == ''){
        alertify.error('Model Name is required ').dismissOthers();
        document.getElementById('name').focus();
        return;
     }

    var data = new FormData();
    data.append('action', 'addmodel');
    data.append('name', name);
    var a = function() { modelreload();  }
    var arr = [a];
    call_ajax_with_functions('','../includes/ajaxreq.php', data, arr);
}

// Edit model
function editmodel(id){
   //var id = $(this).attr('data-id');
   data = new FormData();
    data.append('action', 'modeledit');
    data.append('id', id);
  
    call_ajax_modal('../includes/ajaxreq.php',data, 'Edit model');
}

// Update model
function updatemodel(id){
   //var id = $(this).attr('data-id');
   var name = document.getElementById('modelname').value;

    data = new FormData();
    data.append('action', 'modelupdate');
    data.append('id', id);
    data.append('name', name);
    var a = function() { modelreload();  }
    var arr = [a];
    call_ajax_with_functions('','../includes/ajaxreq.php', data, arr);
}

//Delete model
function deletemodel(id){
   //var id = $(this).attr('data-id');
   data = new FormData();
   data.append('action','modeldelete');
   data.append('id',id);
   alertify.confirm("Do you really want to Delete..?",
   function () {
     var a = function(){ modelreload(); }
     var my_methods = [a];
     call_ajax_notify('../includes/ajaxreq.php', data, 'Item Deleted Successfully', '', my_methods);
   },
   function () {
     alertify.error('Cancel');
   });
}

// Reload model
function modelreload(){
   data = new FormData();
   data.append('action', 'modelreload');

   call_ajax('modeldata', '../includes/ajaxreq.php',data);
}


/******************OrderStatus******************/

//call Add orderstatus modal
function orderstatus(){
   data = new FormData();
    data.append('action', 'orderstatusmodal');
    call_ajax_modal('../includes/ajaxreq.php',data, 'Add orderstatus');
}

//add orderstatus
function addorderstatus(){

    // orderstatus basic detail
    var name = document.getElementById('orderstatusname').value;
    // check
     if(name == ''){
        alertify.error('orderstatus Name is required ').dismissOthers();
        document.getElementById('name').focus();
        return;
     }

    var data = new FormData();
    data.append('action', 'addorderstatus');
    data.append('name', name);
    var a = function() { orderstatusreload();  }
    var arr = [a];
    call_ajax_with_functions('','../includes/ajaxreq.php', data, arr);
}

// Edit orderstatus
function editorderstatus(id){
   //var id = $(this).attr('data-id');
   data = new FormData();
    data.append('action', 'orderstatusedit');
    data.append('id', id);
  
    call_ajax_modal('../includes/ajaxreq.php',data, 'Edit orderstatus');
}

// Update orderstatus
function updorderstatus(id){
  // var id = $(this).attr('data-id');
   var name = document.getElementById('orderstatusname').value;

    data = new FormData();
    data.append('action', 'orderstatusupdate');
    data.append('id', id);
    data.append('name', name);
    var a = function() { orderstatusreload();  }
    var arr = [a];
    call_ajax_with_functions('','../includes/ajaxreq.php', data, arr);
}

//Delete orderstatus
function delorderstatus(id){
   //var id = $(this).attr('data-id');
   data = new FormData();
   data.append('action','orderstatusdelete');
   data.append('id',id);
   alertify.confirm("Do you really want to Delete..?",
   function () {
     var a = function(){ orderstatusreload(); }
     var my_methods = [a];
     call_ajax_notify('../includes/ajaxreq.php', data, 'Item Deleted Successfully', '', my_methods);
   },
   function () {
     alertify.error('Cancel');
   });
}

// Reload orderstatus
function orderstatusreload(){
   data = new FormData();
   data.append('action', 'orderstatusreload');

   call_ajax('orderstatusdata', '../includes/ajaxreq.php',data);
}

/******************Slider******************/

//call Add slider modal
function SliderModal(){
   data = new FormData();
    data.append('action', 'slidermodal');
    call_ajax_lg_modal('../includes/ajaxreq.php',data, 'Add slider');
}

//add slider
function addslider(){

    // slider basic detail
    var name = document.getElementById('slidertitle').value;
    var slidersubtitle = document.getElementById('slidersubtitle').value;
    var sliderlink = document.getElementById('sliderlink').value;
    var slidercategory = document.getElementById('slidercategory').value;
    var pic = document.getElementById('sliderimg');
    // check
     if(name == ''){
        alertify.error('slider Title is required ').dismissOthers();
        document.getElementById('slidertitle').focus();
        return;
     }
     if(pic == ''){
        alertify.error('slider Image is required ').dismissOthers();
        document.getElementById('sliderimg').focus();
        return;
     }

    var data = new FormData();
    data.append('action', 'addslider');
    data.append('name', name);
    data.append('slidersubtitle', slidersubtitle);
    data.append('sliderlink', sliderlink);
    data.append('slidercategory', slidercategory);
    data.append('pimg',pic.files[0]);
    var a = function() { sliderreload();  }
    var arr = [a];
    call_ajax_with_functions('','../includes/ajaxreq.php', data, arr);
}

// Edit slider
function editslider(id){
   //var id = $(this).attr('data-id');
   data = new FormData();
    data.append('action', 'slideredit');
    data.append('id', id);
  
    call_ajax_modal('../includes/ajaxreq.php',data, 'Edit slider');
}

// Update slider
function updslider(id){
   //var id = $(this).attr('data-id');
   var name = document.getElementById('slidertitle').value;
   var slidersubtitle = document.getElementById('slidersubtitle').value;
   var sliderlink = document.getElementById('sliderlink').value;
   var slidercategory = document.getElementById('slidercategory').value;
   var pic = document.getElementById('sliderimg');
   // check
   if(name == ''){
      alertify.error('slider Title is required ').dismissOthers();
      document.getElementById('slidertitle').focus();
      return;
   }
   var pimg="";
   var imgupdte ="";
   if(pic.files[0] === undefined ){
      pimg = $("#newimgprevw").attr("data-img");
      imgupdte = "no";
   }else{
      pimg = pic.files[0];
      imgupdte = "yes";
   }

   data = new FormData();
   data.append('action', 'sliderupdate');
   data.append('id', id);
   data.append('name', name);
   data.append('slidersubtitle', slidersubtitle);
   data.append('sliderlink', sliderlink);
   data.append('slidercategory', slidercategory);
   data.append('pimg', pimg);
   data.append('imgupdte', imgupdte);
   var a = function() { sliderreload();  }
   var arr = [a];
   call_ajax_with_functions('','../includes/ajaxreq.php', data, arr);
}

//Delete slider
function deleteslider(id){
   //var id = $(this).attr('data-id');
   data = new FormData();
   data.append('action','sliderdelete');
   data.append('id',id);
   alertify.confirm("Do you really want to Delete..?",
   function () {
     var a = function(){ sliderreload(); }
     var my_methods = [a];
     call_ajax_notify('../includes/ajaxreq.php', data, 'Item Deleted Successfully', '', my_methods);
   },
   function () {
     alertify.error('Cancel');
   });
}

// Reload slider
function sliderreload(){
   data = new FormData();
   data.append('action', 'sliderreload');

   call_ajax('sliderdata', '../includes/ajaxreq.php',data);
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

//ThemeOptions
function SaveThemeOption(){

    // category basic detail
    var opttitle = document.getElementById('opttitle').value;
    var optemail = document.getElementById('optemail').value;
    var optphone = document.getElementById('optphone').value;
    var optcopyaddress = document.getElementById('optcopyaddress').value;
    var optcopyright = document.getElementById('optcopyright').value;
    var optlogo = document.getElementById('optlogo');

    // check
    if(opttitle == ''){
        alertify.error('Title is required ').dismissOthers();
        document.getElementById('opttitle').focus();
        return;
     }
     if(optemail == ''){
        alertify.error('Email is required ').dismissOthers();
        document.getElementById('optemail').focus();
        return;
     }

   var pimg="";
   var imgupdte ="";
   if(optlogo.files[0] === undefined ){
      pimg = $("#newimgprevw").attr("data-img");
      imgupdte = "no";
   }else{
      pimg = optlogo.files[0];
      imgupdte = "yes";
   }

    var data = new FormData();
    data.append('action', 'themeoptions');
    data.append('opttitle', opttitle);
    data.append('optemail', optemail);
    data.append('optphone', optphone);
    data.append('optcopyaddress', optcopyaddress);
    data.append('optcopyright', optcopyright);
    data.append('optlogo',pimg);
    data.append('imgupdte',imgupdte);

     call_ajax('', '../includes/ajaxreq.php',data);

}
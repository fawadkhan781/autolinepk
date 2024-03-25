//$(document).on('click','#btn_login',function(){
   //document.getElementById('btn_login').addEventListener('click', loginFunc);
   function loginFunc(){
    
    // client basic detail
    var email = $('#email').val();
    var password = $('#password').val();

    // check client contact
     if(email == ''){
        alertify.error('Username is required For Login').dismissOthers();
        document.getElementById('email').focus();
        return;
     }

     if(password == ''){
        alertify.error('Password is required').dismissOthers();
        document.getElementById('password').focus();
        return;
    }
    
    var data = new FormData();
    data.append('action', 'login');
    data.append('email', email);
    data.append('password', password);

     call_ajax('', 'includes/ajax_request_adm.php',data);

}

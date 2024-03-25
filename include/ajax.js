var modal = (function () {/*
 <div id="background_fade" style="z-index:9999999; height: 100% !important; min-height: 100%; width: 100%; position: fixed; top: 0; background-color: rgba(0, 0, 0, 0.7);display:none;">
 <div id="processing" style="z-index:99999999;display: block; padding-right: 17px;" class="modal fade in" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog ajax_modal">
 <div class="modal-content">
 <div class="modal-header">
 <button type="button" class="close" onclick="$('#background_fade').fadeOut(function() { $(this).remove(); });" aria-hidden="true">x</button>
 <h4 class="modal-title" id="modal_title">Processing..</h4>
 </div>
 <div class="modal-body">
 <div id="modal_data" style="padding: 5px 20px;">
 <div class="form-group">
 <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
 <span>Please wait while we are processing your request.</span><br>
 <span>It could take a few seconds depending on your internet connection speed.</span>
 </div>
 </div>
 </div>
 </div>
 </div>
 */}).toString().match(/[^]*\/\*([^]*)\*\/\}$/)[1];

function call_ajax(response_div, php_file, form_data) {
    var request =  get_XmlHttp();
    request.open("POST", php_file, true);
    request.send(form_data);
    $('body').append(modal);
    $('#background_fade').fadeIn();
    $('.btn').attr('disabled','disabled');
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            $('#background_fade').fadeOut(function() {
                $(this).remove();
            });
            $('.btn').removeAttr('disabled');
            if(response_div == '') {
                if(request.responseText.toLowerCase().search('fail') != -1) {
                    alertify.error(request.responseText);
                } else {
                    if(request.responseText=="userloginsuccess"){
                        window.location.href="/autolinepk";
                    }else{
                        var chcking = request.responseText;
                        if(chcking.indexOf('Successfully') > -1) {
                            alertify.success(request.responseText);
                        }else if(chcking.indexOf('selected') > -1) {
                            alertify.success(request.responseText);
                        }else if(chcking.indexOf('Order Placed Success') > -1) {
                            alertify.success("Order Placed Successfully");
                            window.location.href="/autolinepk/thank-you.php"
                        }else{
                            alertify.error(request.responseText);
                         }
                    }
                }
            } else {
                if(request.responseText != ""){
                    document.getElementById(response_div).innerHTML = request.responseText;
                    if(chcking.indexOf('selected') > -1) {
                        alertify.success(request.responseText);
                    }else{
                        alertify.success("Success");
                    }
                }
            }
        }
    }
}


function call_ajax_without_modal(response_div, php_file, form_data) {
    var request =  get_XmlHttp();
    request.open("POST", php_file, true);
    request.send(form_data);
    $('.btn').attr('disabled','disabled');
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            $('.btn').removeAttr('disabled');
            if(response_div == '') {
                if(request.responseText.toLowerCase().search('fail') != -1) {
                    alertify.error(request.responseText);
                } else {
                    alertify.success(request.responseText);
                }
            } else {
                if(request.responseText != ""){
                    document.getElementById(response_div).innerHTML = request.responseText;
                }
            }
        }
    }
}

function call_ajax_without_lg_modal(response_div, php_file, form_data) {
    var request =  get_XmlHttp();
    request.open("POST", php_file, true);
    request.send(form_data);
    $('.btn').attr('disabled','disabled');
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            $('.btn').removeAttr('disabled');
            if(response_div == '') {
                if(request.responseText.toLowerCase().search('fail') != -1) {
                    alertify.error(request.responseText);
                } else {
                    alertify.success(request.responseText);
                }
            } else {
                if(request.responseText != ""){
                    document.getElementById(response_div).innerHTML = request.responseText;
                }
            }
        }
    }
}

function reload_ajax(response_div, php_file, functions) {
    var request =  get_XmlHttp();
    request.open("POST", php_file, true);
    request.send();
    $('body').append(modal);
    $('#background_fade').fadeIn();
    $('.btn').attr('disabled','disabled');
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            $('.btn').removeAttr('disabled');
            $('#background_fade').fadeOut(function() {
                $(this).remove();
            });
            if(request.responseText != "") {
                document.getElementById(response_div).innerHTML = request.responseText;
            }
            if(functions.length > 0) {
                while (functions.length){
                    functions.shift().call();
                }
            }
        }
    }
}

function call_ajax_with_functions(response_div, php_file, form_data, functions) {
    var request =  get_XmlHttp();
    request.open("POST", php_file, true);
    request.send(form_data);
    $('body').append(modal);
    $('#background_fade').fadeIn();
    $('.btn').attr('disabled','disabled');
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            $('.btn').removeAttr('disabled');
            $('#background_fade').fadeOut(function() {
                $(this).remove();
            });
            if(response_div == '') {
                if(request.responseText.toLowerCase().search('fail') != -1) {
                    alertify.error(request.responseText);
                } else {
                    var chcking = request.responseText;
                    if(chcking.indexOf('already') > -1) {
                        alertify.error(request.responseText);
                        }else{
                     alertify.success(request.responseText);
                 }
                }
            } else {
                document.getElementById(response_div).innerHTML = request.responseText;
            }
            if(functions.length > 0) {
                if(request.responseText.search('fail') != -1) {
                } else {
                    while (functions.length) {
                        functions.shift().call();
                    }
                }
            }
        }
    }
}

function call_ajax_modal(php_file, form_data, title) {
    var request =  get_XmlHttp();
    request.open("POST", php_file, true);
    request.send(form_data);
    $('body').append(modal);
    $('#background_fade').fadeIn();
    $('.btn').attr('disabled','disabled');
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            $('.btn').removeAttr('disabled');
            if(request.responseText != ""){
                document.getElementById('modal_title').innerHTML = title;
                document.getElementById('modal_data').innerHTML = request.responseText;
            } else {
                alertify.error("No Responce..");
                $('#background_fade').fadeOut(function() {
                    $(this).remove();
                });
            }
        }
    }
}

function call_ajax_lg_modal(php_file, form_data, title) {
    var request =  get_XmlHttp();
    request.open("POST", php_file, true);
    request.send(form_data);
    $('body').append(modal);
    $('#processing .ajax_modal').addClass("modal-lg");
    $('#background_fade').fadeIn();
    $('.btn').attr('disabled','disabled');
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            $('.btn').removeAttr('disabled');
            if(request.responseText != ""){
                document.getElementById('modal_title').innerHTML = title;
                document.getElementById('modal_data').innerHTML = request.responseText;
            } else {
                alertify.error("No Responce..");
                $('#background_fade').fadeOut(function() {
                    $(this).remove();
                });
            }
        }
    }
}

function call_ajax_modal_with_functions(php_file, form_data, title, functions) {
    var request =  get_XmlHttp();
    request.open("POST", php_file, true);
    request.send(form_data);
    $('body').append(modal);
    $('#background_fade').fadeIn();
    $('.btn').attr('disabled','disabled');
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            $('.btn').removeAttr('disabled');
            if(request.responseText != ""){
                document.getElementById('modal_title').innerHTML = title;
                document.getElementById('modal_data').innerHTML = request.responseText;
            } else {
                alertify.error("No Responce..");
                $('#background_fade').fadeOut(function() {
                    $(this).remove();
                });
            }
            if(functions.length > 0)
            {
                while (functions.length){
                    functions.shift().call();
                }
            }
        }
    }
}

function call_ajax_notify(php_file, form_data, success_msg, focus_input, functions) {
    var request = get_XmlHttp();
    request.open("POST", php_file, true);   
    request.send(form_data);
    //document.getElementById('ajax').style.display = 'block';

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            //document.getElementById('ajax').style.display = 'none';
            if(request.responseText == 'success'){
                alertify.success(success_msg).dismissOthers();
                
                if(focus_input != '')
                {
                    document.getElementById(focus_input).focus();
                }
                if(functions.length > 0)
                {
                    while (functions.length){
                        functions.shift().call();
                    }
                }
            }
            else{
                alertify.error(request.responseText).dismissOthers();
                if(focus_input != '')
                {
                    document.getElementById(focus_input).focus();
                }
            }
        }
    }
}

function get_XmlHttp() {
    var xmlHttp = null;
    if(window.XMLHttpRequest) {		// for Forefox, IE7+, Opera, Safari, ...
        xmlHttp = new XMLHttpRequest();
    }
    else if(window.ActiveXObject) {	// for Internet Explorer 5 or 6
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return xmlHttp;
}
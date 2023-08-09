const APP_URL = $('#app-url').val();
const LOGGIN = $('#login').val();
$(document).ready(function() {
    $('.data-popup').magnificPopup({
        type: 'ajax'
    });
    $('#sign-in-otp-dialog').magnificPopup({
        type: 'inline',
    });
    $('.san-add-to-cart').click(function() {
        let id = $(this).val();
        let  action = 'orderNow';
        let quantity = $(".quantity-" + id).val();
        $.ajax({
            url: APP_URL+"/add-to-cart",
            data: {
                id: id,
                quantity: quantity,
                action: action
            },
            success: function(response) {
                response = JSON.parse(response);
                let isError = (response.status == "Error");
                sanAlert(response.message, isError);
                console.log(response.data);
                if (response.data.length) $('#sidebar_fixed').html(response.data)
            }
        });
    });
    // Input incrementer
    $(".numbers-row").append('<div class="inc button_inc">+</div><div class="dec button_inc">-</div>');
    $(".button_inc").on('click', function() {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        if ($button.text() == "+") {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        $button.parent().find("input").val(newVal);
    });
    $("#login-form").validate({
        rules:{
            phone:{
                    required:true,
                    minlength: 8
                } 
        },
        submitHandler: function() {
            var form_data = $("#login-form").serialize();
            $('#login-submit-error').html("")
            $.post(APP_URL+"/get-otp", form_data)
                .done(function(response) {
                    console.log(response)
                    response = JSON.parse(response);
                    if(response.status == "Error") {
                        $('#login-submit-error').html(response.message);
                        return false;
                    }   
                    $("#otp-phone").val(response.data.phone);
                    showLoginOtp();
                    sanAlert(response.message,false);
                    return true;
                });
        },
    }); 
    $("#otp-form").validate({
        rules:{
            otp:{
                    required:true,
                    minlength: 6,  // <- here
                    maxlength: 6,
                } 
        },
        submitHandler: function() {
            var form_data = $("#otp-form").serialize();
            $('#otp-submit-error').html("")
            $.post(APP_URL+"/check-otp", form_data)
                .done(function(response) {
                    console.log(response)
                    response = JSON.parse(response);
                    if(response.status == "Error") {
                        $('#otp-submit-error').html(response.message);
                        return false;
                    }   
                    sanAlert(response.message,false);
                    if(response.data.userExist){
                        window.location.reload();
                    }
                    window.location.href = APP_URL + "/signup?m="+response.data.phone;
                    return true;
                      
                });
        },
    });
	$("#register-form").validate({
        rules:{
            fname:{
                    required:true,
                }, 
			lname:{
                    required:true,
                }, 
			email:{
                    required:true,
                    email:true,
                }, 
         
        },
        submitHandler: function() {
            var form_data = $("#register-form").serialize();
            $('#register-submit-error').html("")
            $.post(APP_URL+"/register", form_data)
                .done(function(data) {
                    console.log(data)
                    data = JSON.parse(data);
                    if(data.status == "Error") {
                        $('#register-submit-error').html(data.message);
                        return false;
                    }   
                    else {
                        sanAlert("Registration success",false);
                        window.location.href = APP_URL;
                    }                
                });
        },
    });
});

function removeItem(id,action="orderNow") {
    $.ajax({
        url: APP_URL + "/remove-item",
        data: {
            id: id,
            action: action
        },
        success: function(response) {
            response = JSON.parse(response);
            console.log(response.data);
            let isError = (response.status == "Error");
            sanAlert(response.message, isError);
            $('#sidebar_fixed').html(response.data);
        }
    });
}

function sanAlert(msg,error=true,callBack = null){
    let background = error ? "linear-gradient(to right, #b30507, #f05757)" : "linear-gradient(to right, #00b09b, #96c93d)";
    Toastify({
        text: msg,
        duration: 3000,
        close: true,
        gravity: "top",  
        position: "right",  
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
          background: background,
        },
        onClick: function(){
            if (callBack) {
                (typeof callBack == "string") ? window[callBack]() : callBack();
            }
        } // Callback after click
      }).showToast();
}
function orderNow() {
    let date = $('#date').val();
    let time = $('#time').val();
    if (!date) {
        sanAlert('Please select a date');
        return false;
    }
    if (!time) {
        sanAlert('Please select a time');
        return false
    };
    $.ajax({
        url: APP_URL +"/update-cart-date-time",
        data: {
            date: date,
            time: time
        },
        success: function(response) {
            response = JSON.parse(response);
            console.log(response.data);
            if (response.status == "Error") {
                sanAlert(response.message);
                return false;
            }
            if(LOGGIN == 0){
                $('#sign-in').click();
                return false;
            }
            window.location.href = APP_URL +"/checkout"
        }
    });
}
function orderSubmit() {
     let data = $('#order-form').serialize();
    $.ajax({
        url: APP_URL +"/order-submit",
        type: "POST",
        data: data,
        success: function(response) {
            response = JSON.parse(response);
            console.log(response.data);
            if (response.status == "Error") {
                sanAlert(response.message);
                return false;
            }
            if(LOGGIN == 0){
                $('#sign-in').click();
                return false;
            }
            window.location.href = APP_URL +"/confirm"
        }
    });
}
function showLoginPhone(){
    $('#otp-form').hide();
    $('#login-form').show();
}
function showLoginOtp(){
    $('#login-form').hide();
    $('#otp-form').show();
}
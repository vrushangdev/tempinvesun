$(document).ready(function() {

    //custom validation method
    $.validator.addMethod("customemail", 
        function(value, element) {
            return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
        }, 
        "Please enter email id along with domain name."
    );

    // validate signup form on keyup and submit
    $("#loginForm").validate({
        errorElement: 'span',
        rules: {
            password: {
                required: true,
                minlength: 5
            },
            email: {
                required: true,
                //email: true,
                //customemail : true
            },
        },
        messages: {
            password:{
               required:"Please enter password",
               minlength:"Please enter minimum 5 character"
            },
            email:{
                required:"Please enter email address",
                email:"Please enter valid email address"
            } 
        }
    });

    //Forgot password
    $("#forgotForm").validate({
        errorElement: 'span',
        rules: {
            email: {
                required: true,
                email: true,
                customemail : true
            },
        },
        messages: {
            email:{
                required:"Please enter email address",
                email:"Please enter valid email address"
            } 
        }
    });

    $("#resetPassword").validate({
        errorElement: 'span',
        rules: {
            email: {
                required: true,
                email: true,
                customemail : true
            },
            password: {
                required: true,
                minlength: 5
            },
            password_confirmation:{
                required: true,
                minlength: 5,
                equalTo:"#password"  
            }
        },
        messages: {
            email:{
                required:"Please enter email address",
                email:"Please enter valid email address"
            },
            password:{
                required:"Please enter password",
            },
            password_confirmation:{
                required:"Please enter cofirm password",
                equalTo:"The password and confirmation password do not match!"
            }
        }
    });
});


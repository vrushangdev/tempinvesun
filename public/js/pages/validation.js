$(document).ready(function() {

    //custom validation method
    $.validator.addMethod("customemail", 
        function(value, element) {
            return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
        }, 
        "Please enter email id along with domain name."
    );

    $.validator.addMethod('decimal', function(value, element) {
      return this.optional(element) || /^((\d+(\\.\d{0,2})?)|((\d*(\.\d{1,2}))))$/.test(value);
    }, "Please enter a correct size");

    //validate user form
    $("#userForm").validate({
        errorElement: 'span',
        rules: {
            title:{
                required: true,
            },
            mobile:{
                required: true,
                minlength:10,
                maxlength:10,
                remote:{
                    url: "/check-user-mobile",
                    type: "post",
                    data:{
                        user_id : function() {
                            return $('#user_id').val()
                        },
                    }
                }
            },
            address1: {
              required: true,  
            },
            city: {
              required: true,  
            },
            pincode: {
              required: true,  
            },
            state: {
              required: true,  
            },
            country: {
              required: true,  
            },
            gst_number: {
              required: true,  
            },
            district:{
              required: true,    
            },
            calling_id:{
              required: true,    
            },
        },
        messages: {
            title:{
                required: "Please select title",
            },
            first_name:{
                required:"Please enter first name",
            },
            middle_name: {
                required: "Please enter middle name",
            },
            surname: {
              required: "Please enter surname",  
            },
            email:{
                required:"Please enter email address",
                email:"Please enter valid email address",
                remote:"Email already exists!"
            },
            mobile:{
                required:"Please enter mobile",
                remote:"Mobile already exists!"
            },
            address1: {
              required: "Please enter address",  
            },
            city: {
              required: "Please enter city",  
            },
            pincode: {
              required: "Please enter pincode",  
            },
            state: {
              required: "Please enter state",  
            },
            country: {
              required: "Please enter country",  
            },
            gst_number: {
              required: "Please enter GST number",  
            },
            district:{
              required: "Please enter district",    
            },
            calling_id:{
              required: "Please enter calling id",     
            }
        }
    });

    $("#callRequest").validate({
        errorElement: 'span',
        rules: {
            name:{
                required: true,
            },
            mobile:{
                required: true,
                minlength:10,
                maxlength:10,
                remote:{
                    url: "/check-user-mobile",
                    type: "post",
                }
            },
            checkbox:{
                required: true,
            }
        },
        errorPlacement: function(error, element) {
            if (element.attr("type") == "checkbox") {                   
                error.insertAfter('#check_error');
            }
            else { // This is the default behavior of the script for all fields
                error.insertAfter( element );
            }
        },
        messages: {
            name:{
                required: "Please enter name",
            },
            mobile:{
                required:"Please enter mobile",
                remote:"This mobile no already registerd with us!"
            },
            checkbox:{
                required: 'Please check this field',
            }
        }
    });

     $("#installerRequest").validate({
        errorElement: 'span',
        rules: {
            company_name:{
                required: true,
            },
            owner_name:{
                required: true,
            },
            owner_mobile:{
                required: true,
            },
            owner_email:{
                required: true,
            },
            constitation:{
                required: true,
            },
            pincode:{
                required: true,
            },
            city:{
                required: true,
            },
            state:{
                required: true,
            },
            installation_capacity:{
                required: true,
            },
            gst:{
                required: true,
            },
            // mobile:{
            //     required: true,
            //     minlength:10,
            //     maxlength:10,
            //     remote:{
            //         url: "/check-user-mobile",
            //         type: "post",
            //     }
            // },
            checkbox:{
                required: true,
            }
        },
        errorPlacement: function(error, element) {
            if (element.attr("type") == "checkbox") {                   
                error.insertAfter('#check_error');
            }
            else { // This is the default behavior of the script for all fields
                error.insertAfter( element );
            }
        },
        messages: {
            company_name:{
                required: 'Please Enter Company Name',
            },
            owner_name:{
                required: 'Please Enter Owner Name',
            },
            owner_mobile:{
                required: 'Please Enter Owner Mobile',
            },
            owner_email:{
                required: 'Please Enter Owner Email',
            },
            constitation:{
                required: 'Please Select Constitation',
            },
            pincode:{
                required: 'Please Enter Pincode',
            },
            city:{
                required: 'Please Enter City',
            },
            state:{
                required: 'Please Enter State',
            },
            installation_capacity:{
                required: 'Please Select Installation Capacity',
            },
            gst:{
                required: 'Please Enter GST',
            },
            checkbox:{
                required: 'Please check this field',
            }
        }
    });

    

});
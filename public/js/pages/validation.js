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

    // validate role form
    $("#roleForm").validate({
        errorElement: 'span',
        rules: {
            name: {
                required: true,
            },
        },
        messages: {
            name:"Please enter role name",
        }
    });

    //validate user form
    $("#userForm").validate({
        errorElement: 'span',
        rules: {
            role_id:{
                required: true,
            },
            name: {
                required: true,
            },
            email: {
                required: true,
                email: true,
                customemail : true,
                remote:{
                    url: "/admin-panel/check-email",
                    type: "post",
                    data:{
                        role_id: function() {
                            return $("#inputRole").val();
                        },
                        user_id:function() {
                            return $("#id").val();
                        },
                    }
                }
            },
            password: {
                required: true,
                minlength: 6
            },
            mobile:{
                required: true,
                minlength:10,
                maxlength:10,
                remote:{
                    url: "/admin-panel/check-mobile-number",
                    type: "post",
                    data:{
                        role_id: function() {
                            return $("#inputRole").val();
                        },
                        user_id:function() {
                            return $("#id").val();
                        },
                    }
                }
            }
        },
        messages: {
            role_id:{
                required:"Please select role from list",
            },
            name:{
                required:"Please enter name",
            },
            password:{
                required:"Please enter password",
            },
            email:{
                required:"Please enter email address",
                email:"Please enter valid email address",
                remote:"Email already exists!"
            },
            mobile:{
                required:"Please enter mobile",
                remote:"Mobile already exists!"
            }
        }
    });

    $("#categoryForm").validate({
        errorElement: 'span',
        rules: {
            name:{
                required: true,
            },
            image: {
                required: true,
            },
            priority:{
                required: true,
                number:true,
                remote:{
                    url: "/admin-panel/check-priority",
                    type: "post",
                }
            }
        },
        messages: {
            name:{
                required:"Please category enter name",
            },
            image:{
                required:"Please upload category image",
            },
            priority:{
                required:"Please enter priority",
                remote:"This priority is already assigned."
            },
        }
    });

    $("#categoryEditForm").validate({
        errorElement: 'span',
        rules: {
            name:{
                required: true,
            },
            priority:{
                required: true,
                number:true,
                remote:{
                    url: "/admin-panel/check-edit-priority",
                    type: "post",
                    data: {
                        category_id: function() {
                            return $( "#category_id" ).val();
                        },
                    }
                }
            }
        },
        messages: {
            name:{
                required:"Please category enter name",
            },
            priority:{
                required:"Please enter priority",
                remote:"This priority is already assigned."
            },
        }
    });name


    $("#cityForm").validate({
        errorElement: 'span',
        rules: {
            name:{
                required: true,
            },
            image: {
                required: true,
            },
            location:{
                required: true,
            },
            priority:{
                required: true,
                number:true,
                remote:{
                    url: "/admin-panel/check-city-priority",
                    type: "post",
                }
            }
        },
        messages: {
            name:{
                required:"Please category enter name",
            },
            image: {
                required: 'Please upload city image',
            },
            location:{
                required:"Please enter priority",
            },
            priority:{
                required:"Please enter priority",
                remote:"This priority is already assigned."
            }
        }
    });

    $("#cityEditForm").validate({
        errorElement: 'span',
        rules: {
            name:{
                required: true,
            },
            location:{
                required: true,
            },
            priority:{
                required: true,
                number:true,
                remote:{
                    url: "/admin-panel/check-edit-city-priority",
                    type: "post",
                    data: {
                        city_id: function() {
                            return $( "#city_id" ).val();
                        },
                    }
                }
            }
        },
        messages: {
            name:{
                required:"Please category enter name",
            },
            location:{
                required:"Please enter location",
            },
            priority:{
                required:"Please enter priority",
                remote:"This priority is already assigned."
            }
        }
    });

     $("#addNgoForm").validate({
        errorElement: 'span',
        ignore:[],
        rules: {
            name:{
                required: true,
            },
            tag_line: {
                required: true,
            },
            description: {
                required: true,
            },
            image:{
              required: true,  
            },
            category:{
              required: true,    
            },
            donation_link:{
                required: true,      
            },
            mobile:{
                required: true,        
            },
            email:{
                required: true,
                email: true,
                customemail : true,
                remote:{
                    url: "/admin-panel/check-ngo-mail",
                    type: "post",
                }
            },
            password: {
                required: true,
                minlength: 6
            },
        },
        messages: {
            name:{
                required:"Please ngo enter name",
            },
            tag_line:{
                required:"Please enter tag line",
            },
            description:{
                required:"Please enter description",
            },
            image:{
                required:"Please upload category image",  
            },
            category:{
                required: "Please select category",    
            },
            donation_link:{
                required: "Please enter donation link",   
            },
            mobile:{
                required: "Please enter mobile",   
            },
            email:{
                required:"Please enter email address",
                email:"Please enter valid email address",
                remote:"Email already exists!"
            },
            password:{
                required:"Please enter password",
            },
        }
    });

     $("#addEditNgoForm").validate({
        errorElement: 'span',
        ignore:[],
        rules: {
            name:{
                required: true,
            },
            tag_line: {
                required: true,
            },
            description: {
                required: true,
            },
            category:{
              required: true,    
            },
            donation_link:{
                required: true,      
            },
            mobile:{
                required: true,        
            },
            email:{
                required: true,
                email: true,
                customemail : true,
            },
        },
        messages: {
            name:{
                required:"Please ngo enter name",
            },
            tag_line:{
                required:"Please enter tag line",
            },
            description:{
                required:"Please enter description",
            },
            category:{
                required: "Please select category",    
            },
            donation_link:{
                required: "Please enter donation link",   
            },
            mobile:{
                required: "Please enter mobile",   
            },
            email:{
                required:"Please enter email address",
                email:"Please enter valid email address",
                remote:"Email already exists!"
            },
        }
    });

    $("#changePassword").validate({
            errorElement : 'span',
            rules: {
                old_pass: {
                    required: true,
                    minlength: 5
                },
                new_pass: {
                    required: true,
                },
                confirm_password : {
                    required: true,
                    equalTo: "#inputNewPassword"
                }

            },
            messages: {
                old_pass: {
                    required: "Please enter a current password",
                },
                new_pass:{
                    required: "Please enter new password",
                },
                confirm_password:{
                    required: "Please enter confirm password",
                    equalTo : "Please enter password same as above."
                }
            }
        });
    
    

});
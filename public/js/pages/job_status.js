$(document).ready(function() {
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
        
$("input.priority").keyup(function(){
    var priority = $("input.priority").val();
    var order_type = $(".order_type option:selected").val();
    

    $.ajax({
        type: 'post',
        url: '/job-status/check-job-priority',
        data: {
            'priority': priority,
            'order_type': order_type
        },
        success: function(data) {
            if(data == 'true'){
                $(':input[type="submit"]').prop('disabled', true);
                if ($(".priority").parent().next(".validation").length == 0) // only add if not added
                {
                    $(".priority").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>Display Order Already Exists</div>");
                }
                
                $('.priority').focus();
                
            } else {
                $(':input[type="submit"]').prop('disabled',false);
                $(".priority").parent().next(".validation").remove();
            }
        }
    });
});
});




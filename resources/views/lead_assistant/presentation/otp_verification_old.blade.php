@extends('layouts.presentation')
@section('title','Lead Assistant Dashboard | Invesun')
@section('content')
<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

</style>
<div id="page">
   
	<div class="content">
        <center>
            <div id="loader-wrapper">
                
            </div>
        </center>
	   <form id="login" method="post">
	    	@csrf
	    	
            <input type="hidden" id="user_id" name="id" value="{{ $id }}">
            <input type="hidden" name="proposal_id" id ="proposal_id" value="{{ $proposal_id }}">    
            
            <div class="form-group">
                <label for="otp">OTP</label>
                <input type="text" class="form-control" id="otp" name="first_name" placeholder="OTP" required><br>
                <span id="error" style="color:red"> </span>
            </div>	    	

	  </form>
	</div>                
</div>
<br>
<center>
    <div class="loader" style="display:none"></div>
	<a href="javascript:void(0);" class="next submit">Verify</a>
</center>

@endsection
@section('js')
<script type="text/javascript">
     $(document).on('click','.submit',function(){
        $('.loader').show();
        $.ajax({
            type: "post",
            url: '{{ route("verifyOtp") }}',
            data:{ 
                id : $('#user_id').val(),
                otp : $('#otp').val(),
                '_token' : "{{ csrf_token() }}"
            },
            success:function(data){
                $('.loader').hide();
                if(data == 'true'){
                    window.location.href = "/lead-assistant/get-attended-lead-assistant-leads";
                } else {
                    $('#error').text('Enter Valid OTP');
                }
            }
        });
    });

</script>
@endsection

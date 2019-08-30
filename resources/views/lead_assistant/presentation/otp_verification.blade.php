@extends('layouts.presentation_new')
@section('title','Lead Assistant Dashboard | Invesun')
@section('content')
<section class="gradient-01">
    <div class="container ">
        <div class="row m-h-100 ">
            <div class="col-md-6 col-lg-4 m-auto">
            	<div class="avatar">
                    <a href="{{ route('imageFour',[$id,$proposal_id]) }}" class="previous">
    			        <div class="avatar avatar-title bg-success rounded-circle slider-btn-left-otp">
    			        	<i class="mdi mdi-arrow-left-thick"></i>
    			        </div>
                    </a>
			    </div>
			    <div class="avatar right">
			    	<a href="javascript:void(0);" class="next submit">
				        <div class="avatar avatar-title bg-success rounded-circle slider-btn-right-otp">
				        	<i class="mdi mdi-arrow-right-thick"></i>
				        </div>
				    </a>
			    </div>
                <div class="bg-white rounded shadow-lg">
                    <div class=" padding-box-2 p-all-25">
                        <div class="">
                            <div class="text-center p-b-20 pull-up-sm">
                                <div class="avatar avatar-lg">
                                    <span class="avatar-title rounded-circle bg-success"> <i class="mdi mdi-key"></i> </span>
                                </div>
                            </div>
                            <h3 class="text-center">Verify OTP</h3>
                           	<form id="login" method="post">
                                @csrf
                                
                                <input type="hidden" id="user_id" name="id" value="{{ $id }}">
                                <input type="hidden" name="proposal_id" id ="proposal_id" value="{{ $proposal_id }}">    
                                
                                <div class="form-group">
                                    <label for="otp">OTP</label>
                                    <input type="tel" class="form-control" id="otp" name="first_name" placeholder="OTP"  type="tel" class="form-control" maxlength="6" pattern="^\d{6}$" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  required><br>
                                    <span id="error" style="color:red"> </span>
                                </div>       
                                <center>
                                    <div class="spinner-border loader" style="width: 3rem; height: 3rem;display:none;" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </center>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script type="text/javascript">
     $(document).on('click','.submit',function(){
        if($('#otp').val()){
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
        } else {
            alert('Please Enter OTP')
        }
    });

</script>
@endsection
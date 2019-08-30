@extends('layouts.login')
@section('title','Consumer Login | Invesun')
@section('content')
<main class="admin-main  ">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-4  bg-white">
                <a href="#" class="js-card-refresh icon"> </a>
                <div class="row align-items-center m-h-100">
                    <div class="mx-auto col-md-8">
                        <div class="p-b-20 text-center">
                            <p>
                                <img src="{{ asset('img/front/logo.png') }}" width="200" alt="">
                            </p>
                           <!--  <p class="admin-brand-content">
                                Consumer
                            </p> -->
                        </div>
                        <h3 class="text-center p-b-20 fw-400">Consumer Login</h3>
                        <form class="needs-validation" method="POST" id="consumerLoginForm">
                            @csrf   
                            <div class="form-row">
                                <div class="form-group floating-label col-md-12">
                                    <label>Mobile Number</label>
                                    <input type="text" required name="email" class="form-control number" maxLength="10" id="mobile" placeholder="Mobile Number">
                                </div>
                            </div>
                            <center>
                                <div class="spinner-border" style="width: 3rem; height: 3rem;display: none" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </center>
                            <button type="submit" class="btn btn-primary btn-block btn-lg">Send OTP</button>
                        </form>
                        <form class="needs-validation" method="POST" action="" id="consumerOtpForm" style="display:none;">
                            @csrf
                            <input type="hidden" required name="mobile" class="form-control number" maxLength="10" id="otp_mobile" placeholder="Mobile Number">                               
                            <div class="form-row">
                                <div class="form-group floating-label col-md-12">
                                    <label>OTP</label>
                                    <input type="text" required name="otp" maxlength="6" class="form-control number" id="otp" placeholder="Enter OTP">
                                    <span id="otp-invalid" style="color:red;display: none">OTP Invalid!</span>
                                </div>
                            </div>
                            <center>
                                <div class="spinner-border otpVerification" style="width: 3rem; height: 3rem;display: none" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </center>
                            <button type="submit" class="btn btn-primary btn-block btn-lg">Verify OTP</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 d-none d-md-block bg-cover" style="background-image: url('../img/login.jpg');"></div>
        </div>
    </div>
</main>
@endsection
@section('js')
<script type="text/javascript">
    $(document).on('submit','#consumerLoginForm',function(e){
        e.preventDefault();
        $('.spinner-border').show();
        $.ajax({
            type:"POST",
            url: "{{ route('generateOtp') }}",
            data:{
                mobile: $('#mobile').val(),
            },  
            success: function(data) {
                $('.spinner-border').hide();
                if(data == 'false'){
                    $('#otp-invalid').show();
                } else {
                    $('#consumerLoginForm').hide();
                    $('#otp_mobile').val($('#mobile').val());
                    $('#consumerOtpForm').show();
                }
            }
        });
        
    });
    $(document).on('submit','#consumerOtpForm',function(e){
        e.preventDefault();
        $('.otpVerification').show();
        $.ajax({
            type:"POST",
            url: "{{ route('checkLogin') }}",
            data:{
                mobile: $('#otp_mobile').val(),
                otp: $('#otp').val(),
            },  
            success: function(data) {
                 $('.otpVerification').hide();
                if(data == 'false'){
                    $('#otp-invalid').show();
                } else {
                    window.location.href = '/consumer/dashboard';
                }
            }
       });
    });
</script>
@endsection
<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="format-detection" content="telephone=no">
	<link rel="icon" href="{{ asset('img/front/favicon.ico') }}">
	<title>Invesun</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/index/main_installer.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css" integrity="sha256-Tcd+6Q3CIltXsx0o/gYhPNbEkb3HJJpucOvQA7csVwI=" crossorigin="anonymous" />
</head>
<body>
	<div class="wrapper">

		<header>
			<a href="#" title="Invesun" class="logo"><i><img src="{{ asset('img/front/logo.png') }}" alt=""></i></a>
			<div class="contact_lang">
				<a href="{{ route('index') }}" class="tel_no" title="Call">
					<span class="hidden-xs">Back to Site</span>
					<span class="visible-xs">Back to Site</span>
				</a>
			</div>
		</header>

		<main>
			<section class="hero_banner_installer">
				<div class="container">
					<h1>Become Our Installation Partner</h1>
					<p>Join our growing partner community by signing up for our partner program</p>
				</div>
			</section>

			<section class="info_section contact_form">

				<div class="img_block" style="background:white!important;">

					<div class="form_outer">
						<form action="{{ route('saveInstaller') }}" method="post" id="installerRequest">
							@csrf

							<div class="form-group">
								<label>Company Name</label>
								<input type="text" class="form-control-installer" placeholder="Company Name" name="company_name" autocomlpete="off" required>
							</div>

							<div class="form-group">
								<label>Owner Name</label>
								<input type="text" class="form-control-installer" placeholder="Owner Name" name="owner_name" autocomlpete="off" required>
							</div>

							<div class="form-group">
								<label>Owner Mobile</label>
								<input type="tel" class="form-control-installer" placeholder="Owner Mobile" maxlength="10" pattern="^\d{10}$" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  name="owner_mobile" autocomlpete="off" required>
							</div>

							<div class="form-group">
								<label>Owner Email</label>
								<input type="text" class="form-control-installer" placeholder="Owner Email" name="owner_email" autocomlpete="off" required>
							</div>

							<div class="form-group">
								<label>Constitation</label>
								<select class="form-control-installer" name="constitation">
									<option value="">Select Constitation</option>
									<option value="1">Constitation Select</option>
									<option value="2">Sole Proprietor</option>
									<option value="3">HUF</option>
									<option value="4">Partnership</option>
									<option value="5">Company</option>
									<option value="6">Limited Liability Partnership (LLP)</option>
								</select>
							</div>

							<div class="form-group">
								<label>Pincode</label>
								<input type="text" class="form-control-installer" type="tel" class="form-control-installer" placeholder="Pincode" maxlength="6" pattern="^\d{6}$" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  placeholder="Pincode" name="pincode" autocomlpete="off" required>
							</div>

							<div class="form-group">
								<label>City</label>
								<input type="text" class="form-control-installer" placeholder="City" name="city" autocomlpete="off" required>
							</div>

							<div class="form-group">
								<label>State</label>
								<input type="text" class="form-control-installer" placeholder="State" name="state" autocomlpete="off" required>
							</div>

							<div class="form-group">
								<label>Installation Capacity</label>
								<select class="form-control-installer" name="installation_capacity">
									<option value="">Select Installation Capacity</option>
									<option value="1">< 100kW</option>
									<option value="2">100kW to 1MW</option>
									<option value="3">> 1MW</option>
								</select>
							</div>

							<div class="form-group">
								<label>GSTIN</label>
								<input type="text" class="form-control-installer" maxlength="15" placeholder="GSTIN" name="gst" autocomlpete="off" required>
							</div>

							<div class="form-group">
								<div class="custom_checkbox">
									<input type="checkbox" name="checkbox" class="custom_input" required>
									<span></span> I authorize Invesun representative to call/SMS towards this application and other products /services. This  conseat overrides my registrtion for DNC/NDNC, <a href="{{ route('termsAndPrivacy') }}" title="Terms and conditions" target="_blank">Terms and conditions</a><br>
									<span id="check_error"></span>
								</div>
								
							</div>

							<button type="submit" class="orange_btn">{{ trans('sentence.Submit') }}</button>
						</form>


					</div>
				</div>
			</section>
			
			<section>
				<div class="container">
					<center>
						<div class="client-logos">
							<h1 style="font-size: 25px">Our Preferred Partners</h1>
							<br><br>
								<div class="owl-carousel owl-theme">
								    <div class="item"><img src="{{ asset('img/installer/1.jpg') }}"></div>
								    <div class="item"><img src="{{ asset('img/installer/2.jpg') }}"></div>
								    <div class="item"><img src="{{ asset('img/installer/3.jpg') }}"></div>
								    <div class="item"><img src="{{ asset('img/installer/4.jpg') }}"></div>
								    <div class="item"><img src="{{ asset('img/installer/5.jpg') }}"></div>
								</div>
						</div>
					</center>
				</div>
			</section>
		</main>
	</div>
	<footer>
		
	</footer>
	<script type="text/javascript" src="{{ asset('js/index/main.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/pages/validation.js') }}"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.js" integrity="sha256-kiFgik3ybDpn1VOoXqQiaSNcpp0v9HQZFIhTgw1c6i0=" crossorigin="anonymous"></script>
</body>
</html>
<script type="text/javascript">
@if(Session::has('messages'))
    jQuery(document).ready(function() {
        @foreach(Session::get('messages') AS $msg) 
            toastr['{{$msg["type"]}}']('{{$msg["message"]}}');
        @endforeach
    });
@endif
@if (count($errors) > 0) 
    jQuery(document).ready(function() {
        @foreach($errors->all() AS $error)
            toastr.error('{{$error}}');
        @endforeach     
    });
@endif
$(document).on('change','.custom_select',function(){
	window.location.href = $(this).val();
});
$('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})
</script>

<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no_scroll">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="format-detection" content="telephone=no">
	<link rel="icon" href="{{ asset('img/front/favicon.ico') }}">
	<title>Invesun</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/index/main.css') }}">
</head>
<body class="no_scroll">
	<div class="wrapper">

		<header>
			<a href="#" title="Invesun" class="logo"><i><img src="{{ asset('img/front/logo.png') }}" alt=""></i></a>
			<div class="contact_lang">
				<select class="custom_select">
					<option value="lang/en" @if(str_replace('_', '-', app()->getLocale()) == 'en') selected="selected" @endif>ENG</option>
					<option value="lang/gj" @if(str_replace('_', '-', app()->getLocale()) == 'gj') selected="selected" @endif>GUJ</option>
 					<option value="lang/hi" @if(str_replace('_', '-', app()->getLocale()) == 'hi') selected="selected" @endif>HIN</option>
				</select>
				<a href="tel:+918521356483" class="tel_no" title="Call">
					<i>
						<svg class="hidden-xs" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px">
							<path fill-rule="evenodd" d="M17.137,13.521 C17.173,13.798 17.088,14.039 16.884,14.244 L14.484,16.629 C14.375,16.749 14.234,16.852 14.060,16.936 C13.885,17.021 13.714,17.075 13.546,17.099 C13.533,17.099 13.497,17.102 13.437,17.108 C13.377,17.114 13.299,17.117 13.203,17.117 C12.974,17.117 12.604,17.078 12.093,17.000 C11.581,16.921 10.956,16.729 10.216,16.421 C9.476,16.114 8.637,15.653 7.698,15.039 C6.760,14.425 5.762,13.581 4.703,12.509 C3.861,11.678 3.163,10.882 2.609,10.124 C2.056,9.364 1.611,8.663 1.274,8.018 C0.937,7.374 0.684,6.790 0.516,6.265 C0.348,5.741 0.233,5.289 0.173,4.910 C0.113,4.531 0.089,4.232 0.101,4.015 C0.113,3.798 0.119,3.678 0.119,3.654 C0.143,3.485 0.197,3.314 0.281,3.139 C0.366,2.964 0.468,2.823 0.588,2.714 L2.988,0.311 C3.157,0.142 3.349,0.058 3.566,0.058 C3.722,0.058 3.861,0.103 3.981,0.193 C4.101,0.284 4.203,0.395 4.288,0.527 L6.219,4.196 C6.327,4.389 6.357,4.600 6.309,4.829 C6.261,5.057 6.158,5.251 6.002,5.407 L5.118,6.292 C5.094,6.317 5.073,6.356 5.055,6.410 C5.037,6.464 5.028,6.509 5.028,6.545 C5.076,6.798 5.184,7.088 5.352,7.413 C5.497,7.702 5.719,8.054 6.020,8.470 C6.321,8.886 6.748,9.364 7.301,9.907 C7.843,10.461 8.324,10.891 8.745,11.199 C9.166,11.506 9.518,11.732 9.801,11.876 C10.084,12.021 10.300,12.108 10.450,12.138 L10.676,12.183 C10.700,12.183 10.739,12.175 10.793,12.157 C10.847,12.138 10.886,12.117 10.911,12.093 L11.939,11.045 C12.156,10.852 12.408,10.756 12.697,10.756 C12.902,10.756 13.064,10.792 13.184,10.865 L13.202,10.865 L16.685,12.924 C16.938,13.081 17.088,13.280 17.137,13.521 Z" />
						</svg>
						<svg class="visible-xs" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="12px" height="12px">
							<path fill-rule="evenodd"  fill="rgb(255, 255, 255)"
							d="M11.224,9.078 C11.246,9.251 11.194,9.402 11.067,9.529 L9.573,11.020 C9.506,11.095 9.418,11.159 9.309,11.211 C9.200,11.264 9.094,11.298 8.989,11.313 C8.981,11.313 8.959,11.315 8.921,11.319 C8.884,11.323 8.835,11.325 8.776,11.325 C8.633,11.325 8.403,11.300 8.085,11.251 C7.767,11.202 7.377,11.082 6.917,10.890 C6.456,10.698 5.934,10.410 5.350,10.026 C4.766,9.642 4.144,9.116 3.486,8.446 C2.961,7.926 2.527,7.430 2.183,6.956 C1.838,6.481 1.561,6.043 1.352,5.640 C1.142,5.238 0.985,4.873 0.880,4.545 C0.775,4.218 0.704,3.936 0.666,3.699 C0.629,3.462 0.614,3.275 0.621,3.140 C0.629,3.004 0.633,2.929 0.633,2.914 C0.648,2.809 0.681,2.702 0.734,2.592 C0.786,2.483 0.850,2.395 0.925,2.327 L2.419,0.826 C2.523,0.720 2.643,0.668 2.778,0.668 C2.875,0.668 2.961,0.696 3.036,0.752 C3.111,0.809 3.175,0.878 3.227,0.961 L4.429,3.253 C4.496,3.373 4.515,3.505 4.485,3.648 C4.455,3.791 4.391,3.911 4.294,4.009 L3.744,4.562 C3.729,4.577 3.716,4.602 3.705,4.636 C3.693,4.670 3.688,4.698 3.688,4.720 C3.718,4.878 3.785,5.059 3.890,5.262 C3.980,5.443 4.118,5.663 4.305,5.923 C4.493,6.182 4.758,6.481 5.103,6.820 C5.440,7.166 5.739,7.435 6.001,7.627 C6.263,7.819 6.482,7.960 6.658,8.051 C6.834,8.141 6.969,8.195 7.063,8.214 L7.203,8.242 C7.218,8.242 7.242,8.237 7.276,8.226 C7.310,8.214 7.334,8.201 7.349,8.186 L7.989,7.531 C8.124,7.411 8.281,7.351 8.461,7.351 C8.588,7.351 8.689,7.373 8.764,7.418 L8.775,7.418 L10.943,8.705 C11.100,8.803 11.194,8.927 11.224,9.078 Z"/>
						</svg>
					</i>
					<span class="hidden-xs">+91 8521356483</span>
					<span class="visible-xs">Call us</span>
				</a>
			</div>
		</header>

		<main>
			<section class="hero_banner">
				<div class="container">
					<h1>{{ trans('sentence.Reduce Your Energy Bill With Solar') }}</h1>
					<div class="area_code">
						<span class="area_name">Ahmedabad</span>
						<input type="text" class="area_input" maxlength="6" value="380015">
					</div>
					<p>{{ trans('sentence.Set your approx monthly energy bill amount') }}</p>
					<div class="price_slider"></div>
					<a href="#" class="orange_btn" title="Know How To Save">{{ trans('sentence.Know How To Save') }}</a>
				</div>
			</section>

			<section class="info_section overlay_content_mob">
				<div class="content_block">
					<p>{{ trans('sentence.You can save upto') }} <span class="highlight money_saving">₹3750</span> {{ trans('sentence.on your current bill by installing') }} <span class="highlight plantSize">5kW </span>{{ trans('sentence.of solar power plant') }}</p>
				</div>
				<div class="img_block" style="background: url(../img/front/house.png)">
					<img class="visible-xs" src="{{ asset('img/front/house_mob.png')}}" alt="">
				</div>
			</section>

			<section class="info_section left_img">
				<div class="content_block">
					<p>{{ trans('sentence.Switch to solar with easy emi options starting from')}} <span class="highlight loadAmount">₹3250</span></p>
				</div>
				<div class="img_block" style="background: url(../img/front/buildings.png);">
					<img class="visible-xs" src="{{ asset('img/front/buildings_mob.png') }}" alt="">
				</div>
			</section>

			<section class="info_section contact_form">
				<div class="content_block">
					<p>{{ trans('sentence.Our salesperson will explain product details and price for solar installation!') }}</p>
				</div>
				<div class="img_block">
					<div class="form_outer">
						<h2>{{ trans('sentence.We will soon call you back!') }}</h2>
						<form action="{{ route('saveGetCallRequest') }}" method="post" id="callRequest">
							@csrf

							<input type="hidden" name="pincode" id="pincode" value="">

							<input type="hidden" name="shared" value="{{ $shared }}">

							<input type="hidden" name="shared_id" value="{{ $shared_id }}">

							<input type="hidden" name="monthly_energy_saving" id="monthly" value="">

							<input type="hidden" name="plant_size" id="plant_size" value="">

							<div class="form-group">
								<input type="text" class="form-control" placeholder="{{ trans('sentence.Name') }}" name="name" autocomlpete="off" required>
							</div>
							<div class="form-group">
								<input type="tel" class="form-control" placeholder="{{ trans('sentence.Mobile Number') }}" maxlength="10" pattern="^\d{10}$" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  name="mobile" autocomlpete="off" required>
							</div>

							<div class="form-group">
								<div class="custom_checkbox">
									<input type="checkbox" name="checkbox" class="custom_input" required>
									<span></span> I agree to <a href="{{ route('termsAndPrivacy') }}" title="Terms and conditions" target="_blank">Terms and conditions</a><br>
									<span id="check_error"></span>
								</div>
								
							</div>

							<button type="submit" class="orange_btn">{{ trans('sentence.Submit') }}</button>
						</form>
						<footer>
							<p>&copy; Invesun</p>
							<nav>
								<ul>
									<li><a href="#" title="About US">{{ trans('sentence.About') }}</a></li>
									<li><a href="{{ route('termsAndPrivacy') }}" title="Terms & Privacy">{{ trans('sentence.T&C') }}</a></li>
									<li><a href="#" title="Solar101">{{ trans('sentence.Solar101') }}</a></li>
									<li><a href="{{ route('installer') }}" title="Installer">{{ trans('sentence.Installer') }}</a></li>
								</ul>
							</nav>
						</footer>
					</div>
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
</script>

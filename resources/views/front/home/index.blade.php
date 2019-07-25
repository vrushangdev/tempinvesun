<!DOCTYPE html>

<html lang="en" class="no_scroll">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="format-detection" content="telephone=no">
	<!-- <link rel="icon" href="{{ asset('img/front/favicon.ico') }}"> -->
	<title>Invesun</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/index/main.css') }}">
</head>
<body class="no_scroll">
	<div class="wrapper">

		<header>
			<div class="logo">invesun</div>
			<a href="tel:+918521356483" class="tel_no" title="Call">
				<i>
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px">
						<path fill-rule="evenodd" d="M17.137,13.521 C17.173,13.798 17.088,14.039 16.884,14.244 L14.484,16.629 C14.375,16.749 14.234,16.852 14.060,16.936 C13.885,17.021 13.714,17.075 13.546,17.099 C13.533,17.099 13.497,17.102 13.437,17.108 C13.377,17.114 13.299,17.117 13.203,17.117 C12.974,17.117 12.604,17.078 12.093,17.000 C11.581,16.921 10.956,16.729 10.216,16.421 C9.476,16.114 8.637,15.653 7.698,15.039 C6.760,14.425 5.762,13.581 4.703,12.509 C3.861,11.678 3.163,10.882 2.609,10.124 C2.056,9.364 1.611,8.663 1.274,8.018 C0.937,7.374 0.684,6.790 0.516,6.265 C0.348,5.741 0.233,5.289 0.173,4.910 C0.113,4.531 0.089,4.232 0.101,4.015 C0.113,3.798 0.119,3.678 0.119,3.654 C0.143,3.485 0.197,3.314 0.281,3.139 C0.366,2.964 0.468,2.823 0.588,2.714 L2.988,0.311 C3.157,0.142 3.349,0.058 3.566,0.058 C3.722,0.058 3.861,0.103 3.981,0.193 C4.101,0.284 4.203,0.395 4.288,0.527 L6.219,4.196 C6.327,4.389 6.357,4.600 6.309,4.829 C6.261,5.057 6.158,5.251 6.002,5.407 L5.118,6.292 C5.094,6.317 5.073,6.356 5.055,6.410 C5.037,6.464 5.028,6.509 5.028,6.545 C5.076,6.798 5.184,7.088 5.352,7.413 C5.497,7.702 5.719,8.054 6.020,8.470 C6.321,8.886 6.748,9.364 7.301,9.907 C7.843,10.461 8.324,10.891 8.745,11.199 C9.166,11.506 9.518,11.732 9.801,11.876 C10.084,12.021 10.300,12.108 10.450,12.138 L10.676,12.183 C10.700,12.183 10.739,12.175 10.793,12.157 C10.847,12.138 10.886,12.117 10.911,12.093 L11.939,11.045 C12.156,10.852 12.408,10.756 12.697,10.756 C12.902,10.756 13.064,10.792 13.184,10.865 L13.202,10.865 L16.685,12.924 C16.938,13.081 17.088,13.280 17.137,13.521 Z" />
					</svg>
				</i>+91 8521356483
			</a>
		</header>

		<main>
			<section class="hero_banner">
				<div class="container">
					<h1>Reduce Your Energy Bill With Solar</h1>
					<div class="area_code">
						<span class="area_name">Ahmedabad</span>
						<input type="text" class="area_input" maxlength="6" placeholder="Pin code" value="380015">
					</div>
					<p>Set your approx monthly energy bill amount</p>
					<div class="price_slider"></div>
					<a href="#" class="orange_btn" title="Know How To Save">Know How To Save</a>
				</div>
			</section>

			<section class="info_section overlay_content_mob">
				<div class="content_block">
					<p>You can save upto <span class="highlight money_saving">₹2000</span> on your current bill by installing <span class="highlight plantSize">3kW</span> of solar power plant</p>
				</div>
				<div class="img_block" style="background: url(../img/front/house.png)">
					<img class="visible-xs" src="{{ asset('img/front/house_mob.png')}}" alt="">
				</div>
			</section>

			<section class="info_section left_img">
				<div class="content_block">
					<p>Switch to solar with easy emi options starting from <span class="highlight loadAmount">₹2499</span></p>
				</div>
				<div class="img_block" style="background: url(../img/front/buildings.png);">
					<img class="visible-xs" src="{{ asset('img/front/buildings_mob.png') }}" alt="">
				</div>
			</section>

			<section class="info_section contact_form">
				<div class="content_block">
					<p>Our salesperson will explain product details and price for solar installation!</p>
				</div>
				<div class="img_block">
					<div class="form_outer">
						<h2>We will soon call you back!</h2>
						<form action="{{ route('saveGetCallRequest') }}" method="post" id="callRequest">
							@csrf

							<input type="hidden" name="pincode" id="pincode" value="">

							<input type="hidden" name="shared" value="{{ $shared }}">

							<input type="hidden" name="shared_id" value="{{ $shared_id }}">

							<input type="hidden" name="monthly_energy_saving" id="monthly" value="">

							<input type="hidden" name="plant_size" id="plant_size" value="">

							<div class="form-group">
								<input type="text" class="form-control" placeholder="Name" name="name" autocomlpete="off" required>
							</div>
							<div class="form-group">
								<input type="tel" class="form-control" placeholder="Mobile Number" maxlength="10" pattern="^\d{10}$" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  name="mobile" autocomlpete="off" required>
							</div>
							<button type="submit" class="orange_btn">Submit</button>
						</form>
						<footer>
							<p>@Straut renewables</p>
							<nav>
								<ul>
									<li><a href="#" title="About US">About US</a></li>
									<li><a href="#" title="Terms & Privacy">Terms & Privacy</a></li>
									<li><a href="#" title="Solar101">Solar101</a></li>
									<li><a href="#" title="Installer">Installer</a></li>
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
</script>
<script type="text/javascript">
    $(document).on('change','#calculate',function(){
        var amount = $('#amount').val();
        $('#planSize').val(parseFloat(amount / 750).toFixed(2));
        $('#monthly_energy').val(parseFloat((amount * 75) / 100).toFixed(2));
        $('.show').show();
        $('.getCall').show();
    });

    $(document).on('click','#getCall',function(){
        $('#modal_planSize').val($('#planSize').val());
        $('#modal_monthly_energy_saving').val($('#monthly_energy').val());
        $('#modal_amount').val($('#amount').val());
        $('#myModal').modal('show');
    });
</script>

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
	<link rel="stylesheet" type="text/css" href="{{ asset('css/index/main.css') }}">
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

			<div class="container" style="max-width: 1140px;padding-top: 135px;padding-bottom: 35px;margin-right: auto;margin-left: auto;">	
				
				
			</div>
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

<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<link rel="icon" href="{{ asset('img/front/favicon.ico') }}">
	<title>Invesun</title>
	<style type="text/css">
		body, html {
		  height: 100%;
		  margin: 0;
		}
		@media only screen and (max-width: 992px) {
  			.visible-md{ display: none; }
  			.visible-xs{ display: block; }
		}

		@media only screen and (min-width: 1200px) {
  			.visible-md{ display: block; }
  			.visible-xs{ display: none; }
		}
		img {
		    max-width: 100%;
		    max-height: 100%;
		}
	</style>
</head>
<body>
	<img class="visible-md" src="{{ asset('img/thankyou.jpg') }}" style="width:100%;">
	<img class="visible-xs" src="{{ asset('img/mthankyou.jpg') }}" style="width:100%;">
	<script
	  src="https://code.jquery.com/jquery-3.4.1.js"
	  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
	  crossorigin="anonymous"></script>
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

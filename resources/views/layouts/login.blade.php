<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-touch-fullscreen" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">
        <title>@yield('title')</title>
        <link rel="icon" type="image/x-icon" href="assets/img/logo.png"/>
        <link rel="icon" href="assets/img/logo.png" type="image/png" sizes="16x16">
        <link rel="stylesheet" href="{{ asset('plugins/pace/pace.css') }}">
        <script src="{{ asset('plugins/pace/pace.min.js') }}"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/jquery-scrollbar/jquery.scrollbar.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/jquery-ui/jquery-ui.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/timepicker/bootstrap-timepicker.min.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Hind+Vadodara:400,500,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/fonts/jost/jost.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/fonts/materialdesignicons/materialdesignicons.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/front/atmos.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/developer.css') }}">
    </head>
    <body class="jumbo-page">

        @yield('content')

        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('plugins/popper/popper.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('plugins/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
        <script src="{{ asset('plugins/listjs/listjs.min.js') }}"></script>
        <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
        <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
        <script src="{{ asset('js/front/atmos.min.js') }}"></script>
        <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('js/pages/login.js') }}"></script>
        <script src="{{ asset('js/pages/common.js' )}}"></script> 
        <!--page specific scripts for demo-->
    </body>
</html>
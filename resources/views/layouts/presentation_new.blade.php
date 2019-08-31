<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <link rel="icon" href="{{ asset('img/front/favicon.ico') }}">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<title>@yield('title') | Invesun</title>
@include('partials.admin.header_link')
</head>
<body class="jumbo-page noScroll">
@yield('content')
@include('partials.admin.footer_link')
@yield('js')
</body>
</html>
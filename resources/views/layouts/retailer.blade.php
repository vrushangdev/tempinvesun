<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="robots" content="noindex,nofollow" />
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-touch-fullscreen" content="yes">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="apple-mobile-web-app-status-bar-style" content="default">
        <link rel="icon" href="{{ asset('img/front/favicon.ico') }}">
        <title>@yield('title')</title>
        @include('partials.retailer.header_link')
    </head>

    <body class="sidebar-pinned">
        @include('partials.retailer.sidebar')
        <main class="admin-main">
            @include('partials.retailer.header')
            @yield('content')
        </main>
        @include('partials.retailer.footer_link')
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        @yield('js')
    </body>
</html>
<script type="text/javascript">
    @if(Session::has('messages'))
        jQuery(document).ready(function() {
            @foreach(Session::get('messages') AS $msg) 
                $.notify({
                    // options
                    title: '',
                    message: '{{$msg["message"]}}'
                }, {
                    placement: {
                        align: "right",
                        from: "top"
                    },

                    timer: 500,
                    type: '{{$msg["type"]}}',
                });
            @endforeach
        });
    @endif

    @if (count($errors) > 0) 
        jQuery(document).ready(function() {
            @foreach($errors->all() AS $error)
                $.notify({
                    // options
                    title: 'error',
                    message: '{{$error}}'
                }, {
                    placement: {
                        align: "right",
                        from: "top"
                    },

                    timer: 500,
                    type: 'error',
                });
            @endforeach     
        });
    @endif
</script>

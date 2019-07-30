<!doctype html>
<html lang="en-US">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Invesun</title>
        <meta name="author" content="Jake Rocheleau">
        <link rel="shortcut icon" href="http://www.templatemonster.com/favicon.ico">
        <link rel="icon" href="http://www.templatemonster.com/favicon.ico">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
        <style>
        a {
          text-decoration: none;
          display: inline-block;
          padding: 14px 23px;
          font-size: 15px;
        }

        a:hover {
          background-color: #ddd;
          color: black;
        }

        .previous {
          background-color: #f1f1f1;
          color: black;
        }

        .next {
          background-color: #4CAF50;
          color: white;
        }

        .round {
          border-radius: 50%;
        }
        </style>
    </head>
    
    <body>
        <div id="w">
            @yield('content')
            
        </div>
    </body>
    <link href="{{ asset('plugins/dropify/dist/css/dropify.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('plugins/dropify/dist/js/dropify.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $('.dropify').dropify();
    </script>
    @yield('js')
</html>
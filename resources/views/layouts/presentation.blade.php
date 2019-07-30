<!doctype html>
<html lang="en-US">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Sliding Registration Panel Demo</title>
        <meta name="author" content="Jake Rocheleau">
        <link rel="shortcut icon" href="http://www.templatemonster.com/favicon.ico">
        <link rel="icon" href="http://www.templatemonster.com/favicon.ico">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
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
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
 
    <title>
        @yield('title')
    </title>
</head>
<body>
    <div id="app">
        @yield('main')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://kit.fontawesome.com/4f542a4dce.js" crossorigin="anonymous"></script>  
</body>
</html>
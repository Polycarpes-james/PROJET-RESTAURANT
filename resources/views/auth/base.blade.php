<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title') | ADMIN </title>

</head>
<body class="body-connexion">
    <div class="picture-part">
        <img src="{{ image_url("/logue.jpg", 1000, 1200) }}" alt="">
    </div>
    <div class="content-login">
        @yield('content')
    </div>
</body>
</html>
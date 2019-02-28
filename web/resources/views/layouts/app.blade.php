<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAD4SURBVDhPzdGxSwJhHIfxSxQa0ggCBzc3cXLpL6jRoUEc3QwiQTcnFZtaImgIdwUJBId2W6vBQXGLbLRV3Bx8vu97HnHg0UGDD3y433tw572vzl7XxKdrikuE6gV1RFHDO0KlF7ziDmOUESq9oIciHjGDviawPNp29LZwgAuscYydRaADWyCHhrsW/foNAjvHG/Tgk274yqKFKpK64a8P7bWAJY6w7Qw/qOAecxzC6xQrPLu+cYVtXdza0aTtnNjRppMe2tFUwsCOphGu7WhKuFcvnXTMjiatf3/iA7RFFccX0mb1x3RoE3xA2+sgdPqbM0iZ1f/kOBsmUSwbPM7FgQAAAABJRU5ErkJggg==">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@isset($title){{ $title }}@else Laravel @endisset</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-light">
<div id="app">
    <main>
        @yield('content')
    </main>
</div>
</body>
</html>
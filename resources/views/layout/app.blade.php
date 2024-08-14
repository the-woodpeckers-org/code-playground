<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @vite('resources/css/app.css')
</head>
<body id="app">
<v-header></v-header>
@yield('content')
<v-footer></v-footer>
@vite('resources/js/app.js')
</body>
</html>

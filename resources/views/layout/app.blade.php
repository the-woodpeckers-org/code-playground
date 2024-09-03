<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="{{asset('css/styles.css')}}">
    @vite('resources/css/app.css')
</head>
<body id="app">
<v-header></v-header>
<div class="grid grid-cols-12 mx-auto lg:max-w-screen-xl max-w-full">
    <div class="col-span-12">
        @yield('content')
    </div>
</div>
<v-footer></v-footer>
@vite('resources/js/app.js')

<script src="{{asset('js/lib/ace.js')}}"></script>
<script src="{{asset('js/lib/theme-monokai.js')}}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CodePlayground</title>
    <link rel="stylesheet" type="text/css" href="{{asset('richtexteditor/runtime/richtexteditor_content.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('richtexteditor/rte_theme_default.css')}}">
    <script type="text/javascript" src="{{asset('richtexteditor/rte.js')}}"></script>
    <script type="text/javascript" src="{{asset('richtexteditor/plugins/all_plugins.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
          integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">

    <link href="{{asset('css/styles.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>document.documentElement.classList.add('js')</script>
    @vite('resources/css/app.css')
</head>
<body id="app" class="bg-tertiary">
@vite('resources/js/app.js')
<script src="{{asset('js/lib/ace.js')}}"></script>
<script src="{{asset('js/lib/theme-monokai.js')}}"></script>
</body>
</html>

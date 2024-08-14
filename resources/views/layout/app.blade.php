<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>
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
<script>

</script>
<script src="{{asset('js/lib/ace.js')}}"></script>
<script src="{{asset('js/lib/theme-monokai.js')}}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="description" content="@yield("description")" />
        <meta name="keywords" content="@yield("keywords")" />
{{--        <link rel="icon" href="https://alex-media.ru/favicon.ico" type="image/x-icon">--}}
        <title>ФССП</title>
        <link rel="stylesheet" href="{{ asset('/themes/aura-light-green/theme.css') }}">
{{--        <link id="theme-css" rel="stylesheet" type="text/css" href="themes/aura-light-green/theme.css">--}}
        @vite(['resources/js/main.js'])
        @yield("css")
    </head>
    <body>
{{--    @dd($_SERVER)--}}
    <div id="app"></div>
{{--    @yield('content')--}}
    </body>
</html>

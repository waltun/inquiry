<!doctype html>
<html lang="fa-IR" dir="rtl" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('meta')

    <title>پنل مشتریان تهویه آذرباد</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{ $css ?? '' }}

    <style>
        [x-cloak] {
            display: none;
        }
    </style>
</head>
<body class="font-IRANSans bg-gray-50">

<x-clients.header />

<div class="my-6 mx-10">
    {{ $slot }}
</div>

<script src="{{ asset('js/app.js') }}"></script>
{{ $js ?? '' }}
@include('sweetalert::alert')
</body>
</html>

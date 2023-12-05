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

Main panel

<script>
    let sidebar = document.getElementById('sidebar');
    let menuIcon = document.getElementById('menu-icon');
    let closeIcon = document.getElementById('close-icon');
    let layout = document.getElementById('layout');

    menuIcon.addEventListener('click', function () {
        sidebar.classList.remove('w-0');
        sidebar.classList.add('w-72');
        layout.classList.add('pr-72');
        menuIcon.classList.add('hidden');
        closeIcon.classList.remove('hidden');
    });

    closeIcon.addEventListener('click', function () {
        sidebar.classList.add('w-0');
        sidebar.classList.remove('w-72');
        layout.classList.remove('pr-72');
        menuIcon.classList.remove('hidden');
        closeIcon.classList.add('hidden');
    });
</script>

<script src="{{ asset('js/app.js') }}"></script>
{{ $js ?? '' }}
@include('sweetalert::alert')
</body>
</html>

<!doctype html>
<html lang="fa-IR" dir="rtl" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('meta')

    <title>پنل استعلام قیمت تهویه آذرباد</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{ $css ?? '' }}

    <style>
        [x-cloak] {
            display: none;
        }
    </style>

    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="font-IRANSans bg-gray-50 dark:bg-slate-800">
<!-- Sidebar -->
<x-aside/>

<div class="flex flex-col" id="layout">
    <!-- Header -->
    <x-header/>

    <!-- Main -->
    <main>
        <div class="md:px-16 py-4 px-4">
            {{ $slot }}
        </div>
    </main>
</div>

<script>
    let darkIcon = document.getElementById('dark-icon');
    let lightIcon = document.getElementById('light-icon');
    let toggleDarkBtn = document.getElementById('toggleDarkBtn');

    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        lightIcon.classList.remove('hidden');
    } else {
        darkIcon.classList.remove('hidden');
    }

    toggleDarkBtn.addEventListener('click', function () {
        darkIcon.classList.toggle('hidden');
        lightIcon.classList.toggle('hidden');

        if (localStorage.getItem('color-theme')) {
            if (localStorage.getItem('color-theme') === 'light') {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            }
        } else {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        }
    });
</script>

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

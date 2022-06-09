<!doctype html>
<html lang="fa-IR" dir="rtl" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>استعلام</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{ $css ?? '' }}

    <style>
        [x-cloak] {
            display: none;
        }
    </style>
</head>
<body class="font-IRANSans bg-gray-50">

<!-- Overlay on mobile menu -->
<div id="overlay" class="hidden w-full h-full fixed right-0 top-0 bg-gray-900 bg-opacity-50 z-50"></div>

<!-- Sidebar -->
<x-aside/>

<div class="flex flex-col md:pr-64">
    <!-- Header -->
    <x-header/>

    <!-- Main -->
    <main>
        <div class="p-4">
            {{ $slot }}
        </div>
    </main>
</div>

<script>
    //Fullscreen
    function toggleFullScreen() {
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen();
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            }
        }
    }

    //Open & Close Mobile Menu
    const sidebar = document.getElementById('sidebar'),
        sidebarCloseIcon = document.getElementById('sidebar-close-icon'),
        sidebarOpenIcon = document.getElementById('sidebar-open-icon'),
        overlay = document.getElementById('overlay');

    function openSidebar() {
        sidebar.classList.add('absolute', 'z-50', 'flex', 'flex-row-reverse');
        sidebar.classList.remove('hidden');

        sidebarCloseIcon.classList.remove('hidden');
        sidebarCloseIcon.classList.add('flex');

        document.body.classList.add('overflow-hidden');

        overlay.classList.remove('hidden');
    }

    function closeSidebar() {
        sidebar.classList.remove('absolute', 'z-50', 'flex', 'flex-row-reverse');
        sidebar.classList.add('hidden');

        sidebarCloseIcon.classList.add('hidden');
        sidebarCloseIcon.classList.remove('flex');

        document.body.classList.remove('overflow-hidden');

        overlay.classList.add('hidden');
    }

    sidebarOpenIcon.addEventListener('click', () => openSidebar());
    sidebarCloseIcon.addEventListener('click', () => closeSidebar());
    overlay.addEventListener('click', () => closeSidebar());
    window.addEventListener('resize', () => closeSidebar());

</script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="//unpkg.com/alpinejs" defer></script>
{{ $js ?? '' }}
@include('sweetalert::alert')
</body>
</html>

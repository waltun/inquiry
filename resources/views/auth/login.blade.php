<!doctype html>
<html lang="fa-IR" dir="rtl" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ورود به پنل استعلام</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="font-IRANSans bg-gray-50">

<div class="mb-8">
    <img src="{{ asset('images/azarbad.png') }}" alt="" class="mx-auto w-64">
    <div class="mt-4">
        <p class="text-xl font-bold text-black text-center">
            ورود به بخش استعلام قیمت تهویه آذرباد
        </p>
    </div>
</div>

<div class="max-w-xl mx-auto rounded-md border border-gray-200 shadow-sm mt-10 p-4 bg-white">
    @if(Session::has('session-error'))
        <div class="mt-4 bg-red-500 px-4 py-2 rounded-md">
            <p class="text-sm font-bold text-white">
                {{ Session::get('session-error') }}
            </p>
        </div>
    @endif

    <form action="{{ route('login.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="inputPhone" class="block mb-2 text-sm font-bold text-black">
                شماره تماس
            </label>
            <input type="number" name="phone" id="inputPhone"
                   class="input-text" placeholder="مثال : 09123456789 (11 رقم)">
        </div>

        <div class="mt-4">
            <button type="submit" class="bg-green-500 px-6 py-2 rounded-md text-white text-sm">
                ارسال کد
            </button>
        </div>
    </form>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

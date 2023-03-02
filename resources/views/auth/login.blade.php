<!doctype html>
<html lang="fa-IR" dir="rtl" class="scroll-smooth h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ورود به تهویه آذرباد</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="font-IRANSans bg-gray-50 h-full">

<div class="flex min-h-full items-center justify-center">
    <div class="border border-gray-400 rounded-lg p-8 w-full max-w-xl mx-auto shadow-lg">
        <div class="mb-8">
            <img src="{{ asset('images/azarbad.png') }}" alt="" class="mx-auto w-64">
            <div class="mt-4">
                <p class="text-xl font-bold text-black text-center">
                    ورود به وب سایت شرکت تهویه آذرباد
                </p>
            </div>
        </div>

        <div class="mb-4">
            <x-errors/>
        </div>

        @if(Session::has('session-error'))
            <div class="mt-4 bg-red-500 px-4 py-2 rounded-md">
                <p class="text-sm font-bold text-white">
                    {{ Session::get('session-error') }}
                </p>
            </div>
        @endif

        <div class="rounded-md border border-gray-200 shadow-sm p-4 bg-white">
            <form action="{{ route('login.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="inputPhone" class="block mb-2 text-sm font-bold text-black">
                        شماره تماس
                    </label>
                    <input type="number" name="phone" id="inputPhone"
                           class="input-text text-center" placeholder="مثال : 09123456789 (11 رقم)" autofocus>
                </div>

                <div class="mt-4">
                    <button type="submit" class="bg-green-500 px-6 py-2 rounded-md text-white text-sm">
                        ارسال کد
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

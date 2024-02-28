<!doctype html>
<html lang="fa-IR" dir="rtl" class="scroll-smooth h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ورود به سامانه جامع شرکت تهویه آذرباد</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="font-IRANSans bg-gray-50 h-full">

<div class="flex min-h-full items-center justify-center">
    <div class="border border-gray-400 rounded-lg p-8 w-full max-w-xl md:mx-auto mx-4 shadow-lg">
        <div class="mb-8">
            <img src="{{ asset('images/azarbad.png') }}" alt="" class="mx-auto w-64">
            <div class="mt-4">
                <p class="md:text-xl text-lg font-bold text-black text-center">
                    ورود به سامانه جامع شرکت تهویه آذرباد
                </p>
            </div>
        </div>

        <div class="mb-4">
            <x-errors/>
        </div>

        @if(Session::has('code-error'))
            <div class="mb-4 bg-red-500 px-4 py-2 rounded-md">
                <p class="text-sm font-bold text-white">
                    {{ Session::get('code-error') }}
                </p>
            </div>
        @endif

        @if(Session::has('success-login'))
            <div class="my-4 bg-green-500 px-4 py-2 rounded-md">
                <p class="text-sm font-bold text-white text-center">
                    {{ Session::get('success-login') }}
                </p>
            </div>
        @endif

        <div class="rounded-md border border-gray-200 shadow-sm p-4 bg-white">

            <form action="{{ route('login.phone.store') }}" method="POST" name="loginCode">
                @csrf

                <div class="mb-4">
                    <label for="inputCode1" class="block mb-2 text-sm font-bold text-black">
                        کد ارسال شده
                    </label>
                    <div class="flex items-center space-x-4 space-x-reverse justify-center">
                        <input type="number" id="inputCode4" name="code4" class="input-text w-12 h-12 text-center"
                               placeholder="4" onkeyup="autotab(this,document.loginCode.inputName)">
                        <input type="number" id="inputCode3" name="code3" class="input-text w-12 h-12 text-center"
                               placeholder="3" maxlength="1" onkeyup="autotab(this,document.loginCode.inputCode4)">
                        <input type="number" id="inputCode2" name="code2" class="input-text w-12 h-12 text-center"
                               placeholder="2" maxlength="1" onkeyup="autotab(this,document.loginCode.inputCode3)">
                        <input type="number" id="inputCode1" name="code1" class="input-text w-12 h-12 text-center"
                               placeholder="1" maxlength="1" onkeyup="autotab(this,document.loginCode.inputCode2)"
                               autofocus>
                    </div>
                </div>

                <div class="mt-4 flex items-center space-x-4 space-x-reverse">
                    <button type="submit" class="bg-green-500 px-6 py-2 rounded-md text-white text-sm"
                            id="register-button">
                        بررسی کد
                    </button>
{{--                    <p class="text-xs text-indigo-500 font-bold" id="timer-section">--}}
{{--                        اعتبار کد ارسال شده : <span id="expired">02:00</span>--}}
{{--                    </p>--}}
{{--                    <button class="text-xs text-indigo-500 font-bold hidden" type="button" id="resend-button"--}}
{{--                            onclick="resendCode()">--}}
{{--                        ارسال دوباره--}}
{{--                    </button>--}}
                </div>
            </form>
{{--            <form action="{{ route('login.store') }}" method="post" id="resend-form">--}}
{{--                @csrf--}}
{{--                <input type="hidden" name="phone" value="{{ session()->get('phone') }}">--}}
{{--            </form>--}}
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>

<script>
    function autotab(original, destination) {
        if (original.getAttribute && original.value.length == original.getAttribute("maxlength"))
            destination.focus()
    }
</script>

{{--<script>--}}
{{--    let registerBtn = document.getElementById("register-button");--}}
{{--    let timerSection = document.getElementById('timer-section');--}}
{{--    let resendButton = document.getElementById('resend-button');--}}

{{--    let timer = setInterval(function () {--}}
{{--        let now = new Date().getTime();--}}
{{--        let distance = '{{ $expiredTime }}' - now;--}}

{{--        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));--}}
{{--        let seconds = Math.floor((distance % (1000 * 60)) / 1000);--}}

{{--        if (seconds <= 9) {--}}
{{--            document.getElementById("expired").innerHTML = "0" + minutes + ":" + "0" + seconds;--}}
{{--        } else {--}}
{{--            document.getElementById("expired").innerHTML = "0" + minutes + ":" + seconds;--}}
{{--        }--}}

{{--        if (distance < 0) {--}}
{{--            clearInterval(timer);--}}
{{--            document.getElementById("expired").innerHTML = "00:00";--}}
{{--            registerBtn.classList.remove('bg-green-500');--}}
{{--            registerBtn.classList.add('bg-gray-500');--}}
{{--            registerBtn.classList.add('cursor-not-allowed');--}}
{{--            registerBtn.setAttribute('disabled', 'disabled');--}}

{{--            timerSection.remove();--}}

{{--            resendButton.classList.remove('hidden');--}}
{{--        }--}}
{{--    }, 1000);--}}
{{--</script>--}}
{{--<script>--}}
{{--    function resendCode() {--}}
{{--        let resendForm = document.getElementById('resend-form');--}}

{{--        resendForm.submit();--}}
{{--    }--}}
{{--</script>--}}

</body>
</html>

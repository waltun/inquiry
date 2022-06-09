<!doctype html>
<html lang="en" class="h-full bg-gray-50" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ورود به بخش استعلام قیمت</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="h-full font-IRANSans">
<div class="flex justify-center items-center py-12 min-h-full">
    <div class="max-w-md w-full space-y-6 bg-white p-4 rounded-md shadow border border-gray-200">
        <div>
            <x-errors/>
        </div>
        @if(Session::has('register'))
            <div class="bg-green-500 p-4 rounded-md text-white font-bold">
                ثبت نام شما با موفقیت انجام شد و پس از تایید توسط مدیریت می توانید وارد شوید.
            </div>
        @endif
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-green-600" fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
            <h2 class="mt-6 text-center md:text-2xl md:font-extrabold text-lg font-bold text-gray-900">
                ورود به بخش استعلام قیمت
            </h2>
        </div>
        <form class="mt-8 space-y-6" action="{{ route('login.store') }}" method="POST">
            @csrf
            <input type="hidden" name="remember" value="true">
            <div class="rounded-md shadow-sm -space-y-px">
                <div class="mb-4">
                    <label for="inputPhone" class="text-sm text-black font-bold mb-2 block">شماره تماس</label>
                    <input id="inputPhone" name="phone" type="number" class="input-text"
                           placeholder="شماره تماس خود را وارد کنید" value="{{ old('phone') }}">
                </div>
                <div>
                    <label for="inputPassword" class="text-sm text-black font-bold mb-2 block">رمز عبور</label>
                    <input id="inputPassword" name="password" type="password" class="input-text"
                           placeholder="رمز عبور خود را وارد کنید">
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="inputRemember" name="remember" type="checkbox"
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="inputRemember" class="mr-2 block text-sm text-gray-900">
                        مرا به خاطر بسپار
                    </label>
                </div>

                <div class="text-sm">
                    <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                        ثبت نام در بخش استعلام
                    </a>
                </div>
            </div>

            <div>
                <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  <span class="absolute right-0 inset-y-0 flex items-center pr-3">
                        <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400"
                             xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                          <path fill-rule="evenodd"
                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                clip-rule="evenodd"/>
                        </svg>
                  </span>
                    ورود
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>

<!doctype html>
<html lang="fa" class="h-full bg-gray-50" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ثبت نام در سامانه جامع شرکت تهویه آذرباد</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="h-full font-IRANSans">
<div class="flex justify-center items-center py-12 min-h-full">
    <div class="md:max-w-xl max-w-md w-full space-y-4 bg-white p-4 rounded-md shadow border border-gray-200">
        <div>
            <x-errors/>
        </div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-green-600" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/>
            </svg>
            <h2 class="mt-6 text-center md:text-2xl md:font-extrabold text-lg font-bold text-gray-900">
                ثبت نام در سامانه جامع شرکت تهویه آذرباد
            </h2>
        </div>
        <form class="mt-8 space-y-6" action="{{ route('register.sore') }}" method="POST">
            @csrf
            <input type="hidden" name="role" value="user">

            <div class="md:grid grid-cols-2 gap-4">
                <div class="mb-4 md:mb-0">
                    <label for="inputName" class="text-sm text-black font-bold mb-2 block">نام و نام خانوادگی</label>
                    <input id="inputName" name="name" type="text" class="input-text"
                           placeholder="مثال : علی محمدی" value="{{ old('name') }}">
                </div>
                <div class="mb-4 md:mb-0">
                    <label for="inputEmail" class="text-sm text-black font-bold mb-2 block">ایمیل</label>
                    <input id="inputEmail" name="email" type="email" class="input-text"
                           placeholder="مثال : example@gmail.com" value="{{ old('email') }}">
                </div>

                <div class="mb-4 md:mb-0">
                    <label for="inputPhone" class="text-sm text-black font-bold mb-2 block">شماره تماس</label>
                    <input id="inputPhone" name="phone" type="number" class="input-text"
                           placeholder="مثال : 09123456789" value="{{ old('phone') }}">
                </div>
                <div class="mb-4 md:mb-0">
                    <label for="inputNation" class="text-sm text-black font-bold mb-2 block">کد ملی</label>
                    <input id="inputNation" name="nation" type="text" class="input-text"
                           placeholder="مثال : 0123456789" value="{{ old('nation') }}">
                </div>

                <div class="mb-4 md:mb-0">
                    <label for="inputPassword" class="text-sm text-black font-bold mb-2 block">رمز عبور</label>
                    <input id="inputPassword" name="password" type="password" class="input-text"
                           placeholder="حداقل شامل 8 حرف یا عدد">
                </div>
                <div class="mb-4 md:mb-0">
                    <label for="inputPasswordConfirm" class="text-sm text-black font-bold mb-2 block">تکرار رمز
                        عبور</label>
                    <input id="inputPasswordConfirm" name="password_confirmation" type="password" class="input-text"
                           placeholder="حداقل شامل 8 حرف یا عدد">
                </div>

                <div class="mb-4 md:mb-0">
                    <label for="inputGender" class="text-sm text-black font-bold mb-2 block">جنسیت</label>
                    <select name="gender" id="inputGender" class="input-text">
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>مرد</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>زن</option>
                    </select>
                </div>
            </div>

            <div class="mb-4 md:mb-0">
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
                    ثبت نام
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>

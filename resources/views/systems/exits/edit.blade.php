<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/date-picker/persianDatepicker.min.js') }}"></script>
        <script>
            $("#inputExitAt").persianDatepicker({
                format: 'Y/m/d'
            });
        </script>
        <script>
            function showMission(event) {
                let value = event.target.value;
                let missionSection = document.getElementById('missionSection');

                if (value === 'personal') {
                    missionSection.classList.add('hidden');
                }

                if (value === 'mission') {
                    missionSection.classList.remove('hidden');
                }
            }
        </script>
    </x-slot>
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('plugins/date-picker/persianDatepicker-default.css') }}">
    </x-slot>

    <!-- Breadcrumb -->
    <div class="flex items-center space-x-2 space-x-reverse">
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    داشبورد
                </p>
            </div>
        </a>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                 class="breadcrumb-svg-arrow">
                <path fill-rule="evenodd"
                      d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                      clip-rule="evenodd"/>
            </svg>
        </div>
        <a href="{{ route('exits.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    مدیریت خروج موقت کالاها
                </p>
            </div>
        </a>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                 class="breadcrumb-svg-arrow">
                <path fill-rule="evenodd"
                      d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                      clip-rule="evenodd"/>
            </svg>
        </div>
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg-active">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    ویرایش خروج موقت
                </p>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('exits.update', $exit->id) }}" class="md:grid grid-cols-2 gap-4 mt-4">
        @csrf
        @method('PATCH')

        <div class="card">
            <div class="card-header">
                <p class="card-title">
                    مشخصات کلی
                </p>
            </div>

            <div class="mb-4">
                <label for="inputNumber" class="form-label">شماره سند</label>
                <input type="text" id="inputNumber" name="number" class="input-text"
                       placeholder="شماره سند" value="{{ old('number', $exit->number) }}">
            </div>

            <div class="mb-4">
                <label for="inputExitAt" class="form-label">تاریخ خروج</label>
                <input type="text" id="inputExitAt" name="exit_at" class="input-text"
                       placeholder="برای انتخاب تاریخ کلیک کنید" value="{{ old('exit_at', $date) }}">
            </div>

            <div class="mb-4">
                <label for="inputExiter" class="form-label">خارج کننده</label>
                <input type="text" id="inputExiter" name="exiter" class="input-text" placeholder="نام خارج کننده کالا" value="{{ old('exiter', $exit->exiter) }}">
            </div>
            <div class="mb-4">
                <label for="inputCarNumber" class="form-label">شماره خودرو</label>
                <input type="text" id="inputCarNumber" name="car_number" class="input-text" placeholder="شماره خودرو خارج کننده" value="{{ old('car_number', $exit->car_number) }}">
            </div>
            <div class="mb-4">
                <label for="inputPhone" class="form-label">شماره تلفن و آدرس</label>
                <input type="text" id="inputPhone" name="phone" class="input-text" placeholder="شماره تلفن و آدرس" value="{{ old('phone', $exit->phone) }}">
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    خروج کالاها
                </div>
            </div>

            <div class="mb-4">
                <label for="inputType" class="form-label">نوع خروج</label>
                <select name="type" id="inputType" class="input-text" onchange="showMission(event)">
                    <option value="">انتخاب کنید</option>
                    <option value="personal" {{ old('type', $exit->type) == 'personal' ? 'selected' : '' }}>
                        استفاده شخصی (امانت)
                    </option>
                    <option value="mission" {{ old('type', $exit->type) == 'mission' ? 'selected' : '' }}>
                        ماموریت
                    </option>
                </select>
            </div>

            <div class="{{ $exit->type == 'personal' ? 'hidden' : '' }}" id="missionSection">
                <div class="mt-4">
                    <label for="inputMissionLocation" class="form-label">محل ماموریت</label>
                    <input type="text" id="inputMissionLocation" name="mission_location" class="input-text" placeholder="محل ماموریت را وارد کنید"
                           value="{{ old('mission_location', $exit->mission_location) }}">
                </div>
                <div class="mt-4">
                    <label for="inputMissionReason" class="form-label">علت ماموریت</label>
                    <input type="text" id="inputMissionReason" name="mission_reason" class="input-text" placeholder="محل ماموریت را وارد کنید"
                           value="{{ old('mission_reason', $exit->mission_reason) }}">
                </div>
                <div class="mt-4">
                    <label for="inputMissionUsers" class="form-label">اشخاص اعزامی به ماموریت</label>
                    <input type="text" id="inputMissionUsers" name="mission_users" class="input-text" placeholder="افراد اعزامی را تایپ کنید" value="{{ old('mission_users', $exit->mission_users) }}">
                </div>
            </div>
        </div>

        <div class="flex items-center space-x-4 space-x-reverse">
            <button type="submit" class="form-edit-btn" id="submit-button">
                بروزرسانی خروج موقت
            </button>
            <a href="{{ route('exits.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>

<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/date-picker/persianDatepicker.min.js') }}"></script>
        <script>
            $("#inputStartDate").persianDatepicker({
                format: 'Y/m/d'
            });
            $("#inputEndDate").persianDatepicker({
                format: 'Y/m/d'
            })

            function showSections() {
                let type = document.getElementById('inputType').value;
                let startDate = document.getElementById('startDateSection');
                let endDate = document.getElementById('endDateSection');
                let startHour = document.getElementById('startHourSection');
                let endHour = document.getElementById('endHourSection');

                if (type === 'daily') {
                    startDate.classList.remove('hidden');
                    endDate.classList.remove('hidden');
                    startHour.classList.add('hidden');
                    endHour.classList.add('hidden');
                }

                if (type === 'hourly') {
                    startDate.classList.remove('hidden');
                    startHour.classList.remove('hidden');
                    endHour.classList.remove('hidden');
                    endDate.classList.add('hidden');
                }

                if (type === '') {
                    startDate.classList.add('hidden');
                    endDate.classList.add('hidden');
                    startHour.classList.add('hidden');
                    endHour.classList.add('hidden');
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
        <a href="{{ route('leaves.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    مدیریت مرخصی ها
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
                    ایجاد مرخصی جدید
                </p>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('leaves.store') }}" class="md:grid grid-cols-2 gap-4 mt-4">
        @csrf

        <div class="card">
            <div class="card-header">
                <p class="card-title">مشخصات کلی</p>
            </div>

            <div class="mt-4">
                <label for="inputType" class="form-label">نوع مرخصی</label>
                <select name="type" id="inputType" class="input-text" onchange="showSections()">
                    <option value="">انتخاب کنید</option>
                    <option value="daily">مرخصی روزانه</option>
                    <option value="hourly">مرخصی ساعتی</option>
                </select>
            </div>

            <div class="mt-4 hidden" id="startDateSection">
                <label for="inputStartDate" class="form-label">از تاریخ</label>
                <input type="text" id="inputStartDate" name="start_date" class="input-text"
                       placeholder="برای انتخاب تاریخ کلیک کنید" value="{{ old('start_date') }}">
            </div>

            <div class="mt-4 hidden" id="endDateSection">
                <label for="inputEndDate" class="form-label">تا تاریخ</label>
                <input type="text" id="inputEndDate" name="end_date" class="input-text"
                       placeholder="برای انتخاب تاریخ کلیک کنید" value="{{ old('end_date') }}">
            </div>

            <div class="mt-4 hidden" id="startHourSection">
                <label for="inputStartHour" class="form-label">ساعت شروع</label>
                <input type="number" id="inputStartHour" name="start_hour" class="input-text"
                       placeholder="ساعت را به عدد وارد کنید" value="{{ old('start_hour') }}">
            </div>

            <div class="mt-4 hidden" id="endHourSection">
                <label for="inputEndHour" class="form-label">ساعت خاتمه</label>
                <input type="number" id="inputEndHour" name="end_hour" class="input-text"
                       placeholder="ساعت را به عدد وارد کنید" value="{{ old('end_hour') }}">
            </div>

        </div>

        <div class="card">
            <div class="card-header">
                <p class="card-title">علت مرخصی</p>
            </div>

            <div class="mt-4">
                <label for="inputDescription" class="form-label">دلیل مرخصی</label>
                <textarea name="description" id="inputDescription"
                          class="input-text resize-none h-32">{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="flex items-center space-x-4 space-x-reverse">
            <button type="submit" class="form-submit-btn" id="submit-button">
                ثبت درخواست مرخصی
            </button>
            <a href="{{ route('leaves.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>

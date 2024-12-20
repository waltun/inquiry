<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script>
            function getCategory1() {
                let id = document.getElementById('inputCoilCategory').value;
                let section = document.getElementById('categorySection1');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('parts.getCategory') }}',
                    data: {
                        id: id,
                    },
                    success: function (res) {
                        if (res.data != null) {
                            section.innerHTML = `
                            <select class="input-text" onchange="getCategory2()" id="inputCategory2" name="categories[]">
                                <option value="">انتخاب کنید</option>
                                    ${
                                res.data.map(function (category) {
                                    return `<option value="${category.id}">${category.name}</option>`
                                })
                            }
                            </select>`
                        }
                    }
                });
            }

            function getCategory2() {
                let id = document.getElementById('inputCategory2').value;
                let section = document.getElementById('categorySection2');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('parts.getCategory') }}',
                    data: {
                        id: id,
                    },
                    success: function (res) {
                        if (res.data != null) {
                            section.innerHTML = `
                            <select class="input-text" name="categories[]" id="inputCategory3">
                                <option value="">انتخاب کنید</option>
                                    ${
                                res.data.map(function (category) {
                                    return `<option value="${category.id}">${category.name}</option>`
                                })
                            }
                            </select>`;
                        }
                    }
                });
            }
        </script>
        <script>
            function checkSpacer() {
                let spacer = document.getElementById('inputSpacer');
                let cap = document.getElementById('inputCap');

                if (spacer.value > 0) {
                    cap.setAttribute('disabled', 'disabled');
                }
                if (spacer.value === '0') {
                    cap.removeAttribute('disabled');
                }
            }

            function checkCap() {
                let cap = document.getElementById('inputCap');
                let spacer = document.getElementById('inputSpacer');

                if (cap.value > 0) {
                    spacer.setAttribute('disabled', 'disabled');
                }
                if (cap.value === '0') {
                    spacer.removeAttribute('disabled');
                }
            }
        </script>
    </x-slot>

    <!-- Breadcrumb -->
    <div class="flex items-center space-x-2 space-x-reverse whitespace-nowrap">
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
        <a href="{{ route('contracts.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    قراردادها
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
        <a href="{{ route('contracts.show', $contract->id) }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    قرارداد {{ $contract->name }} - {{ $contract->number }}
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
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    محاسبه قیمت کندانسور آبی پوسته لوله
                </p>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    @php
        $values = Session::get('values');
        $selectedParts = Session::get('selectedParts');
        $inputs = Session::get('inputs');
        $name = Session::get('name');
    @endphp

    <form method="POST" action="{{ route('contracts.calculateCondensorConverter', $contract->id) }}">
        @csrf
        <div class="my-4">
            <div class="bg-white rounded-md shadow-md border border-gray-200 py-4 px-6">
                <div class="mb-4 border-b border-gray-300 pb-3 flex justify-between items-center">
                    <div>
                        <p class="text-lg text-black">
                            اطلاعات ورودی {{ $part->name }}
                        </p>
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-4">
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputLooleMessi">لوله مسی کندانسور</label>
                        <select name="loole_messi" id="inputLooleMessi" class="input-text bg-sky-100">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::find('1324')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi') == '1324' ? 'selected' : '') : ($inputs['loole_messi'] == "1324" ? 'selected' : (old('loole_messi') == '1324' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1324')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('78')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi') == '78' ? 'selected' : '') : ($inputs['loole_messi'] == "78" ? 'selected' : (old('loole_messi') == '78' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('78')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('79')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi') == '79' ? 'selected' : '') : ($inputs['loole_messi'] == "79" ? 'selected' : (old('loole_messi') == '79' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('79')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1325')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi') == '1325' ? 'selected' : '') : ($inputs['loole_messi'] == "1325" ? 'selected' : (old('loole_messi') == '1325' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1325')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1326')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi') == '1326' ? 'selected' : '') : ($inputs['loole_messi'] == "1326" ? 'selected' : (old('loole_messi') == '1326' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1326')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1327')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi') == '1327' ? 'selected' : '') : ($inputs['loole_messi'] == "1327" ? 'selected' : (old('loole_messi') == '1327' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1327')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1882')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi') == '1882' ? 'selected' : '') : ($inputs['loole_messi'] == "1882" ? 'selected' : (old('loole_messi') == '1882' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1882')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('10181')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi') == '10181' ? 'selected' : '') : ($inputs['loole_messi'] == "10181" ? 'selected' : (old('loole_messi') == '10181' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('10181')->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputLooleMessiSucshen">
                            لوله مسی خط دیسشارژ
                        </label>
                        <select name="loole_messi_sucshen" id="inputLooleMessiSucshen" class="input-text bg-sky-100">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::find('77')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi_sucshen') == '77' ? 'selected' : '') : ($inputs['loole_messi_sucshen'] == "77" ? 'selected' : (old('loole_messi_sucshen') == '77' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('77')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('78')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi_sucshen') == '78' ? 'selected' : '') : ($inputs['loole_messi_sucshen'] == "78" ? 'selected' : (old('loole_messi_sucshen') == '78' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('78')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('79')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi_sucshen') == '79' ? 'selected' : '') : ($inputs['loole_messi_sucshen'] == "79" ? 'selected' : (old('loole_messi_sucshen') == '79' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('79')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('80')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi_sucshen') == '80' ? 'selected' : '') : ($inputs['loole_messi_sucshen'] == "80" ? 'selected' : (old('loole_messi_sucshen') == '80' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('80')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('81')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi_sucshen') == '81' ? 'selected' : '') : ($inputs['loole_messi_sucshen'] == "81" ? 'selected' : (old('loole_messi_sucshen') == '81' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('81')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('82')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi_sucshen') == '82' ? 'selected' : '') : ($inputs['loole_messi_sucshen'] == "82" ? 'selected' : (old('loole_messi_sucshen') == '82' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('82')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('83')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi_sucshen') == '83' ? 'selected' : '') : ($inputs['loole_messi_sucshen'] == "83" ? 'selected' : (old('loole_messi_sucshen') == '83' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('83')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('84')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi_sucshen') == '84' ? 'selected' : '') : ($inputs['loole_messi_sucshen'] == "84" ? 'selected' : (old('loole_messi_sucshen') == '84' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('84')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('85')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi_sucshen') == '85' ? 'selected' : '') : ($inputs['loole_messi_sucshen'] == "85" ? 'selected' : (old('loole_messi_sucshen') == '85' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('85')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('86')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi_sucshen') == '86' ? 'selected' : '') : ($inputs['loole_messi_sucshen'] == "86" ? 'selected' : (old('loole_messi_sucshen') == '86' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('86')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('87')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi_sucshen') == '87' ? 'selected' : '') : ($inputs['loole_messi_sucshen'] == "87" ? 'selected' : (old('loole_messi_sucshen') == '87' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('87')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('88')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi_sucshen') == '88' ? 'selected' : '') : ($inputs['loole_messi_sucshen'] == "88" ? 'selected' : (old('loole_messi_sucshen') == '88' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('88')->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputLooleMessiMaye">لوله مسی خط مایع</label>
                        <select name="loole_messi_maye" id="inputLooleMessiMaye" class="input-text bg-sky-100">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::find('77')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi_maye') == '77' ? 'selected' : '') : ($inputs['loole_messi_maye'] == "77" ? 'selected' : (old('loole_messi_maye') == '77' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('77')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('78')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi_maye') == '78' ? 'selected' : '') : ($inputs['loole_messi_maye'] == "78" ? 'selected' : (old('loole_messi_maye') == '78' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('78')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('79')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi_maye') == '79' ? 'selected' : '') : ($inputs['loole_messi_maye'] == "79" ? 'selected' : (old('loole_messi_maye') == '79' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('79')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('80')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi_maye') == '80' ? 'selected' : '') : ($inputs['loole_messi_maye'] == "80" ? 'selected' : (old('loole_messi_maye') == '80' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('80')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('81')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi_maye') == '81' ? 'selected' : '') : ($inputs['loole_messi_maye'] == "81" ? 'selected' : (old('loole_messi_maye') == '81' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('81')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('82')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi_maye') == '82' ? 'selected' : '') : ($inputs['loole_messi_maye'] == "82" ? 'selected' : (old('loole_messi_maye') == '82' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('82')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('83')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi_maye') == '83' ? 'selected' : '') : ($inputs['loole_messi_maye'] == "83" ? 'selected' : (old('loole_messi_maye') == '83' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('83')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('84')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi_maye') == '84' ? 'selected' : '') : ($inputs['loole_messi_maye'] == "84" ? 'selected' : (old('loole_messi_maye') == '84' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('84')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('85')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi_maye') == '85' ? 'selected' : '') : ($inputs['loole_messi_maye'] == "85" ? 'selected' : (old('loole_messi_maye') == '85' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('85')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('86')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi_maye') == '86' ? 'selected' : '') : ($inputs['loole_messi_maye'] == "86" ? 'selected' : (old('loole_messi_maye') == '86' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('86')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('87')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi_maye') == '87' ? 'selected' : '') : ($inputs['loole_messi_maye'] == "87" ? 'selected' : (old('loole_messi_maye') == '87' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('87')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('88')->id }}"
                                {{ is_null($inputs) ? (old('loole_messi_maye') == '88' ? 'selected' : '') : ($inputs['loole_messi_maye'] == "88" ? 'selected' : (old('loole_messi_maye') == '88' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('88')->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputSizeLoolePooste">سایز لوله پوسته</label>
                        <select name="size_loole_pooste" id="inputSizeLoolePooste" class="input-text bg-sky-100">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::find('975')->id }}"
                                {{ is_null($inputs) ? (old('size_loole_pooste') == '975' ? 'selected' : '') : ($inputs['size_loole_pooste'] == "975" ? 'selected' : (old('size_loole_pooste') == '975' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('975')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('976')->id }}"
                                {{ is_null($inputs) ? (old('size_loole_pooste') == '976' ? 'selected' : '') : ($inputs['size_loole_pooste'] == "976" ? 'selected' : (old('size_loole_pooste') == '976' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('976')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('977')->id }}"
                                {{ is_null($inputs) ? (old('size_loole_pooste') == '977' ? 'selected' : '') : ($inputs['size_loole_pooste'] == "977" ? 'selected' : (old('size_loole_pooste') == '977' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('977')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('978')->id }}"
                                {{ is_null($inputs) ? (old('size_loole_pooste') == '978' ? 'selected' : '') : ($inputs['size_loole_pooste'] == "978" ? 'selected' : (old('size_loole_pooste') == '978' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('978')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1098')->id }}"
                                {{ is_null($inputs) ? (old('size_loole_pooste') == '1098' ? 'selected' : '') : ($inputs['size_loole_pooste'] == "1098" ? 'selected' : (old('size_loole_pooste') == '1098' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1098')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1099')->id }}"
                                {{ is_null($inputs) ? (old('size_loole_pooste') == '1099' ? 'selected' : '') : ($inputs['size_loole_pooste'] == "1099" ? 'selected' : (old('size_loole_pooste') == '1099' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1099')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1100')->id }}"
                                {{ is_null($inputs) ? (old('size_loole_pooste') == '1100' ? 'selected' : '') : ($inputs['size_loole_pooste'] == "1100" ? 'selected' : (old('size_loole_pooste') == '1100' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1100')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1101')->id }}"
                                {{ is_null($inputs) ? (old('size_loole_pooste') == '1101' ? 'selected' : '') : ($inputs['size_loole_pooste'] == "1101" ? 'selected' : (old('size_loole_pooste') == '1101' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1101')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1102')->id }}"
                                {{ is_null($inputs) ? (old('size_loole_pooste') == '1102' ? 'selected' : '') : ($inputs['size_loole_pooste'] == "1102" ? 'selected' : (old('size_loole_pooste') == '1102' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1102')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1103')->id }}"
                                {{ is_null($inputs) ? (old('size_loole_pooste') == '1103' ? 'selected' : '') : ($inputs['size_loole_pooste'] == "1103" ? 'selected' : (old('size_loole_pooste') == '1103' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1103')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1104')->id }}"
                                {{ is_null($inputs) ? (old('size_loole_pooste') == '1104' ? 'selected' : '') : ($inputs['size_loole_pooste'] == "1104" ? 'selected' : (old('size_loole_pooste') == '1104' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1104')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1105')->id }}"
                                {{ is_null($inputs) ? (old('size_loole_pooste') == '1105' ? 'selected' : '') : ($inputs['size_loole_pooste'] == "1105" ? 'selected' : (old('size_loole_pooste') == '1105' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1105')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1106')->id }}"
                                {{ is_null($inputs) ? (old('size_loole_pooste') == '1106' ? 'selected' : '') : ($inputs['size_loole_pooste'] == "1106" ? 'selected' : (old('size_loole_pooste') == '1106' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1106')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1144')->id }}"
                                {{ is_null($inputs) ? (old('size_loole_pooste') == '1144' ? 'selected' : '') : ($inputs['size_loole_pooste'] == "1144" ? 'selected' : (old('size_loole_pooste') == '1144' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1144')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1145')->id }}"
                                {{ is_null($inputs) ? (old('size_loole_pooste') == '1145' ? 'selected' : '') : ($inputs['size_loole_pooste'] == "1145" ? 'selected' : (old('size_loole_pooste') == '1145' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1145')->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputPichoMohre">پیچ و مهره</label>
                        <select name="picho_mohre" id="inputPichoMohre" class="input-text bg-sky-100">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::find('10173')->id }}"
                                {{ is_null($inputs) ? (old('picho_mohre') == '10173' ? 'selected' : '') : ($inputs['picho_mohre'] == "10173" ? 'selected' : (old('picho_mohre') == '10173' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('10173')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('10172')->id }}"
                                {{ is_null($inputs) ? (old('picho_mohre') == '10172' ? 'selected' : '') : ($inputs['picho_mohre'] == "10172" ? 'selected' : (old('picho_mohre') == '10172' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('10172')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('10179')->id }}"
                                {{ is_null($inputs) ? (old('picho_mohre') == '10179' ? 'selected' : '') : ($inputs['picho_mohre'] == "10179" ? 'selected' : (old('picho_mohre') == '10179' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('10179')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('10178')->id }}"
                                {{ is_null($inputs) ? (old('picho_mohre') == '10178' ? 'selected' : '') : ($inputs['picho_mohre'] == "10178" ? 'selected' : (old('picho_mohre') == '10178' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('10178')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('10177')->id }}"
                                {{ is_null($inputs) ? (old('picho_mohre') == '10177' ? 'selected' : '') : ($inputs['picho_mohre'] == "10177" ? 'selected' : (old('picho_mohre') == '10177' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('10177')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('10176')->id }}"
                                {{ is_null($inputs) ? (old('picho_mohre') == '10176' ? 'selected' : '') : ($inputs['picho_mohre'] == "10176" ? 'selected' : (old('picho_mohre') == '10176' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('10176')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('10175')->id }}"
                                {{ is_null($inputs) ? (old('picho_mohre') == '10175' ? 'selected' : '') : ($inputs['picho_mohre'] == "10175" ? 'selected' : (old('picho_mohre') == '10175' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('10175')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('10174')->id }}"
                                {{ is_null($inputs) ? (old('picho_mohre') == '10174' ? 'selected' : '') : ($inputs['picho_mohre'] == "10174" ? 'selected' : (old('picho_mohre') == '10174' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('10174')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('10180')->id }}"
                                {{ is_null($inputs) ? (old('picho_mohre') == '10180' ? 'selected' : '') : ($inputs['picho_mohre'] == "10180" ? 'selected' : (old('picho_mohre') == '10180' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('10180')->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputBoshen">کانکشن خط دیسشارژ</label>
                        <select name="boshen1" id="inputBoshen" class="input-text bg-sky-100">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::find('10170')->id }}"
                                {{ is_null($inputs) ? (old('boshen1') == '10170' ? 'selected' : '') : ($inputs['boshen1'] == "10170" ? 'selected' : (old('boshen1') == '10170' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('10170')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('10171')->id }}"
                                {{ is_null($inputs) ? (old('boshen1') == '10171' ? 'selected' : '') : ($inputs['boshen1'] == "10171" ? 'selected' : (old('boshen1') == '10171' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('10171')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('5424')->id }}"
                                {{ is_null($inputs) ? (old('boshen1') == '5424' ? 'selected' : '') : ($inputs['boshen1'] == "5424" ? 'selected' : (old('boshen1') == '5424' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('5424')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('5425')->id }}"
                                {{ is_null($inputs) ? (old('boshen1') == '5425' ? 'selected' : '') : ($inputs['boshen1'] == "5425" ? 'selected' : (old('boshen1') == '5425' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('5425')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('5426')->id }}"
                                {{ is_null($inputs) ? (old('boshen1') == '5426' ? 'selected' : '') : ($inputs['boshen1'] == "5426" ? 'selected' : (old('boshen1') == '5426' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('5426')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('5427')->id }}"
                                {{ is_null($inputs) ? (old('boshen1') == '5427' ? 'selected' : '') : ($inputs['boshen1'] == "5427" ? 'selected' : (old('boshen1') == '5427' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('5427')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('5428')->id }}"
                                {{ is_null($inputs) ? (old('boshen1') == '5428' ? 'selected' : '') : ($inputs['boshen1'] == "5428" ? 'selected' : (old('boshen1') == '5428' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('5428')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('5429')->id }}"
                                {{ is_null($inputs) ? (old('boshen1') == '5429' ? 'selected' : '') : ($inputs['boshen1'] == "5429" ? 'selected' : (old('boshen1') == '5429' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('5429')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('5430')->id }}"
                                {{ is_null($inputs) ? (old('boshen1') == '5430' ? 'selected' : '') : ($inputs['boshen1'] == "5430" ? 'selected' : (old('boshen1') == '5430' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('5430')->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputBoshen2">کانکشن خط مایع</label>
                        <select name="boshen2" id="inputBoshen2" class="input-text bg-sky-100">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::find('10170')->id }}"
                                {{ is_null($inputs) ? (old('boshen1') == '10170' ? 'selected' : '') : ($inputs['boshen1'] == "10170" ? 'selected' : (old('boshen1') == '10170' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('10170')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('10171')->id }}"
                                {{ is_null($inputs) ? (old('boshen1') == '10171' ? 'selected' : '') : ($inputs['boshen1'] == "10171" ? 'selected' : (old('boshen1') == '10171' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('10171')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('5424')->id }}"
                                {{ is_null($inputs) ? (old('boshen2') == '5424' ? 'selected' : '') : ($inputs['boshen2'] == "5424" ? 'selected' : (old('boshen2') == '5424' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('5424')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('5425')->id }}"
                                {{ is_null($inputs) ? (old('boshen2') == '5425' ? 'selected' : '') : ($inputs['boshen2'] == "5425" ? 'selected' : (old('boshen2') == '5425' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('5425')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('5426')->id }}"
                                {{ is_null($inputs) ? (old('boshen2') == '5426' ? 'selected' : '') : ($inputs['boshen2'] == "5426" ? 'selected' : (old('boshen2') == '5426' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('5426')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('5427')->id }}"
                                {{ is_null($inputs) ? (old('boshen2') == '5427' ? 'selected' : '') : ($inputs['boshen2'] == "5427" ? 'selected' : (old('boshen2') == '5427' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('5427')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('5428')->id }}"
                                {{ is_null($inputs) ? (old('boshen2') == '5428' ? 'selected' : '') : ($inputs['boshen2'] == "5428" ? 'selected' : (old('boshen2') == '5428' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('5428')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('5429')->id }}"
                                {{ is_null($inputs) ? (old('boshen2') == '5429' ? 'selected' : '') : ($inputs['boshen2'] == "5429" ? 'selected' : (old('boshen2') == '5429' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('5429')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('5430')->id }}"
                                {{ is_null($inputs) ? (old('boshen2') == '5430' ? 'selected' : '') : ($inputs['boshen2'] == "5430" ? 'selected' : (old('boshen2') == '5430' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('5430')->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputSensor">
                            کانکشن شیر اطمینان و تخلیه
                        </label>
                        <select name="sensor" id="inputSensor" class="input-text bg-sky-100">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::find('995')->id }}"
                                {{ is_null($inputs) ? (old('sensor') == '995' ? 'selected' : '') : ($inputs['sensor'] == "995" ? 'selected' : (old('sensor') == '995' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('995')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1165')->id }}"
                                {{ is_null($inputs) ? (old('sensor') == '1165' ? 'selected' : '') : ($inputs['sensor'] == "1165" ? 'selected' : (old('sensor') == '1165' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1165')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1166')->id }}"
                                {{ is_null($inputs) ? (old('sensor') == '1166' ? 'selected' : '') : ($inputs['sensor'] == "1166" ? 'selected' : (old('sensor') == '1166' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1166')->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputNavdani">پایه</label>
                        <select name="navdani" id="inputNavdani" class="input-text bg-sky-100">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::find('302')->id }}"
                                {{ is_null($inputs) ? (old('navdani') == '302' ? 'selected' : '') : ($inputs['navdani'] == "302" ? 'selected' : (old('navdani') == '302' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('302')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('303')->id }}"
                                {{ is_null($inputs) ? (old('navdani') == '303' ? 'selected' : '') : ($inputs['navdani'] == "303" ? 'selected' : (old('navdani') == '303' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('303')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('304')->id }}"
                                {{ is_null($inputs) ? (old('navdani') == '304' ? 'selected' : '') : ($inputs['navdani'] == "304" ? 'selected' : (old('navdani') == '304' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('304')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('305')->id }}"
                                {{ is_null($inputs) ? (old('navdani') == '305' ? 'selected' : '') : ($inputs['navdani'] == "305" ? 'selected' : (old('navdani') == '305' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('305')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('306')->id }}"
                                {{ is_null($inputs) ? (old('navdani') == '306' ? 'selected' : '') : ($inputs['navdani'] == "306" ? 'selected' : (old('navdani') == '306' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('306')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('307')->id }}"
                                {{ is_null($inputs) ? (old('navdani') == '307' ? 'selected' : '') : ($inputs['navdani'] == "307" ? 'selected' : (old('navdani') == '307' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('307')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('308')->id }}"
                                {{ is_null($inputs) ? (old('navdani') == '308' ? 'selected' : '') : ($inputs['navdani'] == "308" ? 'selected' : (old('navdani') == '308' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('308')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('309')->id }}"
                                {{ is_null($inputs) ? (old('navdani') == '309' ? 'selected' : '') : ($inputs['navdani'] == "309" ? 'selected' : (old('navdani') == '309' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('309')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('9')->id }}"
                                {{ is_null($inputs) ? (old('navdani') == '9' ? 'selected' : '') : ($inputs['navdani'] == "9" ? 'selected' : (old('navdani') == '9' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('9')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('10')->id }}"
                                {{ is_null($inputs) ? (old('navdani') == '10' ? 'selected' : '') : ($inputs['navdani'] == "10" ? 'selected' : (old('navdani') == '10' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('10')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('11')->id }}"
                                {{ is_null($inputs) ? (old('navdani') == '11' ? 'selected' : '') : ($inputs['navdani'] == "11" ? 'selected' : (old('navdani') == '11' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('11')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('12')->id }}"
                                {{ is_null($inputs) ? (old('navdani') == '12' ? 'selected' : '') : ($inputs['navdani'] == "12" ? 'selected' : (old('navdani') == '12' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('12')->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputFlanch">فلنچ ورودی و خروجی</label>
                        <select name="flanch" id="inputFlanch" class="input-text bg-sky-100">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::find('1155')->id }}"
                                {{ is_null($inputs) ? (old('flanch') == '1155' ? 'selected' : '') : ($inputs['flanch'] == "1155" ? 'selected' : (old('flanch') == '1155' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1155')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1156')->id }}"
                                {{ is_null($inputs) ? (old('flanch') == '1156' ? 'selected' : '') : ($inputs['flanch'] == "1156" ? 'selected' : (old('flanch') == '1156' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1156')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1157')->id }}"
                                {{ is_null($inputs) ? (old('flanch') == '1157' ? 'selected' : '') : ($inputs['flanch'] == "1157" ? 'selected' : (old('flanch') == '1157' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1157')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1158')->id }}"
                                {{ is_null($inputs) ? (old('flanch') == '1158' ? 'selected' : '') : ($inputs['flanch'] == "1158" ? 'selected' : (old('flanch') == '1158' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1158')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1159')->id }}"
                                {{ is_null($inputs) ? (old('flanch') == '1159' ? 'selected' : '') : ($inputs['flanch'] == "1159" ? 'selected' : (old('flanch') == '1159' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1159')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1160')->id }}"
                                {{ is_null($inputs) ? (old('flanch') == '1160' ? 'selected' : '') : ($inputs['flanch'] == "1160" ? 'selected' : (old('flanch') == '1160' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1160')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1161')->id }}"
                                {{ is_null($inputs) ? (old('flanch') == '1161' ? 'selected' : '') : ($inputs['flanch'] == "1161" ? 'selected' : (old('flanch') == '1161' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1161')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('2647')->id }}"
                                {{ is_null($inputs) ? (old('flanch') == '2647' ? 'selected' : '') : ($inputs['flanch'] == "2647" ? 'selected' : (old('flanch') == '2647' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('2647')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1162')->id }}"
                                {{ is_null($inputs) ? (old('flanch') == '1162' ? 'selected' : '') : ($inputs['flanch'] == "1162" ? 'selected' : (old('flanch') == '1162' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1162')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1163')->id }}"
                                {{ is_null($inputs) ? (old('flanch') == '1163' ? 'selected' : '') : ($inputs['flanch'] == "1163" ? 'selected' : (old('flanch') == '1163' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1163')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1164')->id }}"
                                {{ is_null($inputs) ? (old('flanch') == '1164' ? 'selected' : '') : ($inputs['flanch'] == "1164" ? 'selected' : (old('flanch') == '1164' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1164')->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTube">تیوپ شیت</label>
                        <select name="tube" id="inputTube" class="input-text bg-sky-100">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::find('1170')->id }}"
                                {{ is_null($inputs) ? (old('tube') == '1170' ? 'selected' : '') : ($inputs['tube'] == "1170" ? 'selected' : (old('tube') == '1170' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1170')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1171')->id }}"
                                {{ is_null($inputs) ? (old('tube') == '1171' ? 'selected' : '') : ($inputs['tube'] == "1171" ? 'selected' : (old('tube') == '1171' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1171')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1172')->id }}"
                                {{ is_null($inputs) ? (old('tube') == '1172' ? 'selected' : '') : ($inputs['tube'] == "1172" ? 'selected' : (old('tube') == '1172' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1172')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1173')->id }}"
                                {{ is_null($inputs) ? (old('tube') == '1173' ? 'selected' : '') : ($inputs['tube'] == "1173" ? 'selected' : (old('tube') == '1173' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1173')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1174')->id }}"
                                {{ is_null($inputs) ? (old('tube') == '1174' ? 'selected' : '') : ($inputs['tube'] == "1174" ? 'selected' : (old('tube') == '1174' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1174')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1175')->id }}"
                                {{ is_null($inputs) ? (old('tube') == '1175' ? 'selected' : '') : ($inputs['tube'] == "1175" ? 'selected' : (old('tube') == '1175' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1175')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1176')->id }}"
                                {{ is_null($inputs) ? (old('tube') == '1176' ? 'selected' : '') : ($inputs['tube'] == "1176" ? 'selected' : (old('tube') == '1176' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1176')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1177')->id }}"
                                {{ is_null($inputs) ? (old('tube') == '1177' ? 'selected' : '') : ($inputs['tube'] == "1177" ? 'selected' : (old('tube') == '1177' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1177')->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputRing">رینگ روبند</label>
                        <select name="ring" id="inputRing" class="input-text bg-sky-100">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::find('1170')->id }}"
                                {{ is_null($inputs) ? (old('ring') == '1170' ? 'selected' : '') : ($inputs['ring'] == "1170" ? 'selected' : (old('ring') == '1170' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1170')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1171')->id }}"
                                {{ is_null($inputs) ? (old('ring') == '1171' ? 'selected' : '') : ($inputs['ring'] == "1171" ? 'selected' : (old('ring') == '1171' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1171')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1172')->id }}"
                                {{ is_null($inputs) ? (old('ring') == '1172' ? 'selected' : '') : ($inputs['ring'] == "1172" ? 'selected' : (old('ring') == '1172' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1172')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1173')->id }}"
                                {{ is_null($inputs) ? (old('ring') == '1173' ? 'selected' : '') : ($inputs['ring'] == "1173" ? 'selected' : (old('ring') == '1173' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1173')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1174')->id }}"
                                {{ is_null($inputs) ? (old('ring') == '1174' ? 'selected' : '') : ($inputs['ring'] == "1174" ? 'selected' : (old('ring') == '1174' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1174')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1175')->id }}"
                                {{ is_null($inputs) ? (old('ring') == '1175' ? 'selected' : '') : ($inputs['ring'] == "1175" ? 'selected' : (old('ring') == '1175' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1175')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1176')->id }}"
                                {{ is_null($inputs) ? (old('ring') == '1176' ? 'selected' : '') : ($inputs['ring'] == "1176" ? 'selected' : (old('ring') == '1176' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1176')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1177')->id }}"
                                {{ is_null($inputs) ? (old('ring') == '1177' ? 'selected' : '') : ($inputs['ring'] == "1177" ? 'selected' : (old('ring') == '1177' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1177')->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTooleLoolePooste">طول لوله پوسته</label>
                        <select name="toole_loole_pooste" id="inputTooleLoolePooste" class="input-text bg-sky-100">
                            <option value="">انتخاب کنید</option>
                            <option value="0.75"
                                {{ is_null($inputs) ? (old('toole_loole_pooste') == '0.75' ? 'selected' : '') : ($inputs['toole_loole_pooste'] == "0.75" ? 'selected' : (old('toole_loole_pooste') == '0.75' ? 'selected' : '')) }}>
                                0.75
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('toole_loole_pooste') == '1' ? 'selected' : '') : ($inputs['toole_loole_pooste'] == "1" ? 'selected' : (old('toole_loole_pooste') == '1' ? 'selected' : '')) }}>
                                1
                            </option>
                            <option value="1.2"
                                {{ is_null($inputs) ? (old('toole_loole_pooste') == '1.2' ? 'selected' : '') : ($inputs['toole_loole_pooste'] == "1.2" ? 'selected' : (old('toole_loole_pooste') == '1.2' ? 'selected' : '')) }}>
                                1.2
                            </option>
                            <option value="1.5"
                                {{ is_null($inputs) ? (old('toole_loole_pooste') == '1.5' ? 'selected' : '') : ($inputs['toole_loole_pooste'] == "1.5" ? 'selected' : (old('toole_loole_pooste') == '1.5' ? 'selected' : '')) }}>
                                1.5
                            </option>
                            <option value="2"
                                {{ is_null($inputs) ? (old('toole_loole_pooste') == '2' ? 'selected' : '') : ($inputs['toole_loole_pooste'] == "2" ? 'selected' : (old('toole_loole_pooste') == '2' ? 'selected' : '')) }}>
                                2
                            </option>
                            <option value="3"
                                {{ is_null($inputs) ? (old('toole_loole_pooste') == '3' ? 'selected' : '') : ($inputs['toole_loole_pooste'] == "3" ? 'selected' : (old('toole_loole_pooste') == '3' ? 'selected' : '')) }}>
                                3
                            </option>
                            <option value="4"
                                {{ is_null($inputs) ? (old('toole_loole_pooste') == '4' ? 'selected' : '') : ($inputs['toole_loole_pooste'] == "4" ? 'selected' : (old('toole_loole_pooste') == '4' ? 'selected' : '')) }}>
                                4
                            </option>
                            <option value="6"
                                {{ is_null($inputs) ? (old('toole_loole_pooste') == '6' ? 'selected' : '') : ($inputs['toole_loole_pooste'] == "6" ? 'selected' : (old('toole_loole_pooste') == '6' ? 'selected' : '')) }}>
                                6
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTedadLooleMessi">تعداد لوله مسی</label>
                        <input name="tedad_loole_messi" type="text" class="input-text bg-sky-100"
                               id="inputTedadLooleMessi"
                               value="{{ !is_null($inputs) ? $inputs['tedad_loole_messi'] : old('tedad_loole_messi') }}">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTonaj">تناژ واقعی</label>
                        <input name="tonaj" type="text" class="input-text bg-sky-100"
                               id="inputTonaj"
                               value="{{ !is_null($inputs) ? $inputs['tonaj'] : old('tonaj') }}">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputGaz">گاز مبرد</label>
                        <select name="gaz" id="inputGaz" class="input-text bg-sky-100">
                            <option value="">انتخاب کنید</option>
                            <option value="R22"
                                {{ is_null($inputs) ? (old('gaz') == 'R22' ? 'selected' : '') : ($inputs['gaz'] == "R22" ? 'selected' : (old('gaz') == 'R22' ? 'selected' : '')) }}>
                                R22
                            </option>
                            <option value="R134a"
                                {{ is_null($inputs) ? (old('gaz') == 'R134a' ? 'selected' : '') : ($inputs['gaz'] == "R134a" ? 'selected' : (old('gaz') == 'R134a' ? 'selected' : '')) }}>
                                R134a
                            </option>
                            <option value="R407c"
                                {{ is_null($inputs) ? (old('gaz') == 'R407c' ? 'selected' : '') : ($inputs['gaz'] == "R407c" ? 'selected' : (old('gaz') == 'R407c' ? 'selected' : '')) }}>
                                R407c
                            </option>
                            <option value="R410a"
                                {{ is_null($inputs) ? (old('gaz') == 'R410a' ? 'selected' : '') : ($inputs['gaz'] == "R410a" ? 'selected' : (old('gaz') == 'R410a' ? 'selected' : '')) }}>
                                R410a
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputGaz">تعداد پاس</label>
                        <select name="pass" id="inputPass" class="input-text bg-sky-100">
                            <option value="">انتخاب کنید</option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('pass') == '1' ? 'selected' : '') : ($inputs['pass'] == "1" ? 'selected' : (old('pass') == '1' ? 'selected' : '')) }}>
                                1 پاس
                            </option>
                            <option value="2"
                                {{ is_null($inputs) ? (old('pass') == '2' ? 'selected' : '') : ($inputs['pass'] == "2" ? 'selected' : (old('pass') == '2' ? 'selected' : '')) }}>
                                2 پاس
                            </option>
                            <option value="3"
                                {{ is_null($inputs) ? (old('pass') == '3' ? 'selected' : '') : ($inputs['pass'] == "3" ? 'selected' : (old('pass') == '3' ? 'selected' : '')) }}>
                                3 پاس
                            </option>
                            <option value="4"
                                {{ is_null($inputs) ? (old('pass') == '4' ? 'selected' : '') : ($inputs['pass'] == "4" ? 'selected' : (old('pass') == '4' ? 'selected' : '')) }}>
                                4 پاس
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-x-2 space-x-reverse">
            <button type="submit" class="form-submit-btn">
                محاسبه
            </button>
        </div>

    </form>

    <!-- Content -->
    <div class="mt-4">
        @if(!is_null($values))
            <form method="POST" action="{{ route('contracts.calculateConverter.storeCondensor', [$contract->id, $part->id, $product->id, $part2->id]) }}"
                  class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4">
                @csrf

                <input type="hidden" name="inputs" value="{{ json_encode($inputs) }}">

                <table class="border-collapse border border-gray-400 w-full">
                    <thead class="sticky top-1 bg-gray-200 z-50 shadow-md">
                    <tr>
                        <th class="border border-gray-300 p-4 text-sm">ردیف</th>
                        <th class="border border-gray-300 p-4 text-sm">شرح</th>
                        <th class="border border-gray-300 p-4 text-sm">واحد</th>
                        <th class="border border-gray-300 p-4 text-sm">مقدار / سایز</th>
                        @can('coil-table')
                            <th class="border border-gray-300 p-4 text-sm">قیمت واحد (تومان)</th>
                            <th class="border border-gray-300 p-4 text-sm">قیمت کل (تومان)</th>
                        @endcan
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $finalPrice = 0;
                        $finalWeight = 0;
                    @endphp
                    @foreach($part->children()->orderBy('sort','ASC')->get() as $index => $child)
                        <input type="hidden" name="values[]" id="value{{ $index }}"
                               value="{{ $values[$index] }}">
                        <input type="hidden" name="sorts[]" id="sort{{ $index }}" value="{{ $child->pivot->sort }}">
                        <tr>
                            @if(!is_null($selectedParts))
                                @php
                                    $keys = array_keys($selectedParts);
                                @endphp
                                @if(in_array($index,$keys))
                                    @foreach($keys as $key)
                                        @if($key == $index)
                                            <td class="border border-gray-300 p-4 text-sm text-center">
                                                {{ $index + 1 }}
                                            </td>
                                            <td class="border border-gray-300 p-4 text-sm text-center">
                                                {{ $selectedParts[$index]->name }}
                                            </td>
                                            <td class="border border-gray-300 p-4 text-sm text-center">
                                                {{ $selectedParts[$index]->unit }}
                                                @if(!is_null($selectedParts[$index]->unit2))
                                                    /
                                                    {{ $selectedParts[$index]->unit2 }}
                                                @endif
                                            </td>
                                            <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                                                @if(!is_null($values))
                                                    <span>{{ number_format($values[$index], 2) }}</span>
                                                    @if(!is_null($selectedParts[$index]->unit2))
                                                        @php
                                                            $string = $values[$index] . $selectedParts[$index]->operator2 . $selectedParts[$index]->formula2;
                                                        @endphp
                                                        /
                                                        {{ number_format(eval("return " . $string . ';'), 2) }}
                                                    @endif
                                                @endif
                                            </td>
                                            @can('coil-table')
                                                <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                                                    <span>{{ number_format($selectedParts[$index]->price) }}</span>
                                                </td>
                                                <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                                                    @if(!is_null($values))
                                                        {{ number_format($values[$index] * $selectedParts[$index]->price) }}
                                                    @endif
                                                </td>
                                            @endcan
                                        @endif
                                    @endforeach
                                    @php
                                        $finalPrice += $values[$index] * $selectedParts[$index]->price;
                                        $finalWeight += $values[$index] * $selectedParts[$index]->weight;
                                    @endphp
                                    <input type="hidden" name="parts[]" id="part{{ $index }}"
                                           value="{{ $selectedParts[$index]->id }}">
                                @else
                                    <input type="hidden" name="parts[]" id="part{{ $child->id }}"
                                           value="{{ $child->id }}">
                                    <td class="border border-gray-300 p-4 text-sm text-center">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="border border-gray-300 p-4 text-sm text-center">
                                        {{ $child->name }}
                                    </td>
                                    <td class="border border-gray-300 p-4 text-sm text-center">
                                        {{ $child->unit }}
                                        @if(!is_null($child->unit2))
                                            /
                                            {{ $child->unit2 }}
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                                        <span>{{ number_format($values[$index], 2) }}</span>
                                        @if(!is_null($child->unit2))
                                            @php
                                                $string = $values[$index] . $child->operator2 . $child->formula2;
                                            @endphp
                                            /
                                            {{ number_format(eval("return " . $string . ';'), 2) }}
                                        @endif
                                    </td>
                                    @can('coil-table')
                                        <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                                            <span>{{ number_format($child->price) }}</span>
                                        </td>
                                        <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                                            {{ number_format($values[$index] * $child->price) }}
                                        </td>
                                    @endcan
                                    @php
                                        $finalPrice += $values[$index] * $child->price;
                                        $finalWeight += $values[$index] * $child->weight;
                                    @endphp
                                @endif
                            @endif
                        </tr>
                    @endforeach
                    @can('coil-table')
                        <tr>
                            <td class="border border-gray-300 p-4 text-lg font-bold text-center" colspan="4">
                                قیمت نهایی
                            </td>
                            <td class="border border-gray-300 p-4 text-lg font-bold text-center text-green-600"
                                colspan="2">
                                <span>{{ number_format($finalPrice) }} تومان </span>
                            </td>
                        </tr>
                    @endcan
                    </tbody>
                </table>

                <div class="my-4 bg-gray-100 p-4 rounded-md shadow-md space-y-4">
                    <p class="text-xl font-bold text-black text-center">
                        قیمت نهایی : {{ number_format($finalPrice) }} تومان
                    </p>
                    <input type="hidden" name="price" value="{{ $finalPrice }}">
                    <p class="text-xl font-bold text-black text-center">
                        وزن دستگاه : {{ round($finalWeight) }} کیلوگرم
                    </p>
                    <input type="hidden" name="weight" value="{{ $finalWeight }}">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="my-4 bg-red-300 p-4 rounded-md shadow-md">
                        <label class="block mb-2 text-sm font-bold" for="inputCondensorName">
                            نام کندانسور مورد نظر
                        </label>
                        <input type="text" class="input-text" id="inputCondensorName" name="name" dir="ltr"
                               value="{{ $name }}">
                    </div>
                    @can('users')
                        <div class="my-4 bg-red-300 p-4 rounded-md shadow-md">
                            <label class="block mb-2 text-sm font-bold" for="inputStandard">
                                تعیین استاندارد بودن کندانسور
                            </label>
                            <select name="standard" id="inputStandard" class="input-text">
                                <option value="0">نباشد</option>
                                <option value="1">باشد</option>
                            </select>
                        </div>
                    @endcan
                </div>

                @can('users')
                    <div class="my-4 bg-red-300 p-4 rounded-md shadow-md">
                        <label class="block mb-2 text-sm font-bold" for="inputCoilCategory">
                            دسته بندی کندانسور
                        </label>
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <select name="categories[]" id="inputCoilCategory" class="input-text"
                                        onchange="getCategory1()">
                                    <option value="">انتخاب کنید</option>
                                    @foreach($categories as $category)
                                        <option
                                            value="{{ $category->id }}" {{ request('category1') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="categorySection1">
                            </div>
                            <div id="categorySection2">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="form-submit-btn">
                            ذخیره
                        </button>
                    </div>
                @endcan
            </form>
        @endif
    </div>

</x-layout>

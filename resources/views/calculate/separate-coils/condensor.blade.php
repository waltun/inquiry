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
        <a href="{{ route('separate.coil.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    محاسبه کویل ها
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
                      d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    محاسبه {{ $part->name }}
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
        $satheCoil = Session::get('satheCoil');
        $name = Session::get('name');
    @endphp

    <form method="POST" action="{{ route('separate.coil.calculateCondensor') }}">
        @csrf
        <div class="my-4">
            <div class="bg-white rounded-md shadow-md border border-gray-200 py-4 px-6">
                <div class="mb-4 border-b border-gray-300 pb-3 flex justify-between items-center">
                    <div>
                        <p class="text-lg text-black font-bold">
                            اطلاعات ورودی {{ $part->name }}
                        </p>
                    </div>
                    <div class="flex items-center space-x-4 space-x-reverse">
                        <p class="bg-indigo-500 rounded-md px-6 py-2 text-sm font-bold text-white">
                            سطح کویل :
                            @if(!is_null($satheCoil))
                                <span>{{ number_format($satheCoil,2) }}</span>
                            @else
                                <span>0.00</span>
                            @endif
                        </p>
                        <p class="bg-green-500 rounded-md px-6 py-2 text-sm font-bold text-white">
                            {{ $name ?? '' }}
                        </p>
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-4">
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputLooleMessi">لوله مسی کویل</label>
                        <select name="loole_messi" id="inputLooleMessi" class="input-text bg-sky-100">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::where('id','53')->first()->id }}"
                                {{ is_null($inputs) ? (old('loole_messi') == '53' ? 'selected' : '') : ($inputs['loole_messi'] == "53" ? 'selected' : (old('loole_messi') == '53' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','53')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','54')->first()->id }}"
                                {{ is_null($inputs) ? (old('loole_messi') == '54' ? 'selected' : '') : ($inputs['loole_messi'] == "54" ? 'selected' : (old('loole_messi') == '54' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','54')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','55')->first()->id }}"
                                {{ is_null($inputs) ? (old('loole_messi') == '55' ? 'selected' : '') : ($inputs['loole_messi'] == "55" ? 'selected' : (old('loole_messi') == '55' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','55')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','584')->first()->id }}"
                                {{ is_null($inputs) ? (old('loole_messi') == '584' ? 'selected' : '') : ($inputs['loole_messi'] == "584" ? 'selected' : (old('loole_messi') == '584' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','584')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','56')->first()->id }}"
                                {{ is_null($inputs) ? (old('loole_messi') == '56' ? 'selected' : '') : ($inputs['loole_messi'] == "56" ? 'selected' : (old('loole_messi') == '56' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','56')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','57')->first()->id }}"
                                {{ is_null($inputs) ? (old('loole_messi') == '57' ? 'selected' : '') : ($inputs['loole_messi'] == "57" ? 'selected' : (old('loole_messi') == '57' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','57')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','58')->first()->id }}"
                                {{ is_null($inputs) ? (old('loole_messi') == '58' ? 'selected' : '') : ($inputs['loole_messi'] == "58" ? 'selected' : (old('loole_messi') == '58' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','58')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','59')->first()->id }}"
                                {{ is_null($inputs) ? (old('loole_messi') == '59' ? 'selected' : '') : ($inputs['loole_messi'] == "59" ? 'selected' : (old('loole_messi') == '59' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','59')->first()->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputFin">فین کویل</label>
                        <select name="fin_coil" id="inputFin" class="input-text bg-sky-100">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::where('id','60')->first()->id }}"
                                {{ is_null($inputs) ? (old('fin_coil') == '60' ? 'selected' : '') : ($inputs['fin_coil'] == "60" ? 'selected' : (old('fin_coil') == '60' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','60')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','61')->first()->id }}"
                                {{ is_null($inputs) ? (old('fin_coil') == '61' ? 'selected' : '') : ($inputs['fin_coil'] == "61" ? 'selected' : (old('fin_coil') == '61' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','61')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','62')->first()->id }}"
                                {{ is_null($inputs) ? (old('fin_coil') == '62' ? 'selected' : '') : ($inputs['fin_coil'] == "62" ? 'selected' : (old('fin_coil') == '62' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','62')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','63')->first()->id }}"
                                {{ is_null($inputs) ? (old('fin_coil') == '63' ? 'selected' : '') : ($inputs['fin_coil'] == "63" ? 'selected' : (old('fin_coil') == '63' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','63')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','64')->first()->id }}"
                                {{ is_null($inputs) ? (old('fin_coil') == '64' ? 'selected' : '') : ($inputs['fin_coil'] == "64" ? 'selected' : (old('fin_coil') == '64' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','64')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','65')->first()->id }}"
                                {{ is_null($inputs) ? (old('fin_coil') == '65' ? 'selected' : '') : ($inputs['fin_coil'] == "65" ? 'selected' : (old('fin_coil') == '65' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','65')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','66')->first()->id }}"
                                {{ is_null($inputs) ? (old('fin_coil') == '66' ? 'selected' : '') : ($inputs['fin_coil'] == "66" ? 'selected' : (old('fin_coil') == '66' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','66')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','67')->first()->id }}"
                                {{ is_null($inputs) ? (old('fin_coil') == '67' ? 'selected' : '') : ($inputs['fin_coil'] == "67" ? 'selected' : (old('fin_coil') == '67' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','67')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','68')->first()->id }}"
                                {{ is_null($inputs) ? (old('fin_coil') == '68' ? 'selected' : '') : ($inputs['fin_coil'] == "68" ? 'selected' : (old('fin_coil') == '68' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','68')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','69')->first()->id }}"
                                {{ is_null($inputs) ? (old('fin_coil') == '69' ? 'selected' : '') : ($inputs['fin_coil'] == "69" ? 'selected' : (old('fin_coil') == '69' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','69')->first()->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTedadRadif">تعداد ردیف کویل</label>
                        <select name="tedad_radif_coil" id="inputTedadRadif" class="input-text bg-sky-100">
                            <option value="">انتخاب کنید</option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('tedad_radif_coil') == '1' ? 'selected' : '') : ($inputs['tedad_radif_coil'] == '1' ? 'selected' : (old('tedad_radif_coil') == '1' ? 'selected' : '')) }}>
                                1
                            </option>
                            <option value="2"
                                {{ is_null($inputs) ? (old('tedad_radif_coil') == '2' ? 'selected' : '') : ($inputs['tedad_radif_coil'] == '2' ? 'selected' : (old('tedad_radif_coil') == '2' ? 'selected' : '')) }}>
                                2
                            </option>
                            <option value="3"
                                {{ is_null($inputs) ? (old('tedad_radif_coil') == '3' ? 'selected' : '') : ($inputs['tedad_radif_coil'] == '3' ? 'selected' : (old('tedad_radif_coil') == '3' ? 'selected' : '')) }}>
                                3
                            </option>
                            <option value="4"
                                {{ is_null($inputs) ? (old('tedad_radif_coil') == '4' ? 'selected' : '') : ($inputs['tedad_radif_coil'] == '4' ? 'selected' : (old('tedad_radif_coil') == '4' ? 'selected' : '')) }}>
                                4
                            </option>
                            <option value="5"
                                {{ is_null($inputs) ? (old('tedad_radif_coil') == '5' ? 'selected' : '') : ($inputs['tedad_radif_coil'] == '5' ? 'selected' : (old('tedad_radif_coil') == '5' ? 'selected' : '')) }}>
                                5
                            </option>
                            <option value="6"
                                {{ is_null($inputs) ? (old('tedad_radif_coil') == '6' ? 'selected' : '') : ($inputs['tedad_radif_coil'] == '6' ? 'selected' : (old('tedad_radif_coil') == '6' ? 'selected' : '')) }}>
                                6
                            </option>
                            <option value="8"
                                {{ is_null($inputs) ? (old('tedad_radif_coil') == '8' ? 'selected' : '') : ($inputs['tedad_radif_coil'] == '8' ? 'selected' : (old('tedad_radif_coil') == '8' ? 'selected' : '')) }}>
                                8
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputFinDarInch">فین در اینچ</label>
                        <select name="fin_dar_inch" id="inputFinDarInch" class="input-text bg-sky-100">
                            <option value="">انتخاب کنید</option>
                            <option value="4"
                                {{ is_null($inputs) ? (old('fin_dar_inch') == '4' ? 'selected' : '') : ($inputs['fin_dar_inch'] == '4' ? 'selected' : (old('fin_dar_inch') == '4' ? 'selected' : '')) }}>
                                4
                            </option>
                            <option value="5"
                                {{ is_null($inputs) ? (old('fin_dar_inch') == '5' ? 'selected' : '') : ($inputs['fin_dar_inch'] == '5' ? 'selected' : (old('fin_dar_inch') == '5' ? 'selected' : '')) }}>
                                5
                            </option>
                            <option value="6"
                                {{ is_null($inputs) ? (old('fin_dar_inch') == '6' ? 'selected' : '') : ($inputs['fin_dar_inch'] == '6' ? 'selected' : (old('fin_dar_inch') == '6' ? 'selected' : '')) }}>
                                6
                            </option>
                            <option value="7"
                                {{ is_null($inputs) ? (old('fin_dar_inch') == '7' ? 'selected' : '') : ($inputs['fin_dar_inch'] == '7' ? 'selected' : (old('fin_dar_inch') == '7' ? 'selected' : '')) }}>
                                7
                            </option>
                            <option value="8"
                                {{ is_null($inputs) ? (old('fin_dar_inch') == '8' ? 'selected' : '') : ($inputs['fin_dar_inch'] == '8' ? 'selected' : (old('fin_dar_inch') == '8' ? 'selected' : '')) }}>
                                8
                            </option>
                            <option value="9"
                                {{ is_null($inputs) ? (old('fin_dar_inch') == '9' ? 'selected' : '') : ($inputs['fin_dar_inch'] == '9' ? 'selected' : (old('fin_dar_inch') == '9' ? 'selected' : '')) }}>
                                9
                            </option>
                            <option value="10"
                                {{ is_null($inputs) ? (old('fin_dar_inch') == '10' ? 'selected' : '') : ($inputs['fin_dar_inch'] == '10' ? 'selected' : (old('fin_dar_inch') == '10' ? 'selected' : '')) }}>
                                10
                            </option>
                            <option value="11"
                                {{ is_null($inputs) ? (old('fin_dar_inch') == '11' ? 'selected' : '') : ($inputs['fin_dar_inch'] == '11' ? 'selected' : (old('fin_dar_inch') == '11' ? 'selected' : '')) }}>
                                11
                            </option>
                            <option value="12"
                                {{ is_null($inputs) ? (old('fin_dar_inch') == '12' ? 'selected' : '') : ($inputs['fin_dar_inch'] == '12' ? 'selected' : (old('fin_dar_inch') == '12' ? 'selected' : '')) }}>
                                12
                            </option>
                            <option value="13"
                                {{ is_null($inputs) ? (old('fin_dar_inch') == '13' ? 'selected' : '') : ($inputs['fin_dar_inch'] == '13' ? 'selected' : (old('fin_dar_inch') == '13' ? 'selected' : '')) }}>
                                13
                            </option>
                            <option value="14"
                                {{ is_null($inputs) ? (old('fin_dar_inch') == '14' ? 'selected' : '') : ($inputs['fin_dar_inch'] == '14' ? 'selected' : (old('fin_dar_inch') == '14' ? 'selected' : '')) }}>
                                14
                            </option>
                            <option value="15"
                                {{ is_null($inputs) ? (old('fin_dar_inch') == '15' ? 'selected' : '') : ($inputs['fin_dar_inch'] == '15' ? 'selected' : (old('fin_dar_inch') == '15' ? 'selected' : '')) }}>
                                15
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputKham">خم کویل</label>
                        <select name="kham" id="inputKham" class="input-text bg-sky-100">
                            <option value="0">ندارد</option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('kham') == '1' ? 'selected' : '') : ($inputs['kham'] == '1' ? 'selected' : (old('kham') == '1' ? 'selected' : '')) }}>
                                1
                            </option>
                            <option value="2"
                                {{ is_null($inputs) ? (old('kham') == '2' ? 'selected' : '') : ($inputs['kham'] == '2' ? 'selected' : (old('kham') == '2' ? 'selected' : '')) }}>
                                2
                            </option>
                            <option value="3"
                                {{ is_null($inputs) ? (old('kham') == '3' ? 'selected' : '') : ($inputs['kham'] == '3' ? 'selected' : (old('kham') == '3' ? 'selected' : '')) }}>
                                3
                            </option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-bold" for="inputZekhamatFrame">ضخامت فریم کویل</label>
                        <select name="zekhamat_frame_coil" id="inputZekhamatFrame" class="input-text bg-sky-100">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::where('id','5')->first()->id }}"
                                {{ is_null($inputs) ? (old('zekhamat_frame_coil') == '5' ? 'selected' : '') : ($inputs['zekhamat_frame_coil'] == "5" ? 'selected' : (old('zekhamat_frame_coil') == '5' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','5')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','7')->first()->id }}"
                                {{ is_null($inputs) ? (old('zekhamat_frame_coil') == '7' ? 'selected' : '') : ($inputs['zekhamat_frame_coil'] == "7" ? 'selected' : (old('zekhamat_frame_coil') == '7' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','7')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','8')->first()->id }}"
                                {{ is_null($inputs) ? (old('zekhamat_frame_coil') == '8' ? 'selected' : '') : ($inputs['zekhamat_frame_coil'] == "8" ? 'selected' : (old('zekhamat_frame_coil') == '8' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','8')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','9')->first()->id }}"
                                {{ is_null($inputs) ? (old('zekhamat_frame_coil') == '9' ? 'selected' : '') : ($inputs['zekhamat_frame_coil'] == "9" ? 'selected' : (old('zekhamat_frame_coil') == '9' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','9')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','10')->first()->id }}"
                                {{ is_null($inputs) ? (old('zekhamat_frame_coil') == '10' ? 'selected' : '') : ($inputs['zekhamat_frame_coil'] == "10" ? 'selected' : (old('zekhamat_frame_coil') == '10' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','10')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','660')->first()->id }}"
                                {{ is_null($inputs) ? (old('zekhamat_frame_coil') == '660' ? 'selected' : '') : ($inputs['zekhamat_frame_coil'] == "660" ? 'selected' : (old('zekhamat_frame_coil') == '660' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','660')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','661')->first()->id }}"
                                {{ is_null($inputs) ? (old('zekhamat_frame_coil') == '661' ? 'selected' : '') : ($inputs['zekhamat_frame_coil'] == "661" ? 'selected' : (old('zekhamat_frame_coil') == '661' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','661')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','662')->first()->id }}"
                                {{ is_null($inputs) ? (old('zekhamat_frame_coil') == '662' ? 'selected' : '') : ($inputs['zekhamat_frame_coil'] == "662" ? 'selected' : (old('zekhamat_frame_coil') == '662' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','662')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','663')->first()->id }}"
                                {{ is_null($inputs) ? (old('zekhamat_frame_coil') == '663' ? 'selected' : '') : ($inputs['zekhamat_frame_coil'] == "663" ? 'selected' : (old('zekhamat_frame_coil') == '663' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','663')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','664')->first()->id }}"
                                {{ is_null($inputs) ? (old('zekhamat_frame_coil') == '664' ? 'selected' : '') : ($inputs['zekhamat_frame_coil'] == "664" ? 'selected' : (old('zekhamat_frame_coil') == '664' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','664')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','667')->first()->id }}"
                                {{ is_null($inputs) ? (old('zekhamat_frame_coil') == '667' ? 'selected' : '') : ($inputs['zekhamat_frame_coil'] == "667" ? 'selected' : (old('zekhamat_frame_coil') == '667' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','667')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','668')->first()->id }}"
                                {{ is_null($inputs) ? (old('zekhamat_frame_coil') == '668' ? 'selected' : '') : ($inputs['zekhamat_frame_coil'] == "668" ? 'selected' : (old('zekhamat_frame_coil') == '668' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','668')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','669')->first()->id }}"
                                {{ is_null($inputs) ? (old('zekhamat_frame_coil') == '669' ? 'selected' : '') : ($inputs['zekhamat_frame_coil'] == "669" ? 'selected' : (old('zekhamat_frame_coil') == '669' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','669')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','670')->first()->id }}"
                                {{ is_null($inputs) ? (old('zekhamat_frame_coil') == '670' ? 'selected' : '') : ($inputs['zekhamat_frame_coil'] == "670" ? 'selected' : (old('zekhamat_frame_coil') == '670' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','670')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','671')->first()->id }}"
                                {{ is_null($inputs) ? (old('zekhamat_frame_coil') == '671' ? 'selected' : '') : ($inputs['zekhamat_frame_coil'] == "671" ? 'selected' : (old('zekhamat_frame_coil') == '671' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','671')->first()->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputNoePoosheshZedeKhordegi">
                            نوع پوشش ضد خوردگی
                        </label>
                        <select name="pooshesh_khordegi" id="inputNoePoosheshZedeKhordegi"
                                class="input-text bg-sky-100">
                            <option value="0"
                                {{ is_null($inputs) ? (old('pooshesh_khordegi') == '0' ? 'selected' : '') : ($inputs['pooshesh_khordegi'] == "0" ? 'selected' : (old('pooshesh_khordegi') == '0' ? 'selected' : '')) }}>
                                ندارد
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('pooshesh_khordegi') == '1' ? 'selected' : '') : ($inputs['pooshesh_khordegi'] == "1" ? 'selected' : (old('pooshesh_khordegi') == '1' ? 'selected' : '')) }}>
                                هرسایت
                            </option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-bold" for="inputCollectorAhani">کلکتور ورودی</label>
                        <select name="collector_ahani" id="inputCollectorAhani" class="input-text bg-sky-100">
                            <option value="0">ندارد</option>
                            <option value="{{ \App\Models\Part::where('id','77')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_ahani') == '77' ? 'selected' : '') : ($inputs['collector_ahani'] == "77" ? 'selected' : (old('collector_ahani') == '77' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','77')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','78')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_ahani') == '78' ? 'selected' : '') : ($inputs['collector_ahani'] == "78" ? 'selected' : (old('collector_ahani') == '77' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','78')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','79')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_ahani') == '79' ? 'selected' : '') : ($inputs['collector_ahani'] == "79" ? 'selected' : (old('collector_ahani') == '79' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','79')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','80')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_ahani') == '80' ? 'selected' : '') : ($inputs['collector_ahani'] == "80" ? 'selected' : (old('collector_ahani') == '80' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','80')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','81')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_ahani') == '81' ? 'selected' : '') : ($inputs['collector_ahani'] == "81" ? 'selected' : (old('collector_ahani') == '81' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','81')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','82')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_ahani') == '82' ? 'selected' : '') : ($inputs['collector_ahani'] == "82" ? 'selected' : (old('collector_ahani') == '82' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','82')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','83')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_ahani') == '83' ? 'selected' : '') : ($inputs['collector_ahani'] == "83" ? 'selected' : (old('collector_ahani') == '83' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','83')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','84')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_ahani') == '84' ? 'selected' : '') : ($inputs['collector_ahani'] == "84" ? 'selected' : (old('collector_ahani') == '84' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','84')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','85')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_ahani') == '85' ? 'selected' : '') : ($inputs['collector_ahani'] == "85" ? 'selected' : (old('collector_ahani') == '85' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','85')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','86')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_ahani') == '86' ? 'selected' : '') : ($inputs['collector_ahani'] == "86" ? 'selected' : (old('collector_ahani') == '86' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','86')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','87')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_ahani') == '87' ? 'selected' : '') : ($inputs['collector_ahani'] == "87" ? 'selected' : (old('collector_ahani') == '87' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','87')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','88')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_ahani') == '88' ? 'selected' : '') : ($inputs['collector_ahani'] == "88" ? 'selected' : (old('collector_ahani') == '88' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','88')->first()->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputCollectorMessi">کلکتور خروجی</label>
                        <select name="collector_messi" id="inputCollectorMessi" class="input-text bg-sky-100">
                            <option value="0">ندارد</option>
                            <option value="{{ \App\Models\Part::where('id','77')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_messi') == '77' ? 'selected' : '') : ($inputs['collector_messi'] == "77" ? 'selected' : (old('collector_messi') == '77' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','77')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','78')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_messi') == '78' ? 'selected' : '') : ($inputs['collector_messi'] == "78" ? 'selected' : (old('collector_messi') == '78' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','78')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','79')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_messi') == '79' ? 'selected' : '') : ($inputs['collector_messi'] == "79" ? 'selected' : (old('collector_messi') == '79' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','79')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','80')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_messi') == '80' ? 'selected' : '') : ($inputs['collector_messi'] == "80" ? 'selected' : (old('collector_messi') == '80' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','80')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','81')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_messi') == '81' ? 'selected' : '') : ($inputs['collector_messi'] == "81" ? 'selected' : (old('collector_messi') == '82' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','81')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','82')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_messi') == '82' ? 'selected' : '') : ($inputs['collector_messi'] == "82" ? 'selected' : (old('collector_messi') == '82' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','82')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','83')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_messi') == '83' ? 'selected' : '') : ($inputs['collector_messi'] == "83" ? 'selected' : (old('collector_messi') == '83' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','83')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','84')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_messi') == '84' ? 'selected' : '') : ($inputs['collector_messi'] == "84" ? 'selected' : (old('collector_messi') == '84' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','84')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','85')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_messi') == '85' ? 'selected' : '') : ($inputs['collector_messi'] == "85" ? 'selected' : (old('collector_messi') == '85' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','85')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','86')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_messi') == '86' ? 'selected' : '') : ($inputs['collector_messi'] == "86" ? 'selected' : (old('collector_messi') == '86' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','86')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','87')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_messi') == '87' ? 'selected' : '') : ($inputs['collector_messi'] == "87" ? 'selected' : (old('collector_messi') == '87' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','87')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','88')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_messi') == '88' ? 'selected' : '') : ($inputs['collector_messi'] == "88" ? 'selected' : (old('collector_messi') == '88' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','88')->first()->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputElectrodNoghre">
                            الکترود نقره
                        </label>
                        <select name="electrod_noghre" id="inputElectrodNoghre" class="input-text bg-sky-100">
                            <option value="">
                                انتخاب کنید
                            </option>
                            <option value="{{ \App\Models\Part::where('id','104')->first()->id }}"
                                {{ is_null($inputs) ? (old('electrod_noghre') == '104' ? 'selected' : '') : ($inputs['electrod_noghre'] == "104" ? 'selected' : (old('electrod_noghre') == '104' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','104')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','105')->first()->id }}"
                                {{ is_null($inputs) ? (old('electrod_noghre') == '105' ? 'selected' : '') : ($inputs['electrod_noghre'] == "105" ? 'selected' : (old('electrod_noghre') == '105' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','105')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','108')->first()->id }}"
                                {{ is_null($inputs) ? (old('electrod_noghre') == '108' ? 'selected' : '') : ($inputs['electrod_noghre'] == "108" ? 'selected' : (old('electrod_noghre') == '108' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','108')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','413')->first()->id }}"
                                {{ is_null($inputs) ? (old('electrod_noghre') == '413' ? 'selected' : '') : ($inputs['electrod_noghre'] == "413" ? 'selected' : (old('electrod_noghre') == '413' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','413')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','109')->first()->id }}"
                                {{ is_null($inputs) ? (old('electrod_noghre') == '109' ? 'selected' : '') : ($inputs['electrod_noghre'] == "109" ? 'selected' : (old('electrod_noghre') == '109' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','109')->first()->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTooleCoil">طول کویل (اینچ)</label>
                        <input name="toole_coil" type="text" class="input-text bg-sky-100" id="inputTooleCoil"
                               value="{{ !is_null($inputs) ? $inputs['toole_coil'] : old('toole_coil') }}">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTedadLooleDarRadif">تعداد لوله در
                            ردیف</label>
                        <input name="tedad_loole_dar_radif" type="text" class="input-text bg-sky-100"
                               id="inputTedadLooleDarRadif"
                               value="{{ !is_null($inputs) ? $inputs['tedad_loole_dar_radif'] : old('tedad_loole_dar_radif') }}">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTedadMogheyiatLooleDarRadif">
                            تعداد موقعیت یک لوله در ردیف
                        </label>
                        <input type="text" class="input-text bg-sky-100" id="inputTedadMogheyiatLooleDarRadif"
                               value="{{ !is_null($inputs) ? $inputs['tedad_mogheyiat_loole'] : old('tedad_mogheyiat_loole') }}"
                               name="tedad_mogheyiat_loole">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTedadMadarLoole">تعداد مدار لوله</label>
                        <input type="text" class="input-text bg-sky-100" id="inputTedadMadarLoole"
                               value="{{ !is_null($inputs) ? $inputs['tedad_madar_loole'] : old('tedad_madar_loole') }}"
                               name="tedad_madar_loole">
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
            <form method="POST" action="{{ route('separate.coil.storeCondensor',$part->id) }}"
                  class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4">
                @csrf
                <table class="w-full border-collapse">
                    <thead>
                    <tr class="table-th-tr">
                        <th class="p-4 rounded-tr-lg">ردیف</th>
                        <th class="p-4">شرح</th>
                        <th class="p-4">واحد</th>
                        <th class="p-4">مقدار / سایز</th>
                        <th class="p-4">قیمت واحد</th>
                        <th class="p-4 rounded-tl-lg">قیمت کل</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $finalPrice = 0;
                        $finalWeight = 0;
                    @endphp
                    @foreach($part->children as $index => $child)
                        <input type="hidden" name="values[]" id="value{{ $index }}"
                               value="{{ $values[$index] }}">
                        <tr class="table-tb-tr group">
                            @if(!is_null($selectedParts))
                                @php
                                    $keys = array_keys($selectedParts);
                                @endphp
                                @if(in_array($index,$keys))
                                    @foreach($keys as $key)
                                        @if($key == $index)
                                            <td class="table-tr-td border-t-0 border-l-0">
                                                {{ $index + 1 }}
                                            </td>
                                            <td class="table-tr-td border-t-0 border-x-0">
                                                {{ $selectedParts[$index]->name }}
                                            </td>
                                            <td class="table-tr-td border-t-0 border-x-0">
                                                {{ $selectedParts[$index]->unit }}
                                                @if(!is_null($selectedParts[$index]->unit2))
                                                    /
                                                    {{ $selectedParts[$index]->unit2 }}
                                                @endif
                                            </td>
                                            <td class="table-tr-td border-t-0 border-x-0">
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
                                            <td class="table-tr-td border-t-0 border-x-0">
                                                <span>{{ number_format($selectedParts[$index]->price) }}</span>
                                            </td>
                                            <td class="table-tr-td border-t-0 border-r-0">
                                                @if(!is_null($values))
                                                    {{ number_format($values[$index] * $selectedParts[$index]->price) }}
                                                @endif
                                            </td>
                                        @endif
                                    @endforeach
                                    @php
                                        $finalPrice += $values[$index] * $selectedParts[$index]->price;
                                        $finalWeight += $values[$index] * $selectedParts[$index]->weight;
                                    @endphp
                                    <input type="hidden" name="parts[]" id="part{{ $index }}"
                                           value="{{ $selectedParts[$index]->id }}">
                                @else
                                    <td class="table-tr-td border-t-0 border-l-0">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        {{ $child->name }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        {{ $child->unit }}
                                        @if(!is_null($child->unit2))
                                            /
                                            {{ $child->unit2 }}
                                        @endif
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        <span>{{ number_format($values[$index], 2) }}</span>
                                        @if(!is_null($child->unit2))
                                            @php
                                                $string = $values[$index] . $child->operator2 . $child->formula2;
                                            @endphp
                                            /
                                            {{ number_format(eval("return " . $string . ';'), 2) }}
                                        @endif
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        <span>{{ number_format($child->price) }}</span>
                                    </td>
                                    <td class="table-tr-td border-t-0 border-r-0">
                                        {{ number_format($values[$index] * $child->price) }}
                                    </td>
                                    @php
                                        $finalPrice += $values[$index] * $child->price;
                                        $finalWeight += $values[$index] * $child->weight;
                                    @endphp
                                @endif
                            @endif
                        </tr>
                    @endforeach
                    <tr class="table-tb-tr group">
                        <td class="table-tr-td border-t-0" colspan="4">
                            <p class="text-lg font-bold">
                                قیمت نهایی (تومان)
                            </p>
                        </td>
                        <td class="table-tr-td border-t-0 border-r-0" colspan="2">
                            <span class="text-lg font-bold">{{ number_format($finalPrice) }}</span>
                            <input type="hidden" name="price" value="{{ $finalPrice }}">
                        </td>
                    </tr>
                    <tr class="table-tb-tr group">
                        <td class="table-tr-td border-t-0" colspan="4">
                            <p class="text-lg font-bold">
                                وزن دستگاه (کیلوگرم)
                            </p>
                        </td>
                        <td class="table-tr-td border-t-0 border-r-0" colspan="2">
                            <span class="text-lg font-bold">{{ round($finalWeight) }}</span>
                            <input type="hidden" name="weight" value="{{ $finalWeight }}">
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div class="card mt-4">
                    <div class="card-header">
                        <p class="card-title">
                            مشخصات
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="form-label" for="inputCoilName">
                                نام کویل مورد نظر
                            </label>
                            <input type="text" class="input-text" id="inputCoilName" name="name" dir="ltr"
                                   value="{{ $name }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="inputStandard">
                                تعیین استاندارد بودن کویل
                            </label>
                            <select name="standard" id="inputStandard" class="input-text">
                                <option value="0">نباشد</option>
                                <option value="1">باشد</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <div class="mb-4">
                                <label class="form-label" for="inputCoilCategory">
                                    دسته بندی کویل
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
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <button type="submit" class="form-submit-btn">
                        ذخیره
                    </button>
                </div>
            </form>
        @endif
    </div>
</x-layout>

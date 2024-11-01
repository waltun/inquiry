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
                    محاسبه قیمت کویل فن کویل سقفی یا زمینی
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

    <form method="POST" action="{{ route('contracts.calculateFancoilCoil', $contract->id) }}">
        @csrf
        <div class="my-4">
            <div class="bg-white rounded-md shadow-md border border-gray-200 py-4 px-6">
                <div class="mb-4 border-b border-gray-300 pb-3 flex justify-between items-center">
                    <div>
                        <p class="text-lg text-black">
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
                        <select name="loole_messi" id="inputLooleMessi" class="input-text bg-yellow-300">
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
                        <select name="fin_coil" id="inputFin" class="input-text bg-yellow-300">
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
                        <select name="tedad_radif_coil" id="inputTedadRadif" class="input-text bg-yellow-300">
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
                        <select name="fin_dar_inch" id="inputFinDarInch" class="input-text bg-yellow-300">
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
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-bold" for="inputZekhamatFrame">ضخامت فریم کویل</label>
                        <select name="zekhamat_frame_coil" id="inputZekhamatFrame" class="input-text bg-yellow-300">
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
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-bold" for="inputNoePoosheshZedeKhordegi">
                            نوع پوشش ضد خوردگی
                        </label>
                        <select name="pooshesh_khordegi" id="inputNoePoosheshZedeKhordegi"
                                class="input-text bg-yellow-300">
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
                        <label class="block mb-2 text-sm font-bold" for="inputCollectorAhani">هدر و کلکتور آهنی</label>
                        <select name="collector_ahani" id="inputCollectorAhani" class="input-text bg-yellow-300">
                            <option value="0">ندارد</option>
                            <option value="{{ \App\Models\Part::where('id','70')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_ahani') == '70' ? 'selected' : '') : ($inputs['collector_ahani'] == "70" ? 'selected' : (old('collector_ahani') == '70' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','70')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','71')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_ahani') == '71' ? 'selected' : '') : ($inputs['collector_ahani'] == "71" ? 'selected' : (old('collector_ahani') == '71' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','71')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','72')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_ahani') == '72' ? 'selected' : '') : ($inputs['collector_ahani'] == "72" ? 'selected' : (old('collector_ahani') == '72' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','72')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','73')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_ahani') == '73' ? 'selected' : '') : ($inputs['collector_ahani'] == "73" ? 'selected' : (old('collector_ahani') == '73' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','73')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','74')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_ahani') == '74' ? 'selected' : '') : ($inputs['collector_ahani'] == "74" ? 'selected' : (old('collector_ahani') == '74' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','74')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','75')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_ahani') == '75' ? 'selected' : '') : ($inputs['collector_ahani'] == "75" ? 'selected' : (old('collector_ahani') == '75' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','75')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','76')->first()->id }}"
                                {{ is_null($inputs) ? (old('collector_ahani') == '76' ? 'selected' : '') : ($inputs['collector_ahani'] == "76" ? 'selected' : (old('collector_ahani') == '76' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::where('id','76')->first()->name }}
                            </option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-bold" for="inputCollectorMessi">هدر و کلکتور مسی</label>
                        <select name="collector_messi" id="inputCollectorMessi" class="input-text bg-yellow-300">
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
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-bold" for="inputElectrodNoghre">
                            الکترود نقره
                        </label>
                        <select name="electrod_noghre" id="inputElectrodNoghre" class="input-text bg-yellow-300">
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
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-bold" for="inputNoeCoil">
                            نوع کویل
                        </label>
                        <select name="noe_coil" id="inputNoeCoil" class="input-text bg-yellow-300">
                            <option value="">انتخاب کنید</option>
                            <option value="4"
                                {{ is_null($inputs) ? (old('noe_coil') == '4' ? 'selected' : '') : ($inputs['noe_coil'] == "4" ? 'selected' : (old('noe_coil') == '4' ? 'selected' : '')) }}>
                                4 لوله
                            </option>
                            <option value="2"
                                {{ is_null($inputs) ? (old('noe_coil') == '2' ? 'selected' : '') : ($inputs['noe_coil'] == "2" ? 'selected' : (old('noe_coil') == '2' ? 'selected' : '')) }}>
                                2 لوله
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTooleCoil">طول کویل (اینچ)</label>
                        <input name="toole_coil" type="text" class="input-text bg-yellow-300" id="inputTooleCoil"
                               value="{{ !is_null($inputs) ? $inputs['toole_coil'] : old('toole_coil') }}">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTedadLooleDarRadif">تعداد لوله در
                            ردیف</label>
                        <input name="tedad_loole_dar_radif" type="text" class="input-text bg-yellow-300"
                               id="inputTedadLooleDarRadif"
                               value="{{ !is_null($inputs) ? $inputs['tedad_loole_dar_radif'] : old('tedad_loole_dar_radif') }}">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTedadMogheyiatLooleDarRadif">
                            تعداد موقعیت یک لوله در ردیف
                        </label>
                        <input type="text" class="input-text bg-yellow-300" id="inputTedadMogheyiatLooleDarRadif"
                               value="{{ !is_null($inputs) ? $inputs['tedad_mogheyiat_loole'] : old('tedad_mogheyiat_loole') }}"
                               name="tedad_mogheyiat_loole">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTedadMadarLoole">تعداد مدار لوله</label>
                        <input type="text" class="input-text bg-yellow-300" id="inputTedadMadarLoole"
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
            <a href="{{ route('inquiries.product.amounts',$product->id) }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>

    </form>

    <!-- Content -->
    <div class="mt-4">
        @if(!is_null($values))
            <form method="POST" action="{{ route('contracts.calculateCoil.storeFancoil',[$contract->id, $part->id, $product->id, $part2->id]) }}"
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
                            <th class="border border-gray-300 p-4 text-sm">قیمت واحد</th>
                            <th class="border border-gray-300 p-4 text-sm">قیمت کل</th>
                        @endcan
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

                <div class="my-4 bg-red-300 p-4 rounded-md shadow-md">
                    <label class="block mb-2 text-sm font-bold" for="inputCoilName">
                        نام کویل مورد نظر
                    </label>
                    <input type="text" class="input-text" id="inputCoilName" name="name" dir="ltr" value="{{ $name }}">
                </div>

                @can('show-calculate-category')
                    <div class="my-4 bg-red-300 p-4 rounded-md shadow-md">
                        <label class="block mb-2 text-sm font-bold" for="inputCoilCategory">
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
                @endcan

                <div class="mb-4">
                    <button type="submit" class="form-submit-btn">
                        ذخیره
                    </button>
                </div>
            </form>
        @endif
    </div>

</x-layout>

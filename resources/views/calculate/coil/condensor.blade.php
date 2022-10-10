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
    <nav class="flex bg-gray-100 p-4 rounded-md" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-2 space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center text-xs md:text-sm text-gray-500 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                         fill="currentColor">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    داشبورد
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                    <span class="mr-2 text-xs md:text-sm font-medium text-gray-400">
                        محاسبه قیمت کویل
                    </span>
                </div>
            </li>
        </ol>
    </nav>

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

    <form method="POST" action="{{ route('calculateCondensorCoil') }}">
        @csrf
        <input type="hidden" name="serial" value="{{ $inquiry->inquiry_number }}">
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
                            قیمت نهایی :
                            <span id="finalPriceTopSection">0</span>
                            تومان
                        </p>
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-4">
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputLooleMessi">لوله مسی کویل</label>
                        <select name="loole_messi" id="inputLooleMessi" class="input-text bg-yellow-300">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::where('id','53')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['loole_messi'] == "53" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','53')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','54')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['loole_messi'] == "54" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','54')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','55')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['loole_messi'] == "55" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','55')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','56')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['loole_messi'] == "56" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','56')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','57')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['loole_messi'] == "57" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','57')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','58')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['loole_messi'] == "58" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','58')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','59')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['loole_messi'] == "59" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','59')->first()->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputFin">فین کویل</label>
                        <select name="fin_coil" id="inputFin" class="input-text bg-yellow-300">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::where('id','60')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['fin_coil'] == "60" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','60')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','61')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['fin_coil'] == "61" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','61')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','62')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['fin_coil'] == "62" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','62')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','63')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['fin_coil'] == "63" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','63')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','64')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['fin_coil'] == "64" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','64')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','65')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['fin_coil'] == "65" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','65')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','66')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['fin_coil'] == "66" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','66')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','67')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['fin_coil'] == "67" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','67')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','68')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['fin_coil'] == "68" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','68')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','69')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['fin_coil'] == "69" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','69')->first()->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTedadRadif">تعداد ردیف کویل</label>
                        <select name="tedad_radif_coil" id="inputTedadRadif" class="input-text bg-yellow-300">
                            <option value="">انتخاب کنید</option>
                            <option value="1"
                                {{ is_null($inputs) ? '' : ($inputs['tedad_radif_coil'] == '1' ? 'selected' : '') }}>
                                1
                            </option>
                            <option value="2"
                                {{ is_null($inputs) ? '' : ($inputs['tedad_radif_coil'] == '2' ? 'selected' : '') }}>
                                2
                            </option>
                            <option value="3"
                                {{ is_null($inputs) ? '' : ($inputs['tedad_radif_coil'] == '3' ? 'selected' : '') }}>
                                3
                            </option>
                            <option value="4"
                                {{ is_null($inputs) ? '' : ($inputs['tedad_radif_coil'] == '4' ? 'selected' : '') }}>
                                4
                            </option>
                            <option value="6"
                                {{ is_null($inputs) ? '' : ($inputs['tedad_radif_coil'] == '6' ? 'selected' : '') }}>
                                6
                            </option>
                            <option value="8"
                                {{ is_null($inputs) ? '' : ($inputs['tedad_radif_coil'] == '8' ? 'selected' : '') }}>
                                8
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputFinDarInch">فین در اینچ</label>
                        <select name="fin_dar_inch" id="inputFinDarInch" class="input-text bg-yellow-300">
                            <option value="">انتخاب کنید</option>
                            <option value="4"
                                {{ is_null($inputs) ? '' : ($inputs['fin_dar_inch'] == '4' ? 'selected' : '') }}>
                                4
                            </option>
                            <option value="5"
                                {{ is_null($inputs) ? '' : ($inputs['fin_dar_inch'] == '5' ? 'selected' : '') }}>
                                5
                            </option>
                            <option value="6"
                                {{ is_null($inputs) ? '' : ($inputs['fin_dar_inch'] == '6' ? 'selected' : '') }}>
                                6
                            </option>
                            <option value="7"
                                {{ is_null($inputs) ? '' : ($inputs['fin_dar_inch'] == '7' ? 'selected' : '') }}>
                                7
                            </option>
                            <option value="8"
                                {{ is_null($inputs) ? '' : ($inputs['fin_dar_inch'] == '8' ? 'selected' : '') }}>
                                8
                            </option>
                            <option value="9"
                                {{ is_null($inputs) ? '' : ($inputs['fin_dar_inch'] == '9' ? 'selected' : '') }}>
                                9
                            </option>
                            <option value="10"
                                {{ is_null($inputs) ? '' : ($inputs['fin_dar_inch'] == '10' ? 'selected' : '') }}>
                                10
                            </option>
                            <option value="11"
                                {{ is_null($inputs) ? '' : ($inputs['fin_dar_inch'] == '11' ? 'selected' : '') }}>
                                11
                            </option>
                            <option value="12"
                                {{ is_null($inputs) ? '' : ($inputs['fin_dar_inch'] == '12' ? 'selected' : '') }}>
                                12
                            </option>
                            <option value="13"
                                {{ is_null($inputs) ? '' : ($inputs['fin_dar_inch'] == '13' ? 'selected' : '') }}>
                                13
                            </option>
                            <option value="14"
                                {{ is_null($inputs) ? '' : ($inputs['fin_dar_inch'] == '14' ? 'selected' : '') }}>
                                14
                            </option>
                            <option value="15"
                                {{ is_null($inputs) ? '' : ($inputs['fin_dar_inch'] == '15' ? 'selected' : '') }}>
                                15
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputKham">خم کویل</label>
                        <select name="kham" id="inputKham" class="input-text bg-yellow-300">
                            <option value="0">ندارد</option>
                            <option value="1"
                                {{ is_null($inputs) ? '' : ($inputs['kham'] == '1' ? 'selected' : '') }}>
                                1
                            </option>
                            <option value="2"
                                {{ is_null($inputs) ? '' : ($inputs['kham'] == '2' ? 'selected' : '') }}>
                                2
                            </option>
                            <option value="3"
                                {{ is_null($inputs) ? '' : ($inputs['kham'] == '3' ? 'selected' : '') }}>
                                3
                            </option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-bold" for="inputZekhamatFrame">ضخامت فریم کویل</label>
                        <select name="zekhamat_frame_coil" id="inputZekhamatFrame" class="input-text bg-yellow-300">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::where('id','1')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['zekhamat_frame_coil'] == "1" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','1')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','2')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['zekhamat_frame_coil'] == "2" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','2')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','3')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['zekhamat_frame_coil'] == "3" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','3')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','4')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['zekhamat_frame_coil'] == "4" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','4')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','5')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['zekhamat_frame_coil'] == "5" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','5')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','7')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['zekhamat_frame_coil'] == "7" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','7')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','8')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['zekhamat_frame_coil'] == "8" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','8')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','9')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['zekhamat_frame_coil'] == "9" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','9')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','10')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['zekhamat_frame_coil'] == "10" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','10')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','11')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['zekhamat_frame_coil'] == "11" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','11')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','12')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['zekhamat_frame_coil'] == "12" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','12')->first()->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputNoePoosheshZedeKhordegi">
                            نوع پوشش ضد خوردگی
                        </label>
                        <select name="pooshesh_khordegi" id="inputNoePoosheshZedeKhordegi"
                                class="input-text bg-yellow-300">
                            <option value="0"
                                {{ is_null($inputs) ? '' : ($inputs['pooshesh_khordegi'] == "0" ? 'selected' : '') }}>
                                ندارد
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? '' : ($inputs['pooshesh_khordegi'] == "1" ? 'selected' : '') }}>
                                هرسایت
                            </option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-bold" for="inputCollectorAhani">کلکتور ورودی</label>
                        <select name="collector_ahani" id="inputCollectorAhani" class="input-text bg-yellow-300">
                            <option value="0">ندارد</option>
                            <option value="{{ \App\Models\Part::where('id','77')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['collector_messi'] == "77" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','77')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','78')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['collector_messi'] == "78" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','78')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','79')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['collector_messi'] == "79" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','79')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','80')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['collector_messi'] == "80" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','80')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','81')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['collector_messi'] == "81" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','81')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','82')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['collector_messi'] == "82" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','82')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','83')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['collector_messi'] == "83" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','83')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','84')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['collector_messi'] == "84" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','84')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','85')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['collector_messi'] == "85" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','85')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','86')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['collector_messi'] == "86" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','86')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','87')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['collector_messi'] == "87" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','87')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','88')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['collector_messi'] == "88" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','88')->first()->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputCollectorMessi">کلکتور خروجی</label>
                        <select name="collector_messi" id="inputCollectorMessi" class="input-text bg-yellow-300">
                            <option value="0">ندارد</option>
                            <option value="{{ \App\Models\Part::where('id','77')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['collector_messi'] == "77" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','77')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','78')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['collector_messi'] == "78" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','78')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','79')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['collector_messi'] == "79" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','79')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','80')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['collector_messi'] == "80" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','80')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','81')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['collector_messi'] == "81" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','81')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','82')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['collector_messi'] == "82" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','82')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','83')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['collector_messi'] == "83" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','83')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','84')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['collector_messi'] == "84" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','84')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','85')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['collector_messi'] == "85" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','85')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','86')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['collector_messi'] == "86" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','86')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','87')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['collector_messi'] == "87" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','87')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','88')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['collector_messi'] == "88" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','88')->first()->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputElectrodNoghre">
                            الکترود نقره
                        </label>
                        <select name="electrod_noghre" id="inputElectrodNoghre" class="input-text bg-yellow-300">
                            <option value="">
                                انتخاب کنید
                            </option>
                            <option value="{{ \App\Models\Part::where('id','104')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['electrod_noghre'] == "104" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','104')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','105')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['electrod_noghre'] == "105" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','105')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','108')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['electrod_noghre'] == "108" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','108')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','413')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['electrod_noghre'] == "413" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','413')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','109')->first()->id }}"
                                {{ is_null($inputs) ? '' : ($inputs['electrod_noghre'] == "109" ? 'selected' : '') }}>
                                {{ \App\Models\Part::where('id','109')->first()->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTooleCoil">طول کویل (اینچ)</label>
                        <input name="toole_coil" type="text" class="input-text bg-yellow-300" id="inputTooleCoil"
                               value="{{ !is_null($inputs) ? $inputs['toole_coil'] : '' }}">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTedadLooleDarRadif">
                            تعداد لوله در ردیف
                        </label>
                        <input name="tedad_loole_dar_radif" type="text" class="input-text bg-yellow-300"
                               id="inputTedadLooleDarRadif"
                               value="{{ !is_null($inputs) ? $inputs['tedad_loole_dar_radif'] : '' }}">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTedadMogheyiatLooleDarRadif">
                            تعداد موقعیت یک لوله در ردیف
                        </label>
                        <input type="text" class="input-text bg-yellow-300" id="inputTedadMogheyiatLooleDarRadif"
                               name="tedad_mogheyiat_loole"
                               value="{{ !is_null($inputs) ? $inputs['tedad_mogheyiat_loole'] : '' }}">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTedadMadarLoole">تعداد مدار لوله</label>
                        <input type="text" class="input-text bg-yellow-300" id="inputTedadMadarLoole"
                               name="tedad_madar_loole"
                               value="{{ !is_null($inputs) ? $inputs['tedad_madar_loole'] : '' }}">
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
            <form method="POST" action="{{ route('calculateCoil.storeCondensor',[$part->id,$product->id]) }}"
                  class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4">
                @csrf
                <table class="border-collapse border border-gray-400 w-full">
                    <thead class="sticky top-1 bg-gray-200 z-50 shadow-md">
                    <tr>
                        <th class="border border-gray-300 p-4 text-sm">ردیف</th>
                        <th class="border border-gray-300 p-4 text-sm">شرح</th>
                        <th class="border border-gray-300 p-4 text-sm">مقدار / سایز</th>
                        <th class="border border-gray-300 p-4 text-sm">واحد</th>
                        @can('coil-table')
                            <th class="border border-gray-300 p-4 text-sm">قیمت واحد</th>
                            <th class="border border-gray-300 p-4 text-sm">قیمت کل</th>
                        @endcan
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $finalPrice = 0;
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
                                            <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                                                @if(!is_null($values))
                                                    <span>{{ number_format($values[$index], 2) }}</span>
                                                @endif
                                            </td>
                                            <td class="border border-gray-300 p-4 text-sm text-center">
                                                {{ $selectedParts[$index]->unit }}
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
                                    <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                                        <span>{{ number_format($values[$index], 2) }}</span>
                                    </td>
                                    <td class="border border-gray-300 p-4 text-sm text-center">
                                        {{ $child->unit }}
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
                                <input type="hidden" name="final_price" value="{{ $finalPrice }}">
                            </td>
                        </tr>
                    @endcan
                    </tbody>
                </table>

                <div class="my-4 bg-gray-100 p-4 rounded-md shadow-md">
                    <p class="text-xl font-bold text-black text-center">
                        قیمت نهایی : {{ number_format($finalPrice) }} تومان
                    </p>
                </div>

                <div class="my-4 bg-red-300 p-4 rounded-md shadow-md">
                    <label class="block mb-2 text-sm font-bold" for="inputCoilName">
                        نام کویل مورد نظر
                    </label>
                    <input type="text" class="input-text" id="inputCoilName" name="name" dir="ltr" value="{{ $name }}">
                </div>

                <div class="my-4 bg-red-300 p-4 rounded-md shadow-md">
                    <label class="block mb-2 text-sm font-bold" for="inputCoilCategory">
                        دسته بندی کویل
                    </label>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <select name="categories[]" id="inputCoilCategory" class="input-text" onchange="getCategory1()">
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
                        ثبت مقادیر
                    </button>
                </div>

            </form>
        @endif
    </div>
</x-layout>

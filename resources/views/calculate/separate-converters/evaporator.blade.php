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
            <li class="inline-flex items-center">
                <a href="{{ route('separate.coil.index') }}"
                   class="inline-flex items-center text-xs md:text-sm text-gray-500 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                    محاسبه قیمت جداگانه مبدل ها
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
                        محاسبه {{ $part->name }}
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
        $inputs = null;
        $values = null;
    @endphp

    <form method="POST" action="{{ route('separate.converter.calculateEvaporator') }}">
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
                        <label class="block mb-2 text-sm font-bold" for="inputSizeLoolePooste">سایز لوله پوسته</label>
                        <select name="size_loole_pooste" id="inputSizeLoolePooste" class="input-text bg-yellow-300">
                            <option value="">انتخاب کنید</option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('size_loole_pooste') == '1' ? 'selected' : '') : ($inputs['size_loole_pooste'] == "1" ? 'selected' : (old('size_loole_pooste') == '1' ? 'selected' : '')) }}>
                                1
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('size_loole_pooste') == '1' ? 'selected' : '') : ($inputs['size_loole_pooste'] == "1" ? 'selected' : (old('size_loole_pooste') == '1' ? 'selected' : '')) }}>
                                2
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('size_loole_pooste') == '1' ? 'selected' : '') : ($inputs['size_loole_pooste'] == "1" ? 'selected' : (old('size_loole_pooste') == '1' ? 'selected' : '')) }}>
                                3
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('size_loole_pooste') == '1' ? 'selected' : '') : ($inputs['size_loole_pooste'] == "1" ? 'selected' : (old('size_loole_pooste') == '1' ? 'selected' : '')) }}>
                                4
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputPichoMohre">پیچ و مهره</label>
                        <select name="picho_mohre" id="inputPichoMohre" class="input-text bg-yellow-300">
                            <option value="">انتخاب کنید</option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('picho_mohre') == '1' ? 'selected' : '') : ($inputs['picho_mohre'] == "1" ? 'selected' : (old('picho_mohre') == '1' ? 'selected' : '')) }}>
                                پیچ 1
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('picho_mohre') == '1' ? 'selected' : '') : ($inputs['picho_mohre'] == "1" ? 'selected' : (old('picho_mohre') == '1' ? 'selected' : '')) }}>
                                پیچ 2
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('picho_mohre') == '1' ? 'selected' : '') : ($inputs['picho_mohre'] == "1" ? 'selected' : (old('picho_mohre') == '1' ? 'selected' : '')) }}>
                                پیچ 3
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('picho_mohre') == '1' ? 'selected' : '') : ($inputs['picho_mohre'] == "1" ? 'selected' : (old('picho_mohre') == '1' ? 'selected' : '')) }}>
                                پیچ 4
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputAyegh">عایق</label>
                        <select name="ayegh" id="inputAyegh" class="input-text bg-yellow-300">
                            <option value="">انتخاب کنید</option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('ayegh') == '1' ? 'selected' : '') : ($inputs['ayegh'] == "1" ? 'selected' : (old('ayegh') == '1' ? 'selected' : '')) }}>
                                عایق 1
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('ayegh') == '1' ? 'selected' : '') : ($inputs['ayegh'] == "1" ? 'selected' : (old('ayegh') == '1' ? 'selected' : '')) }}>
                                عایق 2
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('ayegh') == '1' ? 'selected' : '') : ($inputs['ayegh'] == "1" ? 'selected' : (old('ayegh') == '1' ? 'selected' : '')) }}>
                                عایق 3
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('ayegh') == '1' ? 'selected' : '') : ($inputs['ayegh'] == "1" ? 'selected' : (old('ayegh') == '1' ? 'selected' : '')) }}>
                                عایق 4
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputSensor">سنسور های ورودی و خروجی</label>
                        <select name="sensor" id="inputSensor" class="input-text bg-yellow-300">
                            <option value="">انتخاب کنید</option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('sensor') == '1' ? 'selected' : '') : ($inputs['sensor'] == "1" ? 'selected' : (old('sensor') == '1' ? 'selected' : '')) }}>
                                سنسور 1
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('sensor') == '1' ? 'selected' : '') : ($inputs['sensor'] == "1" ? 'selected' : (old('sensor') == '1' ? 'selected' : '')) }}>
                                سنسور 2
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('sensor') == '1' ? 'selected' : '') : ($inputs['sensor'] == "1" ? 'selected' : (old('sensor') == '1' ? 'selected' : '')) }}>
                                سنسور 3
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('sensor') == '1' ? 'selected' : '') : ($inputs['sensor'] == "1" ? 'selected' : (old('sensor') == '1' ? 'selected' : '')) }}>
                                سنسور 4
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputCap">کپ</label>
                        <select name="cap" id="inputCap" class="input-text bg-yellow-300">
                            <option value="">انتخاب کنید</option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('cap') == '1' ? 'selected' : '') : ($inputs['cap'] == "1" ? 'selected' : (old('cap') == '1' ? 'selected' : '')) }}>
                                کپ 1
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('cap') == '1' ? 'selected' : '') : ($inputs['cap'] == "1" ? 'selected' : (old('cap') == '1' ? 'selected' : '')) }}>
                                کپ 2
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('cap') == '1' ? 'selected' : '') : ($inputs['cap'] == "1" ? 'selected' : (old('cap') == '1' ? 'selected' : '')) }}>
                                کپ 3
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('cap') == '1' ? 'selected' : '') : ($inputs['cap'] == "1" ? 'selected' : (old('cap') == '1' ? 'selected' : '')) }}>
                                کپ 4
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputNavdani">ناودانی</label>
                        <select name="navdani" id="inputNavdani" class="input-text bg-yellow-300">
                            <option value="">انتخاب کنید</option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('navdani') == '1' ? 'selected' : '') : ($inputs['navdani'] == "1" ? 'selected' : (old('navdani') == '1' ? 'selected' : '')) }}>
                                ناودانی 1
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('navdani') == '1' ? 'selected' : '') : ($inputs['navdani'] == "1" ? 'selected' : (old('navdani') == '1' ? 'selected' : '')) }}>
                                ناودانی 2
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('navdani') == '1' ? 'selected' : '') : ($inputs['navdani'] == "1" ? 'selected' : (old('navdani') == '1' ? 'selected' : '')) }}>
                                ناودانی 3
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('navdani') == '1' ? 'selected' : '') : ($inputs['navdani'] == "1" ? 'selected' : (old('navdani') == '1' ? 'selected' : '')) }}>
                                ناودانی 4
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputBoshen">بوشن فشار قوی 1</label>
                        <select name="boshen1" id="inputBoshen" class="input-text bg-yellow-300">
                            <option value="">انتخاب کنید</option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('boshen1') == '1' ? 'selected' : '') : ($inputs['boshen1'] == "1" ? 'selected' : (old('boshen1') == '1' ? 'selected' : '')) }}>
                                بوشن 1
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('boshen1') == '1' ? 'selected' : '') : ($inputs['boshen1'] == "1" ? 'selected' : (old('boshen1') == '1' ? 'selected' : '')) }}>
                                بوشن 2
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('boshen1') == '1' ? 'selected' : '') : ($inputs['boshen1'] == "1" ? 'selected' : (old('boshen1') == '1' ? 'selected' : '')) }}>
                                بوشن 3
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('boshen1') == '1' ? 'selected' : '') : ($inputs['boshen1'] == "1" ? 'selected' : (old('boshen1') == '1' ? 'selected' : '')) }}>
                                بوشن 4
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputBoshen2">بوشن فشار قوی 2</label>
                        <select name="boshen2" id="inputBoshen2" class="input-text bg-yellow-300">
                            <option value="">انتخاب کنید</option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('boshen2') == '1' ? 'selected' : '') : ($inputs['boshen2'] == "1" ? 'selected' : (old('boshen2') == '1' ? 'selected' : '')) }}>
                                بوشن 1
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('boshen2') == '1' ? 'selected' : '') : ($inputs['boshen2'] == "1" ? 'selected' : (old('boshen2') == '1' ? 'selected' : '')) }}>
                                بوشن 2
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('boshen2') == '1' ? 'selected' : '') : ($inputs['boshen2'] == "1" ? 'selected' : (old('boshen2') == '1' ? 'selected' : '')) }}>
                                بوشن 3
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('boshen2') == '1' ? 'selected' : '') : ($inputs['boshen2'] == "1" ? 'selected' : (old('boshen2') == '1' ? 'selected' : '')) }}>
                                بوشن 4
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputFlanch">فلنج ورودی و خروجی</label>
                        <select name="flanch" id="inputFlanch" class="input-text bg-yellow-300">
                            <option value="">انتخاب کنید</option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('flanch') == '1' ? 'selected' : '') : ($inputs['flanch'] == "1" ? 'selected' : (old('flanch') == '1' ? 'selected' : '')) }}>
                                فلنج 1
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('flanch') == '1' ? 'selected' : '') : ($inputs['flanch'] == "1" ? 'selected' : (old('flanch') == '1' ? 'selected' : '')) }}>
                                فلنج 2
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('flanch') == '1' ? 'selected' : '') : ($inputs['flanch'] == "1" ? 'selected' : (old('flanch') == '1' ? 'selected' : '')) }}>
                                فلنج 3
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('flanch') == '1' ? 'selected' : '') : ($inputs['flanch'] == "1" ? 'selected' : (old('flanch') == '1' ? 'selected' : '')) }}>
                                فلنج 4
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTube">تیوپ شیت</label>
                        <select name="tube" id="inputTube" class="input-text bg-yellow-300">
                            <option value="">انتخاب کنید</option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('tube') == '1' ? 'selected' : '') : ($inputs['tube'] == "1" ? 'selected' : (old('tube') == '1' ? 'selected' : '')) }}>
                                تیوپ 1
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('tube') == '1' ? 'selected' : '') : ($inputs['tube'] == "1" ? 'selected' : (old('tube') == '1' ? 'selected' : '')) }}>
                                تیوپ 2
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('tube') == '1' ? 'selected' : '') : ($inputs['tube'] == "1" ? 'selected' : (old('tube') == '1' ? 'selected' : '')) }}>
                                تیوپ 3
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('tube') == '1' ? 'selected' : '') : ($inputs['tube'] == "1" ? 'selected' : (old('tube') == '1' ? 'selected' : '')) }}>
                                تیوپ 4
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputRing">رینگ روبند</label>
                        <select name="ring" id="inputRing" class="input-text bg-yellow-300">
                            <option value="">انتخاب کنید</option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('ring') == '1' ? 'selected' : '') : ($inputs['ring'] == "1" ? 'selected' : (old('ring') == '1' ? 'selected' : '')) }}>
                                رینگ 1
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('ring') == '1' ? 'selected' : '') : ($inputs['ring'] == "1" ? 'selected' : (old('ring') == '1' ? 'selected' : '')) }}>
                                رینگ 2
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('ring') == '1' ? 'selected' : '') : ($inputs['ring'] == "1" ? 'selected' : (old('ring') == '1' ? 'selected' : '')) }}>
                                رینگ 3
                            </option>
                            <option value="1"
                                {{ is_null($inputs) ? (old('ring') == '1' ? 'selected' : '') : ($inputs['ring'] == "1" ? 'selected' : (old('ring') == '1' ? 'selected' : '')) }}>
                                رینگ 4
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTooleLooleMessi">طول لوله مسی</label>
                        <input name="toole_loole_messi" type="text" class="input-text bg-yellow-300" id="inputTooleLooleMessi"
                               value="{{ !is_null($inputs) ? $inputs['toole_loole_messi'] : old('toole_loole_messi') }}">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTooleLooleMessi">تعداد لوله مسی</label>
                        <input name="tedad_loole_messi" type="text" class="input-text bg-yellow-300" id="inputTedadLooleMessi"
                               value="{{ !is_null($inputs) ? $inputs['tedad_loole_messi'] : old('tedad_loole_messi') }}">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTooleLoolePooste">طول لوله پوسته</label>
                        <input name="toole_loole_pooste" type="text" class="input-text bg-yellow-300" id="inputTooleLoolePooste"
                               value="{{ !is_null($inputs) ? $inputs['toole_loole_pooste'] : old('toole_loole_pooste') }}">
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
            <form method="POST" action="{{ route('separate.converter.storeEvaporator',$part->id) }}"
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
                    <input type="hidden" name="price" value="{{ $finalPrice }}">
                </div>

                <div class="my-4 bg-red-300 p-4 rounded-md shadow-md">
                    <label class="block mb-2 text-sm font-bold" for="inputCoilName">
                        نام کویل مورد نظر
                    </label>
                    <input type="text" class="input-text" id="inputCoilName" name="name" dir="ltr"
                           value="{{ $name }}">
                </div>

                @can('users')
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

<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script>
            function changeUnit1(event, part) {
                let value = event.target.value;
                let input2 = document.getElementById('inputUnit' + part.id);
                let inputValue = document.getElementById('inputUnitValue' + part.id);
                let operator1 = part.operator2;
                let formula1 = part.formula2;
                let result = 0;

                result = eval(value + operator1 + formula1);
                input2.value = Intl.NumberFormat().format(result);
                inputValue.value = Intl.NumberFormat().format(result);
            }

            function changeUnit2(event, part) {
                let value = event.target.value;
                let input1 = document.getElementById('inputValue' + part.id);
                let inputValue = document.getElementById('inputUnitValue' + part.id);
                let operator2 = part.operator1;
                let formula2 = part.formula1;
                let result = 0;

                result = eval(value + operator2 + formula2);
                input1.value = Intl.NumberFormat().format(result);
                inputValue.value = value;
            }
        </script>
        <script>
            function changePart(event, part) {
                let id = event.target.value;
                let section = document.getElementById('groupPartList' + part);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('inquiries.product.changePart') }}',
                    data: {
                        id: id,
                        part: part,
                    },
                    success: function (res) {
                        let parts = res.data;
                        section.innerHTML = `
                            <select class="input-text" onchange="changePart(event,${part})" id="inputCategory${part}">
                                    ${
                            parts.map(function (part) {
                                return `<option value="${part.id}">${part.name}</option>`
                            })
                        }
                            </select>`
                    }
                });
            }
        </script>
    </x-slot>

    <!-- Breadcrumb -->
    <nav class="flex bg-gray-100 p-4 rounded-md overflow-x-auto whitespace-nowrap" aria-label="Breadcrumb">
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
            <li>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                    <a href="{{ route('separate.electrical.index') }}"
                       class="mr-2 text-xs md:text-sm font-medium text-gray-500 hover:text-gray-900">
                        محاسبه قیمت تابلو برق محلی
                    </a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                    <span class="mr-2 text-xs md:text-sm font-medium text-gray-400">
                        محاسبه قیمت {{ $part->name }}
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    @php
        $values = Session::get('values');
        $selectedParts = Session::get('selectedParts');
        $inputs = Session::get('inputs');
        $name = Session::get('name');
    @endphp

    <form method="POST" action="">
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
                        <label class="block mb-2 text-sm font-bold" for="inputKilidVoroodi">کلید ورودی تابلو برق</label>
                        <select name="kilid_voroodi" id="inputKilidVoroodi" class="input-text bg-yellow-300">
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
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputKilidCompressor">
                            کلید کمپرسور
                        </label>
                        <select name="kilid_compressor" id="inputKilidCompressor" class="input-text bg-yellow-300">
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
                        <label class="block mb-2 text-sm font-bold" for="inputContactorCompressor">
                            کنتاکتور کمپرسور
                        </label>
                        <select name="contactor_compressor" id="inputContactorCompressor"
                                class="input-text bg-yellow-300">
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
                        <label class="block mb-2 text-sm font-bold" for="inputContactorSetareCompressor">
                            کنتاکتور ستاره مثلث کمپرسور
                        </label>
                        <select name="contactor_setare_compressor" id="inputContactorSetareCompressor"
                                class="input-text bg-yellow-300">
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
                        <label class="block mb-2 text-sm font-bold" for="inputKilidHavaresan">
                            کلید موتور فن هوارسان
                        </label>
                        <select name="kilid_havaresan" id="inputKilidHavaresan" class="input-text bg-yellow-300">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::find('1180')->id }}"
                                {{ is_null($inputs) ? (old('picho_mohre') == '1180' ? 'selected' : '') : ($inputs['picho_mohre'] == "1180" ? 'selected' : (old('picho_mohre') == '1180' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1180')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1181')->id }}"
                                {{ is_null($inputs) ? (old('picho_mohre') == '1181' ? 'selected' : '') : ($inputs['picho_mohre'] == "1181" ? 'selected' : (old('picho_mohre') == '1181' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1181')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1182')->id }}"
                                {{ is_null($inputs) ? (old('picho_mohre') == '1182' ? 'selected' : '') : ($inputs['picho_mohre'] == "1182" ? 'selected' : (old('picho_mohre') == '1182' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1182')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1183')->id }}"
                                {{ is_null($inputs) ? (old('picho_mohre') == '1183' ? 'selected' : '') : ($inputs['picho_mohre'] == "1183" ? 'selected' : (old('picho_mohre') == '1183' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1183')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1184')->id }}"
                                {{ is_null($inputs) ? (old('picho_mohre') == '1184' ? 'selected' : '') : ($inputs['picho_mohre'] == "1184" ? 'selected' : (old('picho_mohre') == '1184' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1184')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1185')->id }}"
                                {{ is_null($inputs) ? (old('picho_mohre') == '1185' ? 'selected' : '') : ($inputs['picho_mohre'] == "1185" ? 'selected' : (old('picho_mohre') == '1185' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1185')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1186')->id }}"
                                {{ is_null($inputs) ? (old('picho_mohre') == '1186' ? 'selected' : '') : ($inputs['picho_mohre'] == "1186" ? 'selected' : (old('picho_mohre') == '1186' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1186')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1187')->id }}"
                                {{ is_null($inputs) ? (old('picho_mohre') == '1187' ? 'selected' : '') : ($inputs['picho_mohre'] == "1187" ? 'selected' : (old('picho_mohre') == '1187' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1187')->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputContactorFanHavasaz">
                            کنتاکتور موتور فن هواساز
                        </label>
                        <select name="contactor_fan_havasaz" id="inputContactorFanHavasaz"
                                class="input-text bg-yellow-300">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::find('885')->id }}"
                                {{ is_null($inputs) ? (old('ayegh') == '885' ? 'selected' : '') : ($inputs['ayegh'] == "885" ? 'selected' : (old('ayegh') == '885' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('885')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('886')->id }}"
                                {{ is_null($inputs) ? (old('ayegh') == '886' ? 'selected' : '') : ($inputs['ayegh'] == "886" ? 'selected' : (old('ayegh') == '886' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('886')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('887')->id }}"
                                {{ is_null($inputs) ? (old('ayegh') == '887' ? 'selected' : '') : ($inputs['ayegh'] == "887" ? 'selected' : (old('ayegh') == '887' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('887')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('888')->id }}"
                                {{ is_null($inputs) ? (old('ayegh') == '888' ? 'selected' : '') : ($inputs['ayegh'] == "888" ? 'selected' : (old('ayegh') == '888' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('888')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('889')->id }}"
                                {{ is_null($inputs) ? (old('ayegh') == '889' ? 'selected' : '') : ($inputs['ayegh'] == "889" ? 'selected' : (old('ayegh') == '889' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('889')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('890')->id }}"
                                {{ is_null($inputs) ? (old('ayegh') == '890' ? 'selected' : '') : ($inputs['ayegh'] == "890" ? 'selected' : (old('ayegh') == '890' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('890')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('891')->id }}"
                                {{ is_null($inputs) ? (old('ayegh') == '891' ? 'selected' : '') : ($inputs['ayegh'] == "891" ? 'selected' : (old('ayegh') == '891' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('891')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('892')->id }}"
                                {{ is_null($inputs) ? (old('ayegh') == '892' ? 'selected' : '') : ($inputs['ayegh'] == "892" ? 'selected' : (old('ayegh') == '892' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('892')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('893')->id }}"
                                {{ is_null($inputs) ? (old('ayegh') == '893' ? 'selected' : '') : ($inputs['ayegh'] == "893" ? 'selected' : (old('ayegh') == '893' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('893')->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputInverterFanHavasaz">
                            اینورتر موتور فن هواساز
                        </label>
                        <select name="inverter_fan_havasaz" id="inputInverterFanHavasaz"
                                class="input-text bg-yellow-300">
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
                        <label class="block mb-2 text-sm font-bold" for="inputKilidElectroFan">
                            کلید الکتروفن کندانسور
                        </label>
                        <select name="kilid_electro_fan" id="inputKilidElectroFan" class="input-text bg-yellow-300">
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
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputContactorElectroFan">
                            کنتاکتور الکتروفن کندانسور
                        </label>
                        <select name="contactor_electro_fan" id="inputContactorElectroFan"
                                class="input-text bg-yellow-300">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::find('995')->id }}"
                                {{ is_null($inputs) ? (old('boshen1') == '995' ? 'selected' : '') : ($inputs['boshen1'] == "995" ? 'selected' : (old('boshen1') == '995' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('995')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1165')->id }}"
                                {{ is_null($inputs) ? (old('boshen1') == '1165' ? 'selected' : '') : ($inputs['boshen1'] == "1165" ? 'selected' : (old('boshen1') == '1165' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1165')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1166')->id }}"
                                {{ is_null($inputs) ? (old('boshen1') == '1166' ? 'selected' : '') : ($inputs['boshen1'] == "1166" ? 'selected' : (old('boshen1') == '1166' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1166')->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputInverterElectroFan">
                            اینورتر الکتروفن کندانسور
                        </label>
                        <select name="inverter_electro_fan" id="inputInverterElectroFan"
                                class="input-text bg-yellow-300">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::find('995')->id }}"
                                {{ is_null($inputs) ? (old('boshen2') == '995' ? 'selected' : '') : ($inputs['boshen2'] == "995" ? 'selected' : (old('boshen2') == '995' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('995')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1165')->id }}"
                                {{ is_null($inputs) ? (old('boshen2') == '1165' ? 'selected' : '') : ($inputs['boshen2'] == "1165" ? 'selected' : (old('boshen2') == '1165' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1165')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1166')->id }}"
                                {{ is_null($inputs) ? (old('boshen2') == '1166' ? 'selected' : '') : ($inputs['boshen2'] == "1166" ? 'selected' : (old('boshen2') == '1166' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1166')->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputRele">
                            رله
                        </label>
                        <select name="rele" id="inputRele"
                                class="input-text bg-yellow-300">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::find('995')->id }}"
                                {{ is_null($inputs) ? (old('boshen2') == '995' ? 'selected' : '') : ($inputs['boshen2'] == "995" ? 'selected' : (old('boshen2') == '995' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('995')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1165')->id }}"
                                {{ is_null($inputs) ? (old('boshen2') == '1165' ? 'selected' : '') : ($inputs['boshen2'] == "1165" ? 'selected' : (old('boshen2') == '1165' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1165')->name }}
                            </option>
                            <option value="{{ \App\Models\Part::find('1166')->id }}"
                                {{ is_null($inputs) ? (old('boshen2') == '1166' ? 'selected' : '') : ($inputs['boshen2'] == "1166" ? 'selected' : (old('boshen2') == '1166' ? 'selected' : '')) }}>
                                {{ \App\Models\Part::find('1166')->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTransform">
                            تراتسفور ماتور 220 به 24 ولت
                        </label>
                        <input name="transform" type="text" class="input-text bg-yellow-300"
                               id="inputTransform"
                               value="{{ !is_null($inputs) ? $inputs['tedad_loole_messi'] : old('tedad_loole_messi') }}">
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
        <!-- Laptop List -->
        <form method="POST" action="">
            @csrf

            <div class="bg-white shadow overflow-x-auto rounded-lg hidden md:block">
                <table class="min-w-full">
                    <thead>
                    <tr class="bg-sky-200">
                        <th scope="col"
                            class="px-4 py-2 text-sm font-bold text-gray-800 text-center rounded-tr-md">
                            ردیف
                        </th>
                        <th scope="col" class="px-4 py-2 text-sm font-bold text-gray-800 text-center">
                            دسته بندی
                        </th>
                        <th scope="col" class="px-4 py-2 text-sm font-bold text-gray-800 text-center">
                            نام
                        </th>
                        <th scope="col" class="px-4 py-2 text-sm font-bold text-gray-800 text-center">
                            واحد
                        </th>
                        <th scope="col" class="px-4 py-2 text-sm font-bold text-gray-800 text-center">
                            مقادیر
                        </th>
                        <th scope="col" class="px-4 py-2 text-sm font-bold text-gray-800 text-center">
                            قیمت
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($part->children()->orderBy('sort','ASC')->get() as $index => $child)
                        @php
                            $category = $child->categories[1];
                            $selectedCategory = $child->categories[2];
                        @endphp
                        @switch($index)
                            @case('0')
                                <tr class="bg-yellow-500">
                                    <td class="px-4 py-2 text-center text-sm font-bold" colspan="6">
                                        مشخصات کلید و المانهای ورودی
                                    </td>
                                </tr>
                                @break
                            @case('3')
                                <tr class="bg-yellow-500">
                                    <td class="px-4 py-2 text-center text-sm font-bold" colspan="6">
                                        مشخصات کلید و کنتاکتورهای کمپرسور
                                    </td>
                                </tr>
                                @break
                            @case('9')
                                <tr class="bg-yellow-500">
                                    <td class="px-4 py-2 text-center text-sm font-bold" colspan="6">
                                        مشخصات کلید و کنتاکتورهای فن الکترو موتور فن هوارسان
                                    </td>
                                </tr>
                                @break
                            @case('13')
                                <tr class="bg-yellow-500">
                                    <td class="px-4 py-2 text-center text-sm font-bold" colspan="6">
                                        مشخصات کلید و کنتاکتورهای فن الکتروفن‌های کندانسور
                                    </td>
                                </tr>
                                @break
                            @case('17')
                                <tr class="bg-yellow-500">
                                    <td class="px-4 py-2 text-center text-sm font-bold" colspan="6">
                                        مشخصات کلیدها و کنتاکتورهای هیتر الکتریکی
                                    </td>
                                </tr>
                                @break
                            @case('19')
                                <tr class="bg-yellow-500">
                                    <td class="px-4 py-2 text-center text-sm font-bold" colspan="6">
                                        مشخصات کلیدها و کنتاکتورهای رطوبت زن
                                    </td>
                                </tr>
                                @break
                            @case('21')
                                <tr class="bg-yellow-500">
                                    <td class="px-4 py-2 text-center text-sm font-bold" colspan="6">
                                        اطلاعات سیم و کابل
                                    </td>
                                </tr>
                                @break
                            @case('24')
                                <tr class="bg-yellow-500">
                                    <td class="px-4 py-2 text-center text-sm font-bold" colspan="6">
                                        سایر تجهیزات
                                    </td>
                                </tr>
                                @break
                        @endswitch
                        <tr>
                            <td class="px-4 py-1 whitespace-nowrap">
                                <input type="text" class="input-text w-14 text-center" name="sorts[]"
                                       id="partSort{{ $child->id }}"
                                       value="{{ $child->pivot->sort == 0 ||  $child->pivot->sort == null ? $loop->index+1 : $child->pivot->sort }}">
                            </td>
                            <td class="px-4 py-1">
                                <select name="" id="inputCategory{{ $child->id }}" class="input-text"
                                        onchange="changePart(event,{{ $child->id }})">
                                    @foreach($category->children as $child2)
                                        <option
                                            value="{{ $child2->id }}" {{ $child2->id == $selectedCategory->id ? 'selected' : '' }}>
                                            {{ $child2->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-4 py-1 whitespace-nowrap">
                                @php
                                    $selectedPart = \App\Models\Part::find($child->id);
                                    $lastCategory = $selectedPart->categories()->latest()->first();
                                    $categoryParts = $lastCategory->parts;
                                @endphp
                                <select name="part_ids[]" class="input-text" id="groupPartList{{ $child->id }}"
                                        onchange="showCalculateButton('{{ $child->id }}')">
                                    @foreach($categoryParts as $part2)
                                        <option
                                            value="{{ $part2->id }}" {{ $part2->id == $child->id ? 'selected' : '' }}>
                                            {{ $part2->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-4 py-1 whitespace-nowrap">
                                <p class="text-sm text-black text-center">
                                    {{ $child->unit }}
                                    @if(!is_null($child->unit2))
                                        / {{ $child->unit2 }}
                                    @endif
                                </p>
                            </td>
                            <td class="px-4 py-1 whitespace-nowrap">
                                <input type="text" name="values[]" id="inputValue{{ $child->id }}"
                                       class="input-text w-24 text-center" onkeyup="changeUnit1(event,{{ $child }})"
                                       value="{{ $child->pivot->value ?? '' }}">
                                @if(!is_null($child->unit2))
                                    <input type="text" id="inputUnit{{ $child->id }}"
                                           class="input-text w-20 text-center" onkeyup="changeUnit2(event,{{ $child }})"
                                           placeholder="{{ $child->unit2 }}" value="{{ $child->pivot->value2 }}">
                                @endif
                                <input type="hidden" name="units[]" id="inputUnitValue{{ $child->id }}"
                                       value="{{ $child->pivot->value2 }}">
                            </td>
                            <td class="px-4 py-1 whitespace-nowrap">
                                @if($child->price)
                                    <p class="text-sm text-black font-medium text-center">
                                        {{ number_format($child->price) }} تومان
                                    </p>
                                @else
                                    <p class="text-sm font-medium text-center">
                                        منتظر قیمت گذاری
                                    </p>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="my-4">
                <button type="submit" class="form-submit-btn">
                    محاسبه
                </button>
            </div>

        </form>
    </div>
</x-layout>

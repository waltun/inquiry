<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
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
            function changeRoute(type, part, inquiry) {
                let form = document.getElementById('form');

                if (type == 'calculate') {
                    form.action = '/inquiry-part-electrical/calculate/chiller';
                    form.submit();
                }

                if (type == 'post') {
                    form.action = '/inquiry-part-electrical/' + inquiry + '/' + part + '/store-chiller';
                    form.submit();
                }
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
        $sorts = Session::get('sorts');
        $name = Session::get('name');
        $values = Session::get('values');
        $part_ids = Session::get('part_ids');
    @endphp
        <!-- Content -->
    <div class="mt-4">
        <!-- Laptop List -->
        <form method="POST" action="" id="form">
            @csrf

            <div class="bg-white shadow overflow-x-auto rounded-lg hidden md:block">
                <table class="w-full border-collapse">
                    <thead class="bg-indigo-300">
                    <tr class="table-th-tr">
                        <th scope="col" class="p-4 rounded-tr-lg">
                            ردیف
                        </th>
                        <th scope="col" class="p-4">
                            دسته بندی
                        </th>
                        <th scope="col" class="p-4">
                            نام
                        </th>
                        <th scope="col" class="p-4">
                            واحد
                        </th>
                        <th scope="col" class="p-4">
                            مقادیر
                        </th>
                        <th scope="col" class="p-4">
                            قیمت
                        </th>
                        <th scope="col" class="p-4 rounded-tl-lg">
                            قیمت کل
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $finalPrice = 0;
                        $finalWeight = 0;
                    @endphp
                    @foreach($part->children()->orderBy('sort','ASC')->get() as $index => $child)
                        <tr class="bg-yellow-500">
                            <td class="px-4 py-2 text-center text-sm font-bold" colspan="7">
                                {{ $child->name }}
                            </td>
                        </tr>
                        @foreach($child->children()->wherePivot('head_part_id', null)->orderBy('sort', 'ASC')->get() as $index2 => $ch)
                            @php
                                if (!is_null($part_ids)){
                                    $ch = \App\Models\Part::find($part_ids[$index][$index2]);
                                    $finalPrice += $ch->price * (int)$values[$index][$index2];
                                    $finalWeight += $ch->weight * (int)$values[$index][$index2];
                                } else {
                                    $finalPrice += $ch->price * (int)$ch->pivot->value;
                                    $finalWeight += $ch->weight * (int)$ch->pivot->value;
                                }
                                $category = $ch->categories[1];
                                $selectedCategory = $ch->categories[2];
                            @endphp
                            <tr class="table-tb-tr group {{ $loop->even ? 'bg-sky-100' : '' }}">
                                <td class="table-tr-td border-t-0 border-l-0">
                                    @if(!is_null($part_ids))
                                        <input type="text" class="input-text w-14 text-center"
                                               name="sorts[{{ $index }}][{{ $index2 }}]"
                                               id="partSort{{ $ch->id }}" value="{{ $sorts[$index][$index2] }}">
                                    @else
                                        <input type="text" class="input-text w-14 text-center"
                                               name="sorts[{{ $index }}][{{ $index2 }}]"
                                               id="partSort{{ $ch->id }}"
                                               value="{{ $ch->pivot->sort == 0 ||  $ch->pivot->sort == null ? $loop->index+1 : $ch->pivot->sort }}">
                                    @endif
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    <select name="" id="inputCategory{{ $ch->id }}" class="input-text"
                                            onchange="changePart(event,{{ $ch->id }})">
                                        @foreach($category->children as $child2)
                                            <option
                                                value="{{ $child2->id }}" {{ $child2->id == $selectedCategory->id ? 'selected' : '' }}>
                                                {{ $child2->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    @php
                                        $selectedPart = \App\Models\Part::find($ch->id);
                                        $lastCategory = $selectedPart->categories()->latest()->first();
                                        $categoryParts = $lastCategory->parts;
                                    @endphp
                                    <select name="part_ids[{{ $index }}][{{ $index2 }}]" class="input-text"
                                            id="groupPartList{{ $ch->id }}">
                                        @foreach($categoryParts as $part2)
                                            <option
                                                value="{{ $part2->id }}" {{ $part2->id == $ch->id ? 'selected' : '' }}>
                                                {{ $part2->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    <p class="text-sm text-black text-center">
                                        {{ $ch->unit }}
                                    </p>
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    @if(!is_null($part_ids))
                                        <input type="text" name="values[{{ $index }}][{{ $index2 }}]"
                                               id="inputValue{{ $ch->id }}"
                                               class="input-text w-24 text-center"
                                               value="{{ $values[$index][$index2] }}">
                                    @else
                                        <input type="text" name="values[{{ $index }}][{{ $index2 }}]"
                                               id="inputValue{{ $ch->id }}"
                                               class="input-text w-24 text-center"
                                               value="{{ $ch->pivot->value ?? '' }}">
                                    @endif
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    @if($ch->price)
                                        <p class="text-sm text-black font-medium text-center">
                                            {{ number_format($ch->price) }} تومان
                                        </p>
                                    @else
                                        <p class="text-sm font-medium text-center">
                                            منتظر قیمت گذاری
                                        </p>
                                    @endif
                                </td>
                                <td class="table-tr-td border-t-0 border-r-0">
                                    @if(!is_null($part_ids))
                                        <p class="text-sm text-black font-medium text-center">
                                            {{ number_format($ch->price * $values[$index][$index2]) }} تومان
                                        </p>
                                    @else
                                        <p class="text-sm text-black font-medium text-center">
                                            {{ number_format($ch->price * $ch->pivot->value) }} تومان
                                        </p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="my-4 bg-gray-100 p-4 rounded-md shadow-md">
                <p class="text-xl font-bold text-black text-center">
                    قیمت نهایی : {{ number_format($finalPrice) }} تومان
                </p>
                <input type="hidden" name="price" value="{{ $finalPrice }}">
            </div>

            <div class="my-4 flex justify-between items-center">
                <div class="flex items-center space-x-2 space-x-reverse">
                    <button type="button" class="form-submit-btn"
                            onclick="changeRoute('calculate')">
                        محاسبه
                    </button>
                    <a href="{{ route('inquiries.parts.index',$inquiry->id) }}" class="form-cancel-btn">
                        انصراف (خروج)
                    </a>
                </div>
                <div class="space-y-2">
                    <p class="px-4 py-2 text-sm rounded-md bg-green-500 font-bold text-white">
                        قیمت کل : {{ number_format($finalPrice) }} تومان
                    </p>
                    <p class="px-4 py-2 text-sm rounded-md bg-gray-500 font-bold text-white">
                        وزن دستگاه : {{ number_format($finalWeight) }} کیلوگرم
                    </p>
                </div>
            </div>

            @if(!is_null($part_ids))
                <div class="grid grid-cols-2 gap-4">
                    <div class="my-4 bg-red-300 p-4 rounded-md shadow-md">
                        <label class="block mb-2 text-sm font-bold" for="inputCoilName">
                            نام تابلو برق مورد نظر
                        </label>
                        <input type="text" class="input-text" id="inputCoilName" name="name" dir="ltr"
                               value="{{ $name }}">
                    </div>

                    <div class="my-4 bg-red-300 p-4 rounded-md shadow-md">
                        <label class="block mb-2 text-sm font-bold" for="inputQuantity">
                            تعداد تابلو برق مورد نظر
                        </label>
                        <input type="text" class="input-text" id="inputQuantity" name="quantity">
                    </div>
                </div>

                @can('users')
                    <div class="my-4 bg-red-300 p-4 rounded-md shadow-md">
                        <label class="block mb-2 text-sm font-bold" for="inputCoilCategory">
                            دسته بندی تابلو برق
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
                    <button type="button" class="form-submit-btn"
                            onclick="changeRoute('post',{{ $part->id }},{{ $inquiry->id }})">
                        ذخیره
                    </button>
                </div>
            @endif

        </form>
    </div>
</x-layout>

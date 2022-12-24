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
            function changeRoute(type, part, product) {
                let form = document.getElementById('form');

                if (type == 'calculate') {
                    form.action = '/calculate/zent-electrical';
                    form.submit();
                }

                if (type == 'post') {
                    form.action = '/calculate/electrical/' + part + '/' + product + '/post-zent';
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

        $modell = \App\Models\Modell::find($product->model_id);
    @endphp

        <!-- Content -->
    <div class="mt-4">
        <!-- Laptop List -->
        <form method="POST" action="" id="form">
            @csrf
            <input type="hidden" name="serial" value="{{ $inquiry->inquiry_number }}">
            <input type="hidden" name="product_model" value="{{ $product->model_custom_name ?? $modell->name }}">

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
                    @php
                        $finalPrice = 0;
                    @endphp
                    @foreach($part->children()->orderBy('sort','ASC')->get() as $index => $child)
                        @php
                            if (!is_null($part_ids)){
                                $child = \App\Models\Part::find($part_ids[$index]);
                            }
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
                            @case('8')
                                <tr class="bg-yellow-500">
                                    <td class="px-4 py-2 text-center text-sm font-bold" colspan="6">
                                        مشخصات کلید و کنتاکتورهای فن الکترو موتور فن هوارسان
                                    </td>
                                </tr>
                                @break
                            @case('14')
                                <tr class="bg-yellow-500">
                                    <td class="px-4 py-2 text-center text-sm font-bold" colspan="6">
                                        مشخصات کلید و کنتاکتور الکترو پمپ‌ ها
                                    </td>
                                </tr>
                                @break
                            @case('18')
                                <tr class="bg-yellow-500">
                                    <td class="px-4 py-2 text-center text-sm font-bold" colspan="6">
                                        مشخصات کلیدها و کنتاکتورهای هیتر الکتریکی
                                    </td>
                                </tr>
                                @break
                            @case('22')
                                <tr class="bg-yellow-500">
                                    <td class="px-4 py-2 text-center text-sm font-bold" colspan="6">
                                        مشخصات کلیدها و کنتاکتورهای رطوبت زن
                                    </td>
                                </tr>
                                @break
                            @case('24')
                                <tr class="bg-yellow-500">
                                    <td class="px-4 py-2 text-center text-sm font-bold" colspan="6">
                                        اطلاعات سیم و کابل
                                    </td>
                                </tr>
                                @break
                            @case('28')
                                <tr class="bg-yellow-500">
                                    <td class="px-4 py-2 text-center text-sm font-bold" colspan="6">
                                        سایر تجهیزات
                                    </td>
                                </tr>
                                @break
                            @case('38')
                                <tr class="bg-yellow-500">
                                    <td class="px-4 py-2 text-center text-sm font-bold" colspan="6">
                                        اقلام کنترلی
                                    </td>
                                </tr>
                                @break
                        @endswitch
                        <tr>
                            <td class="px-4 py-1 whitespace-nowrap">
                                @if(!is_null($part_ids))
                                    <input type="text" class="input-text w-14 text-center" name="sorts[]"
                                           id="partSort{{ $child->id }}" value="{{ $sorts[$index] }}">
                                @else
                                    <input type="text" class="input-text w-14 text-center" name="sorts[]"
                                           id="partSort{{ $child->id }}"
                                           value="{{ $child->pivot->sort == 0 ||  $child->pivot->sort == null ? $loop->index+1 : $child->pivot->sort }}">
                                @endif
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
                                <select name="part_ids[]" class="input-text" id="groupPartList{{ $child->id }}">
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
                                </p>
                            </td>
                            <td class="px-4 py-1 whitespace-nowrap">
                                @if(!is_null($part_ids))
                                    <input type="text" name="values[]" id="inputValue{{ $child->id }}"
                                           class="input-text w-24 text-center" value="{{ $values[$index] }}">
                                @else
                                    <input type="text" name="values[]" id="inputValue{{ $child->id }}"
                                           class="input-text w-24 text-center" value="{{ $child->pivot->value ?? '' }}">
                                @endif
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
                        @php
                            if (!is_null($part_ids)) {
                                $finalPrice += $values[$index] * $child->price;
                            } else {
                                $finalPrice += $child->pivot->value * $child->price;
                            }
                        @endphp
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

            <div class="my-4">
                <button type="button" class="form-submit-btn"
                        onclick="changeRoute('calculate',{{ $part->id }},{{ $product->id }})">
                    محاسبه
                </button>
            </div>

            @if(!is_null($part_ids))
                <div class="my-4 bg-red-300 p-4 rounded-md shadow-md">
                    <label class="block mb-2 text-sm font-bold" for="inputCoilName">
                        نام تابلو برق مورد نظر
                    </label>
                    <input type="text" class="input-text" id="inputCoilName" name="name" dir="ltr"
                           value="{{ $name }}">
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
                            onclick="changeRoute('post',{{ $part->id }},{{ $product->id }})">
                        ذخیره
                    </button>
                </div>
            @endif

        </form>
    </div>
</x-layout>

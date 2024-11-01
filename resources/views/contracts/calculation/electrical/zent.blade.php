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
            function changeRoute(type, contract, part, product, part2) {
                let form = document.getElementById('form');

                if (type == 'calculate') {
                    form.action = '/contracts/' + contract + '/zent-electrical';
                    form.submit();
                }

                if (type == 'post') {
                    form.action = '/contracts/' + contract + '/electrical/' + part + '/' + product + '/' + part2 + '/post-zent';
                    form.submit();
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
                    محاسبه قیمت {{ $part->name }}
                </p>
            </div>
        </div>
    </div>

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
            <input type="hidden" name="product_model" value="{{ $product->model_custom_name ?? $modell->name }}">

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
                                if (!is_null($part_ids)) {
                                    $ch = \App\Models\Part::find($part_ids[$index][$index2]);
                                    $finalPrice += $ch->price * $values[$index][$index2];
                                    $finalWeight += $ch->weight * $values[$index][$index2];
                                } else {
                                    $finalPrice += $ch->price * $ch->pivot->value;
                                    $finalWeight += $ch->weight * $ch->pivot->value;
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
                                        @foreach($categoryParts as $part3)
                                            <option
                                                value="{{ $part3->id }}" {{ $part3->id == $ch->id ? 'selected' : '' }}>
                                                {{ $part3->name }}
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
                            onclick="changeRoute('calculate',{{ $part->id }},{{ $product->id }})">
                        محاسبه
                    </button>
                    <a href="{{ route('inquiries.product.amounts',$product->id) }}" class="form-cancel-btn">
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
                            onclick="changeRoute('post', {{ $contract->id }}, {{ $part->id }}, {{ $product->id }}, {{ $part2->id }})">
                        ذخیره
                    </button>
                </div>
            @endif

        </form>
    </div>
</x-layout>

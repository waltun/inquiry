<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script>
            function getCategory1() {
                let id = document.getElementById('inputCategory1').value;
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
                            <select class="input-text" onchange="getCategory2()" id="inputCategory2" name="category2">
                                <option value="">انتخاب زیر دسته</option>
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
                            <select class="input-text" name="category3" id="inputCategory3" onchange="searchCategory()">
                                <option value="">انتخاب زیر دسته</option>
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

            function searchCategory() {
                let form = document.getElementById('search-category')
                form.submit();
            }
        </script>
        <script>
            function changeUnit1(event, part) {
                let value = event.target.value;
                let input2 = document.getElementById('inputQuantity2' + part.id);
                let inputValue = document.getElementById('inputUnitValue' + part.id);
                let operator1 = part.operator2;
                let formula1 = part.formula2;
                let result;

                result = eval(value + operator1 + formula1);
                let formatResult = Intl.NumberFormat().format(result);
                input2.value = formatResult.replace(',', '');
                inputValue.value = result;
            }

            function changeUnit2(event, part) {
                let value = event.target.value;
                let input1 = document.getElementById('inputQuantity' + part.id);
                let inputValue = document.getElementById('inputUnitValue' + part.id);
                let operator2 = part.operator1;
                let formula2 = part.formula1;
                let result;

                result = eval(value + operator2 + formula2);
                input1.value = Intl.NumberFormat().format(result);
                inputValue.value = value;
            }
        </script>
        <script>
            let submitButton = document.getElementById('submit-button');
            submitButton.addEventListener('click', function () {
                submitButton.classList.add('hidden')
            });
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
                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    مشاهده قرارداد {{ $contract->name }}
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
        <a href="{{ route('contracts.parts.index', $contract->id) }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    قطعات محصولات قرارداد
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
                    قطعات محصولات قرارداد {{ $contract->name }} - CNT-{{ $contract->number }}
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="flex items-center justify-between mt-8">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-8 h-8 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            <div class="mr-2">
                <p class="font-bold text-2xl text-black dark:text-white">
                    افزودن قطعه به قرارداد {{ $contract->name }} - CNT-{{ $contract->number }}
                </p>
            </div>

            @if(request()->has('search') || request()->has('category1') || request()->has('category2') || request()->has('category3'))
                <a href="{{ route('contracts.parts.add-single-part', [$contract->id, $product->id]) }}"
                   class="mr-4 text-sm font-medium underline underline-offset-4 text-indigo-500">
                    پاکسازی جستجو
                </a>
            @endif
        </div>
    </div>

    <!-- Search -->
    <div class="bg-white rounded-lg shadow border border-gray-200 p-4 mt-4">
        <div class="grid grid-cols-4 gap-4">
            <form class="col-span-1">
                <input type="text" id="inputSearch" name="search" class="input-text" placeholder="مثال : جستجو + اینتر"
                       value="{{ request('search') }}">
            </form>

            <form class="col-span-3 grid grid-cols-3 gap-4" id="search-category">
                <div>
                    <select name="category1" id="inputCategory1" class="input-text" onchange="getCategory1()">
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
                    @if(request()->has('category2'))
                        @php
                            $category2 = \App\Models\Category::find(request('category1'))->children;
                        @endphp
                        <select name="category2" id="inputCategory2" class="input-text" onchange="getCategory2()">
                            <option value="">انتخاب زیر دسته</option>
                            @foreach($category2 as $category)
                                <option
                                        value="{{ $category->id }}" {{ request('category2') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    @endif
                </div>
                <div id="categorySection2">
                    @if(request()->has('category3'))
                        @php
                            $category3 = \App\Models\Category::find(request('category2'))->children;
                        @endphp
                        <select name="category3" id="inputCategory3" class="input-text" onchange="searchCategory()">
                            <option value="">انتخاب زیر دسته</option>
                            @foreach($category3 as $category)
                                <option
                                        value="{{ $category->id }}" {{ request('category3') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Content -->
    <div class="mt-4 space-y-4">
        <div class="mt-8 overflow-x-auto rounded-lg">
            <table class="w-full border-collapse">
                <thead>
                <tr class="table-th-tr">
                    <th scope="col" class="p-4 rounded-tr-lg">
                        #
                    </th>
                    <th scope="col" class="p-4">
                        نام
                    </th>
                    <th scope="col" class="p-4">
                        واحد
                    </th>
                    <th scope="col" class="p-4">
                        قیمت
                    </th>
                    <th scope="col" class="p-4 rounded-tl-lg">
                        <span class="sr-only">اقدامات</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($parts as $part)
                    <tr class="table-tb-tr group">
                        <td class="table-tr-td border-t-0 border-l-0">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            @if(in_array($part->id,$contract->products->pluck('part_id')->toArray()))
                                <p class="text-red-600">{{ $part->name }}</p>
                            @else
                                {{ $part->name }}
                            @endif
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $part->unit }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ number_format($part->price) }}
                        </td>
                        <td class="table-tr-td border-t-0 border-r-0">
                            <div class="inline-flex" x-data="{open:false}">
                                <button type="button" class="table-success-btn" @click="open=!open">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 4.5v15m7.5-7.5h-15"/>
                                    </svg>
                                    افزودن به قرارداد
                                </button>
                                <div class="relative z-10" x-show="open" x-cloak>
                                    <div class="modal-backdrop"></div>
                                    <div class="fixed z-10 inset-0 overflow-y-auto">
                                        <div class="modal">
                                            <div class="modal-body">
                                                <div class="bg-white dark:bg-slate-800 p-4">
                                                    <div class="mb-4 flex justify-between items-center">
                                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                            اضافه کردن قطعه به قرارداد {{ $contract->name }}
                                                        </h3>
                                                        <button type="button" @click="open = false">
                                                            <span class="modal-close">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     fill="none"
                                                                     viewBox="0 0 24 24"
                                                                     stroke-width="1.5"
                                                                     stroke="currentColor"
                                                                     class="w-5 h-5 dark:text-white">
                                                                    <path stroke-linecap="round"
                                                                          stroke-linejoin="round"
                                                                          d="M6 18L18 6M6 6l12 12"/>
                                                                </svg>
                                                            </span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" class="mt-6"
                                                          action="{{ route('contracts.parts.store-single-part',[$contract->id,$product->id]) }}">
                                                        @csrf
                                                        <input type="hidden" name="part_id" value="{{ $part->id }}">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="inputQuantity">
                                                                تعداد قطعه
                                                                @if(!is_null($part->unit2))
                                                                    <span class="text-xs font-bold">
                                                                        ( واحد : {{ $part->unit }} / {{ $part->unit2 }} )
                                                                    </span>
                                                                @endif
                                                            </label>
                                                            <input type="text" class="input-text w-1/2" name="quantity"
                                                                   id="inputQuantity{{ $part->id }}"
                                                                   placeholder="{{ $part->unit }}"
                                                                   onkeyup="changeUnit1(event,{{ $part }})">
                                                            @if(!is_null($part->unit2))
                                                                /
                                                                <input type="text" class="input-text w-1/3"
                                                                       name="quantity2"
                                                                       id="inputQuantity2{{ $part->id }}"
                                                                       placeholder="{{ $part->unit2 }}"
                                                                       onkeyup="changeUnit2(event,{{ $part }})">
                                                            @endif
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="form-label" for="inputTag">
                                                                تگ
                                                            </label>
                                                            <input type="text" class="input-text" name="tag"
                                                                   id="inputTag"
                                                                   placeholder="تگ / شماره سریال و...">
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="form-label" for="inputType">
                                                                نوع قطعه
                                                            </label>
                                                            <select name="type" id="inputType" class="input-text">
                                                                <option value="">انتخاب کنید</option>
                                                                <option value="setup">قطعات یدکی راه اندازی</option>
                                                                <option value="setup_one">قطعات راه اندازی</option>
                                                                <option value="install">قطعات نصب</option>
                                                                <option value="years">قطعات یدکی دو سالانه</option>
                                                                <option value="control">قطعات کنترلی</option>
                                                                <option value="power_cable">لیست کابل قدرت</option>
                                                                <option value="control_cable">لیست کابل کنترلی</option>
                                                                <option value="cable">اقلام کابل کشی</option>
                                                                <option value="canal">اقلام کانال کشی</option>
                                                                <option value="pipe">لیست لوله و اتصالات</option>
                                                                <option value="install_setup_price">
                                                                    دستمزد نصب و راه اندازی
                                                                </option>
                                                                <option value="setup_price">دستمزد راه اندازی</option>
                                                                <option value="supervision">دستمزد نظارت</option>
                                                                <option value="copper_piping">دستمزد لوله کشی مسی
                                                                </option>
                                                                <option value="carbon_piping">دستمزد لوله کربن استیل
                                                                </option>
                                                                <option value="transport">هزینه حمل</option>
                                                                <option value="coil">انواع کویل</option>
                                                                <option value="other">سایر تجهیزات</option>
                                                            </select>
                                                        </div>
                                                        <div
                                                                class="flex justify-end items-center space-x-4 space-x-reverse">
                                                            <button type="submit" class="form-submit-btn"
                                                                    id="submit-button">
                                                                ثبت
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4 hidden md:block">
            {{ $parts->links() }}
        </div>
    </div>
</x-layout>

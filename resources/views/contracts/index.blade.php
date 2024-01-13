<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
        <script>
            function searchForm() {
                let form = document.getElementById('search-form');
                form.submit();
            }

            $("#inputCustomer").select2();
        </script>
    </x-slot>
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
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
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg-active">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    قرارداد ها
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="md:flex items-center justify-between mt-8 space-y-4 md:space-y-0">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-8 h-8 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
            </svg>
            <div class="mr-2 flex items-center">
                <p class="font-bold text-2xl text-black dark:text-white">
                    لیست قراردادها
                </p>
                @if(request()->has('search') || request()->has('type') || request()->has('customer'))
                    <a href="{{ route('contracts.index') }}"
                       class="text-sm font-bold underline underline-offset-4 text-indigo-500 mr-4">
                        پاکسازی فیلتر
                    </a>
                @endif
            </div>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse">
            <a href="{{ route('contracts.create') }}" class="page-success-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                <span class="mr-2">ایجاد قرارداد جدید</span>
            </a>
            <a href="{{ route('final-contracts.index') }}" class="page-warning-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
                </svg>
                <span class="mr-2">لیست قراردادهای تمام شده</span>
            </a>
        </div>
    </div>

    <div class="mt-4">

        <!-- Search -->
        <form action="" method="get" class="grid grid-cols-3 gap-4" id="search-form">
            <div>
                <input type="text" name="search" value="{{ request('search') }}" class="input-text"
                       placeholder="جستجوی نام و شماره قرارداد + اینتر ">
            </div>
            <div>
                <select name="type" class="input-text" onchange="searchForm()">
                    <option value="">نوع قراداد</option>
                    <option value="official" {{ request('type') == 'official' ? 'selected' : '' }}>
                        رسمی
                    </option>
                    <option value="operational" {{ request('type') == 'operational' ? 'selected' : '' }}>
                        عملکردی
                    </option>
                </select>
            </div>
            <div>
                <select name="customer" class="input-text" onchange="searchForm()" id="inputCustomer">
                    <option value="">انتخاب مشتری</option>
                    @foreach($customers as $customer)
                        <option
                            value="{{ $customer->id }}" {{ request('customer') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <!-- Content -->
        <div class="mt-4 space-y-4">
            <div class="overflow-x-auto rounded-lg hidden md:block">
                <table class="w-full border-collapse">
                    <thead>
                    <tr class="table-th-tr">
                        <th scope="col" class="p-2 rounded-tr-lg">
                            شماره قرارداد
                        </th>
                        <th scope="col" class="p-2">
                            شماره قرارداد قبلی
                        </th>
                        <th scope="col" class="p-2">
                            نام خریدار
                        </th>
                        <th scope="col" class="p-2">
                            نام پروژه
                        </th>
                        <th scope="col" class="p-2">
                            مسئول پروژه
                        </th>
                        <th scope="col" class="p-2">
                            بازاریاب
                        </th>
                        <th scope="col" class="p-2">
                            تاریخ
                        </th>
                        @can('contract-price')
                            <th scope="col" class="p-2">
                                قیمت کل (تومان)
                            </th>
                            <th scope="col" class="p-2">
                                بدهی (تومان)
                            </th>
                        @endcan
                        <th scope="col" class="p-2">
                            محصولات
                        </th>
                        <th scope="col" class="p-2 rounded-tl-lg">
                            <span class="sr-only">اقدامات</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contracts as $contract)
                        @php
                            $contractPrice = 0;
                            $paymentPrice = 0;
                            $leftPrice = 0;
                            $collectionPrice = 0;

                            foreach ($contract->products as $product) {
                                $contractPrice += $product->price * $product->quantity;
                            }

                            foreach ($contract->payments()->where('confirm', 1)->get() as $payment2) {
                                if ($payment2->type == 'return') {
                                    $paymentPrice -= $payment2->price;
                                } else {
                                    $paymentPrice += $payment2->price;
                                }

                                if (is_null($payment2->account_id) && $payment2->cash_type == 'check') {
                                    $collectionPrice += $payment2->price;
                                }
                            }

                            $tax = $contractPrice * 9 / 100;
                            $contractTaxPrice = $contractPrice + $tax;

                            $leftPrice = $contractPrice - $paymentPrice;
                            $leftTaxPrice = $contractTaxPrice - $paymentPrice;
                        @endphp
                        <tr class="table-tb-tr group hover:font-bold hover:text-red-600 {{ $loop->even ? 'bg-sky-100' : '' }}">
                            <td class="table-tr-td border-t-0 border-l-0 group-hover:scale-110">
                                <a href="{{ route('contracts.show', $contract->id) }}">
                                    {{ "CNT-" . $contract->number }}
                                </a>
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0 group-hover:scale-110">
                                <a href="{{ route('contracts.show', $contract->id) }}">
                                    {{ $contract->old_number ?? '-' }}
                                </a>
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0 group-hover:scale-110">
                                <a href="{{ route('contracts.show', $contract->id) }}">
                                    {{ $contract->customer->name }}
                                </a>
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0 group-hover:scale-110">
                                <a href="{{ route('contracts.show', $contract->id) }}">
                                    {{ $contract->name ?? '-' }}
                                </a>
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0 group-hover:scale-110">
                                <a href="{{ route('contracts.show', $contract->id) }}">
                                    {{ $contract->user->name }}
                                </a>
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0 group-hover:scale-110">
                                <a href="{{ route('contracts.show', $contract->id) }}">
                                    @if(!$contract->marketings->isEmpty())
                                        دارد
                                    @else
                                        ندارد
                                    @endif
                                </a>
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0 group-hover:scale-110">
                                <a href="{{ route('contracts.show', $contract->id) }}">
                                    {{ jdate($contract->start_contract_date)->format('Y/m/d') }}
                                </a>
                            </td>
                            @can('contract-price')
                                <td class="table-tr-td border-t-0 border-x-0 group-hover:scale-110">
                                    <a href="{{ route('contracts.show', $contract->id) }}">
                                        @if($contract->type == 'official')
                                            {{ number_format($contractTaxPrice) }}
                                        @else
                                            {{ number_format($contractPrice) }}
                                        @endif
                                    </a>
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0 group-hover:scale-110">
                                    <a href="{{ route('contracts.show', $contract->id) }}">
                                        @if($contract->type == 'official')
                                            {{ number_format($leftTaxPrice) }}
                                        @else
                                            {{ number_format($leftPrice) }}
                                        @endif
                                    </a>
                                </td>
                            @endcan
                            <td class="table-tr-td border-t-0 border-x-0">
                                @if(!$contract->products->isEmpty())
                                    <div class="flex items-center justify-center" x-data="{open: false}">
                                        <button type="button" class="table-dropdown-copy" @click="open = !open">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </button>

                                        <!-- Contract Product Modal -->
                                        <div class="relative z-10" x-show="open" x-cloak>
                                            <div class="modal-backdrop"></div>
                                            <div class="fixed z-10 inset-0 overflow-y-auto">
                                                <div class="modal">
                                                    <div class="modal-body">
                                                        <div class="bg-white dark:bg-slate-800 p-4">
                                                            <div class="mb-4 flex justify-between items-center">
                                                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                                    محصولات قرارداد {{ $contract->name }} -
                                                                    CNT-{{ $contract->number }}
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
                                                            <div class="mt-6 space-y-4">
                                                                @foreach($contract->products()->where('group_id','!=',0)->where('model_id','!=',0)->get() as $product)
                                                                    @php
                                                                        $modell = \App\Models\Modell::find($product->model_id);
                                                                    @endphp
                                                                    <div class="p-2 rounded-lg border border-gray-200">
                                                                        <div
                                                                            class="space-x-4 space-x-reverse flex items-center">
                                                                            <p class="text-sm font-medium">
                                                                                {{ $modell->parent->name }}
                                                                                - {{ $product->model_custom_name ?? $modell->name }}
                                                                            </p>
                                                                            <p class="text-sm font-medium">
                                                                                تعداد : {{ $product->quantity }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                @endforeach

                                                                @php
                                                                    $types = ['setup','years','control','power_cable','control_cable','pipe','install_setup_price','setup_price','supervision','transport','other','setup_one','install','cable','canal','copper_piping','carbon_piping', 'coil',null];
                                                                @endphp
                                                                @foreach($types as $type)
                                                                    @php
                                                                        $products = $contract->products()->where('part_id','!=',0)->where('type',$type)->get();
                                                                    @endphp
                                                                    @if(!$products->isEmpty())
                                                                        <div
                                                                            class="p-2 rounded-lg border border-gray-200">
                                                                            <div class="mb-2">
                                                                                @switch($type)
                                                                                    @case('setup')
                                                                                        قطعات یدکی راه اندازی
                                                                                        @break
                                                                                    @case('years')
                                                                                        قطعات یدکی دوسالانه
                                                                                        @break
                                                                                    @case('control')
                                                                                        قطعات کنترلی
                                                                                        @break
                                                                                    @case('power_cable')
                                                                                        قطعات کابل قدرت
                                                                                        @break
                                                                                    @case('control_cable')
                                                                                        قطعات کابل کنترلی
                                                                                        @break
                                                                                    @case('pipe')
                                                                                        قطعات لوله و اتصالات
                                                                                        @break
                                                                                    @case('install_setup_price')
                                                                                        دستمزد نصب و راه اندازی
                                                                                        @break
                                                                                    @case('setup_price')
                                                                                        دستمزد راه اندازی
                                                                                        @break
                                                                                    @case('supervision')
                                                                                        دستمزد نظارت
                                                                                        @break
                                                                                    @case('transport')
                                                                                        هزینه حمل
                                                                                        @break
                                                                                    @case('other')
                                                                                        سایر تجهیزات
                                                                                        @break
                                                                                    @case('setup_one')
                                                                                        قطعات راه اندازی
                                                                                        @break
                                                                                    @case('install')
                                                                                        قطعات نصب
                                                                                        @break
                                                                                    @case('cable')
                                                                                        اقلام کابل کشی
                                                                                        @break
                                                                                    @case('canal')
                                                                                        اقلام کانال کشی
                                                                                        @break
                                                                                    @case('copper_piping')
                                                                                        دستمزد لوله کشی مسی
                                                                                        @break
                                                                                    @case('carbon_piping')
                                                                                        دستمزد لوله کشی کربن استیل
                                                                                        @break
                                                                                    @case('coil')
                                                                                        انواع کویل
                                                                                        @break
                                                                                    @case('')
                                                                                        سایر تجهیزات (قطعات قبلی)
                                                                                        @break
                                                                                @endswitch
                                                                            </div>
                                                                            @foreach($products as $product)
                                                                                @php
                                                                                    $part = \App\Models\Part::find($product->part_id);
                                                                                @endphp
                                                                                <div
                                                                                    class="mb-2 flex items-center space-x-4 space-x-reverse">
                                                                                    <p class="text-sm font-medium">
                                                                                        {{ $part->name  }}
                                                                                    </p>
                                                                                    <p class="text-sm font-medium">
                                                                                        تعداد
                                                                                        : {{ $product->quantity  }}
                                                                                    </p>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </td>
                            <td class="table-tr-td border-t-0 border-r-0">
                                <div class="flex items-center justify-center space-x-4 space-x-reverse">
                                    <div x-data="{open : false}" class="relative">
                                        <button @click="open = !open">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                                            </svg>
                                        </button>

                                        <div x-show="open" @click.away="open = false"
                                             class="table-dropdown -top-4 left-8"
                                             x-cloak>
                                            <form action="{{ route('contracts.complete', $contract->id) }}"
                                                  method="POST">
                                                @csrf

                                                <button type="submit" class="table-success-btn text-xs"
                                                        onclick="return confirm('اتمام قرارداد ؟')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M4.5 12.75l6 6 9-13.5"/>
                                                    </svg>
                                                    اتمام
                                                </button>
                                            </form>

                                            <a href="{{ route('contracts.edit', $contract->id) }}"
                                               class="table-dropdown-edit text-xs">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                                </svg>
                                                ویرایش
                                            </a>

                                            @if(auth()->user()->role == 'admin')
                                                <form action="{{ route('contracts.destroy', $contract->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="table-dropdown-delete text-xs"
                                                            onclick="return confirm('قرارداد حذف شود ؟')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24"
                                                             stroke-width="1.5" stroke="currentColor"
                                                             class="w-4 h-4 ml-1">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                        </svg>
                                                        حذف
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $contracts->links() }}
            </div>
        </div>
    </div>
</x-layout>

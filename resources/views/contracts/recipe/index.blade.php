<x-layout>
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
        <a href="{{ route('contracts.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
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
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
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
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg-active">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 4.5v15m6-15v15m-10.875 0h15.75c.621 0 1.125-.504 1.125-1.125V5.625c0-.621-.504-1.125-1.125-1.125H4.125C3.504 4.5 3 5.004 3 5.625v12.75c0 .621.504 1.125 1.125 1.125z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    دستور ساخت قرارداد {{ $contract->name }} - CNT-{{ $contract->number }}
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
                      d="M9 4.5v15m6-15v15m-10.875 0h15.75c.621 0 1.125-.504 1.125-1.125V5.625c0-.621-.504-1.125-1.125-1.125H4.125C3.504 4.5 3 5.004 3 5.625v12.75c0 .621.504 1.125 1.125 1.125z"/>
            </svg>
            <div class="mr-2">
                <p class="font-bold text-2xl text-black dark:text-white">
                    دستور ساخت قرارداد {{ $contract->name }} - CNT-{{ $contract->number }}
                </p>
            </div>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse">
            <a href="{{ route('contracts.recipe.parts', $contract->id) }}" class="page-info-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-4 h-4 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                </svg>
                ویرایش دستورساخت
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="mt-4 space-y-4">
        <!-- Product List -->
        @if(!$contract->products()->where('group_id','!=',0)->where('model_id','!=',0)->get()->isEmpty())
            <div class="card">
                <div class="card-header">
                    <p class="card-title text-lg">لیست محصولات</p>
                </div>

                <div class="mt-8 overflow-x-auto rounded-lg">
                    <table class="w-full border-collapse">
                        <thead>
                        <tr class="table-th-tr">
                            <th scope="col" class="p-4 rounded-tr-lg">
                                ردیف
                            </th>
                            <th scope="col" class="p-4">
                                دسته محصول
                            </th>
                            <th scope="col" class="p-4">
                                مدل محصول
                            </th>
                            <th scope="col" class="p-4">
                                تگ
                            </th>
                            <th scope="col" class="p-4">
                                تعداد
                            </th>
                            <th scope="col" class="p-4">
                                تغییرات
                            </th>
                            <th scope="col" class="p-4">
                                پایان ساخت
                            </th>
                            <th scope="col" class="p-4">
                                پکینگ
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contract->products()->where('group_id','!=',0)->where('model_id','!=',0)->get() as $product)
                            <input type="hidden" name="products[]" value="{{ $product->id }}">
                            @php
                                $modell = \App\Models\Modell::find($product->model_id);
                            @endphp
                            <tr class="table-tb-tr group whitespace-normal {{ $loop->even ? 'bg-sky-100' : '' }} {{ $product->status == 'end' ? 'text-green-600 font-bold' : '' }}">
                                <td class="table-tr-td border-t-0 border-l-0">
                                    {{ $loop->index + 1 }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    <a href="#product{{ $product->id }}">
                                        {{ $modell->parent->name }}
                                    </a>
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ $product->model_custom_name ?? $modell->name }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ $product->description ?? '-' }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ $product->quantity }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    @if(!$product->histories->isEmpty())
                                        <div class="flex items-center justify-center" x-data="{open:false}">
                                            <button class="table-warning-btn" @click="open = !open" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                مشاهده
                                            </button>
                                            <div class="relative z-10" x-show="open" x-cloak>
                                                <div class="modal-backdrop"></div>
                                                <div class="fixed z-10 inset-0 overflow-y-auto">
                                                    <div class="modal">
                                                        <div class="modal-body">
                                                            <div class="bg-white dark:bg-slate-800 p-4">
                                                                <div class="mb-4 flex justify-between items-center">
                                                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                                        تغییرات قطعات محصول {{ $modell->parent->name }}
                                                                        - {{ $product->model_custom_name ?? $modell->name }}
                                                                    </h3>
                                                                    <button type="button" @click="open = false">
                                                                    <span class="modal-close">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                             fill="none"
                                                                             viewBox="0 0 24 24"
                                                                             stroke-width="1.5" stroke="currentColor"
                                                                             class="w-5 h-5 dark:text-white">
                                                                            <path stroke-linecap="round"
                                                                                  stroke-linejoin="round"
                                                                                  d="M6 18L18 6M6 6l12 12"/>
                                                                        </svg>
                                                                    </span>
                                                                    </button>
                                                                </div>
                                                                <div class="mt-6 space-y-2">
                                                                    @foreach($product->histories as $history)
                                                                        <div
                                                                            class="p-2 border border-gray-200 rounded-lg">
                                                                            <div class="grid grid-cols-5 gap-4">
                                                                                <div>
                                                                                    <p class="text-xs font-medium text-black">
                                                                                        تاریخ
                                                                                        : {{ jdate($history->created_at)->format('Y/m/d') }}
                                                                                    </p>
                                                                                </div>
                                                                                <div>
                                                                                    @php
                                                                                        $user = \App\Models\User::find($history->user_id);
                                                                                    @endphp
                                                                                    <p class="text-xs font-medium text-black">
                                                                                        توسط : {{ $user->name }}
                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-span-3">
                                                                                    @php
                                                                                        $oldPart = \App\Models\Part::find($history->old_part_id);
                                                                                        $newPart = \App\Models\Part::find($history->new_part_id);
                                                                                    @endphp
                                                                                    <p class="text-xs font-medium text-black">
                                                                                        @switch($history->type)
                                                                                            @case('change')
                                                                                                قطعه <span
                                                                                                    class="text-indigo-600">{{ $oldPart->name }}</span>
                                                                                                به <span
                                                                                                    class="text-indigo-600">{{ $newPart->name }}</span>
                                                                                                تغییر یافت
                                                                                                @break
                                                                                        @endswitch
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    @if($product->status == 'end')
                                        <div class="flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="2" stroke="currentColor" class="w-4 h-4 ml-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M4.5 12.75l6 6 9-13.5"/>
                                            </svg>
                                            صادر شده ( {{ jdate($product->end_at)->format('Y/m/d') }} )
                                        </div>
                                    @else
                                        <form method="POST" class="flex justify-center"
                                              action="{{ route('contracts.recipe.end-of-production', [$contract->id, $product->id]) }}">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit" class="table-success-btn"
                                                    onclick="return confirm('پایان ساخت صادر شود ؟')">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                                                </svg>
                                                صدور
                                            </button>
                                        </form>
                                    @endif
                                </td>
                                <td class="table-tr-td border-t-0 border-r-0">
                                    @if(!is_null($product->packing_id))
                                        {{ $product->packing->name }}
                                    @else
                                        <div class="flex items-center justify-center" x-data="{open:false}">
                                            <button class="table-warning-btn" @click="open = !open" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                انتخاب پکینگ
                                            </button>
                                            <div class="relative z-10" x-show="open" x-cloak>
                                                <div class="modal-backdrop"></div>
                                                <div class="fixed z-10 inset-0 overflow-y-auto">
                                                    <div class="modal">
                                                        <div class="modal-body">
                                                            <form method="POST"
                                                                  action="{{ route('contracts.recipe.add-to-packing', [$contract->id, $product->id]) }}"
                                                                  class="bg-white dark:bg-slate-800 p-4">
                                                                @csrf
                                                                @method('PATCH')

                                                                <div class="mb-4 flex justify-between items-center">
                                                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                                        اضافه کردن محصول به پکینگ
                                                                    </h3>
                                                                    <button type="button" @click="open = false">
                                                                    <span class="modal-close">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                             fill="none"
                                                                             viewBox="0 0 24 24"
                                                                             stroke-width="1.5" stroke="currentColor"
                                                                             class="w-5 h-5 dark:text-white">
                                                                            <path stroke-linecap="round"
                                                                                  stroke-linejoin="round"
                                                                                  d="M6 18L18 6M6 6l12 12"/>
                                                                        </svg>
                                                                    </span>
                                                                    </button>
                                                                </div>
                                                                <div class="mt-6 space-y-2">
                                                                    <div class="mb-4">
                                                                        <label for="inputPacking" class="form-label">
                                                                            انتخاب پکینگ
                                                                        </label>
                                                                        <select name="packing_id" id="inputPacking"
                                                                                class="input-text">
                                                                            <option value="">انتخاب کنید</option>
                                                                            @foreach($contract->packings as $packing)
                                                                                <option value="{{ $packing->id }}">
                                                                                    {{ $packing->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="flex justify-end">
                                                                        <button type="submit" class="form-submit-btn">
                                                                            افزودن
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Part List -->
        @php
            $types = ['setup','years','control','power_cable','control_cable','pipe','install_setup_price','setup_price','supervision','transport','other','setup_one','install','cable','canal','copper_piping','carbon_piping', 'coil',null];
        @endphp
        @foreach($types as $type)
            @php
                $products = $contract->products()->where('part_id','!=',0)->where('type',$type)->get();
            @endphp
            @if(!$products->isEmpty())
                <div class="card">
                    <div class="card-header">
                        <p class="card-title text-lg">
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
                        </p>
                    </div>
                    <table class="w-full border-collapse">
                        <thead>
                        <tr class="table-th-tr">
                            <th class="p-4 rounded-tr-lg">ردیف</th>
                            <th class="p-4">نام قطعه</th>
                            <th class="p-4">واحد</th>
                            <th class="p-4">تعداد</th>
                            <th class="p-4">پایان ساخت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            @php
                                $part = \App\Models\Part::find($product->part_id);
                            @endphp
                            <tr class="table-tb-tr group whitespace-normal {{ $loop->even ? 'bg-sky-100' : '' }}">
                                <td class="table-tr-td border-t-0 border-l-0">
                                    {{ $loop->index + 1 }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ $part->name }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ $part->unit }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ $product->quantity }}
                                </td>
                                <td class="table-tr-td border-t-0 border-r-0">
                                    @if($product->status == 'end')
                                        <div
                                            class="flex items-center justify-center bg-green-500 text-white rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="2" stroke="currentColor" class="w-4 h-4 ml-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M4.5 12.75l6 6 9-13.5"/>
                                            </svg>
                                            صادر شده
                                        </div>
                                    @else
                                        <form method="POST" class="flex justify-center"
                                              action="{{ route('contracts.recipe.end-of-production', [$contract->id, $product->id]) }}">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit" class="table-success-btn"
                                                    onclick="return confirm('پایان ساخت صادر شود ؟')">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                                                </svg>
                                                صدور
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @endforeach

        <!-- Detail Parts -->
        @foreach($contract->products()->where('group_id','!=',0)->where('model_id','!=',0)->get() as $product)
            @php
                $modell = \App\Models\Modell::find($product->model_id);
            @endphp
            <div class="card" id="product{{ $product->id }}">
                <div class="card-header">
                    <p class="card-title text-lg">
                        لیست قطعات محصول
                        <span class="text-red-600">{{ $modell->parent->name }}</span> -
                        <span class="text-red-600">{{ $product->model_custom_name ?? $modell->name }}</span>
                    </p>
                </div>
                <div class="mb-4 flex justify-end" x-data="{open:false}">
                    <button type="button" class="page-warning-btn" @click="open = !open">
                        مشاهده تغییرات
                    </button>
                    <div class="relative z-10" x-show="open" x-cloak>
                        <div class="modal-backdrop"></div>
                        <div class="fixed z-10 inset-0 overflow-y-auto">
                            <div class="modal">
                                <div class="modal-body">
                                    <div class="bg-white dark:bg-slate-800 p-4">
                                        <div class="mb-4 flex justify-between items-center">
                                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                تغییرات قطعات محصول {{ $modell->parent->name }}
                                                - {{ $product->model_custom_name ?? $modell->name }}
                                            </h3>
                                            <button type="button" @click="open = false">
                                                <span class="modal-close">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor"
                                                         class="w-5 h-5 dark:text-white">
                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
                                        <div class="mt-6 space-y-2">
                                            @foreach($product->histories as $history)
                                                <div class="p-2 border border-gray-200 rounded-lg">
                                                    <div class="grid grid-cols-5 gap-4">
                                                        <div>
                                                            <p class="text-xs font-medium text-black">
                                                                تاریخ
                                                                : {{ jdate($history->created_at)->format('Y/m/d') }}
                                                            </p>
                                                        </div>
                                                        <div>
                                                            @php
                                                                $user = \App\Models\User::find($history->user_id);
                                                            @endphp
                                                            <p class="text-xs font-medium text-black">
                                                                توسط : {{ $user->name }}
                                                            </p>
                                                        </div>
                                                        <div class="col-span-3">
                                                            @php
                                                                $oldPart = \App\Models\Part::find($history->old_part_id);
                                                                $newPart = \App\Models\Part::find($history->new_part_id);
                                                            @endphp
                                                            <p class="text-xs font-medium text-black">
                                                                @switch($history->type)
                                                                    @case('change')
                                                                        قطعه <span
                                                                            class="text-indigo-600">{{ $oldPart->name }}</span>
                                                                        به <span
                                                                            class="text-indigo-600">{{ $newPart->name }}</span>
                                                                        تغییر یافت
                                                                        @break
                                                                @endswitch
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="w-full border-collapse">
                    <thead>
                    <tr class="table-th-tr whitespace-nowrap">
                        <th class="p-4 rounded-tr-lg">ردیف</th>
                        <th class="p-4">نام قطعه</th>
                        <th class="p-4">واحد</th>
                        <th class="p-4">وزن</th>
                        <th class="p-4 rounded-tl-lg"> مقادیر</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($product->spareAmounts()->orderBy('sort', 'ASC')->get() as $amount)
                        @php
                            $part = \App\Models\Part::find($amount->part_id);
                        @endphp
                        <tr class="table-tb-tr group whitespace-nowrap">
                            <td class="table-tr-td border-t-0 border-l-0">
                                {{ $amount->sort }}
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ $part->name }}
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ $part->unit }}
                                @if(!is_null($part->unit2))
                                    / {{ $part->unit2 }}
                                @endif
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ $part->weight }}
                            </td>
                            <td class="table-tr-td border-t-0 border-r-0">
                                <div class="flex items-center justify-center">
                                    {{ $amount->value }}
                                    @if(!is_null($part->unit2))
                                        <p class="mr-2">/</p>
                                        {{ $amount->value2 }}
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
</x-layout>

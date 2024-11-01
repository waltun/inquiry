<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/date-picker/persianDatepicker.min.js') }}"></script>
        <script>
            $('.dates').persianDatepicker({
                format: 'Y/m/d'
            });
        </script>

        <script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
        <script>
            tinymce.init({
                selector: '#inputDescription',
                plugins: 'preview paste importcss searchreplace autolink directionality code visualblocks visualchars fullscreen link template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount textpattern noneditable help charmap quickbars emoticons',
                menubar: 'edit view insert format tools table help',
                toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview | template link anchor codesample | ltr rtl',
                toolbar_sticky: true,
                directionality: "rtl",
                importcss_append: true,
                template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
                template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
                height: 600,
                quickbars_selection_toolbar: 'bold italic fontsizeselect | link h2 h3 blockquote | removeformat forecolor',
                toolbar_mode: 'sliding',
                contextmenu: 'link table',
                content_style:
                    "@import url('/fonts/font.css'); body { font-family: IRANSans; }",
            })
        </script>
    </x-slot>
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('plugins/date-picker/persianDatepicker-default.css') }}">
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
        <a href="{{ route('contracts.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    قرارداد ها
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
                    گارانتی محصولات قرارداد {{ $contract->name }} - CNT-{{ $contract->number }}
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
                    لیست گارانتی محصولات قرارداد {{ $contract->name }} - CNT-{{ $contract->number }}
                </p>
            </div>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse">
            <a href="{{ route('contracts.show', $contract->id) }}" class="page-warning-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-4 h-4 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3"></path>
                </svg>
                بازگشت
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="mt-4 space-y-4">
        @if(!$contract->products->isEmpty())
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
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contract->products()->orderBy('sort', 'ASC')->where('group_id','!=',0)->where('model_id','!=',0)->get() as $product)
                                @php
                                    $modell = \App\Models\Modell::find($product->model_id);
                                @endphp
                                <tr class="table-tb-tr group whitespace-normal {{ $loop->even ? 'bg-sky-100' : '' }}">
                                    <td class="table-tr-td border-t-0 border-l-0">
                                        {{ $loop->index + 1 }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        {{ $modell->parent->name }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        {{ $product->model_custom_name ?? $modell->name }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        {{ $product->tag ?? '-' }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-r-0">
                                        {{ $product->quantity }}
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
                                <th class="p-4 rounded-tl-lg">تعداد</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                @php
                                    $part = \App\Models\Part::find($product->part_id);
                                    $lastCategory = $part->categories()->latest()->first();
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
                                    <td class="table-tr-td border-t-0 border-r-0">
                                        {{ $product->quantity }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @endforeach
        @else
            <div class="mt-8">
                <p class="text-base text-center text-red-600 font-bold">
                    --- منتظر انتخاب پیش فاکتور ---
                </p>
                <div class="flex justify-center mt-4">
                    <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                       class="text-sm font-medium text-indigo-600 underline underline-offset-4">
                        انتخاب پیش فاکتور
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('contracts.warranty-condition.store', $contract->id) }}" class="mt-4">
        @csrf
        @method('PATCH')

        @if(request()->has('terms') || $contract->description)
            <div class="card">
                <div class="card-header">
                    <p class="card-title">شرایط گارانتی</p>
                </div>

                <div class="mt-4">
                    <label for="inputDescription" class="form-label">شرایط گارانتی دستگاه ها و تجهیزات قرارداد</label>
                    <textarea name="description" id="inputDescription" class="input-text h-64">
                        @if(!is_null($contract->description))
                            @if(request()->has('terms'))
                                @php
                                    $selectedTerms = explode(',', request()->get('terms'));
                                    $descriptions = \App\Models\WarrantyCondition::whereIn('id', $selectedTerms)->pluck('description')->implode("\n\n");
                                @endphp
                                {{ $contract->description . "\n\n" . $descriptions }}
                            @else
                                {{ $contract->description }}
                            @endif
                        @else
                            @if(request()->has('terms'))
                                @php
                                    $selectedTerms = explode(',', request()->get('terms'));
                                    $descriptions = \App\Models\WarrantyCondition::whereIn('id', $selectedTerms)->pluck('description')->implode("\n\n");
                                @endphp
                                {{ $descriptions }}
                            @else
                                @php
                                    $selectedTerm = \App\Models\WarrantyCondition::find(3);
                                @endphp
                                {{ $selectedTerm->description }}
                            @endif
                        @endif
                    </textarea>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-3 gap-4 mb-4">
            @foreach($terms as $term)
                @php
                    $selectedTerms = request()->has('terms') ? explode(',', request()->get('terms')) : [];
                    $isSelected = in_array($term->id, $selectedTerms);

                    if ($isSelected) {
                        $newTerms = array_diff($selectedTerms, [$term->id]);
                    } else {
                        $newTerms = array_merge($selectedTerms, [$term->id]);
                    }

                    $query = http_build_query(['terms' => implode(',', $newTerms)]);
                @endphp
                <a href="{{ route('contracts.warranty-condition.index', $contract->id) }}?{{ $query }}"
                   class="dashboard-cards group {{ $isSelected ? 'bg-indigo-300' : '' }}">
                    <div class="flex items-center">
                        <div class="dashboard-card-icon bg-gray-600 dark:bg-slate-800 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                            </svg>
                        </div>
                        <div class="mr-4">
                            <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
                                {{ $term->name }}
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white">
                            <path fill-rule="evenodd"
                                  d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="flex items-center space-x-4 space-x-reverse mt-4">
            <button type="submit" class="form-submit-btn">
                ثبت شرایط گارانتی
            </button>
            <a href="{{ route('contracts.warranty-condition.index', $contract->id) }}" class="page-warning-btn py-3">
                پاکسازی
            </a>
        </div>
    </form>
</x-layout>

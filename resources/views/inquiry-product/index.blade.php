<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script>
            $(".multiPercentBtn").on('click', function () {
                let ids = [];
                let percent = $("#inputPercent").val();
                $(".checkboxes:checked").each(function () {
                    ids.push($(this).val());
                });

                if (ids.length <= 0) {
                    alert("لطفا موارد مورد نظر را انتخاب کنید")
                } else {
                    $.ajax({
                        url: '{{ route('inquiries.product.multiPercent') }}',
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {
                            ids: ids,
                            percent: percent
                        },
                        success: function () {
                            alert("محصولات مورد نظر با موفقیت ضریب گذاری شدند");
                            location.reload();
                        }
                    });
                }
            });
        </script>

        <script>
            document.getElementById('select-all').onclick = function () {
                let checkboxes = document.getElementsByName('product-checkbox');
                for (let checkbox of checkboxes) {
                    checkbox.checked = this.checked
                }
            }
        </script>
    </x-slot>

    <!-- Breadcrumb -->
    <div class="flex items-center space-x-2 space-x-reverse overflow-x-auto whitespace-nowrap md:overflow-hidden">
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
        @if($inquiry->submit)
            <a href="{{ route('inquiries.submitted') }}" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="mr-2">
                    <p class="breadcrumb-p">
                        استعلام های منتظر قیمت
                    </p>
                </div>
            </a>
        @else
            <a href="{{ route('inquiries.index') }}" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="mr-2">
                    <p class="breadcrumb-p">
                        لیست استعلام ها
                    </p>
                </div>
            </a>
        @endif
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                 class="breadcrumb-svg-arrow">
                <path fill-rule="evenodd"
                      d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                      clip-rule="evenodd"/>
            </svg>
        </div>
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg-active" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    محصولات استعلام {{ $inquiry->name }}
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="md:flex items-center justify-between mt-8 space-y-4 md:space-y-0">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 dark:text-white" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
            </svg>
            <div class="mr-2">
                <p class="font-bold text-xl text-black dark:text-white">
                    لیست محصولات استعلام {{ $inquiry->name }}
                </p>
            </div>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse">
            <a href="{{ route('inquiries.product.create',$inquiry->id) }}" class="page-success-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                <span class="mr-2">ایجاد محصول جدید</span>
            </a>
        </div>
    </div>

    <!-- Copy & Correction text -->
    @if(!is_null($inquiry->correction_id) || !is_null($inquiry->copy_id))
        <div class="my-4 bg-red-500 p-2 rounded-md">
            @if(!is_null($inquiry->correction_id))
                @php
                    $correctionInquiry = \App\Models\Inquiry::find($inquiry->correction_id);
                @endphp
                @if($correctionInquiry)
                    <p class="text-sm font-bold text-white">
                        توجه : این استعلام، درخواست اصلاح استعلام {{ $correctionInquiry->name }}
                        - {{ $correctionInquiry->inquiry_number }}
                        است.
                    </p>
                @endif
            @endif
            @if(!is_null($inquiry->copy_id))
                @php
                    $copyInquiry = \App\Models\Inquiry::find($inquiry->copy_id);
                @endphp
                @if($copyInquiry)
                    <p class="text-sm font-bold text-white">
                        توجه : این استعلام، کپی شده از استعلام {{ $copyInquiry->name }}
                        - {{ $copyInquiry->inquiry_number }}
                        است.
                    </p>
                @endif
            @endif
        </div>
    @endif

    <!-- Content -->
    <div class="mt-4 space-y-4">
        @php
            $products = $inquiry->products()->where('group_id','!=',0)->where('model_id','!=',0)->orderBy('sort','ASC')->get();
        @endphp
        <div class="mt-8 overflow-x-auto rounded-lg hidden md:block">
            <table class="w-full border-collapse">
                <thead>
                <tr class="table-th-tr">
                    @if($inquiry->submit == '1')
                        <th scope="col" class="p-2 rounded-tr-lg">
                            <input type="checkbox" class="checkboxes w-4 h-4 mx-auto block" id="select-all">
                        </th>
                    @endif
                    <th scope="col" class="p-2">
                        Sort
                    </th>
                    <th scope="col" class="p-2">
                        دسته
                    </th>
                    <th scope="col" class="p-2">
                        مدل
                    </th>
                    <th scope="col" class="p-2">
                        تعداد
                    </th>
                    <th scope="col" class="p-2">
                        تگ
                    </th>
                    <th scope="col" class="p-2">
                        <span class="sr-only">اقدامات</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    @php
                        $modell = \App\Models\Modell::find($product->model_id);
                    @endphp
                    <tr class="table-tb-tr group">
                        @if($inquiry->submit == '1')
                            <td class="table-tr-td border-t-0 border-l-0">
                                <input type="checkbox" value="{{ $product->id }}"
                                       class="checkboxes w-4 h-4 mx-auto block"
                                       name="product-checkbox">
                            </td>
                        @endif
                        <td class="table-tr-td border-t-0 border-l-0">
                            {{ $product->sort }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $modell->parent->name }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $product->model_custom_name ?? $modell->name }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $product->quantity }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $product->description ?? '-' }}
                        </td>
                        <td class="table-tr-td border-t-0 border-r-0 whitespace-nowrap">
                            <div class="flex items-center justify-center space-x-4 space-x-reverse">
                                <div x-data="{open:false}" class="mt-1 relative">
                                    <button @click="open = !open">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                                        </svg>
                                    </button>
                                    <div x-show="open" @click.away="open = false" class="table-dropdown -top-16 left-6"
                                         x-cloak>
                                        @can('edit-inquiry-product')
                                            <a href="{{ route('inquiries.product.edit',$product->id) }}"
                                               class="table-dropdown-edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                                </svg>
                                                ویرایش
                                            </a>
                                        @endcan
                                        @can('inquiry-product-replicate')
                                            <div x-data="{open:false}">
                                                <button type="button" class="table-warning-btn"
                                                        @click="open=!open">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5A3.375 3.375 0 006.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0015 2.25h-1.5a2.251 2.251 0 00-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 00-9-9z"/>
                                                    </svg>
                                                    کپی
                                                </button>
                                                <div class="relative z-10" x-show="open" x-cloak>
                                                    <div class="modal-backdrop"></div>
                                                    <div class="fixed z-10 inset-0 overflow-y-auto">
                                                        <div class="modal">
                                                            <div class="modal-body">
                                                                <div class="bg-white dark:bg-slate-800 p-4">
                                                                    <div class="mb-4 flex justify-between items-center">
                                                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                                            کپی محصول استعلام {{ $inquiry->name }}
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
                                                                          action="{{ route('inquiries.product.replicate',$product->id) }}">
                                                                        @csrf
                                                                        <div class="mb-4">
                                                                            <label for="inputQuantity"
                                                                                   class="form-label">
                                                                                تعداد
                                                                            </label>
                                                                            <input type="number" class="input-text"
                                                                                   name="quantity" id="inputQuantity"
                                                                                   placeholder="تعداد به عدد">
                                                                        </div>
                                                                        <div class="mb-4">
                                                                            <label for="inputModel"
                                                                                   class="form-label">
                                                                                نام مدل
                                                                            </label>
                                                                            <input type="text" class="input-text"
                                                                                   name="model_custom_name"
                                                                                   id="inputQinputModeluantity"
                                                                                   placeholder="نام جدید مدل، می تواند خالی باشد">
                                                                        </div>
                                                                        <div
                                                                            class="flex justify-end items-center space-x-4 space-x-reverse">
                                                                            <button type="submit"
                                                                                    class="form-submit-btn">
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
                                        @endcan
                                        @can('delete-inquiry-product')
                                            <form action="{{ route('inquiries.product.destroy',$product->id) }}"
                                                  method="POST"
                                                  class="table-dropdown-delete">
                                                @csrf
                                                @method('DELETE')
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                </svg>
                                                <button onclick="return confirm('محصول حذف شود ؟')">
                                                    حذف
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>

                                @can('inquiry-product-amounts')
                                    <a href="{{ route('inquiries.product.amounts',$product->id) }}"
                                       class="table-warning-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        جزئیات
                                    </a>
                                @endcan
                                @can('inquiry-product-percent')
                                    @if($inquiry->submit)
                                        <a href="{{ route('inquiries.product.percent',$product->id) }}"
                                           class="table-info-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185zM9.75 9h.008v.008H9.75V9zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm4.125 4.5h.008v.008h-.008V13.5zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                                            </svg>
                                            ثبت ضریب
                                        </a>
                                    @endif
                                @endcan
                                @if($product->amounts->isEmpty())
                                    <p class="p-1 bg-red-400 text-white text-xs rounded-lg group-hover:bg-red-600">
                                        مقادیر ثبت نشده
                                    </p>
                                @endif
                                @if($product->percent > 0)
                                    <p class="p-1 bg-green-400 text-white text-xs rounded-lg group-hover:bg-myGreen-100">
                                        ضریب ثبت شده
                                    </p>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                <tr class="table-tb-tr group">
                    <td class="table-tr-td border-t-0" colspan="7">
                        <div class="flex justify-between items-center">
                            <a href="{{ route('inquiries.product.create',$inquiry->id) }}"
                               class="w-6 h-6 rounded-full bg-green-500 grid place-content-center mr-6"
                               title="ایجاد محصول جدید">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                     stroke="currentColor" class="w-4 h-4 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 4.5v15m7.5-7.5h-15"></path>
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-8 block md:hidden space-y-4">
            @foreach($products as $product)
                @php
                    $modell = \App\Models\Modell::find($product->model_id);
                @endphp
                <div class="p-4 rounded-lg shadow-search bg-white border border-sky-100 space-y-4">
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-medium text-black whitespace-nowrap">Sort :</p>
                        <span class="border w-full mx-4 {{ $loop->odd ? 'border-sky-200' : 'border-red-200' }}"></span>
                        <p class="text-xs font-medium text-black whitespace-nowrap">
                            {{ $product->sort }}
                        </p>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-medium text-black whitespace-nowrap">دسته :</p>
                        <span class="border w-full mx-4 {{ $loop->odd ? 'border-sky-200' : 'border-red-200' }}"></span>
                        <p class="text-xs font-medium text-black whitespace-nowrap">
                            {{ $modell->parent->name }}
                        </p>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-medium text-black whitespace-nowrap">مدل :</p>
                        <span class="border w-full mx-4 {{ $loop->odd ? 'border-sky-200' : 'border-red-200' }}"></span>
                        <p class="text-xs font-medium text-black whitespace-nowrap">
                            {{ $product->model_custom_name ?? $product->modell }}
                        </p>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-medium text-black whitespace-nowrap">تعداد :</p>
                        <span class="border w-full mx-4 {{ $loop->odd ? 'border-sky-200' : 'border-red-200' }}"></span>
                        <p class="text-xs font-medium text-black whitespace-nowrap">
                            {{ $product->quantity }}
                        </p>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-medium text-black whitespace-nowrap">تگ :</p>
                        <span class="border w-full mx-4 {{ $loop->odd ? 'border-sky-200' : 'border-red-200' }}"></span>
                        <p class="text-xs font-medium text-black whitespace-nowrap">
                            @if(is_null($product->description))
                                -
                            @else
                                {{ $product->description }}
                            @endif
                        </p>
                    </div>
                    <div class="flex items-center border-t border-gray-300 pt-4 space-x-2 space-x-reverse">
                        @can('inquiry-product-amounts')
                            <a href="{{ route('inquiries.product.amounts',$product->id) }}"
                               class="mobile-warning-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                جزئیات
                            </a>
                        @endcan
                        @can('inquiry-product-percent')
                            @if($inquiry->submit)
                                <a href="{{ route('inquiries.product.percent',$product->id) }}"
                                   class="mobile-info-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185zM9.75 9h.008v.008H9.75V9zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm4.125 4.5h.008v.008h-.008V13.5zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                                    </svg>
                                    ثبت ضریب
                                </a>
                            @endif
                        @endcan
                        <div class="flex items-center justify-center space-x-4 space-x-reverse relative"
                             x-data="{open:false}">
                            <button @click="open = !open">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false"
                                 class="table-dropdown top-0 right-2 whitespace-nowrap"
                                 x-cloak>
                                @can('edit-inquiry-product')
                                    <a href="{{ route('inquiries.product.edit',$product->id) }}"
                                       class="table-dropdown-edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                        </svg>
                                        ویرایش
                                    </a>
                                @endcan
                                @can('inquiry-product-replicate')
                                    <div x-data="{open:false}">
                                        <button type="button" class="table-warning-btn"
                                                @click="open=!open">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                 class="w-4 h-4 ml-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5A3.375 3.375 0 006.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0015 2.25h-1.5a2.251 2.251 0 00-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 00-9-9z"/>
                                            </svg>
                                            کپی
                                        </button>
                                        <div class="relative z-10" x-show="open" x-cloak>
                                            <div class="modal-backdrop"></div>
                                            <div class="fixed z-10 inset-0 overflow-y-auto">
                                                <div class="modal">
                                                    <div class="modal-body">
                                                        <div class="bg-white dark:bg-slate-800 p-4">
                                                            <div class="mb-4 flex justify-between items-center">
                                                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                                    کپی محصول استعلام {{ $inquiry->name }}
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
                                                                  action="{{ route('inquiries.product.replicate',$product->id) }}">
                                                                @csrf
                                                                <div class="mb-4">
                                                                    <label for="inputQuantity"
                                                                           class="form-label">
                                                                        تعداد
                                                                    </label>
                                                                    <input type="number" class="input-text"
                                                                           name="quantity" id="inputQuantity"
                                                                           placeholder="تعداد به عدد">
                                                                </div>
                                                                <div class="mb-4">
                                                                    <label for="inputModel"
                                                                           class="form-label">
                                                                        نام مدل
                                                                    </label>
                                                                    <input type="text" class="input-text"
                                                                           name="model_custom_name"
                                                                           id="inputQinputModeluantity"
                                                                           placeholder="نام جدید مدل، می تواند خالی باشد">
                                                                </div>
                                                                <div
                                                                    class="flex justify-end items-center space-x-4 space-x-reverse">
                                                                    <button type="submit"
                                                                            class="form-submit-btn">
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
                                @endcan
                                @can('delete-inquiry-product')
                                    <form action="{{ route('inquiries.product.destroy',$product->id) }}"
                                          method="POST"
                                          class="table-dropdown-delete">
                                        @csrf
                                        @method('DELETE')
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                        </svg>
                                        <button onclick="return confirm('محصول حذف شود ؟')">
                                            حذف
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                        @if($product->percent > 0)
                            <p class="p-1 bg-green-400 text-white text-xs rounded-lg group-hover:bg-myGreen-100">
                                ضریب ثبت شده
                            </p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Multi Percent -->
        @can('inquiry-product-multi-percent')
            @if($inquiry->submit)
                <div class="my-4 hidden md:block" x-data="{open:false}">
                    <button type="button" class="form-edit-btn" @click="open=!open">
                        ثبت ضریب چندتایی
                    </button>
                    <div class="relative z-50" x-show="open" x-cloak>
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                        <div class="fixed z-10 inset-0 overflow-y-auto">
                            <div
                                class="flex items-center justify-center min-h-full p-4 text-center">
                                <div
                                    class="relative bg-white rounded-lg text-right overflow-hidden shadow-xl transform transition-all my-8 md:max-w-lg w-full">
                                    <div class="bg-white p-4">
                                        <div class="mt-3 text-center sm:mt-0 sm:text-right">
                                            <h3 class="text-lg font-medium text-gray-900 border-b border-gray-300 pb-3">
                                                ثبت ضریب دستمزد و سود
                                            </h3>
                                            <div class="mt-4">
                                                <label class="block mb-2 text-sm font-bold" for="inputQuantity">
                                                    ضریب
                                                </label>
                                                <input type="text" class="input-text" name="percent" id="inputPercent"
                                                       placeholder="بین 1 تا 2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-100 px-4 py-2">
                                        <button type="button" class="form-submit-btn multiPercentBtn">
                                            ثبت
                                        </button>
                                        <button type="button" class="form-cancel-btn"
                                                @click="open = !open">
                                            انصراف
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endcan
    </div>

    <div class="mt-6 md:grid grid-cols-3 gap-4 space-y-4 md:space-y-0">
        @can('inquiries')
            <a href="{{ route('inquiries.index') }}" class="dashboard-cards group">
                <div class="flex items-center">
                    <div class="dashboard-card-icon bg-yellow-600 dark:bg-slate-800">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-6 h-6 text-white group-hover:text-myBlue-100"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="mr-4">
                        <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
                            استعلام ها
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
        @endcan

        @can('submitted-inquiries')
            <a href="{{ route('inquiries.submitted') }}" class="dashboard-cards group">
                <div class="flex items-center">
                    <div class="dashboard-card-icon bg-yellow-600 dark:bg-slate-800">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-6 h-6 text-white group-hover:text-myBlue-100"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="mr-4">
                        <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
                            استعلام های منتظر قیمت
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
        @endcan

        @can('priced-inquiries')
            <a href="{{ route('inquiries.priced') }}" class="dashboard-cards group">
                <div class="flex items-center">
                    <div class="dashboard-card-icon bg-yellow-600 dark:bg-slate-800">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-6 h-6 text-white group-hover:text-myBlue-100"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="mr-4">
                        <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
                            استعلام های قیمت گذاری شده
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
        @endcan
    </div>
</x-layout>

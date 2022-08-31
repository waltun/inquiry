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
                    <a href="{{ route('inquiries.index') }}"
                       class="mr-2 text-xs md:text-sm font-medium text-gray-500 hover:text-gray-900">
                        مدیریت استعلام ها
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
                        لیست محصولات استعلام {{ $inquiry->name }} - {{ $inquiry->inquiry_number }}
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Navigation Btn -->
    <div class="mt-4 md:flex justify-between items-center">
        <div class="mb-4 md:mb-0">
            <p class="text-lg text-black font-bold">
                لیست محصولات استعلام {{ $inquiry->name }}
            </p>
        </div>
        <div class="space-x-2 space-x-reverse flex items-center overflow-x-auto whitespace-nowrap">
            @can('create-inquiry')
                <a href="{{ route('inquiries.product.create',$inquiry->id) }}" class="form-submit-btn text-xs">
                    ایجاد محصول جدید
                </a>
            @endcan
            @can('inquiries')
                <a href="{{ route('inquiries.index') }}" class="form-detail-btn text-xs">لیست استعلام ها</a>
            @endcan
            @can('inquiries')
                <a href="{{ route('inquiries.submitted') }}" class="form-edit-btn text-xs">
                    لیست استعلام های منتظر قیمت گذاری
                </a>
            @endcan
        </div>

    </div>

    <!-- Content -->
    <div class="mt-4">
        <!-- Laptop List -->
        <div class="bg-white shadow overflow-x-auto rounded-lg hidden md:block">
            <table class="min-w-full">
                <thead>
                <tr class="bg-sky-200">
                    <th scope="col"
                        class="px-4 py-3 text-sm font-bold text-gray-800 text-center rounded-r-md">
                        #
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        گروه
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        مدل
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        تعداد
                    </th>
                    <th scope="col" class="relative px-4 py-3 rounded-l-md">
                        <span class="sr-only">اقدامات</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($inquiry->products()->where('group_id','!=',0)->where('model_id','!=',0)->get() as $product)
                    @php
                        $group = \App\Models\Group::find($product->group_id);
                        $modell = \App\Models\Modell::find($product->model_id);
                    @endphp
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <input type="checkbox" value="{{ $product->id }}"
                                   class="checkboxes w-4 h-4 accent-blue-600 bg-gray-200 rounded border border-gray-300 focus:ring-blue-500 focus:ring-2 focus:ring-offset-1 mx-auto block">
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center font-medium">{{ $group->name }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center font-medium">{{ $modell->name }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center">{{ $product->quantity }}</p>
                        </td>
                        <td class="px-4 py-3 space-x-3 space-x-reverse whitespace-nowrap">
                            <a href="{{ route('inquiries.product.amounts',$product->id) }}"
                               class="form-submit-btn text-xs">
                                جزئیات
                            </a>
                            <a href="{{ route('inquiries.product.edit',$product->id) }}"
                               class="form-edit-btn text-xs">
                                ویرایش تعداد
                            </a>
                            @can('percent-inquiry')
                                @if($inquiry->submit)
                                    <a href="{{ route('inquiries.product.percent',$product->id) }}"
                                       class="form-percent-btn text-xs">
                                        ثبت ضریب
                                    </a>
                                @endif
                            @endcan
                            <form action="{{ route('inquiries.product.destroy',$product->id) }}" method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="form-cancel-btn text-xs"
                                        onclick="return confirm('محصول حذف شود ؟')">
                                    حذف
                                </button>
                            </form>
                            @if($product->percent > 0)
                                <p class="text-sm font-bold text-green-600 inline">
                                    ضریب ثبت شده
                                </p>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        @if($inquiry->submit)
            <div class="mt-4" x-data="{open:false}">
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
                                            ثبت ضریب محصولات
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
        <!-- Mobile List -->
        <div class="block md:hidden">
            @foreach($inquiry->products()->where('group_id','!=',0)->where('model_id','!=',0)->get() as $product)
                @php
                    $group = \App\Models\Group::find($product->group_id);
                    $modell = \App\Models\Modell::find($product->model_id);
                @endphp
                <div class="bg-white rounded-md p-4 border border-gray-200 shadow-sm mb-4 relative z-30">
                    <span
                        class="absolute right-2 top-2 p-2 w-6 h-6 rounded-full bg-indigo-300 text-black text-xs grid place-content-center font-bold">
                        {{ $loop->index+1 }}
                    </span>
                    <div class="space-y-4">
                        <p class="text-xs text-black text-center font-bold">
                            گروه : {{ $group->name }}
                        </p>
                        <p class="text-xs text-black text-center font-bold">
                            مدل : {{ $modell->name }}
                        </p>
                        <p class="text-xs text-black text-center">
                            تعداد : {{ $product->quantity }}
                        </p>
                        <div class="flex w-full justify-between">
                            <a href="{{ route('inquiries.product.amounts',$product->id) }}"
                               class="form-submit-btn text-xs">
                                جزئیات
                            </a>
                            @can('percent-inquiry')
                                @if($inquiry->submit)
                                    <a href="{{ route('inquiries.product.percent',$product->id) }}"
                                       class="form-edit-btn text-xs">
                                        ثبت ضریب
                                    </a>
                                @endif
                            @endcan
                            <form action="{{ route('inquiries.product.destroy',$product->id) }}" method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="form-cancel-btn text-xs"
                                        onclick="return confirm('محصول حذف شود ؟')">
                                    حذف
                                </button>
                            </form>
                        </div>
                        @if($product->percent > 0)
                            <div class="mt-4">
                                <p class="text-sm font-bold text-green-600 inline">
                                    ضریب ثبت شده
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>

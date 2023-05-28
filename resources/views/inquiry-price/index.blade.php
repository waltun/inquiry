<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script>
            function showPrice(id) {
                let input = document.getElementById("inputPrice" + id);
                let section = document.getElementById("priceSection" + id);
                section.innerText = new Intl.NumberFormat().format(input.value) + ' تومان ';
            }
        </script>
        <script>
            function updateDate(id) {
                let url = window.location.href;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    method: 'PATCH',
                    url: '/inquiry-price/' + id + '/update-date',
                    data: {
                        id: id,
                    },
                    success: function (res) {
                        if (res.data === 'error') {
                            alert('قیمت برای این قطعه ثبت نشده است!')
                        } else {
                            location.href = url;
                        }
                    }
                });
            }
        </script>
        <script>
            $(".deleteAllBtn").on('click', function () {
                let ids = [];
                $(".checkboxes:checked").each(function () {
                    ids.push($(this).val());
                });

                if (ids.length <= 0) {
                    alert("لطفا موارد مورد نظر را انتخاب کنید")
                } else {
                    $.ajax({
                        url: '{{ route('inquiryPrice.multiUpdateDate') }}',
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {
                            ids: ids,
                        },
                        success: function () {
                            alert("آیتم های مورد نظر با موفقیت بروزرسانی شدند");
                            location.reload();
                        }
                    });
                }
            });
        </script>
        <script>
            // document.getElementById('select-all').onclick = function () {
            //     let id = document.getElementById('select-all').getAttribute('data-id');
            //     alert(id)
            //     let checkboxes = document.getElementsByName('part-checkbox-' + id);
            //     for (let checkbox of checkboxes) {
            //         checkbox.checked = this.checked
            //     }
            // };

            function selectAll(id) {
                let checkboxes = document.getElementsByName('part-checkbox-' + id);
                for (let checkbox of checkboxes) {
                    if (checkbox.checked) {
                        checkbox.checked = ''
                    } else {
                        checkbox.checked = 'checked'
                    }
                }
            }
        </script>
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
                      d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    بخش درخواست‌های بروزرسانی قیمت
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="flex items-center justify-between mt-8">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-8 h-8 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"></path>
            </svg>
            <div class="mr-2">
                <p class="font-bold text-2xl text-black dark:text-white">
                    بخش درخواست‌های بروزرسانی قیمت
                </p>
            </div>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse">
            @can('inquiries')
                <a href="{{ route('inquiries.index') }}" class="page-warning-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="mr-2">استعلام ها</span>
                </a>
            @endcan
        </div>
    </div>

    <!-- Content -->
    <div class="mt-4">
        @php
            $color = '';
            $time = null;
        @endphp
        @foreach($inquiryPrices as $inquiryPrice)
            @php
                $inquiry = \App\Models\Inquiry::find($inquiryPrice->inquiry_id);
                $part = \App\Models\Part::find($inquiryPrice->part_id);
                $user = \App\Models\User::find($inquiryPrice->user_id);
                $parts = \App\Models\InquiryPrice::select('part_id')->where('inquiry_id',$inquiry->id)->get()->unique('part_id');
            @endphp
            <form action="{{ route('inquiryPrice.update',$inquiry->id) }}" method="POST" class="card">
                @csrf
                @method('PATCH')
                <div class="card-header">
                    <p class="card-title text-lg">
                        درخواست های استعلام {{ $inquiry->name }}
                    </p>
                </div>
                <div class="flex items-center space-x-4 space-x-reverse justify-center">
                    <p class="bg-myBlue-300 py-2 px-4 rounded-lg text-sm text-white">
                        تاریخ ارسال درخواست : {{ jdate($inquiryPrice->created_at)->format('%A, %d %B %Y - H:m') }}
                    </p>
                    <p class="bg-myBlue-300 py-2 px-4 rounded-lg text-sm text-white">
                        کاربر درخواست کننده : {{ $user->name }}
                    </p>
                </div>

                <div class="mt-8 overflow-x-auto rounded-lg">
                    <table class="w-full border-collapse">
                        <thead>
                        <tr class="table-th-tr">
                            <th scope="col" class="p-4 rounded-tr-lg">
                                <input type="checkbox" class="checkboxes w-4 h-4 mx-auto block"
                                       id="select-all-{{ $inquiryPrice->id }}"
                                       onclick="selectAll({{ $inquiryPrice->id }})">
                            </th>
                            <th scope="col" class="p-4">
                                نام
                            </th>
                            <th scope="col" class="p-4">
                                واحد
                            </th>
                            <th scope="col" class="p-4">
                                قیمت قبلی
                            </th>
                            <th scope="col" class="p-4">
                                قیمت (تومان)
                            </th>
                            <th scope="col" class="p-4">
                                آخرین بروزرسانی
                            </th>
                            <th scope="col" class="p-4 rounded-tl-lg">
                                <span class="sr-only">بروزرسانی تاریخ</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($parts as $item)
                            @php
                                $part = \App\Models\Part::find($item->part_id);
                            @endphp
                            <tr class="table-tb-tr group {{ $loop->even ? 'bg-sky-100' : '' }}">
                                <td class="table-tr-td border-t-0 border-l-0">
                                    <input type="checkbox" value="{{ $part->id }}"
                                           name="part-checkbox-{{ $inquiryPrice->id }}"
                                           class="checkboxes w-4 h-4 focus:ring-blue-500 focus:ring-2 focus:ring-offset-1 mx-auto block">
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0 whitespace-normal text-red-600">
                                    {{ $part->name }}
                                    @if($part->percent_submit)
                                        <br>
                                        <span class="text-xs text-red-600">(قیمت این محصول یک بار بیشتر از 50 درصد وارد شده، برای تایید دوباره قیمت را وارد کنید)</span>
                                    @endif
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ $part->unit }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    @if($part->old_price > 0)
                                        {{ number_format($part->old_price) }} تومان
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    <div class="flex items-center space-x-2 space-x-reverse">
                                        <input type="text" class="input-text w-32 text-center"
                                               id="inputPrice{{ $part->id }}"
                                               name="prices[]"
                                               value="{{ $part->price ?? '' }}" onkeyup="showPrice({{ $part->id }})">
                                        <span class="text-xs" id="priceSection{{ $part->id }}">
                                            {{ number_format($part->price) ?? '0' }} تومان
                                        </span>
                                        <input type="hidden" name="parts[]" value="{{ $part->id }}">
                                    </div>
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ jdate($part->price_updated_at)->format('%A, %d %B %Y') }}
                                </td>
                                <td class="table-tr-td border-t-0 border-r-0">
                                    <button type="button" class="table-warning-btn text-red-600"
                                            onclick="updateDate({{ $part->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z"/>
                                        </svg>
                                        بروزرسانی
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex items-center space-x-4 space-x-reverse mt-4">
                    <button type="submit" class="form-submit-btn">
                        ثبت قیمت
                    </button>
                    <button type="button" class="form-detail-btn deleteAllBtn">
                        بروزرسانی تاریخ (انتخاب شده‌ها)
                    </button>
                </div>
            </form>
        @endforeach
    </div>
</x-layout>

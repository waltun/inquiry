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
                        url: '{{ route('inquiries.parts.multiPercent') }}',
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
            function changeFormula(event, cid) {
                let id = event.target.value;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('inquiries.product.getPart') }}',
                    data: {
                        id: id,
                    },
                    success: function (res) {
                        let part = res.data;
                        let value = document.getElementById('inputUnit' + cid).value;
                        let input = document.getElementById('inputAmount' + cid);
                        let inputValue = document.getElementById('inputUnitValue' + cid);

                        let operator2 = part.operator1;
                        let formula2 = part.formula1;
                        let result;

                        result = eval(value + operator2 + formula2);
                        let formatResult = Intl.NumberFormat().format(result);
                        input.value = formatResult.replace(',', '');
                        inputValue.value = result;
                    }
                });
            }
        </script>
        <script>
            function changeUnit1(event, cid) {

                let id = document.getElementById('groupPartList' + cid).value;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('inquiries.product.getPart') }}',
                    data: {
                        id: id,
                    },
                    success: function (res) {
                        let part = res.data;
                        let value = event.target.value;
                        let input2 = document.getElementById('inputUnit' + cid);
                        let inputValue = document.getElementById('inputUnitValue' + cid);
                        let operator1 = part.operator2;
                        let formula1 = part.formula2;
                        let result;

                        result = eval(value + operator1 + formula1);
                        let formatResult = Intl.NumberFormat().format(result);
                        input2.value = formatResult.replace(',', '');
                        inputValue.value = result;
                    }
                });
            }

            function changeUnit2(event, cid) {
                let id = document.getElementById('groupPartList' + cid).value;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('inquiries.product.getPart') }}',
                    data: {
                        id: id,
                    },
                    success: function (res) {
                        let part = res.data;
                        let value = event.target.value;
                        let input1 = document.getElementById('inputQuantity' + cid);
                        let inputValue = document.getElementById('inputUnitValue' + cid);
                        let operator2 = part.operator1;
                        let formula2 = part.formula1;
                        let result;

                        result = eval(value + operator2 + formula2);
                        let formatResult = Intl.NumberFormat().format(result);
                        input1.value = formatResult.replace(',', '');
                        inputValue.value = value;
                    }
                });
            }
        </script>
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
            function deletePartFromInquiry(inquiry, part) {
                if (confirm('قطعه حذف شود ؟')) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'DELETE',
                        url: '/inquiries/' + inquiry + '/' + part + '/destroy-part',
                        success: function () {
                            location.reload();
                        }
                    });
                }
            }
        </script>
        <script>
            function showPrice(event, id, totalPrice) {
                let value = totalPrice * event.target.value;
                let input = document.getElementById('inputFinalPrice' + id);
                let priceSection = document.getElementById('finalPrice' + id);
                priceSection.innerText = Intl.NumberFormat().format(value) + ' ' + 'تومان';
                input.value = parseInt(value);
            }

            function calculatePercent(event, id, totalPrice) {
                let value = event.target.value;
                let percent = value / totalPrice;
                let input = document.getElementById('inputPercent' + id);
                input.value = (Math.round(percent * 100) / 100).toFixed(2);

                let priceSection = document.getElementById('finalPrice' + id);
                priceSection.innerText = Intl.NumberFormat().format(value) + ' ' + 'تومان';
            }
        </script>
        <script>
            function submitPartPercent(id) {
                let percent = document.getElementById('inputPercent' + id).value;
                let finalPrice = document.getElementById('inputFinalPrice' + id).value;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route('inquiries.part-percent.ajax') }}',
                    type: 'POST',
                    data: {
                        percent: percent,
                        final_price: finalPrice,
                        product_id: id
                    },
                    success: function () {
                        location.reload();
                    }
                });
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
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg-active">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    قطعات تکی استعلام {{ $inquiry->name }}
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
                      d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <div class="mr-2">
                <p class="font-bold md:text-2xl text-lg text-black dark:text-white">
                    لیست قطعات تکی استعلام {{ $inquiry->name }}
                </p>
            </div>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse whitespace-nowrap overflow-x-auto md:overflow-hidden">
            <div x-data="{open:false}">
                <button type="button" class="page-info-btn" @click="open = !open">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-5 h-5 ml-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    افزودن کویل
                </button>
                <div class="relative z-10" x-show="open" x-cloak>
                    <div class="modal-backdrop"></div>
                    <div class="fixed z-10 inset-0 overflow-y-auto">
                        <div class="modal">
                            <div class="modal-body">
                                <div class="bg-white dark:bg-slate-800 p-4">
                                    <div class="mb-4 flex justify-between items-center">
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                            افزودن کویل جدید به قطعات تکی
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
                                    <form class="mt-6" method="POST"
                                          action="{{ route('inquiryPart.coil.index',$inquiry->id) }}">
                                        @csrf
                                        <div class="mb-4">
                                            <label class="form-label">
                                                انتخاب نوع کویل
                                            </label>
                                            <select name="coil_type" id="inputCoilType" class="input-text">
                                                <option value="">انتخاب کنید</option>
                                                <option value="fancoil">
                                                    کویل {{ \App\Models\Part::select('name')->where('id','170')->first()->name }}
                                                </option>
                                                <option value="warm">
                                                    کویل {{ \App\Models\Part::select('name')->where('id','169')->first()->name }}
                                                </option>
                                                <option value="cold">
                                                    کویل {{ \App\Models\Part::select('name')->where('id','168')->first()->name }}
                                                </option>
                                                <option value="condensor">
                                                    کویل {{ \App\Models\Part::select('name')->where('id','167')->first()->name }}
                                                </option>
                                                <option value="evaperator">
                                                    کویل {{ \App\Models\Part::select('name')->where('id','150')->first()->name }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="flex justify-end items-center space-x-4 space-x-reverse">
                                            <button type="submit" class="form-submit-btn">
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

            <div x-data="{open:false}">
                <button type="button" class="page-info-btn" @click="open = !open">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-5 h-5 ml-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    افزودن تابلو محلی
                </button>
                <div class="relative z-10" x-show="open" x-cloak>
                    <div class="modal-backdrop"></div>
                    <div class="fixed z-10 inset-0 overflow-y-auto">
                        <div class="modal">
                            <div class="modal-body">
                                <div class="bg-white dark:bg-slate-800 p-4">
                                    <div class="mb-4 flex justify-between items-center">
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                            افزودن تابلو محلی جدید به قطعات تکی
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
                                    <form class="mt-6" method="POST"
                                          action="{{ route('inquiryPart.electrical.index',$inquiry->id) }}">
                                        @csrf
                                        <div class="mb-4">
                                            <label class="form-label">
                                                انتخاب نوع تابلو محلی
                                            </label>
                                            <select name="electrical_type" id="inputElectricalType" class="input-text">
                                                <option value="">انتخاب کنید</option>
                                                <option value="air">
                                                    {{ \App\Models\Part::select('name')->where('id','2249')->first()->name }}
                                                </option>
                                                <option value="chiller">
                                                    {{ \App\Models\Part::select('name')->where('id','2144')->first()->name }}
                                                </option>
                                                <option value="panel">
                                                    {{ \App\Models\Part::select('name')->where('id','1879')->first()->name }}
                                                </option>
                                                <option value="zent">
                                                    {{ \App\Models\Part::select('name')->where('id','2256')->first()->name }}
                                                </option>
                                                <option value="mini">
                                                    {{ \App\Models\Part::select('name')->where('id','2264')->first()->name }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="flex justify-end items-center space-x-4 space-x-reverse">
                                            <button type="submit" class="form-submit-btn">
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

            <div x-data="{open:false}">
                <button type="button" class="page-info-btn" @click="open = !open">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-5 h-5 ml-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    افزودن دمپر
                </button>
                <div class="relative z-10" x-show="open" x-cloak>
                    <div class="modal-backdrop"></div>
                    <div class="fixed z-10 inset-0 overflow-y-auto">
                        <div class="modal">
                            <div class="modal-body">
                                <div class="bg-white dark:bg-slate-800 p-4">
                                    <div class="mb-4 flex justify-between items-center">
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                            افزودن دمپر جدید به قطعات تکی
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
                                    <form class="mt-6" method="POST"
                                          action="{{ route('inquiryPart.damper.index',$inquiry->id) }}">
                                        @csrf
                                        <div class="mb-4">
                                            <label class="form-label">
                                                انتخاب نوع دمپر
                                            </label>
                                            <select name="damper_type" id="inputElectricalType" class="input-text">
                                                <option value="">انتخاب کنید</option>
                                                <option value="taze">
                                                    {{ \App\Models\Part::select('name')->where('id','146')->first()->name }}
                                                </option>
                                                <option value="bargasht">
                                                    {{ \App\Models\Part::select('name')->where('id','147')->first()->name }}
                                                </option>
                                                <option value="raft">
                                                    {{ \App\Models\Part::select('name')->where('id','148')->first()->name }}
                                                </option>
                                                <option value="exast">
                                                    {{ \App\Models\Part::select('name')->where('id','149')->first()->name }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="flex justify-end items-center space-x-4 space-x-reverse">
                                            <button type="submit" class="form-submit-btn">
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

            <div x-data="{open:false}">
                <button type="button" class="page-info-btn" @click="open = !open">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-5 h-5 ml-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    افزودن مبدل
                </button>
                <div class="relative z-10" x-show="open" x-cloak>
                    <div class="modal-backdrop"></div>
                    <div class="fixed z-10 inset-0 overflow-y-auto">
                        <div class="modal">
                            <div class="modal-body">
                                <div class="bg-white dark:bg-slate-800 p-4">
                                    <div class="mb-4 flex justify-between items-center">
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                            افزودن مبدل جدید به قطعات تکی
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
                                    <form class="mt-6" method="POST"
                                          action="{{ route('inquiryPart.converter.index',$inquiry->id) }}">
                                        @csrf
                                        <div class="mb-4">
                                            <label class="form-label">
                                                انتخاب نوع مبدل
                                            </label>
                                            <select name="converter_type" id="inputElectricalType" class="input-text">
                                                <option value="">انتخاب کنید</option>
                                                <option value="evaporator">
                                                    {{ \App\Models\Part::select('name')->where('id','1194')->first()->name }}
                                                </option>
                                                <option value="condensor">
                                                    {{ \App\Models\Part::select('name')->where('id','1301')->first()->name }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="flex justify-end items-center space-x-4 space-x-reverse">
                                            <button type="submit" class="form-submit-btn">
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
        </div>
    </div>

    @if(!$inquiry->submit)
        @can('submit-inquiry')
            <div class="mt-4 flex justify-end">
                <form action="{{ route('inquiries.submit',$inquiry->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button class="page-success-btn"
                            onclick="return confirm('استعلام ثبت نهایی شود ؟')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M4.5 12.75l6 6 9-13.5"/>
                        </svg>
                        ثبت نهایی
                    </button>
                </form>
            </div>
        @endcan
    @endif

    @if($inquiry->submit)
        @can('inquiry-final-submit')
            @if(!$inquiry->products->pluck('percent')->contains(0))
                <div class="flex justify-end">
                    <form action="{{ route('inquiries.finalSubmit',$inquiry->id) }}" method="POST"
                          class="page-success-btn">
                        @csrf
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M4.5 12.75l6 6 9-13.5"/>
                        </svg>
                        <button onclick="return confirm('استعلام ثبت نهایی شود ؟')">
                            ثبت نهایی
                        </button>
                    </form>
                </div>
            @endif
        @endcan
    @endif

    <!-- Errors -->
    <x-errors/>

    <!-- Copy & Correction Message -->
    @if(!is_null($inquiry->correction_id) || !is_null($inquiry->copy_id))
        @can('users')
            <div class="my-4 bg-red-500 p-2 rounded-md">
                @if(!is_null($inquiry->correction_id))
                    @php
                        $correctionInquiry = \App\Models\Inquiry::find($inquiry->correction_id)
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
                        $copyInquiry = \App\Models\Inquiry::find($inquiry->copy_id)
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
        @endcan
    @endif

    <!-- Content -->
    <div class="mt-4">
        @php
            $types = ['setup','years','control','power_cable','control_cable','pipe','install_setup_price','setup_price','supervision','transport','other','setup_one','install','cable','canal','copper_piping','carbon_piping', 'coil',null];
            $finalPrice = 0;
        @endphp
        @foreach($types as $type)
            @php
                $products = $inquiry->products()->where('part_id','!=',0)->where('type',$type)->orderBy('sort','ASC')->get();
            @endphp
            @if(!$products->isEmpty())
                <form action="{{ route('inquiries.parts.storeAmounts',$inquiry->id) }}" method="POST"
                      class="border border-indigo-400 p-4 rounded-md mb-4">
                    @csrf
                    <input type="hidden" name="submitType" value="{{ $type }}">
                    <div class="mb-4">
                        <p class="text-sm font-bold text-black">
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
                    <div class="mt-8 overflow-x-auto rounded-lg">
                        <table class="w-full border-collapse">
                            <thead>
                            <tr class="table-th-tr">
                                @if($inquiry->submit)
                                    <th scope="col" class="p-4 rounded-tr-lg">
                                        #
                                    </th>
                                @endif
                                <th scope="col" class="p-4">
                                    Sort
                                </th>
                                <th scope="col" class="p-4">
                                    دسته بندی
                                </th>
                                <th scope="col" class="p-4">
                                    نام قطعه
                                </th>
                                <th scope="col" class="p-4">
                                    نوع قطعه
                                </th>
                                <th scope="col" class="p-4">
                                    تگ
                                </th>
                                <th scope="col" class="p-4">
                                    واحد
                                </th>
                                <th scope="col" class="p-4">
                                    قیمت نت واحد (تومان)
                                </th>
                                <th scope="col" class="p-4">
                                    قیمت با ضریب (تومان)
                                </th>
                                <th scope="col" class="p-4">
                                    تعداد
                                </th>
                                <th scope="col" class="p-4">
                                    قیمت کل (تومان)
                                </th>
                                <th scope="col" class="p-4 rounded-tl-lg">
                                    <span class="sr-only">اقدامات</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $color = '';
                                $totalPrice = 0;
                            @endphp
                            @foreach($products as $product)
                                @php
                                    $part = \App\Models\Part::find($product->part_id);
                                    if ($product->price) {
                                        $totalPrice += $product->price * $product->quantity;
                                    } else {
                                        $totalPrice += $part->price * $product->quantity;
                                    }
                                    $category = $part->categories[1];
                                    $selectedCategory = $part->categories[2];
                                @endphp
                                <tr class="table-tb-tr group {{ $loop->even ? 'bg-sky-100' : '' }}">
                                    @if($inquiry->submit == '1')
                                        <td class="table-tr-td border-t-0 border-l-0">
                                            <input type="checkbox" value="{{ $product->id }}"
                                                   class="checkboxes w-4 h-4 accent-blue-600 bg-gray-200 rounded border border-gray-300 focus:ring-blue-500 focus:ring-2 focus:ring-offset-1 mx-auto block">
                                        </td>
                                    @endif
                                    <td class="table-tr-td border-t-0 border-l-0">
                                        {{ $loop->index + 1 }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        <select id="inputCategory{{ $part->id }}" class="input-text w-20"
                                                onchange="changePart(event,{{ $part->id }})">
                                            @foreach($category->children as $child)
                                                <option
                                                    value="{{ $child->id }}" {{ $child->id == $selectedCategory->id ? 'selected' : '' }}>
                                                    {{ $child->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        @php
                                            $selectedPart = \App\Models\Part::find($part->id);
                                            $lastCategory = $selectedPart->categories()->latest()->first();
                                            if ((in_array($part->id, $specials, true) && !$part->standard) || ($part->coil && !$part->standard)) {
                                                $categoryParts = $lastCategory->parts()->where('inquiry_id',$inquiry->id)->get();
                                                if ($categoryParts->isEmpty()) {
                                                    $categoryParts[] = $lastCategory->parts()->first();
                                                }
                                            } else {
                                                $categoryParts = $lastCategory->parts;
                                            }
                                        @endphp
                                        <div class="flex items-center space-x-2 space-x-reverse">
                                            <select name="part_ids[]" class="input-text"
                                                    id="groupPartList{{ $part->id }}"
                                                    onchange="changeFormula(event,{{ $part->id }});">
                                                @foreach($categoryParts as $part2)
                                                    <option
                                                        value="{{ $part2->id }}" {{ $part2->id == $part->id ? 'selected' : '' }}>
                                                        {{ $part2->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if($part->coil == '1' && !$part->standard && !in_array($part->id, $specials, true))
                                                <a href="{{ route('collections.amounts',$part->id) }}"
                                                   target="_blank"
                                                   class="text-xs mr-1 text-indigo-500 underline underline-offset-4 whitespace-nowrap">
                                                    جزئیات
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        <select name="types[]" id="inputType{{ $product->id }}" class="input-text">
                                            <option value="setup" {{ $product->type == 'setup' ? 'selected' : '' }}>
                                                قطعات یدکی راه اندازی
                                            </option>
                                            <option value="years" {{ $product->type == 'years' ? 'selected' : '' }}>
                                                قطعات یدکی دو سالانه
                                            </option>
                                            <option
                                                value="control" {{ $product->type == 'control' ? 'selected' : '' }}>
                                                قطعات کنترلی
                                            </option>
                                            <option
                                                value="power_cable" {{ $product->type == 'power_cable' ? 'selected' : '' }}>
                                                لیست کابل قدرت
                                            </option>
                                            <option
                                                value="control_cable" {{ $product->type == 'control_cable' ? 'selected' : '' }}>
                                                لیست کابل کنترلی
                                            </option>
                                            <option value="pipe" {{ $product->type == 'pipe' ? 'selected' : '' }}>
                                                لیست لوله و اتصالات
                                            </option>
                                            <option
                                                value="install_setup_price" {{ $product->type == 'install_setup_price' ? 'selected' : '' }}>
                                                دستمزد نصب و راه اندازی
                                            </option>
                                            <option
                                                value="setup_price" {{ $product->type == 'setup_price' ? 'selected' : '' }}>
                                                دستمزد راه‌اندازی
                                            </option>
                                            <option
                                                value="supervision" {{ $product->type == 'supervision' ? 'selected' : '' }}>
                                                دستمزد نظارت
                                            </option>
                                            <option
                                                value="transport" {{ $product->type == 'transport' ? 'selected' : '' }}>
                                                هزینه حمل
                                            </option>
                                            <option
                                                value="setup_one" {{ $product->type == 'setup_one' ? 'selected' : '' }}>
                                                قطعات راه اندازی
                                            </option>
                                            <option
                                                value="install" {{ $product->type == 'install' ? 'selected' : '' }}>
                                                قطعات نصب
                                            </option>
                                            <option
                                                value="cable" {{ $product->type == 'cable' ? 'selected' : '' }}>
                                                اقلام کابل کشی
                                            </option>
                                            <option
                                                value="canal" {{ $product->type == 'canal' ? 'selected' : '' }}>
                                                اقلام کانال کشی
                                            </option>
                                            <option
                                                value="copper_piping" {{ $product->type == 'copper_piping' ? 'selected' : '' }}>
                                                دستمزد لوله کشی مسی
                                            </option>
                                            <option
                                                value="carbon_piping" {{ $product->type == 'carbon_piping' ? 'selected' : '' }}>
                                                دستمزد لوله کشی کربن استیل
                                            </option>
                                            <option
                                                value="coil" {{ $product->type == 'coil' ? 'selected' : '' }}>
                                                انواع کویل
                                            </option>
                                            <option value="other" {{ $product->type == 'other' ? 'selected' : '' }}>
                                                سایر تجهیزات
                                            </option>
                                        </select>
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        <input type="text" name="tags[]" class="input-text"
                                               value="{{ $product->description }}"
                                               placeholder="تگ قطعه">
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        {{ $part->unit }}
                                        @if(!is_null($part->unit2))
                                            / {{ $part->unit2 }}
                                        @endif
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        @if($type == 'transport' || $type  == 'supervision' || $type == 'setup_price' || $type == 'install_setup_price')
                                            <div class="flex justify-center">
                                                <input type="text" name="prices[]"
                                                       class="input-text w-28 text-center"
                                                       value="{{ $product->price == 0 ? $part->price : $product->price }}"
                                                       placeholder="قیمت">
                                            </div>
                                        @else
                                            {{ number_format($part->price) }}
                                        @endif
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        @if($product->price)
                                            {{ number_format($product->price) }}
                                        @else
                                            {{ number_format($part->price) }}
                                        @endif
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        <input type="text" class="input-text w-20 text-center"
                                               value="{{ $product->quantity }}"
                                               name="quantities[]"
                                               id="inputQuantity{{ $part->id }}"
                                               onkeyup="changeUnit1(event,'{{ $part->id }}')">
                                        @if(!is_null($part->unit2))
                                            <input type="text" class="input-text w-20 text-center"
                                                   placeholder="{{ $part->unit2 }}"
                                                   id="inputUnit{{ $part->id }}"
                                                   onkeyup="changeUnit2(event,'{{ $part->id }}')"
                                                   value="{{ $product->quantity2 }}">
                                        @endif
                                        <input type="hidden" id="inputUnitValue{{ $part->id }}"
                                               value="{{ $product->quantity2 }}"
                                               name="quantities2[]">
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        @if($product->price)
                                            <p class="{{ $color }}">
                                                {{ number_format($product->price * $product->quantity) }}
                                            </p>
                                        @else
                                            <p class="{{ $color }}">
                                                {{ number_format($part->price * $product->quantity) }}
                                            </p>
                                        @endif
                                    </td>
                                    <td class="table-tr-td border-t-0 border-r-0">
                                        <div class="flex items-center space-x-2 space-x-reverse">
                                            @can('inquiry-product-percent')
                                                @if($inquiry->submit)
                                                    <div x-data="{open: false}">
                                                        <button type="button" @click="open = !open"
                                                                class="table-info-btn">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                 viewBox="0 0 24 24"
                                                                 stroke-width="1.5" stroke="currentColor"
                                                                 class="w-4 h-4 ml-1">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185zM9.75 9h.008v.008H9.75V9zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm4.125 4.5h.008v.008h-.008V13.5zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                                                            </svg>
                                                            ثبت ضریب
                                                        </button>

                                                        <!-- Percent Modal -->
                                                        <div class="relative z-10" x-show="open" x-cloak>
                                                            <div class="modal-backdrop"></div>
                                                            <div class="fixed z-10 inset-0 overflow-y-auto">
                                                                <div class="modal">
                                                                    <div class="modal-body">
                                                                        <div class="bg-white dark:bg-slate-800 p-4">
                                                                            <div
                                                                                class="mb-4 flex justify-between items-center">
                                                                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                                                    ثبت ضریب برای {{ $part->name }}
                                                                                </h3>
                                                                                <button type="button"
                                                                                        @click="open = false">
                                                                                        <span class="modal-close">
                                                                                            <svg
                                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                                fill="none"
                                                                                                viewBox="0 0 24 24"
                                                                                                stroke-width="1.5"
                                                                                                stroke="currentColor"
                                                                                                class="w-5 h-5 dark:text-white">
                                                                                                <path
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"
                                                                                                    d="M6 18L18 6M6 6l12 12"/>
                                                                                            </svg>
                                                                                        </span>
                                                                                </button>
                                                                            </div>
                                                                            @php
                                                                                $group = \App\Models\Group::find($product->group_id);
                                                                                $modell = \App\Models\Modell::find($product->model_id);
                                                                                $inquiryPart = \App\Models\Part::find($product->part_id);
                                                                                $totalPercentPrice = 0;
                                                                                if (!is_null($group) && !is_null($modell)) {
                                                                                    foreach ($product->amounts as $amount) {
                                                                                        $part2 = \App\Models\Part::find($amount->part_id);
                                                                                        $totalPercentPrice += ($part2->price * $amount->value);
                                                                                    }
                                                                                }
                                                                                if (!is_null($inquiryPart)) {
                                                                                    $totalPercentPrice = $product->price == 0 ? $inquiryPart->price : $product->price;
                                                                                }
                                                                            @endphp
                                                                            <div class="mt-6 space-y-4">
                                                                                <div class="grid grid-cols-3 gap-4">
                                                                                    <div class="card">
                                                                                        <div class="card-header">
                                                                                            <p class="card-title">
                                                                                                جمع قیمت
                                                                                                متریال</p>
                                                                                        </div>
                                                                                        <div
                                                                                            class="mt-4 bg-myBlue-300 p-2 rounded-lg">
                                                                                            <p class="text-center text-lg font-bold text-white">
                                                                                                {{ number_format($totalPercentPrice) }}
                                                                                                تومان
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="card">
                                                                                        <div class="card-header">
                                                                                            <p class="card-title">
                                                                                                ضریب دستمزد و سود
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="mt-4">
                                                                                            <input type="text"
                                                                                                   id="inputPercent{{ $product->id }}"
                                                                                                   name="percent"
                                                                                                   class="input-text"
                                                                                                   placeholder="مثال : 1.6"
                                                                                                   value="{{ $product->percent ?? old('percent') }}"
                                                                                                   onkeyup="showPrice(event, {{ $product->id }}, {{ $totalPercentPrice }})">
                                                                                        </div>
                                                                                        @if($product->old_percent > 0)
                                                                                            <div class="mt-4">
                                                                                                <p class="text-center text-indigo-500 font-medium">
                                                                                                    ضریب قبلی ثبت
                                                                                                    شده
                                                                                                    : {{ $product->old_percent }}
                                                                                                </p>
                                                                                            </div>
                                                                                        @endif
                                                                                    </div>

                                                                                    <div class="card">
                                                                                        <div class="card-header">
                                                                                            <p class="card-title">
                                                                                                قیمت فروش شرکت</p>
                                                                                        </div>
                                                                                        <div class="mt-4">
                                                                                            <input type="text"
                                                                                                   class="input-text"
                                                                                                   name="final_price"
                                                                                                   onkeyup="calculatePercent(event, {{ $product->id }}, {{ $totalPercentPrice }})"
                                                                                                   value="{{ $product->price ?: $totalPercentPrice * $product->percent }}"
                                                                                                   id="inputFinalPrice{{ $product->id }}">
                                                                                        </div>
                                                                                        <div
                                                                                            class="mt-4">
                                                                                            <p class="text-center text-lg font-bold text-black"
                                                                                               id="finalPrice{{ $product->id }}">
                                                                                                {{ number_format($totalPercentPrice * $product->percent) }}
                                                                                                تومان
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-span-3">
                                                                                        <button type="button"
                                                                                                class="form-submit-btn"
                                                                                                onclick="submitPartPercent({{ $product->id }})">
                                                                                            ثبت ضریب
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endcan
                                            <button type="button"
                                                    onclick="deletePartFromInquiry('{{ $inquiry->id }}','{{ $part->id }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor"
                                                     class="w-5 h-5 text-red-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                </svg>
                                            </button>
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
                                <td class="table-tr-td border-t-0"
                                    colspan="{{ $inquiry->submit ? '12' : '11' }}">
                                    <div class="flex justify-between items-center">
                                        <a href="{{ route('inquiries.parts.create',$inquiry->id) }}"
                                           class="w-8 h-8 rounded-full bg-green-500 grid place-content-center mr-6"
                                           title="افزودن قطعه جدید">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="2"
                                                 stroke="currentColor" class="w-6 h-6 text-white">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M12 4.5v15m7.5-7.5h-15"></path>
                                            </svg>
                                        </a>
                                        @php
                                            $finalPrice += $totalPrice;
                                        @endphp
                                        <div class="flex items-center space-x-4 space-x-reverse">
                                            <p class="table-price-label">
                                                قیمت کل : {{ number_format($totalPrice) }} تومان
                                            </p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="form-submit-btn">
                            ثبت مقادیر
                        </button>
                    </div>
                </form>
            @endif
        @endforeach

        <div class="flex items-center justify-end space-x-4 space-x-reverse">
            <a href="{{ route('inquiries.product.index', $inquiry->id) }}" class="page-info-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                     stroke="currentColor" class="w-4 h-4 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                </svg>
                محصولات
            </a>

            @if($inquiry->message)
                <div x-data="{open:false}">
                    <button type="button" class="page-warning-btn"
                            @click="open=!open">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" class="w-4 h-4 ml-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        اصلاحیه
                    </button>
                    <div class="relative z-10" x-show="open" x-cloak>
                        <div class="modal-backdrop"></div>
                        <div class="fixed z-10 inset-0 overflow-y-auto">
                            <div class="modal">
                                <div class="modal-body">
                                    <div class="bg-white dark:bg-slate-800 p-4">
                                        <div class="mb-4 flex justify-between items-center">
                                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                اصلاحیه برای استعلام
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
                                        <div class="mt-6">
                                            <div class="mb-4">
                                                <p class="form-label">
                                                    متن اصلاحیه
                                                </p>
                                                <div
                                                    class="mt-2 border border-gray-200 rounded-lg p-4 dark:border-black">
                                                    <p class="text-sm font-medium">
                                                        {{ $inquiry->message }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div
                                                class="flex justify-end items-center space-x-4 space-x-reverse">
                                                <button type="button" class="form-cancel-btn"
                                                        @click="open = false">
                                                    انصراف!
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @can('inquiry-description')
                <a href="{{ route('inquiries.description',$inquiry->id) }}"
                   class="page-gray-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" class="w-4 h-4 ml-1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3.75 6.75h16.5M3.75 12h16.5M12 17.25h8.25"/>
                    </svg>
                    شرایط استعلام
                </a>
            @endcan

            @can('inquiry-datasheet')
                <a href="{{ route('inquiries.printDatasheet',$inquiry->id) }}"
                   class="page-success-btn" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" class="w-4 h-4 ml-1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"></path>
                    </svg>
                    دیتاشیت
                </a>
            @endcan
        </div>

        <div class="mt-4 flex items-center justify-between">
            <a href="{{ route('inquiries.parts.create',$inquiry->id) }}"
               class="w-8 h-8 rounded-full bg-green-500 grid place-content-center"
               title="افزودن قطعه جدید">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="2"
                     stroke="currentColor" class="w-6 h-6 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 4.5v15m7.5-7.5h-15"></path>
                </svg>
            </a>

            @if(auth()->user()->role == 'admin')
                <p class="table-price-label">
                    قیمت نهایی : {{ number_format($finalPrice) }} تومان
                </p>
            @endif
        </div>

        @if($inquiry->submit)
            @can('inquiry-part-multi-percent')
                <div class="my-4" x-data="{open:false}">
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
            @endcan
        @endif

        @if($inquiry->submit)
            <div class="mt-6 flex justify-end">
                <a href="{{ route('inquiries.submitted') }}" class="page-warning-btn">
                    بازگشت
                </a>
            </div>
        @else
            <div class="mt-6 flex justify-end">
                <a href="{{ route('inquiries.index') }}" class="page-warning-btn">
                    بازگشت
                </a>
            </div>
        @endif
    </div>
</x-layout>

<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
        <script>
            function selectModelByGroup(event) {
                let group_id = event.target.value;
                let modelSection1 = document.getElementById('modellSection1');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('inquiries.create.selectModelByGroup') }}',
                    data: {
                        group_id: group_id,
                    },
                    success: function (res) {
                        let modells = res.data;
                        modelSection1.innerHTML = `
                            <label for="inputModel1" class="form-label">
                                انتخاب زیردسته
                            </label>
                            <select class="input-text" id="inputModel1" onchange="selectModelByModel(event)">
                                <option value="">انتخاب کنید</option>
                                ${modells.map(
                            function (item) {
                                return `
                                            <option value="${item['id']}">${item['name']}</option>
                                        `
                            }
                        )}
                            </select>
                        `
                    }
                });
            }

            function selectModelByModel(event) {
                let model_id = event.target.value;
                let modelSection2 = document.getElementById('modellSection2');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('inquiries.create.selectModelByModel') }}',
                    data: {
                        model_id: model_id,
                    },
                    success: function (res) {
                        let modells = res.data;
                        modelSection2.innerHTML = `
                            <label for="inputModel2" class="form-label">
                                انتخاب مدل
                            </label>
                            <select class="input-text" id="inputModel2" name="model_id">
                                <option value="">انتخاب کنید</option>
                                ${modells.map(
                            function (item) {
                                return `
                                            <option value="${item['id']}">${item['name']}</option>
                                        `
                            }
                        )}
                            </select>
                        `
                    }
                });
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
        <a href="{{ route('inquiries.product.index',$inquiry->id) }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    محصولات استعلام {{ $inquiry->name }}
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
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    ایجاد محصول جدید
                </p>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('inquiries.product.store',$inquiry->id) }}"
          class="md:grid grid-cols-2 gap-4 mt-4">
        @csrf

        <div class="card">
            <div class="card-header">
                <p class="card-title">گروه</p>
            </div>

            <div class="mt-4">
                <label for="inputGroup" class="form-label">
                    انتخاب دسته اصلی محصول
                </label>
                <select name="group_id" id="inputGroup" class="input-text" onchange="selectModelByGroup(event)">
                    <option value="">انتخاب کنید</option>
                    @foreach($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>
            <div id="modellSection1" class="mt-4">
            </div>
            <div id="modellSection2" class="mt-4">
            </div>

        </div>

        <div class="card">
            <div class="card-header">
                <p class="card-title">مدل و تعداد</p>
            </div>

            <div class="mt-4">
                <label for="inputDescription" class="form-label">
                    تگ (توضیحات)
                </label>
                <input type="text" class="input-text" name="description" id="inputDescription"
                       placeholder="تگ / محل سرویس / ساختمان / شماره سریال / ...">
            </div>

            <div class="mt-4">
                <label for="inputQuantity" class="form-label">تعداد</label>
                <input type="number" id="inputQuantity" name="quantity" class="input-text" placeholder="حداقل تعداد : 1"
                       value="{{ old('quantity') }}">
            </div>

            <div class="mt-4">
                <label for="inputModelName" class="form-label">نام مدل</label>
                <input type="text" id="inputModelName" name="model_custom_name" class="input-text"
                       placeholder="مثلا : 1000CFM"
                       value="{{ old('model_custom_name') }}">
            </div>
        </div>

        <div class="flex items-center space-x-4 space-x-reverse">
            <button type="submit" class="form-submit-btn">
                ثبت محصول
            </button>
            <a href="{{ route('inquiries.product.index',$inquiry->id) }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>

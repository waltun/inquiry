<x-layout>
    <x-slot name="js">
        <script>
            let totalPrice = parseInt('{{ $totalPrice }}')

            function showPrice(event) {
                let value = totalPrice * event.target.value;
                let priceSection = document.getElementById('finalPrice');
                priceSection.innerText = Intl.NumberFormat().format(value) + ' ' + 'تومان';
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
                    ثبت ضریب برای محصول
                </p>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Info -->
    @if(!is_null($group) && !is_null($modell))
        <div class="mt-6 flex items-center space-x-4 space-x-reverse justify-center">
            <p class="bg-myBlue-300 py-2 px-4 rounded-lg text-sm text-white">
                دسته : {{ $modell->parent->name }}
            </p>
            <p class="bg-myBlue-300 py-2 px-4 rounded-lg text-sm text-white">
                مدل : {{ $product->model_custom_name ?? $modell->name }}
            </p>
        </div>
    @endif

    <!-- Form -->
    <form method="POST" action="{{ route('inquiries.product.storePercent',$product->id) }}"
          class="md:grid grid-cols-3 gap-4 mt-6">
        @csrf
        @method('PATCH')

        <div class="card">
            <div class="card-header">
                <p class="card-title">قیمت فعلی استعلام</p>
            </div>
            <div class="mt-4">
                <p class="text-center text-lg font-bold text-green-600">
                    {{ number_format($totalPrice) }} تومان
                </p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <p class="card-title">
                    ضریب استعلام
                </p>
            </div>
            <div class="mt-4">
                <label for="inputPercent" class="form-label">
                    ضریب استعلام را مشخص کنید
                </label>
                <input type="text" id="inputPercent" name="percent" class="input-text"
                       placeholder="مثال : 0.3" value="{{ $product->percent ?? old('percent') }}"
                       onkeyup="showPrice(event)">
            </div>
            @if($product->old_percent > 0)
                <div class="mt-4">
                    <p class="text-center text-indigo-500 font-medium">
                        ضریب قبلی ثبت شده : {{ $product->old_percent }}
                    </p>
                </div>
            @endif
        </div>

        <div class="card">
            <div class="card-header">
                <p class="card-title">قیمت نهایی استعلام</p>
            </div>
            <div class="mt-4">
                <p class="text-center text-lg font-bold text-green-600" id="finalPrice">
                    {{ number_format($totalPrice * $product->percent) }} تومان
                </p>
            </div>
        </div>

        @if(!is_null($product->description))
            <div class="col-span-3 card">
                <div class="card-header">
                    <p class="card-title">توضیحات (تگ) محصول</p>
                </div>
                <div class="mt-4">
                    <p class="text-base text-gray-700">
                        {{ $product->description }}
                    </p>
                </div>
            </div>
        @endif

        <div class="flex items-center space-x-4 space-x-reverse">
            <button type="submit" class="form-submit-btn">
                ثبت ضریب محصول
            </button>
            <a href="{{ route('inquiries.product.index',$inquiry->id) }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>

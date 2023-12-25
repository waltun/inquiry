<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script>
            function searchPart() {
                let form = document.getElementById('searchForm');

                form.submit();
            }
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
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg-active">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    آنالیز قطعات استفاده شده در قرارداد ها
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
                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <div class="mr-2">
                <p class="font-bold text-2xl text-black dark:text-white">
                    آنالیز قطعات استفاده شده در قراردادها
                </p>
            </div>
        </div>
    </div>

    <!-- Search -->
    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 mt-4">
        <form class="grid grid-cols-4 gap-4" id="searchForm">
            <div>
                <input type="text" name="search" value="{{ request('search') }}" class="input-text"
                       placeholder="جستجو براساس نام قطعه">
            </div>
            <div>
                <select name="buyer_manage" id="inputBuyerManage" class="input-text" onchange="searchPart()">
                    <option value="">انتخاب مسئول خرید</option>
                    <option value="factory" {{ request('buyer_manage') == 'factory' ? 'selected' : '' }}>
                        تدارکات کارخانه
                    </option>
                    <option value="office" {{ request('buyer_manage') == 'office' ? 'selected' : '' }}>
                        دفتر مرکزی
                    </option>
                </select>
            </div>
            <div>
                <select name="contract" id="inputContract" class="input-text">
                    <option value="">انتخاب قرارداد</option>
                    @foreach($searchContracts as $searchContract)
                        <option value="{{ $searchContract->id }}">
                            {{ $searchContract->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @if(request()->has('search') || request()->has('buyer_manage'))
                <div>
                    <a href="{{ route('contracts.analyze-parts.index') }}" class="page-warning-btn inline-flex">
                        پاکسازی فیلتر
                    </a>
                </div>
            @endif
        </form>
    </div>

    <!-- Content -->
    <div class="mt-4">
        <div class="card">
            <div class="card-header">
                <p class="card-title text-lg">
                    لیست قطعات
                </p>
            </div>
            <table class="w-full border-collapse">
                <thead>
                <tr class="table-th-tr whitespace-normal">
                    <th class="p-4 rounded-tr-lg">ردیف</th>
                    <th class="p-4">نام قطعه</th>
                    <th class="p-4">واحد</th>
                    <th class="p-4">مقدار</th>
                    <th class="p-4">خریدار</th>
                    <th class="p-4 rounded-tl-lg">قرارداد ها</th>
                </tr>
                </thead>
                <tbody>
                @foreach($paginator->items() as $partId => $value)
                    @php
                        $part = \App\Models\Part::find($partId);
                        $contractAmounts = $amounts->where('part_id', $partId);
                    @endphp
                    <tr class="table-tb-tr group whitespace-normal">
                        <td class="table-tr-td border-t-0 border-l-0">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0 {{ $value['status'] == 'ordered' ? 'text-red-600' : '' }}">
                            {{ $part->name }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $part->unit }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $value['value'] }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            @if($value['buyer_manage'] == 'factory')
                                تدارکات کارخانه
                            @elseif(is_null($value['buyer_manage']))
                                -
                            @else
                                دفتر مرکزی
                            @endif
                        </td>
                        <td class="table-tr-td border-t-0 border-r-0">
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

                                <!-- Contract Modal -->
                                <div class="relative z-10" x-show="open" x-cloak>
                                    <div class="modal-backdrop"></div>
                                    <div class="fixed z-10 inset-0 overflow-y-auto">
                                        <div class="modal">
                                            <div class="modal-body">
                                                <div class="bg-white dark:bg-slate-800 p-4">
                                                    <div class="mb-4 flex justify-between items-center">
                                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                            قطعه {{ $part->name }} در قراردادها
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
                                                        @php
                                                            $contractAmountInfo = [];
                                                            $contractAmountValues = [];
                                                            foreach ($contractAmounts as $contractAmount) {
                                                                if ($contractAmount->product->contract->recipe) {
                                                                    $contractAmountInfo[$contractAmount->product->contract_id] = [
                                                                    "status" => null,
                                                                    "buyer_manage" => null,
                                                                    "user_id" => null
                                                                ];
                                                                $contractAmountValues[$contractAmount->product->contract_id] = 0;
                                                                }
                                                            }
                                                            foreach ($contractAmounts as $contractAmount) {
                                                                if ($contractAmount->product->contract->recipe) {
                                                                    $contractAmountValues[$contractAmount->product->contract_id] += $contractAmount->value * $contractAmount->product->quantity;

                                                                    $contractAmountInfo[$contractAmount->product->contract_id] = [
                                                                        "status" => $contractAmount->status,
                                                                        "buyer_manage" => $contractAmount->buyer_manage,
                                                                        "user_id" => $contractAmount->user_id
                                                                    ];
                                                                }
                                                            }
                                                        @endphp
                                                        @foreach($contractAmountInfo as $contractId => $contractAmountValue)
                                                            @php
                                                                $contract = \App\Models\Contract::find($contractId);
                                                            @endphp
                                                            <form method="POST"
                                                                  action="{{ route('contracts.analyze-parts.store') }}"
                                                                  class="p-2 rounded-lg border border-gray-400">
                                                                @csrf
                                                                <input type="hidden" name="contract_id"
                                                                       value="{{ $contract->id }}">
                                                                <input type="hidden" name="part_id"
                                                                       value="{{ $part->id }}">
                                                                <div class="grid grid-cols-3 gap-4 border-b border-gray-200 pb-3">
                                                                    <div class="flex justify-center">
                                                                        <p class="text-sm font-medium">
                                                                            قرارداد
                                                                            : {{ $contract->name }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="flex justify-center">
                                                                        <p class="text-sm font-medium">
                                                                            میزان استفاده
                                                                            : {{ $contractAmountValues[$contractId] }} {{ $part->unit }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="flex justify-center">
                                                                        <a href="{{ route('contracts.parts.index', $contract->id) }}"
                                                                           class="text-sm font-medium text-indigo-600">
                                                                            مشاهده قرارداد
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="grid grid-cols-4 gap-4 mt-6">
                                                                    <div>
                                                                        <select name="status" id="inputStatus"
                                                                                class="input-text {{ !is_null($contractAmountValue["status"]) ? 'bg-green-100' : '' }}">
                                                                            <option value="">
                                                                                انتخاب وضعیت
                                                                            </option>
                                                                            <option
                                                                                value="ordered" {{ $contractAmountValue["status"] == 'ordered' ? 'selected' : '' }}>
                                                                                سفارش گذاری شد
                                                                            </option>
                                                                            <option
                                                                                value="buy" {{ $contractAmountValue["status"] == 'buy' ? 'selected' : '' }}>
                                                                                خریداری و تحویل انبار شد
                                                                            </option>
                                                                            <option
                                                                                value="available" {{ $contractAmountValue["status"] == 'available' ? 'selected' : '' }}>
                                                                                موجودی انبار می باشد
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                    <div>
                                                                        <select name="buyer_manage"
                                                                                id="inputBuyer{{ $part->id }}"
                                                                                class="input-text {{ !is_null($contractAmountValue["buyer_manage"]) ? 'bg-green-100' : '' }}">
                                                                            <option
                                                                                value="factory" {{ $contractAmountValue["buyer_manage"] == 'factory' ? 'selected' : '' }}>
                                                                                تدارکات کارخانه
                                                                            </option>
                                                                            <option
                                                                                value="office" {{ $contractAmountValue["buyer_manage"] == 'office' ? 'selected' : '' }}>
                                                                                دفتر مرکزی
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                    <div>
                                                                        <select name="user_id"
                                                                                id="inputUser{{ $part->id }}"
                                                                                class="input-text {{ !is_null($contractAmountValue["user_id"]) ? 'bg-green-100' : '' }}">
                                                                            <option value="">انتخاب کاربر</option>
                                                                            @foreach(\App\Models\User::where('role', 'staff')->get() as $user)
                                                                                <option
                                                                                    value="{{ $user->id }}" {{ $contractAmountValue["user_id"] == $user->id ? 'selected' : '' }}>
                                                                                    {{ $user->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div>
                                                                        <button type="submit"
                                                                                class="form-submit-btn py-2">
                                                                            ثبت
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        @endforeach
                                                    </div>
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

            <div class="mt-4">
                {{ $paginator->links() }}
            </div>
        </div>
    </div>
</x-layout>

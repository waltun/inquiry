<x-clients.layout>
    <!-- Navigation -->
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="md:w-8 md:h-8 w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
            </svg>
            <div class="mr-2 flex items-center">
                <p class="font-bold md:text-2xl text-sm text-black dark:text-white">
                    پیش فاکتور های {{ auth()->user()->name }}
                </p>
            </div>
        </div>
        <a href="{{ route('clients.dashboard', $user->id) }}" class="page-warning-btn">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-4 h-4 ml-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3"/>
            </svg>
            بازگشت
        </a>
    </div>

    <!-- Content -->
    <div class="mt-4 space-y-4">
        <div class="mt-8 overflow-x-auto rounded-lg hidden md:block">
            <table class="w-full border-collapse">
                <thead>
                <tr class="table-th-tr">
                    <th scope="col" class="p-4 rounded-tr-lg">
                        #
                    </th>
                    <th scope="col" class="p-4">
                        شماره پیش فاکتور
                    </th>
                    <th scope="col" class="p-4">
                        نام پروژه
                    </th>
                    <th scope="col" class="p-4">
                        مسئول پروژه
                    </th>
                    <th scope="col" class="p-4">
                        تاریخ
                    </th>
                    <th scope="col" class="p-4 rounded-tl-lg">
                        <span class="sr-only">اقدامات</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoices as $invoice)
                    <tr class="table-tb-tr group {{ $loop->even ? 'bg-sky-100' : '' }}">
                        <td class="table-tr-td border-t-0 border-l-0">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            INV-{{ $invoice->invoice_number ?? $invoice->inquiry->inquiry_number }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $invoice->inquiry->name }}
                        </td>
                        @php
                            $user = \App\Models\User::find($invoice->user_id);
                        @endphp
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $user->name }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ jdate($invoice->created_at)->format('%A, %d %B %Y') }}
                        </td>
                        <td class="table-tr-td border-t-0 border-r-0">
                            <div class="flex items-center justify-center">
                                <a href="#" class="table-warning-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    مشاهده
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Invoices -->
        <div class="space-y-4 block md:hidden">
            @foreach($invoices as $invoice)
                <div class="rounded-lg shadow p-4 bg-white">
                    <div class="mb-3">
                        <p class="text-xs text-gray-600 text-center font-medium">
                            شماره پیش فاکتور :
                            INV-{{ $invoice->invoice_number ?? $invoice->inquiry->inquiry_number }}
                        </p>
                    </div>
                    <div class="mb-3">
                        <p class="text-xs text-gray-600 text-center font-medium">
                            نام پروژه :
                            {{ $invoice->inquiry->name }}
                        </p>
                    </div>
                    <div class="mb-3">
                        @php
                            $user = \App\Models\User::find($invoice->user_id);
                        @endphp
                        <p class="text-xs text-gray-600 text-center font-medium">
                            مسئول پروژه :
                            {{ $user->name }}
                        </p>
                    </div>
                    <div class="mb-3">
                        <p class="text-xs text-gray-600 text-center font-medium">
                            تاریخ :
                            {{ jdate($invoice->created_at)->format('%A, %d %B %Y') }}
                        </p>
                    </div>
                    <div class="flex items-center justify-center">
                        <a href="" class="page-gray-btn">
                            مشاهده پیش فاکتور
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-clients.layout>

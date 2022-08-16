<x-layout>
    <!-- Breadcrumb -->
    <nav class="flex bg-gray-100 p-4 rounded-md" aria-label="Breadcrumb">
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
            <li aria-current="page">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                    <span class="mr-2 text-xs md:text-sm font-medium text-gray-400">
                        اعلان های خوانده شده
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Navigation Btn -->
    <div class="mt-4 md:flex justify-between items-center">
        <div class="mb-4 md:mb-0">
            <p class="text-lg text-black font-bold">
                لیست اعلان های خوانده شده
            </p>
        </div>
        <div class="space-x-2 space-x-reverse flex items-center">
            <a href="{{ route('notifications.index') }}" class="form-detail-btn text-xs">اعلان های خوانده نشده</a>
        </div>

    </div>

    <!-- Content -->
    <div class="mt-4">
        @foreach($notifications as $notification)
            @switch($notification->type)
                @case('App\Notifications\NewInquiryNotification')
                    @php
                        $inquiry = \App\Models\Inquiry::find($notification->data['inquiry_id']);
                    @endphp
                    <div class="border border-gray-400 rounded-md p-4 bg-white mb-4">
                        <div class="md:flex items-center justify-between mb-4 pb-3 border-b border-gray-200">
                            <div class="mb-4 md:mb-0">
                                <p class="text-sm text-gray-700">
                                    تاریخ اعلان
                                    : {{ jdate($notification->created_at)->format('%A, %d %B %Y - ساعت H:i') }}
                                </p>
                            </div>
                            <form action="{{ route('notifications.destroy',$notification->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="form-cancel-btn text-xs">
                                    حذف اعلان
                                </button>
                            </form>
                        </div>
                        <div class="mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-indigo-500" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <div class="mr-2">
                                <p class="md:text-lg text-sm font-bold text-black">
                                    {{ $notification->data['message'] }}
                                </p>
                            </div>
                        </div>
                        <div class="md:flex items-center md:space-x-reverse md:space-x-4 mb-4 space-y-4 md:space-y-0">
                            <p class="text-sm font-medium">
                                پروژه : {{ $inquiry->name }}
                            </p>
                            <p class="text-sm">
                                مسئول پروژه : {{ \App\Models\User::find($inquiry->user_id)->name }}
                            </p>
                            <p class="text-sm">
                                شماره استعلام : {{ $inquiry->inquiry_number }}
                            </p>
                        </div>
                        <div class="flex justify-end space-x-reverse space-x-4">
                            <a href="{{ route('inquiries.show',$inquiry->id) }}" class="form-edit-btn text-xs">
                                مشاهده استعلام
                            </a>
                            <a href="{{ route('inquiries.submitted') }}" class="form-detail-btn text-xs">
                                لیست استعلام های منتظر قیمت
                            </a>
                        </div>
                    </div>
                    @break
                @case('App\Notifications\PercentInquiryNotification')
                    @php
                        $inquiry = \App\Models\Inquiry::find($notification->data['inquiry_id']);
                    @endphp
                    <div class="border border-gray-400 rounded-md p-4 bg-white mb-4">
                        <div class="md:flex items-center justify-between mb-4 pb-3 border-b border-gray-200">
                            <div class="mb-4 md:mb-0">
                                <p class="text-sm text-gray-700">
                                    تاریخ اعلان
                                    : {{ jdate($notification->created_at)->format('%A, %d %B %Y - ساعت H:i') }}
                                </p>
                            </div>
                            <form action="{{ route('notifications.destroy',$notification->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="form-cancel-btn text-xs">
                                    حذف اعلان
                                </button>
                            </form>
                        </div>
                        <div class="mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-indigo-500" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <div class="mr-2">
                                <p class="md:text-lg text-sm font-bold text-black">
                                    {{ $notification->data['message'] }}
                                </p>
                            </div>
                        </div>
                        <div class="md:flex items-center md:space-x-reverse md:space-x-4 mb-4 space-y-4 md:space-y-0">
                            <p class="text-sm font-medium">
                                پروژه : {{ $inquiry->name }}
                            </p>
                            <p class="text-sm">
                                مسئول پروژه : {{ \App\Models\User::find($inquiry->user_id)->name }}
                            </p>
                            <p class="text-sm">
                                شماره استعلام : {{ $inquiry->inquiry_number }}
                            </p>
                        </div>
                        <div class="flex justify-end space-x-reverse space-x-4">
                            <a href="{{ route('inquiries.products',$inquiry->id) }}" class="form-edit-btn text-xs">
                                مشاهده استعلام
                            </a>
                            <a href="{{ route('inquiries.priced') }}" class="form-detail-btn text-xs">
                                لیست استعلام های قیمت گذاری شده
                            </a>
                        </div>
                    </div>
                    @break
                @case('App\Notifications\CopyInquiryNotification' || 'App\Notifications\CorrectionInquiryNotification')
                    @php
                        $inquiry = \App\Models\Inquiry::find($notification->data['inquiry_id']);
                    @endphp
                    <div class="border border-gray-400 rounded-md p-4 bg-white mb-4">
                        <div class="md:flex items-center justify-between mb-4 pb-3 border-b border-gray-200">
                            <div class="mb-4 md:mb-0">
                                <p class="text-sm text-gray-700">
                                    تاریخ اعلان
                                    : {{ jdate($notification->created_at)->format('%A, %d %B %Y - ساعت H:i') }}
                                </p>
                            </div>
                            <form action="{{ route('notifications.destroy',$notification->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="form-cancel-btn text-xs">
                                    حذف اعلان
                                </button>
                            </form>
                        </div>
                        <div class="mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-indigo-500" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <div class="mr-2">
                                <p class="md:text-lg text-sm font-bold text-black">
                                    {{ $notification->data['message'] }}
                                </p>
                            </div>
                        </div>
                        <div class="md:flex items-center md:space-x-reverse md:space-x-4 mb-4 space-y-4 md:space-y-0">
                            <p class="text-sm font-medium">
                                نام پروژه : {{ $inquiry->name }}
                            </p>
                            <p class="text-sm">
                                مسئول پروژه : {{ \App\Models\User::find($inquiry->user_id)->name }}
                            </p>
                            <p class="text-sm">
                                شماره استعلام : {{ $inquiry->inquiry_number }}
                            </p>
                        </div>
                        <div class="flex justify-end space-x-reverse space-x-4">
                            <a href="{{ route('inquiries.index') }}" class="form-detail-btn text-xs">
                                لیست استعلام ها
                            </a>
                        </div>
                    </div>
                    @break
            @endswitch
        @endforeach
    </div>

    <div class="mt-4">
        {{ $notifications->links() }}
    </div>
</x-layout>

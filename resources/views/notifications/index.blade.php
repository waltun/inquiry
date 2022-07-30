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
                        مدیریت اعلان های خوانده نشده
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Navigation Btn -->
    <div class="mt-4 flex justify-between items-center">
        <div>
            <p class="text-lg text-black font-bold">
                لیست اعلان های خوانده نشده
            </p>
        </div>
        <div class="space-x-2 space-x-reverse flex items-center">
            <a href="{{ route('notifications.read') }}" class="form-detail-btn text-xs">اعلان های خوانده شده</a>
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
                        <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-200">
                            <p class="text-sm text-gray-700">
                                تاریخ اعلان : {{ jdate($notification->created_at)->format('%A, %d %B %Y - ساعت H:i') }}
                            </p>
                            <form action="{{ route('notifications.markAsRead',$notification->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="form-submit-btn text-xs">
                                    تغییر اعلان به خوانده شده
                                </button>
                            </form>
                        </div>
                        <div class="mb-4">
                            <p class="text-lg font-bold text-black">
                                {{ $notification->data['message'] }}
                            </p>
                        </div>
                        <div class="flex items-center space-x-reverse space-x-4 mb-4">
                            <p class="text-sm">
                                شماره استعلام : {{ $inquiry->inquiry_number }}
                            </p>
                            <p class="text-sm">
                                نام پروژه : {{ $inquiry->name }}
                            </p>
                            <p class="text-sm">
                                مسئول پروژه : {{ \App\Models\User::find($inquiry->user_id)->name }}
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
                        <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-200">
                            <p class="text-sm text-gray-700">
                                تاریخ اعلان : {{ jdate($notification->created_at)->format('%A, %d %B %Y - ساعت H:i') }}
                            </p>
                            <form action="{{ route('notifications.markAsRead',$notification->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="form-submit-btn text-xs">
                                    تغییر اعلان به خوانده شده
                                </button>
                            </form>
                        </div>
                        <div class="mb-4">
                            <p class="text-lg font-bold text-black">
                                {{ $notification->data['message'] }}
                            </p>
                        </div>
                        <div class="flex items-center space-x-reverse space-x-4 mb-4">
                            <p class="text-sm">
                                شماره استعلام : {{ $inquiry->inquiry_number }}
                            </p>
                            <p class="text-sm">
                                نام پروژه : {{ $inquiry->name }}
                            </p>
                            <p class="text-sm">
                                مسئول پروژه : {{ \App\Models\User::find($inquiry->user_id)->name }}
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
                        <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-200">
                            <p class="text-sm text-gray-700">
                                تاریخ اعلان : {{ jdate($notification->created_at)->format('%A, %d %B %Y - ساعت H:i') }}
                            </p>
                            <form action="{{ route('notifications.markAsRead',$notification->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="form-submit-btn text-xs">
                                    تغییر اعلان به خوانده شده
                                </button>
                            </form>
                        </div>
                        <div class="mb-4">
                            <p class="text-lg font-bold text-black">
                                {{ $notification->data['message'] }}
                            </p>
                        </div>
                        <div class="flex items-center space-x-reverse space-x-4 mb-4">
                            <p class="text-sm">
                                شماره استعلام : {{ $inquiry->inquiry_number }}
                            </p>
                            <p class="text-sm">
                                نام پروژه : {{ $inquiry->name }}
                            </p>
                            <p class="text-sm">
                                مسئول پروژه : {{ \App\Models\User::find($inquiry->user_id)->name }}
                            </p>
                        </div>
                        <div class="flex justify-end space-x-reverse space-x-4">
                            <a href="{{ route('inquiries.index') }}" class="form-edit-btn text-xs">
                                لیست استعلام ها
                            </a>
                        </div>
                    </div>
                    @break
            @endswitch
        @endforeach
    </div>
</x-layout>

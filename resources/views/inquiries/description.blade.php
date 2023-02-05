<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
        <script>
            tinymce.init({
                selector: '#inputDescription',
                plugins: 'preview paste importcss searchreplace autolink directionality code visualblocks visualchars fullscreen link template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount textpattern noneditable help charmap quickbars emoticons',
                menubar: 'edit view insert format tools table help',
                toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview | template link anchor codesample | ltr rtl',
                toolbar_sticky: true,
                directionality: "rtl",
                importcss_append: true,
                template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
                template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
                height: 600,
                quickbars_selection_toolbar: 'bold italic fontsizeselect | link h2 h3 blockquote | removeformat forecolor',
                toolbar_mode: 'sliding',
                contextmenu: 'link table',
                content_style:
                    "@import url('/fonts/font.css'); body { font-family: IRANSans; }",
            })
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
                        ایجاد شرایط جدید برای استعلام
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Alert -->
    <div class="mt-4">
        <div class="bg-yellow-500 rounded-md p-4" x-data="{ open:false }">
            <div class="flex justify-between items-center cursor-pointer" @click="open = !open">
                <p class="text-xs md:text-sm text-black">نکات قابل توجه</p>
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="md:h-5 md:w-5 h-4 w-4 transition-transform transform text-black"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" :class="{'rotate-180' : open}">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>
            <div class="bg-yellow-500 rounded-b-md mt-4" x-show="open" x-cloak>
                <ul class="list-disc mr-4 space-y-2">
                    <li class="text-xs md:text-sm text-black">تمامی فیلد های موجود برای اضافه کردن کاربر جدید ضروری می
                        باشد.
                    </li>
                    <li class="text-xs md:text-sm text-black">شماره تماس 11 رقم و با صفر شروع می شود.</li>
                    <li class="text-xs md:text-sm text-black">رمز عبور حداقل باید 8 رقم یا حرف باشد.</li>
                    <li class="text-xs md:text-sm text-black">کد ملی باید 10 رقم و فقط شامل عدد باشد.</li>
                    <li class="text-xs md:text-sm text-black">
                        در انتخاب نقش کاربر دقت کنید، چون هر نقش دسترسی های مختلفی دارد (البته این قسمت قابل ویرایش می
                        باشد).
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('inquiries.storeDescription',$inquiry->id) }}"
          class="mt-4">
        @csrf
        @method('PATCH')

        <div class="bg-white shadow-sm p-4 rounded-md border border-gray-200 mb-4 md:mb-0">
            <p class="md:text-sm text-xs text-black font-bold border-b-2 border-teal-400 pb-3">مشخصات کلی</p>

            <div class="mt-4">
                <label for="inputDescription" class="block mb-2 md:text-sm text-xs text-black">شرایط استعلام</label>
                <textarea name="description" id="inputDescription"
                          class="input-text h-64">
                    @if($inquiry->description)
                        {{ $inquiry->description }}
                    @else
                        <ol>
                        <li><strong><span style="font-size: 10pt;">مدت زمان تحویل کالا : <span style="color: #3598db;">دستگاه های این پیشنهاد 90 روز کاری پس از وصول پیش پرداخت و تایید مشخصات فنی تحویل می گردد.</span></span></strong></li>
                        <li><strong><span style="font-size: 10pt;">مدت گارانتی : <span style="color: #3598db;">مدت گارانتی دستگاه های این پیشنهاد 12 ماه از زمان راه اندازی یا 18 ماه از زمان ارسال (هر یک زودتر فرا رسد) می باشد.</span></span></strong></li>
                        <li><strong><span style="font-size: 10pt;">نحوه پرداخت : <span style="color: #3598db;">پیشنهاد می گردد 50 درصد مبلغ بابت پیش پرداخت و الباقی پس از پایان ساخت دستگاه ها و قبل از ارسال آن ها پرداخت گردد.</span></span></strong></li>
                        <li><strong><span style="font-size: 10pt;">محل تحویل : <span style="color: #3598db;">درب کارخانه شرکت تهویه آذرباد.</span></span></strong></li>
                        <li><strong><span style="font-size: 10pt;"><span style="color: #3598db;"><span style="color: #000000;">مدت اعتبار</span> : مدت زمان اعتبار این پیشنهاد مالی 5 روز می باشد.</span></span></strong></li>
                        <li><strong><span style="font-size: 10pt;">نوع تضامین درخواستی خریدار :</span></strong>
                        <ul>
                        <li><span style="color: #3598db;"><strong><span style="font-size: 10pt;">ضمانت نامه بانکی معادل</span></strong></span></li>
                        <li><span style="color: #3598db;"><strong><span style="font-size: 10pt;">ضمانت نامه با 20 درصد اُور</span></strong></span></li>
                        <li><span style="color: #3598db;"><strong><span style="font-size: 10pt;">چک تضمین شرکتی</span></strong></span></li>
                        <li><span style="color: #3598db;"><strong><span style="font-size: 10pt;">تضمین ندارد.</span></strong></span></li>
                        </ul>
                        </li>
                        <li><strong><span style="font-size: 10pt;">قیمت پیشنهادی بر اساس چه ارزی هست ؟&nbsp;</span></strong>
                        <ul>
                        <li><strong><span style="color: #3598db; font-size: 10pt;">ریال</span></strong></li>
                        <li><strong><span style="color: #3598db; font-size: 10pt;">یورو</span></strong></li>
                        <li><strong><span style="color: #3598db; font-size: 10pt;">دلار</span></strong></li>
                        </ul>
                        </li>
                        <li><strong><span style="font-size: 10pt;">نرخ تسعیر ارز :&nbsp;</span></strong>
                        <ul>
                        <li><strong><span style="color: #3598db; font-size: 10pt;">یورو با نرخ آزاد</span></strong></li>
                        <li><strong><span style="color: #3598db; font-size: 10pt;">یورو با نرخ سامانه ثنا و میانگین حواله خرید و فروش روزانه</span></strong></li>
                        <li><strong><span style="color: #3598db; font-size: 10pt;">دلار با نرخ آزاد</span></strong></li>
                        <li><strong><span style="color: #3598db; font-size: 10pt;">دلار با نرخ سامانه ثنا و میانگین حواله خرید و فروش روزانه</span></strong></li>
                        <li><strong><span style="color: #3598db; font-size: 10pt;">موضوعیت ندارد</span></strong></li>
                        </ul>
                        </li>
                        <li><strong><span style="font-size: 10pt;">زمان عودت تضامین پیش پرداخت :&nbsp;</span></strong>
                        <ul>
                        <li><span style="color: #3598db;"><strong><span style="font-size: 10pt;">تضمین پیش پرداخت هم زمان با ارسال دستگاه ها عودت می گردد.</span></strong></span></li>
                        <li><span style="color: #3598db;"><strong><span style="font-size: 10pt;">تضمین پیش پرداخت پس از ارسال دستگاه ها و حداکثر یک ماه پس از تحویل عودت می گردد.</span></strong></span></li>
                        <li><span style="color: #3598db;"><strong><span style="font-size: 10pt;">تضمین حسن انجام کار هم زمان با ارسال دستگاه ها عودت می گردد.</span></strong></span></li>
                        <li><span style="color: #3598db;"><strong><span style="font-size: 10pt;">تضمین حسن انجام کار پس از ارسال دستگاه ها و حداکثر یک ماه پس از تحویل عودت می گردد.</span></strong></span></li>
                        <li><span style="color: #3598db;"><strong><span style="font-size: 10pt;">تضمین دوره گارانتی پس از اتمام دوره گارانتی عودت می گردد.</span></strong></span></li>
                        </ul>
                        </li>
                        <li><strong><span style="font-size: 10pt;">مالیات ارزش افزوده به مبلغ پیشنهادی فوق اضافه می گردد.</span></strong></li>
                        <li><strong><span style="font-size: 10pt;">مدت خدمات پس از فروش 10 سال می باشد که در این دوره هزینه های مربوطه دریافت می گردد.</span></strong></li>
                        <li><strong><span style="font-size: 10pt;">نصب، راه اندازی و تامین متریال مربوط به دستگاه های این پیشنهاد به عهده خریدار می باشد.</span></strong></li>
                        <li><strong><span style="font-size: 10pt;">تعهدات کارفرما :&nbsp;</span></strong>
                        <ul>
                        <li><span style="color: #3598db;"><strong><span style="font-size: 10pt;">تامین متریال راه اندازی از قبیل گاز مبرد، روغن مبرد، مغزی فیلتر درایر، تامین گاز شست و شو.</span></strong></span></li>
                        <li><span style="color: #3598db;"><strong><span style="font-size: 10pt;">اجرای فوندانسیون مناسب با دستگاه ها.</span></strong></span></li>
                        <li><span style="color: #3598db;"><strong><span style="font-size: 10pt;">حمل، تخلیه و انتقال دستگاه ها بر روی فوندانسیون.</span></strong></span></li>
                        <li><span style="color: #3598db;"><strong><span style="font-size: 10pt;">حمل، تخلیه و انتقال ابزارآلات و قطعات راه اندازی تا محل نصب دستگاه ها.</span></strong></span></li>
                        <li><span style="color: #3598db;"><strong><span style="font-size: 10pt;">انجام لوله کشی، کابل کشی، کانال کشی و اتصال آن ها به دستگاه ها.</span></strong></span></li>
                        <li><span style="color: #3598db;"><strong><span style="font-size: 10pt;">استارت و راه اندازی دستگاه ها.</span></strong></span></li>
                        <li><span style="color: #3598db;"><strong><span style="font-size: 10pt;">فراهم نمودن شرایط برقی و کنترلی استاندارد مطابق نیاز دستگاه ها.</span></strong></span></li>
                        <li><span style="color: #3598db;"><strong><span style="font-size: 10pt;">ارائه محل اقامت و غذا برای پرسنل نصاب و راه انداز شرکت در صورت داشتن تعهد نصب و راه اندازی.</span></strong></span></li>
                        <li><span style="color: #3598db;"><strong><span style="font-size: 10pt;">پرداخت هزینه های ایاب و ذهاب در دوره گارانتی و خدمات پس از فروش.</span></strong></span></li>
                        <li><span style="color: #3598db;"><strong><span style="font-size: 10pt;">نصب الکترو پمپ ها و اجرای لوله کشی مربوطه و اتصال به دستگاه.</span></strong></span></li>
                        <li><span style="color: #3598db;"><strong><span style="font-size: 10pt;">تامین تابلو برق و کنترل مناسب و استاندارد جهت دستگاه ها.</span></strong></span></li>
                        </ul>
                        </li>
                        <li><strong><span style="font-size: 10pt;">نصب دستگاه ها</span></strong> :&nbsp;<span style="color: #3598db;"><strong><span style="font-size: 10pt;">نصب دستگاه ها توسط فروشنده یا توسط شرکت های مورد تایید یا کارشناس ناظر فروشنده الزامی است.</span></strong></span></li>
                        <li><strong><span style="font-size: 10pt;">تعهدات پیمانکار :</span></strong></li>
                        <li><strong><span style="font-size: 10pt;">سایر :</span></strong></li>
                        </ol>
                    @endif
                </textarea>
            </div>

        </div>

        <div class="space-x-2 space-x-reverse mt-4">
            <button type="submit" class="form-submit-btn">
                ثبت شرایط استعلام
            </button>
            <a href="{{ route('inquiries.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>

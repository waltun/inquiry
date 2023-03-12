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
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="breadcrumb-svg-active">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    ایجاد شرایط استعلام برای {{ $inquiry->name }}
                </p>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('inquiries.storeDescription',$inquiry->id) }}" class="mt-4">
        @csrf
        @method('PATCH')

        <div class="card">
            <div class="card-header">
                <p class="card-title">مشخصات کلی</p>
            </div>

            <div class="mt-4">
                <label for="inputDescription" class="form-label">شرایط استعلام</label>
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

        <div class="flex items-center space-x-4 space-x-reverse mt-4">
            <button type="submit" class="form-submit-btn">
                ثبت شرایط استعلام
            </button>
            <a href="{{ route('inquiries.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>

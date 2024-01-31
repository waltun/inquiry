<x-layout>
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
            <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg-active" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    مدیریت قطعات کارخانه و دفتر
                </p>
            </div>
        </div>
    </div>

    <!-- Search -->
    <div class="mt-8">
        <div class="flex items-center space-x-4 space-x-reverse">
            <form>
                <input type="text" id="inputSearch" name="search" class="input-text" placeholder="جستجو کلمه + اینتر"
                       value="{{ request('search') }}">
            </form>
            @if(request()->has('search'))
                <a href="{{ route('combine-codes.index') }}" class="text-xs underline underline-offset-8 font-medium text-indigo-500">
                    پاکسازی جستجو
                </a>
            @endif
        </div>
    </div>

    <!-- Content -->
    <div class="mt-4 space-y-4">
        <div class="grid grid-cols-2 gap-4">
            <div class="mt-4 overflow-x-auto rounded-lg">
                <div class="mb-4">
                    <p class="text-sm font-medium text-red-500">
                        قطعات دفتر
                    </p>
                </div>
                <table class="w-full border-collapse">
                    <thead>
                    <tr class="table-th-tr">
                        <th scope="col" class="p-4 rounded-tr-lg">
                            #
                        </th>
                        <th scope="col" class="p-4">
                            نام
                        </th>
                        <th scope="col" class="p-4 rounded-tl-lg">
                            واحد
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($parts as $part)
                        <tr class="table-tb-tr group {{ $loop->even ? 'bg-sky-100' : '' }}">
                            <td class="table-tr-td border-t-0 border-l-0">
                                {{ $loop->index + 1 }}
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ $part->name }}
                            </td>
                            <td class="table-tr-td border-t-0 border-r-0">
                                {{ $part->unit }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4 overflow-x-auto rounded-lg">
                <div class="mb-4">
                    <p class="text-sm font-medium text-red-500">
                        قطعات کارخانه
                    </p>
                </div>
                <table class="w-full border-collapse">
                    <thead>
                    <tr class="table-th-tr">
                        <th scope="col" class="p-4 rounded-tr-lg">
                            #
                        </th>
                        <th scope="col" class="p-4">
                            نام
                        </th>
                        <th scope="col" class="p-4 rounded-tl-lg">
                            واحد
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($codings as $coding)
                        <tr class="table-tb-tr group {{ $loop->even ? 'bg-sky-100' : '' }}">
                            <td class="table-tr-td border-t-0 border-l-0">
                                {{ $loop->index + 1 }}
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ $coding->name }}
                            </td>
                            <td class="table-tr-td border-t-0 border-r-0">
                                {{ $coding->unit }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $parts->links() }}
        </div>
    </div>
</x-layout>

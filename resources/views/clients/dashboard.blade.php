<x-clients.layout>
    <div class="md:grid grid-cols-3 gap-4">
        <a href="{{ route('clients.invoices', $user->id) }}" class="dashboard-cards group">
            <div class="flex items-center">
                <div class="dashboard-card-icon bg-yellow-500 dark:bg-slate-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6 text-white group-hover:text-myBlue-100">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                    </svg>
                </div>
                <div class="mr-4">
                    <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
                        مشاهده پیش فاکتورها
                    </p>
                </div>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                     class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white">
                    <path fill-rule="evenodd"
                          d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                          clip-rule="evenodd"/>
                </svg>
            </div>
        </a>
    </div>
</x-clients.layout>

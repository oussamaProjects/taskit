@if (session('success') || session('failure'))
    <div id="notification"
        class="flex items-center text-white pl-2 pr-6 py-2 rounded-sm mb-4 absolute top-16 right-4 z-50 {{ !is_null(session('success')) ? 'bg-green-500' : 'bg-red-400' }}">
        <span class="text-xl inline-block mr-2 align-middle">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
              </svg>
        </span>
        <span class="inline-block align-middle text-sm mr-4">
            {{ session('success') ?? session('failure') }}
        </span>
        <button
            class="absolute bg-transparent text-xl font-semibold leading-none right-1 top-0 outline-none focus:outline-none"
            onclick="closeAlert(event)">
            <span>×</span>
        </button>
    </div>
@endif
 
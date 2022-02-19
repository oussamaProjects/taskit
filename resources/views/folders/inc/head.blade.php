<div class="grid grid-cols-1 lg:grid-cols-1">
    <div class="relative flex flex-col min-w-0 mb-2 break-words bg-bg-color w-full shadow rounded">
        <div class="rounded-t mb-0 px-0 border-0">
            <div class="flex flex-wrap items-center px-4 py-4">
                <div class="relative w-full max-w-full flex flex-grow flex-1">
                    

                    <form action="/folder-search" method="post" id="search-form" class="relative w-60 ml-2">
                        {{ csrf_field() }}
                        <button class="outline-none focus:outline-none absolute top-2 right-1">
                            <svg class="w-6 h-6 text-gray-800 cursor-pointer" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                        <input type="text" autocomplete="off" name="search" id="search" placeholder="Cherche des dossiers"
                            class="peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm placeholder-gray-800 border appearance-none focus:shadow-outline" />
                    </form>
                </div>

                @include('folders.inc.action-buttons')

            </div>
        </div>
    </div>
</div>
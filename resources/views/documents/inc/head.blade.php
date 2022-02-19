
    <div class="ml-14 mt-14 mb-4 md:ml-64">
        <div class="flex items-center p-4 gap-4 bg-bg-color">

    <form action="/search" method="post" id="search-form"
        class="relative w-60">
        {{ csrf_field() }}
        <button class="outline-none focus:outline-none absolute top-2 right-1">
            <svg class="w-6 h-6 text-gray-800 cursor-pointer" fill="none" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </button>
        <input type="text" autocomplete="off" name="search" id="search" placeholder="Recherche"
            class="peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm placeholder-gray-800 border appearance-none focus:shadow-outline" />
    </form>

    <form action="/sort" method="post" id="sort-form" class="ml-auto">
        {{ csrf_field() }}
        <div class="input-field col m2 s12">
            <select name="filetype" id="sort" class="peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm placeholder-gray-800 border appearance-none focus:shadow-outline">
                <option value="" disabled selected>Choisir</option>
                <option value="image/jpeg" @if ($filetype === 'image/jpeg') selected @endif>Image</option>
                <option value="video/mp4" @if ($filetype === 'video/mp4') selected @endif>Video</option>
                <option value="audio/mpeg" @if ($filetype === 'audio/mpeg') selected @endif>Audio</option>
                <option value="application/pdf" @if ($filetype === 'application/pdf') selected @endif>PDF</option>
                <option value="text/plain" @if ($filetype === 'text/plain') selected @endif>Document text</option>
                <option value="application/vnd.openxmlformats-officedocument.wordprocessingml.document">Word
                    Documents</option>
                <option value="">Others</option>
            </select>
        </div>
    </form>

    <div class="flex">
        &nbsp;
        <a href="\allDocuments"
            class="flex text-bg-color bg-secondary hover:bg-main border-0 py-2 px-6 text-tiny focus:outline-none hover:bg-main ml-2">Afficher
            tous les documents</a>
        @can('upload')
            <button id="buttonmodalFile"
                class="flex text-bg-color bg-secondary hover:bg-main border-0 py-2 px-6 text-tiny focus:outline-none hover:bg-main ml-2"
                type="button">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 m-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                </svg>
                <span class="ml-2">Ajouter un document</span>
            </button>
        @endcan
    </div>
</div>
</div>
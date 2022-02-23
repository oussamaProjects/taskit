<div class="grid grid-cols-1 lg:grid-cols-1 p-4 gap-4">
    <div class="relative flex flex-col break-words bg-bg-color w-full shadow-sm rounded">
        <div class="rounded-t mb-0 px-0 border">
            <div class="flex flex-wrap items-center px-2 py-3">

                <div class="relative w-full max-w-full flex-grow flex-1">
                    <form action="/search" method="post" id="search-form" class="relative w-60">
                        {{ csrf_field() }}
                        <button class="outline-none focus:outline-none absolute top-2 right-1">
                            <svg class="w-6 h-6 text-gray-800 cursor-pointer" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                        <input type="text" autocomplete="off" name="search" id="search" placeholder="Recherche"
                            class="peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color" />
                    </form>
                </div>

                <form action="/sort" method="post" id="sort-form" class="ml-auto">
                    {{ csrf_field() }}
                    <div class="input-field col m2 s12">
                        <select name="filetype" id="sort"
                            class="peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color">
                            <option value="" disabled selected>Choisir</option>
                            <option value="image/jpeg" @if ($filetype === 'image/jpeg') selected @endif>Image
                            </option>
                            <option value="video/mp4" @if ($filetype === 'video/mp4') selected @endif>Video
                            </option>
                            <option value="audio/mpeg" @if ($filetype === 'audio/mpeg') selected @endif>Audio
                            </option>
                            <option value="application/pdf" @if ($filetype === 'application/pdf') selected @endif>PDF
                            </option>
                            <option value="text/plain" @if ($filetype === 'text/plain') selected @endif>Document
                                text
                            </option>
                            <option value="application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                Word
                                Documents</option>
                            <option value="">Others</option>
                        </select>
                    </div>
                </form>

                @include('documents.inc.action-buttons')

            </div>
        </div>
    </div>
</div>

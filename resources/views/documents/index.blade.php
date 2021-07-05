@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="ml-14 mt-16 mb-4 md:ml-64">
        <div class="flex items-center p-4 gap-4">

            <form action="/search" method="post" id="search-form"
                class="bg-white rounded flex items-center w-full max-w-xl mr-4 p-2 shadow-sm border border-gray-200 ">
                {{ csrf_field() }}
                <button class="outline-none focus:outline-none">
                    <svg class="w-5 text-gray-600 h-5 cursor-pointer" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
                <input type="text" name="search" id="search" placeholder="Search"
                    class="w-full pl-3 text-sm text-black outline-none focus:outline-none bg-transparent" />
            </form>

            <form action="/sort" method="post" id="sort-form" class="ml-auto">
                {{ csrf_field() }}
                <div class="input-field col m2 s12">
                    <select name="filetype" id="sort">
                        <option value="" disabled selected>Choose</option>
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
                <button
                    class="flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded ml-auto mr-4"
                    data-url="{{ url('documentsDeleteMulti') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>

                    <span class="ml-2">Supprimer la selection</span>

                </button>
                &nbsp;
                @can('upload')
                    <a href="/documents/create"
                        class="flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded ml-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        <span class="ml-2">Ajouter un document</span>
                    </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="ml-14 mb-14 md:ml-64">
        <div class="grid grid-cols-4 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-6 p-4 gap-4">
            @if (count($docs) > 0)
                @foreach ($docs as $doc)
                    <div id="tr_{{ $doc->id }}">

                        <div data-id="{{ $doc->id }}"
                            class="max-w-xs mx-auto overflow-hidden bg-white shadow-lg dark:bg-gray-900 relative">

                            <input type="checkbox" class="filled-in sub_chk absolute m-4" id="chk_{{ $doc->id }}"
                                data-id="{{ $doc->id }}">
                            <label for="chk_{{ $doc->id }}"></label>

                            {{-- <img class="object-cover w-full h-56"
                                src="https://images.unsplash.com/photo-1542156822-6924d1a71ace?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"
                                alt="avatar"> --}}

                            <div class="py-5 text-center">

                                @if (strpos($doc->mimetype, 'image') !== false)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto my-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                @elseif(strpos($doc->mimetype, "video") !== false)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto my-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                @elseif(strpos($doc->mimetype, "audio") !== false)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto my-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
                                    </svg>
                                @elseif(strpos($doc->mimetype,"text") !== false)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto my-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                @elseif(strpos($doc->mimetype,"application/pdf") !== false)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto my-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2}
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                @elseif(strpos($doc->mimetype,
                                    "application/vnd.openxmlformats-officedocument") !== false)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto my-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto my-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                @endif
                                <a href="/documents/{{ $doc->id }}"
                                    class="block text-2xl font-bold text-gray-800 dark:text-white">
                                    {{ $doc->name }}
                                </a>
                                <span class="text-sm text-gray-700 dark:text-gray-200">
                                    {{ $doc->filesize }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h5 class="teal-text">Aucun document n'a été téléchargé</h5>
            @endif

            @if (count($folders) > 0)
                @foreach ($folders as $fold)
                    <div data-id="{{ $fold->id }}"
                        class="max-w-xs mx-auto overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-900">
                        {{-- <img class="object-cover w-full h-56"
                            src="https://images.unsplash.com/photo-1542156822-6924d1a71ace?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"
                            alt="avatar"> --}}

                        <div class="py-5 text-center">
                            <a href="/folders/{{ $fold->id }}"
                                class="block text-2xl font-bold text-gray-800 dark:text-white">
                                {{ $fold->name }}
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 p-4 gap-4">
            <div class="flex flex-col text-center w-full mb-6">
                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">Documents</h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Tous les documents
                </p>
            </div>
            <div class="w-full overflow-auto">
                <table class="table-auto w-full text-left whitespace-no-wrap">
                    <thead>
                        <tr>
                            <th
                                class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                            </th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                Nom de fichier
                            </th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                Propriétaire
                            </th>
                            {{-- <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                Département
                            </th> --}}
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                Téléchargé à
                            </th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                Expire le
                            </th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>


                        @if (count($docs) > 0)
                            @foreach ($docs as $doc)
                                <tr id="tr_{{ $doc->id }}">
                                    <td>
                                        <input type="checkbox" id="chk_{{ $doc->id }}" class="sub_chk"
                                            data-id="{{ $doc->id }}">
                                        <label for="chk_{{ $doc->id }}"></label>
                                    </td>
                                    <td class="px-4 py-3">{{ $doc->name }}</td>
                                    <td class="px-4 py-3">{{ $doc->user->name }}</td>
                                    {{-- <td class="px-4 py-3">{{ $doc->user->department['dptName'] }}</td> --}}
                                    <td class="px-4 py-3">{{ $doc->created_at->toDayDateTimeString() }}</td>
                                    <td class="px-4 py-3 text-lg text-gray-900">
                                        @if ($doc->isExpire)
                                            {{ $doc->expires_at }}
                                        @else
                                            No Expiration
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-lg text-gray-900">
                                        <div class="h-6 flex ">
                                            @can('read')
                                                {!! Form::open() !!}
                                                <a href="/documents/{{ $doc->id }}" class="mr-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                                    </svg>
                                                </a>
                                                {!! Form::close() !!}
                                                {!! Form::open() !!}
                                                <a href="/documents/open/{{ $doc->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                                {!! Form::close() !!}
                                            @endcan
                                            @can('download')
                                                <a href="/documents/download/{{ $doc->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                    </svg>
                                                </a>
                                            @endcan
                                            <!-- SHARE using link -->
                                            @can('shared')
                                                {!! Form::open(['action' => ['ShareController@update', $doc->id], 'method' => 'PATCH', 'id' => 'form-share-documents-' . $doc->id]) !!}
                                                <a href="" class="data-share" data-form="documents-{{ $doc->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                                    </svg>
                                                </a>

                                                {!! Form::close() !!}
                                            @endcan
                                            @can('edit')
                                                <a href="/documents/{{ $doc->id }}/edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                            @endcan
                                            <!-- DELETE using link -->
                                            @can('delete')
                                                {!! Form::open(['action' => ['DocumentsController@destroy', $doc->id], 'method' => 'DELETE', 'id' => 'form-delete-documents-' . $doc->id]) !!}
                                                <a href="" class="data-delete" data-form="documents-{{ $doc->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </a>
                                                {!! Form::close() !!}
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">
                                    <h5 class="p-6 text-center">Aucun document n'a été téléchargé</h5>
                                </td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection
<div id="tr_{{ $doc->id }}">
    <div data-id="{{ $doc->id }}"
        class="folder-container h-20 flex items-center justify-center max-w-xs mx-auto shadow-md relative rounded-md"
        style="background-color: {{ $doc->color ?? 'red' }}">

        <div class="flex py-1 px-1 text-center align-middle">
            
            <div class="image">

                @if (strpos($doc->mimetype, 'image') !== false)
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto my-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                @elseif(strpos($doc->mimetype, 'video') !== false)
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto my-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                @elseif(strpos($doc->mimetype, 'audio') !== false)
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto my-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
                    </svg>
                @elseif(strpos($doc->mimetype, 'text') !== false)
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto my-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                @elseif(strpos($doc->mimetype, 'application/pdf') !== false)
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto my-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2}
                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                @elseif(strpos($doc->mimetype, 'application/vnd.openxmlformats-officedocument') !== false)
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto my-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto my-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                @endif
            </div>

            <div class="flex flex-col name px-2 text-left">

                <a href="/documents/{{ $doc->id }}" class="block text-sm font-bold capitalize">
                    {{ $doc->name }}
                </a>
                <span class="text-xs mt-auto">
                    {{ $doc->filesize }}
                </span>
            </div>

            @hasanyrole('Root|Admin')
                <div class="right ml-auto show-action">

                    <a href="#" class="right show-action" data-form="folders-{{ $folder->id }}"
                        class="flex items-center flex-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                        </svg>
                    </a>

                </div>
                <div
                    class="other-actions absolute z-10 w-40 h-32 -right-32 -bottom-32 text-gray-700 bg-white p-1 flex flex-col border hidden">
                    <div class="top">
                        <div class="text-xs font-bold">Actions</div>
                        <div class="h-6 flex">

                            {{-- @can('read') --}}
                            {!! Form::open() !!}
                            <a href="/documents/{{ $doc->id }}" class="mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                </svg>
                            </a>
                            {!! Form::close() !!}
                            {!! Form::open() !!}
                            <a href="/documents/open/{{ $doc->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                            {!! Form::close() !!}
                            {{-- @endcan --}}

                            {{-- @can('download') --}}
                            <a href="/documents/download/{{ $doc->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </a>
                            {{-- @endcan --}}

                            <!-- SHARE using link -->
                            @can('shared')
                                {!! Form::open(['action' => ['ShareController@update', $doc->id], 'method' => 'PATCH', 'id' => 'form-share-documents-' . $doc->id]) !!}
                                <a href="" class="data-share" data-form="documents-{{ $doc->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                    </svg>
                                </a>

                                {!! Form::close() !!}
                            @endcan

                            {{-- @can('edit') --}}
                            <a href="/documents/{{ $doc->id }}/edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            {{-- @endcan --}}

                            <!-- DELETE using link -->
                            {{-- @can('delete') --}}
                            {!! Form::open(['action' => ['DocumentsController@destroy', $doc->id], 'method' => 'DELETE', 'id' => 'form-delete-documents-' . $doc->id]) !!}
                            <a href="" class="data-delete" data-form="documents-{{ $doc->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </a>
                            {!! Form::close() !!}
                            {{-- @endcan --}}

                        </div>
                    </div>
                    @include('inc.colorDoc',['doc' => $doc])

                </div>
            @endrole

        </div>
    </div>
</div>

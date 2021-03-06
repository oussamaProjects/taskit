<div id="tr_{{ $doc->id }}" class="relative">
    <div data-id="{{ $doc->id }}" class="doc-folder-container icon-doc"
        style="background-color:{{ (!isset($doc->color) || $doc->color == "#FFFFFF") ? '#fffdf3' : $doc->color }}">

        <div class="flex flex-row px-2 py-3 relative inset-0 items-start">

            <div class="image mr-1">
                @include('inc.mime-type-icon', ['doc'=>$doc])
            </div>

            <div class="flex flex-col name">

                <a href="/documents/{{ $doc->id }}" class="block text-xs font-bold capitalize m-0">
                    {{ $doc->name }}  V-{{ $doc->version }}
                </a>
                <span class="text-xs mt-auto">
                    {{ $doc->filesize }}
                </span>
            </div>

            @hasanyrole('Root|Admin')
                <div class="absolute w-2 right-0 bottom-0">
                    <a href="#" class="right show-action" class="flex items-center flex-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                        </svg>
                    </a>
                </div>

                <div
                    class="other-actions absolute z-20 w-32 -right-28 -bottom-14 text-gray-800 bg-bg-color p-1 pb-0 flex flex-col border hidden">
                    <div class="top"> 
                        <div class="h-5 flex">

                            {{-- @can('read') --}}
                            {!! Form::open() !!}
                            <a href="/documents/{{ $doc->id }}" class="mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 m-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                </svg>
                            </a>
                            {!! Form::close() !!}
                            {!! Form::open() !!}
                            <a href="/documents/open/{{ $doc->id }}" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 m-1" fill="none"
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 m-1" fill="none"
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 m-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                    </svg>
                                </a>

                                {!! Form::close() !!}
                            @endcan

                            {{-- @can('edit') --}}
                            <a href="/documents/{{ $doc->id }}/edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 m-1" fill="none"
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 m-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </a>
                            {!! Form::close() !!}
                            {{-- @endcan --}}

                        </div>
                    </div>
                    @include('inc.docs.colorDoc',['doc' => $doc])

                </div>
            @endrole

        </div>
    </div>
</div>

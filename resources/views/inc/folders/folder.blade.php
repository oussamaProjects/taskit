    <div data-id="{{ $folder->id }}" class="doc-folder-container icon-folder self-start bg-bg-color"
        style="background-color:{{ (!isset($folder->color) || $folder->color == "#FFFFFF") ? '#fffdf3' : $folder->color }}">

        <div class="flex flex-col py-2 pl-2 pr-4 absolute inset-0 items-start">

            <div class="flex flex-col name">
                <a href="/folders/{{ $folder->id }}" class="block text-xs font-bold capitalize m-0">
                    {{ $folder->name }}
                </a>
                <div class="text-xxs font-medium mt-auto">
                    ({{ count($folder->documents()->get()) }}) documents
                </div>
                <div class="text-xxs mt-auto">
                    {{ \Carbon\Carbon::createFromTimeStamp($folder->created_at->toDayDateTimeString())->formatLocalized('%d %B %Y, %H:%M') }}
                </div>
            </div>

            @hasanyrole('Root|Admin')
                <div class="absolute w-2 right-0 bottom-0">
                    <a href="#" class="right ml-auto show-action" data-form="folders-{{ $folder->id }}"
                        class="flex items-center flex-1">
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
                        <div class="h-5 flex ">
                            <!-- DELETE using link -->
                            {!! Form::open(['action' => ['FolderController@destroy', $folder->id], 'method' => 'DELETE', 'id' => 'form-delete-folders-' . $folder->id, 'class' => 'flex items-center']) !!}
                            <a href="/folder/{{ $folder->id }}/child" class="flex items-center flex-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 m-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                </svg>
                            </a>
                            <a href="/folders/{{ $folder->id }}/edit" class="flex items-center flex-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 m-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            {!! Form::close() !!}

                            {!! Form::open(['action' => ['FolderController@destroy', $folder->id], 'method' => 'DELETE', 'id' => 'form-delete-folder-' . $folder->id, 'class' => 'flex items-center']) !!}
                            @can('delete')
                                <a href="#" class="flex items-center flex-1 data-delete" data-form="folder-{{ $folder->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 m-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </a>
                            @endcan
                            {!! Form::close() !!}

                        </div>
                    </div>

                    @include('inc.folders.colorFolder',['folder' => $folder])
                </div>
            @endrole

        </div>
    </div>

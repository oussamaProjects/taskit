<div data-id="{{ $folder->id }}" class="doc-folder-container icon-folder self-start"
    {{-- style="background-color:{{ !isset($folder->color) || $folder->color == '#FFFFFF' ? '#fffdf3' : $folder->color }}" --}}>
    <div class="card flex flex-col">

        <div class="flex flex-col items-start justify-start name card__face front">

            <a href="/folders/{{ $folder->id }}" class="flex items-center text-xs font-bold capitalize m-0">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                    class="w-5 h-4" viewBox="0 0 256 256" xml:space="preserve">
                    <defs>
                    </defs>
                    <g transform="translate(128 128) scale(0.72 0.72)" style="">
                        <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;"
                            transform="translate(-175.05 -175.05000000000004) scale(3.89 3.89)">
                            <path
                                d="M 3.649 80.444 h 82.703 c 2.015 0 3.649 -1.634 3.649 -3.649 v -56.12 c 0 -2.015 -1.634 -3.649 -3.649 -3.649 H 35.525 c -1.909 0 -3.706 -0.903 -4.846 -2.435 l -2.457 -3.301 c -0.812 -1.092 -2.093 -1.735 -3.454 -1.735 H 3.649 C 1.634 9.556 0 11.19 0 13.205 v 63.591 C 0 78.81 1.634 80.444 3.649 80.444 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: {{ !isset($folder->color) || $folder->color == '#FFFFFF' ? '#6CC1ED' : $folder->color }}; fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 86.351 80.444 H 3.649 C 1.634 80.444 0 78.81 0 76.795 V 29.11 c 0 -2.015 1.634 -3.649 3.649 -3.649 h 82.703 c 2.015 0 3.649 1.634 3.649 3.649 v 47.685 C 90 78.81 88.366 80.444 86.351 80.444 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: {{ !isset($folder->color) || $folder->color == '#FFFFFF' ? '#6CC1ED' : $folder->color }}; fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 85.106 76.854 H 4.894 c -0.276 0 -0.5 -0.224 -0.5 -0.5 s 0.224 -0.5 0.5 -0.5 h 80.213 c 0.276 0 0.5 0.224 0.5 0.5 S 85.383 76.854 85.106 76.854 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: {{ !isset($folder->color) || $folder->color == '#FFFFFF' ? '#6CC1ED' : $folder->color }}; fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 85.106 72.762 H 4.894 c -0.276 0 -0.5 -0.224 -0.5 -0.5 s 0.224 -0.5 0.5 -0.5 h 80.213 c 0.276 0 0.5 0.224 0.5 0.5 S 85.383 72.762 85.106 72.762 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: {{ !isset($folder->color) || $folder->color == '#FFFFFF' ? '#6CC1ED' : $folder->color }}; fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                        </g>
                    </g>
                </svg>
                <span class="ml-1">{{ $folder->name }}</span>
            </a>
            <div class="text-xxs font-medium">
                ({{ count($folder->documents()->get()) }}) documents
            </div>
            <div class="text-xxs">
                {{ \Carbon\Carbon::createFromTimeStamp($folder->created_at->toDayDateTimeString())->formatLocalized('%d %B %Y, %H:%M') }}
            </div>

        </div>

        @hasanyrole('Root|Admin')

            <div class="flex flex-col items-start justify-start other-actions card__face back">

                <div class="top">
                    <div class="h-5 flex ">
                        <!-- DELETE using link -->
                        {!! Form::open(['action' => ['FolderController@destroy', $folder->id], 'method' => 'DELETE', 'id' => 'form-delete-folders-' . $folder->id, 'class' => 'flex items-center']) !!}
                        <a href="/folder/{{ $folder->id }}/child" class="flex items-center flex-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 m-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                            </svg>
                        </a>
                        <a href="/folders/{{ $folder->id }}/edit" class="flex items-center flex-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 m-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>
                        {!! Form::close() !!}

                        {!! Form::open(['action' => ['FolderController@destroy', $folder->id], 'method' => 'DELETE', 'id' => 'form-delete-folder-' . $folder->id, 'class' => 'flex items-center']) !!}
                        @can('delete')
                            <a href="#" class="flex items-center flex-1 data-delete" data-form="folder-{{ $folder->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 m-1" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </a>
                        @endcan
                        {!! Form::close() !!}

                        <a href="/favorites/folder/{{ $folder->id }}/">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 m-1 text-red-500"
                                fill="{{ $folder->hasBeenFavoritedBy(auth()->user()) ? 'red' : 'none' }}"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </a>

                    </div>
                </div>

                @include('inc.folders.colorFolder',['folder' => $folder])


            </div>
        @endrole

    </div>

    <div class="absolute w-2 right-0 top-0">
        <a href="#" class="right ml-auto show-action" data-form="folders-{{ $folder->id }}"
            class="flex items-center flex-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </a>
    </div>


</div>

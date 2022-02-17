<div id="tr_{{ $folder->id }}">
    <div data-id="{{ $folder->id }}" 
        class="folder-container h-14 flex items-center justify-center max-w-xs mx-auto shadow-md relative rounded-r-lg"
        style="background-color:{{ $folder->color ?? 'red' }}">

        <div class="flex py-1 px-1 text-center align-middle">
            
            <div class="image">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto my-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                </svg>
            </div>
            
            <div class="flex flex-col name px-2 text-left">
                <a href="/folder/{{ $folder->id }}/child" class="block text-sm font-bold capitalize">
                    {{ $folder->name }}
                </a>
                <div class="text-xs mt-auto">
                    {{ $folder->created_at->toDayDateTimeString() }}
                </div>
            </div>

            @hasanyrole('Root|Admin')
                <a href="#" class="right ml-auto show-action" data-form="folders-{{ $folder->id }}"
                    class="flex items-center flex-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                    </svg>
                </a>

                <div
                    class="other-actions absolute z-10 w-40 h-32 -right-32 -bottom-32 text-gray-700 bg-white p-1 flex flex-col border hidden">
                    <div class="top">
                        <div class="text-xs font-bold">Actions</div>
                        <div class="h-6 flex ">
                            <!-- DELETE using link -->
                            {!! Form::open(['action' => ['FolderController@destroy', $folder->id], 'method' => 'DELETE', 'id' => 'form-delete-folders-' . $folder->id, 'class' => 'flex items-center']) !!}
                            <a href="/folder/{{ $folder->id }}/child" class="flex items-center flex-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                </svg>
                            </a>
                            <a href="/folders/{{ $folder->id }}/edit" class="flex items-center flex-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            {!! Form::close() !!}

                        </div>
                    </div>

                    @include('inc.colorFolder',['folder' => $folder])
                </div>
            @endrole

        </div>
    </div>
</div>

{!! Form::open(['action' => 'FolderController@store', 'method' => 'POST', 'class' => '']) !!}

<div class="mb-8 relative">
    <label for="name" class="text-xs opacity-75 scale-75">Nom de dossier</label>
    {{ Form::text('name', '', ['id' => 'name','autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm']) }}
</div>

<div class="relative mb-4">
    {!! Form::checkbox('parent', 1, false, ['id' => 'parent_yes', 'class' => 'opacity-0 absolute', 'onclick' => 'checkRadio(value)']) !!}
    <label
        class="select-none inline-block text-sm font-medium text-bg-color bg-secondary hover:text-bg-color hover:bg-main transition text-center px-2 py-1 mb-1 rounded-sm w-30 cursor-pointer w-full"
        for="parent_yes">Have a parent</label>
</div>

<div class="mb-4 dossier_parent hidden flex items-end" id="dossier_parent">
    <div class="w-full">
        <div class="relative ">
            <label for="name" class="text-xs opacity-75 scale-75">Dans
                le dossier</label>
            <select name="folder_parent_id" id="folder" onchange="javascript:handleSelect(this)"
                class="peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm">
                @foreach ($folders_input as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
                <option value="add_folder"> --- Ajouter un autre dossier</option>
            </select>
            {{-- <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                    <path
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" fill-rule="evenodd">
                    </path>
                </svg>
            </div> --}}
        </div>
    </div>
    <div class="w-6 ml-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" id="add_folder"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
        </svg>
    </div>
    @if ($errors->has('folder'))
        <span class="text-amber text-xs">{{ $errors->first('folder') }}</span>
    @endif
</div>

@include('inc.folders.autorisation', ['subs' => $subs])


<div class="flex items-end justify-end">
    {{ Form::submit('Sauvegarder', ['class' =>'flex text-bg-color bg-secondary hover:bg-main border-0 py-2 px-6 text-tiny focus:outline-none transition hover:bg-main ml-2']) }}
    {!! Form::close() !!}
</div>

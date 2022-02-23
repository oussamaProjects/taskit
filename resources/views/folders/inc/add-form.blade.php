{!! Form::open(['action' => 'FolderController@store', 'method' => 'POST', 'class' => '']) !!}

<div class="mb-4 relative">
    <label for="name" class="text-xs opacity-75 scale-75">Nom de dossier</label>
    {{ Form::text('name', '', ['id' => 'name','autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color']) }}
</div>

@include('inc.color-container',['location' => 'folder'])

<div class="relative mb-4">
    {!! Form::checkbox('parent', 1, false, ['id' => 'parent_yes', 'class' => 'opacity-0 absolute', 'onclick' => 'checkRadio(value)']) !!}
    <label
        class="select-none inline-block text-xs font-light text-bg-color bg-secondary hover:text-main hover:bg-tertiary transition text-center px-2 py-1 mb-1 rounded-sm w-30 cursor-pointer w-40"
        for="parent_yes">Have a parent</label>
</div>

<div class="mb-4 dossier_parent hidden flex items-end" id="dossier_parent">

    <div class="w-full">
        <div class="relative ">
            <label for="name" class="text-xs opacity-75 scale-75">Dans
                le dossier</label>
            <select name="folder_parent_id" id="folder" onchange="javascript:handleSelect(this)"
                class="peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color">
                @foreach ($folders_input as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
                <option class="add_folder" value="add_folder"> --- Ajouter un autre dossier</option>
            </select>
        </div>
    </div>

    <div class="w-6 ml-3">
        <svg id="add_folder" class="h-6 w-6 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
            width="16" height="16">
            <path fill-rule="evenodd"
                d="M13.25 2.5H2.75a.25.25 0 00-.25.25v10.5c0 .138.112.25.25.25h10.5a.25.25 0 00.25-.25V2.75a.25.25 0 00-.25-.25zM2.75 1h10.5c.966 0 1.75.784 1.75 1.75v10.5A1.75 1.75 0 0113.25 15H2.75A1.75 1.75 0 011 13.25V2.75C1 1.784 1.784 1 2.75 1zM8 4a.75.75 0 01.75.75v2.5h2.5a.75.75 0 010 1.5h-2.5v2.5a.75.75 0 01-1.5 0v-2.5h-2.5a.75.75 0 010-1.5h2.5v-2.5A.75.75 0 018 4z">
            </path>
        </svg>
    </div>

    @if ($errors->has('folder'))
        <span class=" text-red-500 text-xs">{{ $errors->first('folder') }}</span>
    @endif

</div>

@include('inc.folders.autorisation', ['subs' => $subs])


<div class="flex items-end justify-end mt-4">
    {{ Form::submit('Sauvegarder', ['class' =>'flex text-bg-color bg-secondary hover:text-main hover:bg-tertiary border py-2 px-6 text-tiny focus:outline-none transition hover:no-underline ml-2']) }}
    {!! Form::close() !!}
</div>

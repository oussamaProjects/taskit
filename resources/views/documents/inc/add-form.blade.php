{!! Form::open(['action' => 'DocumentsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'col s12']) !!}

{{ csrf_field() }}

<div class="mb-4 flex">
    <div class="mr-4 relative flex-1">
        <label for="name" class="text-xs opacity-75 scale-75">
            Nom du document
        </label>
        {{ Form::text('name', '', ['id' => 'name','autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm']) }}
        @if ($errors->has('name'))
            <span class="text-amber text-xs">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <div class="mr-4 relative flex-1">
        <label for="ref" class="text-xs opacity-75 scale-75">
            Réference
        </label>
        {{ Form::text('ref', '', ['id' => 'ref','autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm']) }}
        @if ($errors->has('ref'))
            <span class="text-amber text-xs">{{ $errors->first('ref') }}</span>
        @endif
    </div>
    <div class="relative flex-1">
        <label for="name" class="text-xs opacity-75 scale-75">
            Version
        </label>
        {{ Form::text('version', '', ['id' => 'version','autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm']) }}
        @if ($errors->has('version'))
            <span class="text-amber text-xs">{{ $errors->first('version') }}</span>
        @endif
    </div>
</div>

<div class="mb-2 relative">
    <label for="name" class="text-xs opacity-75 scale-75">Description</label>
    {{ Form::textarea('description', '', ['id' => 'description','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-16 text-sm']) }}
    @if ($errors->has('description'))
        <span class="text-amber text-xs">{{ $errors->first('description') }}</span>
    @endif
</div>

<div class="mb-2 relative hidden">
    {{ Form::checkbox('isExpire', 1, true, ['id' => 'isExpire']) }}
    <label for="name" class="text-xs opacity-75 scale-75">Does
        Not Expire</label>
</div>

<div class="mb-2 relative">
    <div class="flex">



        <div class="mb-4 pr-2 relative flex-1 flex items-end">
            <div class="w-full relative">
                <label for="category" class="text-xs opacity-75 scale-75">
                    Catégorie (Optional)
                </label>
                <select name="category_id" id="category" onchange="javascript:handleSelect(this)"
                    class="peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm">
                    @foreach ($categories as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                    <option value="add_categorie"> --- Ajouter une autre categorie</option>
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
            <div class="w-6 ml-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    id="add_categorie" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
            </div>
            @if ($errors->has('folder'))
                <span class="text-amber text-xs">{{ $errors->first('folder') }}</span>
            @endif
        </div>

        <div class="mb-4 ml-2 relative flex-1 flex items-end">
            <div class="w-full relative">
                <label for="folder" class="text-xs opacity-75 scale-75">Dans
                    le dossier</label>
                <select name="folder_id" id="folder" onchange="javascript:handleSelect(this)"
                    class="peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm">
                    @foreach ($folders_input as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                    <option value="add_folder_main"> --- Ajouter un autre dossier</option>
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
            <div class="w-6 ml-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    id="add_folder_main" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
            </div>
            @if ($errors->has('folder'))
                <span class="text-amber text-xs">{{ $errors->first('folder') }}</span>
            @endif
        </div>

    </div>
</div>

@include('inc.docs.autorisation', ['subs' => $subs])

<div class="relative">
    <div class="btn bg-color">
        <span class="black-text">Sélectionner votre fichier (Max: 50MB)</span>
        {{ Form::file('file') }}
        @if ($errors->has('file'))
            <span class="text-amber text-xs">{{ $errors->first('file') }}</span>
        @endif
    </div>
</div>

<div class="flex items-end justify-end">
    {{ Form::submit('Sauvegarder', ['class' =>'flex text-bg-color bg-secondary hover:bg-main border-0 py-2 px-6 text-tiny focus:outline-none transition hover:bg-main ml-2']) }}
</div>

{!! Form::close() !!}

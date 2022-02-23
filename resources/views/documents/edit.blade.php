@extends('layouts.app')

@section('content')
    @include('inc.sidebar')

    @include('documents.inc.head')

    <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 gap-4">
        <div class="col-span-2">

            {!! Form::open(['action' => ['DocumentsController@update', $doc->id], 'method' => 'PATCH', 'enctype' => 'multipart/form-data', 'class' => 'col ml-4 s12']) !!}

            {{ csrf_field() }}

            <div class="mb-4 flex">
                <div class="mr-4 relative flex-1">
                    <label for="name" class="text-xs opacity-75 scale-75">
                        Nom du document
                    </label>
                    {{ Form::text('name', $doc->name, ['id' => 'name','autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color']) }}
                    @if ($errors->has('name'))
                        <span class="text-red-500 text-xs">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mr-4 relative flex-1">
                    <label for="ref" class="text-xs opacity-75 scale-75">
                        Réference
                    </label>
                    {{ Form::text('ref', $doc->ref, ['id' => 'ref','autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color']) }}
                    @if ($errors->has('ref'))
                        <span class="text-red-500 text-xs">{{ $errors->first('ref') }}</span>
                    @endif
                </div>
                <div class="relative flex-1">
                    <label for="name" class="text-xs opacity-75 scale-75">
                        Version
                    </label>
                    {{ Form::text('version', $doc->version, ['id' => 'version','autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color']) }}
                    @if ($errors->has('version'))
                        <span class="text-red-500 text-xs">{{ $errors->first('version') }}</span>
                    @endif
                </div>
            </div>

            <div class="mb-2 relative">
                <label for="name" class="text-xs opacity-75 scale-75">Description</label>
                {{ Form::textarea('description', $doc->description, ['id' => 'description','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-16 text-sm']) }}
                @if ($errors->has('description'))
                    <span class="text-red-500 text-xs">{{ $errors->first('description') }}</span>
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
                                class="peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color">
                                @foreach ($categories as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                                <option class="add_folder" value="add_categorie"> --- Ajouter une autre categorie</option>
                            </select> 
                        </div>
                        <div class="w-6 ml-3">
                            <svg id="add_categorie" class="h-6 w-6 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M13.25 2.5H2.75a.25.25 0 00-.25.25v10.5c0 .138.112.25.25.25h10.5a.25.25 0 00.25-.25V2.75a.25.25 0 00-.25-.25zM2.75 1h10.5c.966 0 1.75.784 1.75 1.75v10.5A1.75 1.75 0 0113.25 15H2.75A1.75 1.75 0 011 13.25V2.75C1 1.784 1.784 1 2.75 1zM8 4a.75.75 0 01.75.75v2.5h2.5a.75.75 0 010 1.5h-2.5v2.5a.75.75 0 01-1.5 0v-2.5h-2.5a.75.75 0 010-1.5h2.5v-2.5A.75.75 0 018 4z"></path></svg>
                        </div>
                        @if ($errors->has('folder'))
                            <span class="text-red-500 text-xs">{{ $errors->first('folder') }}</span>
                        @endif
                    </div>

                    <div class="mb-4 ml-2 relative flex-1 flex items-end">
                        <div class="w-full relative">
                            <label for="folder" class="text-xs opacity-75 scale-75">Dans
                                le dossier</label>
                            <select name="folder_id" id="folder" onchange="javascript:handleSelect(this)"
                                class="peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color">
                                @foreach ($folders_input as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                                <option class="add_folder" value="add_folder_main"> --- Ajouter un autre dossier</option>
                            </select> 
                        </div>
                        <div class="w-6 ml-3">
                            <svg id="add_folder_main" class="h-6 w-6 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M13.25 2.5H2.75a.25.25 0 00-.25.25v10.5c0 .138.112.25.25.25h10.5a.25.25 0 00.25-.25V2.75a.25.25 0 00-.25-.25zM2.75 1h10.5c.966 0 1.75.784 1.75 1.75v10.5A1.75 1.75 0 0113.25 15H2.75A1.75 1.75 0 011 13.25V2.75C1 1.784 1.784 1 2.75 1zM8 4a.75.75 0 01.75.75v2.5h2.5a.75.75 0 010 1.5h-2.5v2.5a.75.75 0 01-1.5 0v-2.5h-2.5a.75.75 0 010-1.5h2.5v-2.5A.75.75 0 018 4z"></path></svg>
                        </div>
                        @if ($errors->has('folder'))
                            <span class="text-red-500 text-xs">{{ $errors->first('folder') }}</span>
                        @endif
                    </div>

                </div>
            </div>

            @include('inc.docs.autorisation', ['subs' => $subs])

            <div class="flex">
                {{ Form::submit('Sauvegarder', ['class' =>'flex text-bg-color bg-secondary hover:text-main hover:bg-tertiary border py-2 px-6 text-tiny focus:outline-none transition hover:no-underline ml-2']) }}
            </div>

            {!! Form::close() !!}
        </div>


        @can('upload')
            <button id="buttonmodalFileImg" class="bg-bg-color h-auto p-4" type="button">
                <img src="{{ asset('img/undraw_Add_files_re_v09g.svg') }}" alt="">
            </button>
        @endcan


    </div>

    @include('inc.sidebar-footer')
    @include('popups.addFile')
    @include('popups.scripts')
@endsection

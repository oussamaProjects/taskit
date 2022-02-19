@extends('layouts.app')

@section('content')
    @include('inc.sidebar')

    <div class="ml-14 mt-14 mb-4 md:ml-64 display-none">
        <div class="flex items-center p-4 gap-4 bg-bg-color shadow">

            <form action="/search" method="post" id="search-form"
                class="bg-bg-color rounded flex items-center w-full max-w-xl mr-4 p-2 shadow-sm border border-bg-color ">
                {{ csrf_field() }}
                <button class="outline-none focus:outline-none">
                    <svg class="w-5 text-gray-800 h-5 cursor-pointer" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
                <input type="text" autocomplete="off" name="search" id="search" placeholder="Recherche"
                    class="w-full pl-3 text-sm text-black outline-none focus:outline-none bg-transparent" />
            </form>

            <div class="flex ml-auto">
                @can('upload')
                    <button id="buttonmodalFile"
                        class="flex text-bg-color bg-secondary hover:bg-main border-0 py-2 px-6 text-tiny focus:outline-none hover:bg-main ml-2"
                        type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 m-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        <span class="ml-2">Ajouter un document</span>
                    </button>
                @endcan
            </div>

        </div>
    </div>


    <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 gap-4">
        <div class="col-span-2">
            <div class="h-full ml-14 mb-10 md:ml-64" style=" ">
                <div class="flex flex-col p-4 ml-4 bg-bg-color shadow">
                    <h1 class="sm:text-2xl text-xl font-medium title-font text-gray-800">Modifier le document</h1>
                </div>

                {!! Form::open(['action' => ['DocumentsController@update', $doc->id], 'method' => 'PATCH', 'enctype' => 'multipart/form-data', 'class' => 'col ml-4 s12']) !!}

                {{ csrf_field() }}

                <div class="mb-4 flex">
                    <div class="mr-4 relative flex-1">
                        <label for="name" class="text-xs opacity-75 scale-75">
                            Nom du document
                        </label>
                        {{ Form::text('name', $doc->name, ['id' => 'name','autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm']) }}
                        @if ($errors->has('name'))
                            <span class="text-amber text-xs">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="mr-4 relative flex-1">
                        <label for="ref" class="text-xs opacity-75 scale-75">
                            Réference
                        </label>
                        {{ Form::text('ref', $doc->ref, ['id' => 'ref','autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm']) }}
                        @if ($errors->has('ref'))
                            <span class="text-amber text-xs">{{ $errors->first('ref') }}</span>
                        @endif
                    </div>
                    <div class="relative flex-1">
                        <label for="name" class="text-xs opacity-75 scale-75">
                            Version
                        </label>
                        {{ Form::text('version', $doc->version, ['id' => 'version','autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm']) }}
                        @if ($errors->has('version'))
                            <span class="text-amber text-xs">{{ $errors->first('version') }}</span>
                        @endif
                    </div>
                </div>

                <div class="mb-2 relative">
                    <label for="name" class="text-xs opacity-75 scale-75">Description</label>
                    {{ Form::textarea('description', $doc->description, ['id' => 'description','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-16 text-sm']) }}
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
                                    class="peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm placeholder-gray-800 border appearance-none focus:shadow-outline">
                                    @foreach ($categories as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                    <option value="add_categorie"> --- Ajouter une autre categorie</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" fill-rule="evenodd">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div class="w-6 ml-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" id="add_categorie" stroke="currentColor">
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
                                    class="peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm placeholder-gray-800 border appearance-none focus:shadow-outline">
                                    @foreach ($folders_input as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                    <option value="add_folder_main"> --- Ajouter un autre dossier</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" fill-rule="evenodd">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div class="w-6 ml-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" id="add_folder_main" stroke="currentColor">
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

                @include('inc.autorisation', ['subs' => $subs])



                <div class="flex">
                    {{ Form::submit('Sauvegarder', ['class' => 'flex text-bg-color bg-secondary hover:bg-main border-0 py-2 px-6 text-tiny focus:outline-none hover:bg-main ml-2']) }}
                </div>

                {!! Form::close() !!}
            </div>
        </div>

        @can('upload')
            <button id="buttonmodalFileImg" class="bg-bg-color h-auto p-4 shadow" type="button">
                <img src="{{ asset('img/undraw_Add_files_re_v09g.svg') }}" alt="">
            </button>
        @endcan


    </div>

    @include('popups.addFile')
    @include('popups.scripts')
@endsection

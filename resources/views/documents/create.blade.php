@extends('layouts.app')

@section('content')
    @include('inc.sidebar')
 
        <div class="flex flex-col w-full p-4">
            <h1 class="sm:text-2xl text-xl font-medium title-font text-gray-800">Ajouter le document</h1>
        </div>

        <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 gap-4">
            <div class="col-span-2 ml-4 bg-bg-color">
                {!! Form::open(['action' => 'DocumentsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => '']) !!}

                {{ csrf_field() }}

                <div class="grid grid-cols-3 sm:grid-cols-3 lg:grid-cols-3 p-4 gap-4">
                    <div class="mb-2 relative">
                        <label for="name" class="text-xs opacity-75 scale-75">Nom
                            du document</label>
                        {{ Form::text('name', '', ['id' => 'name','autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color']) }}
                        @if ($errors->has('name'))
                            <span class=" text-red-500 text-xs">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="mb-2 relative">
                        <label for="name" class="text-xs opacity-75 scale-75">Description</label>
                        {{ Form::textarea('description', '', ['id' => 'description','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-16 text-sm bg-bg-color']) }}
                        @if ($errors->has('description'))
                            <span class=" text-red-500 text-xs">{{ $errors->first('description') }}</span>
                        @endif
                    </div>

               
                    <div class="mb-2 relative">
                        <label for="ref" class="text-xs opacity-75 scale-75">
                            Réference
                        </label>
                        {{ Form::text('ref', '', ['id' => 'ref','autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color']) }}
                        @if ($errors->has('ref'))
                            <span class=" text-red-500 text-xs">{{ $errors->first('ref') }}</span>
                        @endif
                    </div>

                    {{-- <div class="mb-2 relative">
                        <label for="name" class="text-xs opacity-75 scale-75">
                            Version
                        </label>
                        {{ Form::text('version', '', ['id' => 'version','autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color']) }}
                        @if ($errors->has('version'))
                            <span class=" text-red-500 text-xs">{{ $errors->first('version') }}</span>
                        @endif
                    </div>
                    <div class="mb-2 relative hidden">
                        {{ Form::checkbox('isExpire', 1, true, ['id' => 'isExpire']) }}
                        <label for="name" class="text-xs opacity-75 scale-75">Does
                            Not Expire</label>
                    </div> --}}
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-2 p-4 gap-4">

                    <div class="mb-2 relative">
                        <label class="text-xs opacity-75 scale-75">
                            Activité (Optional)
                        </label>
                        {{ Form::select('category_id[]', $categories, null, ['multiple' => 'multiple','id' => 'category','class' =>'form-multiselect peer border border-bg-color focus:outline-none rounded focus:border-bg-color0 focus:shadow-sm-sm block w-full py-2']) }}
                        @if ($errors->has('category'))
                            <span class=" text-red-500 text-xs">{{ $errors->first('category') }}</span>
                        @endif
                    </div>

                    <div class="mb-2 relative">
                        <label class="text-xs opacity-75 scale-75">
                            Folder (Optional)
                        </label>
                        {{ Form::select('folder_id[]', $folders, null, ['multiple' => 'multiple','id' => 'folder','class' =>'form-multiselect peer border border-bg-color focus:outline-none rounded focus:border-bg-color0 focus:shadow-sm-sm block w-full py-2']) }}
                        @if ($errors->has('folder'))
                            <span class=" text-red-500 text-xs">{{ $errors->first('folder') }}</span>
                        @endif
                    </div>
                </div>

                @include('inc.docs.autorisation', ['subs' => $subs])

                <div class="mb-2 relative">
                    <div class="btn bg-color">
                        <span class="black-text">Sélectionner votre fichier (Max: 50MB)</span>
                        {{ Form::file('file') }}
                        @if ($errors->has('file'))
                            <span class=" text-red-500 text-xs">{{ $errors->first('file') }}</span>
                        @endif
                    </div>
                </div>

                <div class="flex items-end justify-end mt-4">
                    {{ Form::submit('Sauvegarder', ['class' => 'text-bg-color bg-main border py-2 px-6 focus:outline-none hover:bg-main text-lg']) }}
                </div>
            </div>


            {!! Form::close() !!}
        </div>
    
        @include('inc.sidebar-footer')
@endsection

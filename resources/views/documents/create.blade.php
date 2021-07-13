@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="mt-20 ml-14 mb-10 md:ml-64" style="width: 660px;max-wodth:100%;">
        <div class="flex flex-col w-full p-4">
            <h1 class="sm:text-2xl text-xl font-medium title-font text-gray-900">Ajouter le document</h1>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 p-4 gap-4">

            {!! Form::open(['action' => 'DocumentsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'col s12']) !!}

            {{ csrf_field() }}


            <div class="mb-5 relative">
                <label for="name"
                    class="peer-placeholder-shown:opacity-100 opacity-75 peer-focus:opacity-75 peer-placeholder-shown:scale-100 scale-75 peer-focus:scale-75 peer-placeholder-shown:translate-y-0 -translate-y-3 peer-focus:-translate-y-3 peer-placeholder-shown:translate-x-0 translate-x-1 peer-focus:translate-x-1 absolute top-0 left-0 px-3 py-5 h-full pointer-events-none transform origin-left transition-all duration-100 ease-in-out">Nom
                    de fichier</label>
                {{ Form::text('name', '', ['id' => 'name', 'class' => 'peer pt-8 border border-gray-200 focus:outline-none rounded-md focus:border-gray-500 focus:shadow-sm w-full p-3 h-16 placeholder-transparent']) }}
                @if ($errors->has('name'))
                    <span class="text-red-600 text-xs">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="mb-5 relative">
                <label for="name"
                    class="peer-placeholder-shown:opacity-100 opacity-75 peer-focus:opacity-75 peer-placeholder-shown:scale-100 scale-75 peer-focus:scale-75 peer-placeholder-shown:translate-y-0 -translate-y-3 peer-focus:-translate-y-3 peer-placeholder-shown:translate-x-0 translate-x-1 peer-focus:translate-x-1 absolute top-0 left-0 px-3 py-5 h-full pointer-events-none transform origin-left transition-all duration-100 ease-in-out">Description</label>
                {{ Form::textarea('description', '', ['id' => 'description', 'class' => 'peer pt-8 border border-gray-200 focus:outline-none rounded-md focus:border-gray-500 focus:shadow-sm w-full p-3 h-16 placeholder-transparent']) }}
                @if ($errors->has('description'))
                    <span class="text-red-600 text-xs">{{ $errors->first('description') }}</span>
                @endif
            </div>

            <div class="mb-5 relative hidden">
                {{ Form::checkbox('isExpire', 1, true, ['id' => 'isExpire']) }}
                <label for="name"
                    class="peer-placeholder-shown:opacity-100 opacity-75 peer-focus:opacity-75 peer-placeholder-shown:scale-100 scale-75 peer-focus:scale-75 peer-placeholder-shown:translate-y-0 -translate-y-3 peer-focus:-translate-y-3 peer-placeholder-shown:translate-x-0 translate-x-1 peer-focus:translate-x-1 absolute top-0 left-0 px-3 py-5 h-full pointer-events-none transform origin-left transition-all duration-100 ease-in-out">Does
                    Not Expire</label>
            </div>

            <div class="mb-5 relative">
                <label
                    class="peer-placeholder-shown:opacity-100 opacity-75 peer-focus:opacity-75 peer-placeholder-shown:scale-100 scale-75 peer-focus:scale-75 peer-placeholder-shown:translate-y-0 -translate-y-3 peer-focus:-translate-y-3 peer-placeholder-shown:translate-x-0 translate-x-1 peer-focus:translate-x-1 absolute top-0 left-0  py-5 h-full pointer-events-none transform origin-left transition-all duration-100 ease-in-out">
                    Category (Optional)
                </label>
                {{ Form::select('category_id[]', $categories, null, ['multiple' => 'multiple', 'id' => 'category', 'class' => 'form-multiselect block w-full pt-12 pl-3']) }}
                @if ($errors->has('category'))
                    <span class="text-red-600 text-xs">{{ $errors->first('category') }}</span>
                @endif
            </div>

            <div class="mb-5 relative">
                <label
                    class="peer-placeholder-shown:opacity-100 opacity-75 peer-focus:opacity-75 peer-placeholder-shown:scale-100 scale-75 peer-focus:scale-75 peer-placeholder-shown:translate-y-0 -translate-y-3 peer-focus:-translate-y-3 peer-placeholder-shown:translate-x-0 translate-x-1 peer-focus:translate-x-1 absolute top-0 left-0  py-5 h-full pointer-events-none transform origin-left transition-all duration-100 ease-in-out">
                    Folder (Optional)
                </label>
                {{ Form::select('folder_id[]', $folders, null, ['multiple' => 'multiple', 'id' => 'folder', 'class' => 'form-multiselect block w-full pt-12 pl-3']) }}
                @if ($errors->has('folder'))
                    <span class="text-red-600 text-xs">{{ $errors->first('folder') }}</span>
                @endif
            </div>

            <div class="mb-5 relative">
                <h3 class="text-gray-900 text-lg mt-6 mb-4 font-medium title-font uppercase">Autorisation</h3>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3">
                    @if (count($depts) > 0)
                        @foreach ($depts as $dept)

                            <div class="mb-6">
                                <div class="text-gray-900 mb-2 font-medium title-font">
                                    {{ $dept->dptName }}
                                </div>

                                <div class="">
                                    <input type="radio" name="permissions_{{ $dept->id }}[]"
                                        value="{{ $dept->id }}_all" id="{{ $dept->id }}_all">
                                    <label for="{{ $dept->id }}_all">All</label>
                                </div>

                                <div class="">
                                    <input type="radio" name="permissions_{{ $dept->id }}[]"
                                        id="{{ $dept->id }}_admins" value="{{ $dept->id }}_admins" checked>
                                    <label for="{{ $dept->id }}_admins">Admins</label>
                                </div>
                            </div>

                        @endforeach
                    @endif
                </div>
            </div>

            <div class="mb-5 relative">
                <div class="btn white">
                    <span class="black-text">Choisir le fichier (Max: 50MB)</span>
                    {{ Form::file('file') }}
                    @if ($errors->has('file'))
                        <span class="text-red-600 text-xs">{{ $errors->first('file') }}</span>
                    @endif
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>

            <div class="mb-5 relative">
                <p class="center">
                    {{ Form::submit('Sauvegarder', ['class' => 'text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 text-lg']) }}
                </p>
            </div>
        </div>

        {!! Form::close() !!}
    </div>

@endsection

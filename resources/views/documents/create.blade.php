@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="mt-20 ml-14 mb-10 md:ml-64" style="width: 660px;max-wodth:100%;">
        <div class="flex flex-col w-full p-4">
            <h1 class="sm:text-4xl text-3xl font-medium title-font text-gray-900">Ajouter le document</h1>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 p-4 gap-4">

            {!! Form::open(['action' => 'DocumentsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'col s12']) !!}

            {{ csrf_field() }}


            <div class="mb-5 relative">
                <label for="name" class="leading-7 text-sm text-gray-600">Nom de fichier</label>
                {{ Form::text('name', '', ['id' => 'name', 'class' => 'w-full bg-gray-100 bg-opacity-50 border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out']) }}
                @if ($errors->has('name'))
                    <span class="red-text"><strong>{{ $errors->first('name') }}</strong></span>
                @endif
            </div>

            <div class="mb-5 relative">
                <label for="name" class="leading-7 text-sm text-gray-600">Description</label>
                {{ Form::textarea('description', '', ['id' => 'description', 'class' => 'w-full bg-gray-100 bg-opacity-50 border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out']) }}
                @if ($errors->has('description'))
                    <span class="red-text"><strong>{{ $errors->first('description') }}</strong></span>
                @endif
            </div>

            <div class="mb-5 relative hidden">
                {{ Form::checkbox('isExpire', 1, true, ['id' => 'isExpire']) }}
                <label for="name" class="leading-7 text-sm text-gray-600">Does Not Expire</label>
            </div>

            <div class="mb-5 relative">
                <label class="block text-left" style="max-width: 300px;">
                    <span class="leading-7 text-sm text-gray-600">Category (Optional)</span>
                    {{ Form::select('category_id[]', $categories, null, ['multiple' => 'multiple', 'id' => 'category', 'class' => 'form-multiselect block w-full mt-1']) }}
                    @if ($errors->has('category'))
                        <span class="red-text"><strong>{{ $errors->first('category') }}</strong></span>
                    @endif
                </label>
            </div>

            <div class="mb-5 relative">
                <label class="block text-left" style="max-width: 300px;">
                    <span class="leading-7 text-sm text-gray-600">Folder (Optional)</span>
                    {{ Form::select('folder_id[]', $folders, null, ['multiple' => 'multiple', 'id' => 'folder', 'class' => 'form-multiselect block w-full mt-1']) }}
                    @if ($errors->has('folder'))
                        <span class="red-text"><strong>{{ $errors->first('folder') }}</strong></span>
                    @endif
                </label>
            </div>

            <div class="mb-5 relative">
                <h3 class="text-gray-900 text-lg mt-6 mb-4 font-medium title-font uppercase">Permission</h3>
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
                    <span class="black-text">Choose File (Max: 50MB)</span>
                    {{ Form::file('file') }}
                    @if ($errors->has('file'))
                        <span class="red-text"><strong>{{ $errors->first('file') }}</strong></span>
                    @endif
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>

            <div class="mb-5 relative">
                <p class="center">
                    {{ Form::submit('Save', ['class' => 'text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 text-lg']) }}
                </p>
            </div>
        </div>

        {!! Form::close() !!}
    </div>

@endsection

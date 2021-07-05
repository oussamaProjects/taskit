@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="ml-14 mt-14 mb-4 md:ml-64 display-none">
        <div class="flex items-center p-4 gap-4">

            <form action="/search" method="post" id="search-form"
                class="bg-white rounded flex items-center w-full max-w-xl mr-4 p-2 shadow-sm border border-gray-200 ">
                {{ csrf_field() }}
                <button class="outline-none focus:outline-none">
                    <svg class="w-5 text-gray-600 h-5 cursor-pointer" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
                <input type="text" name="search" id="search" placeholder="Search"
                    class="w-full pl-3 text-sm text-black outline-none focus:outline-none bg-transparent" />
            </form>

            <div class="flex ml-auto">
                @can('upload')
                    <a href="/documents/create" class="btn waves-effect waves-light right flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        <span class="ml-2">Ajouter un document</span>
                    </a>
                @endcan
            </div>

        </div>
    </div>

    <div class="h-full ml-14 mb-10 md:ml-64" style="width: 660px;max-wodth:100%;">
        <div class="flex flex-col w-full p-4">
            <h1 class="sm:text-4xl text-3xl font-medium title-font text-gray-900">Modifier le document</h1>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-1 p-4 gap-4">

            {!! Form::open(['action' => ['DocumentsController@update', $doc->id], 'method' => 'PATCH', 'enctype' => 'multipart/form-data']) !!}

            {{ csrf_field() }}

            <div class="mb-5 relative">
                <label for="name" class="leading-7 text-sm text-gray-600">Name</label>
                {{ Form::text('name', $doc->name, ['id' => 'name', 'class' => 'w-full bg-gray-100 bg-opacity-50 border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out']) }}
                @if ($errors->has('name'))
                    <span class="red-text"><strong>{{ $errors->first('name') }}</strong></span>
                @endif
            </div>

            <div class="mb-5 relative">
                <label for="name" class="leading-7 text-sm text-gray-600">Description</label>
                {{ Form::textarea('description', $doc->description, ['id' => 'description', 'class' => 'w-full bg-gray-100 bg-opacity-50 border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out']) }}
                @if ($errors->has('description'))
                    <span class="red-text"><strong>{{ $errors->first('description') }}</strong></span>
                @endif
            </div>

            <div class="mb-5 relative hidden">
                @if (is_null($doc->expires_at))
                    {{ Form::checkbox('isExpire', 1, true, ['id' => 'isExpire']) }}
                @else
                    {{ Form::checkbox('isExpire', 1, false, ['id' => 'isExpire']) }}
                @endif
                <label for="name" class="leading-7 text-sm text-gray-600">Does Not Expire</label>
            </div>

            <div class="mb-5 relative hidden">
                @if (is_null($doc->expires_at))
                    {{ Form::text('expires_at', '', ['class' => 'datepicker', 'id' => 'expirePicker', 'disabled']) }}
                @else
                    {{ Form::text('expires_at', $doc->expires_at, ['class' => 'datepicker', 'id' => 'expirePicker']) }}
                @endif
                <label for="name" class="leading-7 text-sm text-gray-600">Expires At</label>
            </div>

            <div class="mb-5 relative">
                <label class="block text-left" style="max-width: 300px;">
                    <span class="leading-7 text-sm text-gray-600">Category (Optional)</span>
                    {{ Form::select('category_id[]', $categories, $selectedCategories, ['multiple' => 'multiple', 'id' => 'category', 'class' => 'form-multiselect block w-full mt-1']) }}
                    @if ($errors->has('category'))
                        <span class="red-text"><strong>{{ $errors->first('category') }}</strong></span>
                    @endif
                </label>
            </div>

            <div class="mb-5 relative">
                <label class="block text-left" style="max-width: 300px;">
                    <span class="leading-7 text-sm text-gray-600">Folder (Optional)</span>
                    {{ Form::select('folder_id[]', $folders, $selectedFolders, ['multiple' => 'multiple', 'id' => 'folder', 'class' => 'form-multiselect block w-full mt-1']) }}
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
                                        value="{{ $dept->id }}_all" id="{{ $dept->id }}_all"
                                        {{ $dept->permission_for == 0 ? 'checked' : '' }}>
                                    <label for="{{ $dept->id }}_all">All</label>
                                </div>

                                <div class="">
                                    <input type="radio" name="permissions_{{ $dept->id }}[]"
                                        id="{{ $dept->id }}_admins" value="{{ $dept->id }}_admins"
                                        {{ $dept->permission_for == 1 ? 'checked' : '' }}>
                                    <label for="{{ $dept->id }}_admins">Admins</label>
                                </div>
                            </div>

                        @endforeach
                    @endif
                </div>
            </div>

            <div class="mb-5 relative">
                <p class="center">
                    {{ Form::submit('Save Changes', ['class' => 'text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 text-lg']) }}
                </p>
            </div>

            {!! Form::close() !!}
        </div>

    </div>

@endsection

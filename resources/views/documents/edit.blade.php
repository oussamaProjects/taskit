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
                    <a href="/documents/create"
                        class="flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded ml-auto">
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


    <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3">
        <div class="col-span-2">
            <div class="h-full ml-14 mb-10 md:ml-64" style="width: 660px;max-wodth:100%;">
                <div class="flex flex-col w-full p-4">
                    <h1 class="sm:text-4xl text-3xl font-medium title-font text-gray-900">Modifier le document</h1>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-1 p-4 gap-4">

                    {!! Form::open(['action' => ['DocumentsController@update', $doc->id], 'method' => 'PATCH', 'enctype' => 'multipart/form-data']) !!}

                    {{ csrf_field() }}

                    <div class="mb-5 relative">
                        <label for="name" class="peer-placeholder-shown:opacity-100 opacity-75 peer-focus:opacity-75 peer-placeholder-shown:scale-100 scale-75 peer-focus:scale-75 peer-placeholder-shown:translate-y-0 -translate-y-3 peer-focus:-translate-y-3 peer-placeholder-shown:translate-x-0 translate-x-1 peer-focus:translate-x-1 absolute top-0 left-0 px-3 py-5 h-full pointer-events-none transform origin-left transition-all duration-100 ease-in-out">Name</label>
                        {{ Form::text('name', $doc->name, ['id' => 'name', 'class' => 'peer pt-8 border border-gray-200 focus:outline-none rounded-md focus:border-gray-500 focus:shadow-sm w-full p-3 h-16 placeholder-transparent']) }}
                        @if ($errors->has('name'))
                            <span class="red-text"><strong>{{ $errors->first('name') }}</strong></span>
                        @endif
                    </div>

                    <div class="mb-5 relative">
                        <label for="name" class="peer-placeholder-shown:opacity-100 opacity-75 peer-focus:opacity-75 peer-placeholder-shown:scale-100 scale-75 peer-focus:scale-75 peer-placeholder-shown:translate-y-0 -translate-y-3 peer-focus:-translate-y-3 peer-placeholder-shown:translate-x-0 translate-x-1 peer-focus:translate-x-1 absolute top-0 left-0 px-3 py-5 h-full pointer-events-none transform origin-left transition-all duration-100 ease-in-out">Description</label>
                        {{ Form::textarea('description', $doc->description, ['id' => 'description', 'class' => 'peer pt-8 border border-gray-200 focus:outline-none rounded-md focus:border-gray-500 focus:shadow-sm w-full p-3 h-16 placeholder-transparent']) }}
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
                        <label for="name" class="peer-placeholder-shown:opacity-100 opacity-75 peer-focus:opacity-75 peer-placeholder-shown:scale-100 scale-75 peer-focus:scale-75 peer-placeholder-shown:translate-y-0 -translate-y-3 peer-focus:-translate-y-3 peer-placeholder-shown:translate-x-0 translate-x-1 peer-focus:translate-x-1 absolute top-0 left-0 px-3 py-5 h-full pointer-events-none transform origin-left transition-all duration-100 ease-in-out">Does Not Expire</label>
                    </div>

                    <div class="mb-5 relative hidden">
                        @if (is_null($doc->expires_at))
                            {{ Form::text('expires_at', '', ['class' => 'datepicker', 'id' => 'expirePicker', 'disabled']) }}
                        @else
                            {{ Form::text('expires_at', $doc->expires_at, ['class' => 'datepicker', 'id' => 'expirePicker']) }}
                        @endif
                        <label for="name" class="peer-placeholder-shown:opacity-100 opacity-75 peer-focus:opacity-75 peer-placeholder-shown:scale-100 scale-75 peer-focus:scale-75 peer-placeholder-shown:translate-y-0 -translate-y-3 peer-focus:-translate-y-3 peer-placeholder-shown:translate-x-0 translate-x-1 peer-focus:translate-x-1 absolute top-0 left-0 px-3 py-5 h-full pointer-events-none transform origin-left transition-all duration-100 ease-in-out">Expires At</label>
                    </div>

                    <div class="mb-5 relative">
                        <label class="block text-left" style="max-width: 300px;">
                            <span class="peer-placeholder-shown:opacity-100 opacity-75 peer-focus:opacity-75 peer-placeholder-shown:scale-100 scale-75 peer-focus:scale-75 peer-placeholder-shown:translate-y-0 -translate-y-3 peer-focus:-translate-y-3 peer-placeholder-shown:translate-x-0 translate-x-1 peer-focus:translate-x-1 absolute top-0 left-0 px-3 py-5 h-full pointer-events-none transform origin-left transition-all duration-100 ease-in-out">Category (Optional)</span>
                            {{ Form::select('category_id[]', $categories, $selectedCategories, ['multiple' => 'multiple', 'id' => 'category', 'class' => 'form-multiselect block w-full mt-1']) }}
                            @if ($errors->has('category'))
                                <span class="red-text"><strong>{{ $errors->first('category') }}</strong></span>
                            @endif
                        </label>
                    </div>

                    <div class="mb-5 relative">
                        <label class="block text-left" style="max-width: 300px;">
                            <span class="peer-placeholder-shown:opacity-100 opacity-75 peer-focus:opacity-75 peer-placeholder-shown:scale-100 scale-75 peer-focus:scale-75 peer-placeholder-shown:translate-y-0 -translate-y-3 peer-focus:-translate-y-3 peer-placeholder-shown:translate-x-0 translate-x-1 peer-focus:translate-x-1 absolute top-0 left-0 px-3 py-5 h-full pointer-events-none transform origin-left transition-all duration-100 ease-in-out">Folder (Optional)</span>
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
                            {{ Form::submit('Save Changes', ['class' => 'text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 text-lg']) }}
                        </p>
                    </div>

                    {!! Form::close() !!}
                </div>

            </div>
        </div>
        <img src="{{ asset('img/undraw_Add_files_re_v09g.svg') }}" alt="">
    </div>

@endsection

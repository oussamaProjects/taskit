@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="ml-14 mt-14 mb-4 md:ml-64 display-none">
        <div class="flex items-center p-4 gap-4 bg-white shadow">

            <form action="/search" method="post" id="search-form"
                class="bg-white rounded flex items-center w-full max-w-xl mr-4 p-2 shadow-sm border border-gray-200 ">
                {{ csrf_field() }}
                <button class="outline-none focus:outline-none">
                    <svg class="w-5 text-gray-600 h-5 cursor-pointer" fill="none" stroke-linecap="round"
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
                        class="flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-blue-500 rounded ml-4"
                        type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
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
                <div class="flex flex-col p-4 ml-4 bg-white shadow">
                    <h1 class="sm:text-2xl text-xl font-medium title-font text-gray-900">Modifier le document</h1>
                </div>


                {!! Form::open(['action' => ['DocumentsController@update', $doc->id], 'method' => 'PATCH', 'enctype' => 'multipart/form-data', 'class' => 'grid grid-cols-2 lg:grid-cols-2 p-4 gap-4 mt-4 ml-4 bg-white shadow']) !!}

                {{ csrf_field() }}
                <div class=" ">

                    <div class="mb-2 relative">
                        <label for="name" class="text-xs opacity-75 scale-75">Name</label>
                        {{ Form::text('name', $doc->name, ['id' => 'name','autocomplete' => 'off','class' =>'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-8 placeholder-transparent text-sm']) }}
                        @if ($errors->has('name'))
                            <span class="text-red-600 text-xs">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="mb-2 relative">
                        <label for="name" class="text-xs opacity-75 scale-75">Description</label>
                        {{ Form::textarea('description', $doc->description, ['id' => 'description','class' =>'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-8 placeholder-transparent text-sm']) }}
                        @if ($errors->has('description'))
                            <span class="text-red-600 text-xs">{{ $errors->first('description') }}</span>
                        @endif
                    </div>

                    <div class="mb-2 relative hidden">
                        @if (is_null($doc->expires_at))
                            {{ Form::checkbox('isExpire', 1, true, ['id' => 'isExpire']) }}
                        @else
                            {{ Form::checkbox('isExpire', 1, false, ['id' => 'isExpire']) }}
                        @endif
                        <label for="name" class="text-xs opacity-75 scale-75">Does
                            Not Expire</label>
                    </div>
                </div>

                <div class=" ">
                    <div class="mb-2 relative">
                        <label for="ref" class="text-xs opacity-75 scale-75">
                            Réference
                        </label>
                        {{ Form::text('ref', $doc->ref, ['id' => 'ref','autocomplete' => 'off','class' =>'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-8 placeholder-transparent text-sm']) }}
                        @if ($errors->has('ref'))
                            <span class="text-red-600 text-xs">{{ $errors->first('ref') }}</span>
                        @endif
                    </div>

                    <div class="mb-2 relative">
                        <label for="name" class="text-xs opacity-75 scale-75">
                            Version
                        </label>
                        {{ Form::text('version', $doc->version, ['id' => 'version','autocomplete' => 'off','class' =>'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-8 placeholder-transparent text-sm']) }}
                        @if ($errors->has('version'))
                            <span class="text-red-600 text-xs">{{ $errors->first('version') }}</span>
                        @endif
                    </div>
                </div>

                <div class="mb-2 relative hidden">
                    @if (is_null($doc->expires_at))
                        {{ Form::text('expires_at', '', ['class' => 'datepicker', 'id' => 'expirePicker', 'disabled']) }}
                    @else
                        {{ Form::text('expires_at', $doc->expires_at, ['class' => 'datepicker', 'id' => 'expirePicker']) }}
                    @endif
                    <label for="name" class="text-xs opacity-75 scale-75">Expires
                        At</label>
                </div>

                <div class="mb-2 relative">
                    <label class="text-xs opacity-75 scale-75">Category
                        (Optional)
                    </label>
                    {{ Form::select('category_id[]', $categories, $selectedCategories, ['multiple' => 'multiple','id' => 'category','class' =>'form-multiselect peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm block w-full py-2 text-sm']) }}
                    @if ($errors->has('category'))
                        <span class="text-red-600 text-xs">{{ $errors->first('category') }}</span>
                    @endif
                </div>

                <div class="mb-2 relative">
                    <label class="text-xs opacity-75 scale-75">Folder
                        (Optional)
                    </label>
                    {{ Form::select('folder_id[]', $folders, $selectedFolders, ['multiple' => 'multiple','id' => 'folder','class' =>'form-multiselect peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm block w-full py-2 text-sm']) }}
                    @if ($errors->has('folder'))
                        <span class="text-red-600 text-xs">{{ $errors->first('folder') }}</span>
                    @endif
                </div>

                <div class="col-span-2"> 

                    @hasanyrole('Root|Admin')
                        @if (count($subs) > 0)
                            <div class="mb-2 relative">
                                <h3 class="text-xs opacity-75 scale-75 uppercase">Autorisation</h3>
                                <h3 class="text-gray-900 text-md mt-4 mb-4 font-medium title-font uppercase">Filials</h3>
                                <div class="grid sm:grid-cols-2 lg:grid-cols-3">

                                    @foreach ($subs as $sub)
                                        <div>
                                            <div class="font-bold mt-2">{{ $sub->subsName }}</div>
                                            @foreach ($sub->departments()->get() as $dept)
                                                <div>
                                                    <label class="text-gray-900 mb-2 font-medium title-font">
                                                        {{ $dept['dptName'] }}
                                                    </label>
                                                </div>
                                                <div>
                                                    <div class="">
                                                        <input type="radio" name="permissions_{{ $dept['id'] }}[]"
                                                            id="{{ $dept['id'] }}_none" value="{{ $dept['id'] }}_none"
                                                            checked>
                                                        <label class="text-sm"
                                                            for="{{ $dept['id'] }}_none">None</label>
                                                    </div>

                                                    <div class="">
                                                        <input type="radio" name="permissions_{{ $dept['id'] }}[]"
                                                            value="{{ $dept['id'] }}_all" id="{{ $dept['id'] }}_all">
                                                        <label class="text-sm" for="{{ $dept['id'] }}_all">All</label>
                                                    </div>

                                                    <div class="">
                                                        <input type="radio" name="permissions_{{ $dept['id'] }}[]"
                                                            id="{{ $dept['id'] }}_admins"
                                                            value="{{ $dept['id'] }}_admins">
                                                        <label class="text-sm"
                                                            for="{{ $dept['id'] }}_admins">Admins</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div id="folder_dept_list"></div>
                        @endif
                    @endhasanyrole

                    {{-- <div class="relative">
                        <div class="btn white">
                            <span class="black-text">Sélectionner votre fichier (Max: 50MB)</span>
                            {{ Form::file('file') }}
                            @if ($errors->has('file'))
                                <span class="text-red-600 text-xs">{{ $errors->first('file') }}</span>
                            @endif
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div> --}}

                    <div class="mb-2 relative">
                        <p class="center">
                            {{ Form::submit(' Sauvegarder', ['class' => 'text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-blue-500 text-lg']) }}
                        </p>
                    </div>
                </div>

                {!! Form::close() !!}


            </div>
        </div>

        @can('upload')
            <button id="buttonmodalFileImg" class="bg-white h-auto p-4 shadow" type="button">
                <img src="{{ asset('img/undraw_Add_files_re_v09g.svg') }}" alt="">
            </button>
        @endcan


    </div>


    <div id="modalFile"
        class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-blue-500 bg-opacity-50 transform scale-0 transition-transform duration-300">
        <!-- Modal content -->
        <div class="bg-white w-1/2 p-4">
            <!--Close modal button-->
            <button id="closebuttonFile" type="button" class="focus:outline-none float-right">
                <!-- Hero icon - close button -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>

            <div>
                <h2 class="text-gray-900 text-xl mb-2 font-medium title-font">Ajouter un document</h2>

                {!! Form::open(['action' => 'DocumentsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'col s12']) !!}

                {{ csrf_field() }}


                <div class="mb-4 flex">
                    <div class="mr-4 relative flex-1">
                        <label for="name" class="text-xs opacity-75 scale-75">
                            Nom du document
                        </label>
                        {{ Form::text('name', '', ['id' => 'name','autocomplete' => 'off','class' =>'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-8 placeholder-transparent text-sm']) }}
                        @if ($errors->has('name'))
                            <span class="text-red-600 text-xs">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="mr-4 relative flex-1">
                        <label for="ref" class="text-xs opacity-75 scale-75">
                            Réference
                        </label>
                        {{ Form::text('ref', '', ['id' => 'ref','autocomplete' => 'off','class' =>'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-8 placeholder-transparent text-sm']) }}
                        @if ($errors->has('ref'))
                            <span class="text-red-600 text-xs">{{ $errors->first('ref') }}</span>
                        @endif
                    </div>
                    <div class="relative flex-1">
                        <label for="name" class="text-xs opacity-75 scale-75">
                            Version
                        </label>
                        {{ Form::text('version', '', ['id' => 'version','autocomplete' => 'off','class' =>'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-8 placeholder-transparent text-sm']) }}
                        @if ($errors->has('version'))
                            <span class="text-red-600 text-xs">{{ $errors->first('version') }}</span>
                        @endif
                    </div>
                </div>

                <div class="mb-2 relative">
                    <label for="name" class="text-xs opacity-75 scale-75">Description</label>
                    {{ Form::textarea('description', '', ['id' => 'description','class' =>'peer pt-5 border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-3 h-20 placeholder-transparent']) }}
                    @if ($errors->has('description'))
                        <span class="text-red-600 text-xs">{{ $errors->first('description') }}</span>
                    @endif
                </div>

                <div class="mb-2 relative hidden">
                    {{ Form::checkbox('isExpire', 1, true, ['id' => 'isExpire']) }}
                    <label for="name" class="text-xs opacity-75 scale-75">Does
                        Not Expire</label>
                </div>

                <div class="mb-2 relative">
                    <div class="flex">

                        <div class="mb-2 relative flex-1 hidden">
                            <label class="text-xs opacity-75 scale-75">
                                Catégorie (Optional)
                            </label>
                            {{ Form::select('category_id[]', $categories, null, ['multiple' => 'multiple','id' => 'category','class' =>'form-multiselect peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm block w-full py-2']) }}
                            @if ($errors->has('category'))
                                <span class="text-red-600 text-xs">{{ $errors->first('category') }}</span>
                            @endif
                        </div>

                        <div class="mb-4 pr-2 relative flex-1 hidden">
                            <label class="text-xs opacity-75 scale-75">
                                Folder (Optional)
                            </label>
                            {{ Form::select('folder_id[]', $folders, null, ['multiple' => 'multiple','id' => 'folder','class' =>'form-multiselect peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm block w-full py-2']) }}
                            @if ($errors->has('folder'))
                                <span class="text-red-600 text-xs">{{ $errors->first('folder') }}</span>
                            @endif
                        </div>


                        <div class="mb-4 pr-2 relative flex-1">
                            <label for="name" class="text-xs opacity-75 scale-75">
                                Catégorie (Optional)
                            </label>
                            <select name="category_id" id="folder" onchange="javascript:handleSelect(this)"
                                class="peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-8 placeholder-transparent text-sm placeholder-gray-600 border appearance-none focus:shadow-outline">
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
                            @if ($errors->has('folder'))
                                <span class="text-red-600 text-xs">{{ $errors->first('folder') }}</span>
                            @endif
                        </div>

                        <div class="mb-4 ml-2 relative flex-1">
                            <label for="name" class="text-xs opacity-75 scale-75">Dans
                                le dossier</label>
                            <select name="folder_id" id="folder" onchange="javascript:handleSelect(this)"
                                class="peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-8 placeholder-transparent text-sm placeholder-gray-600 border appearance-none focus:shadow-outline">
                                @foreach ($folders as $id => $name)
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
                            @if ($errors->has('folder'))
                                <span class="text-red-600 text-xs">{{ $errors->first('folder') }}</span>
                            @endif
                        </div>

                    </div>
                </div>

                @hasanyrole('Root|Admin')
                @if (count($subs) > 0)
                    <div class="mb-2 relative">
                        <h3 class="text-xs opacity-75 scale-75 uppercase">Autorisation</h3>
                        <h3 class="text-gray-900 text-md mt-4 mb-4 font-medium title-font uppercase">Filials</h3>
                        <div class="grid sm:grid-cols-2 lg:grid-cols-3">

                            @foreach ($subs as $sub)
                                <div>
                                    <div class="font-bold mt-2">{{ $sub->subsName }}</div>
                                    @foreach ($sub->departments()->get() as $dept)
                                        <div>
                                            <label class="text-gray-900 mb-2 font-medium title-font">
                                                {{ $dept['dptName'] }}
                                            </label>
                                        </div>
                                        <div>
                                            <div class="">
                                                <input type="radio" name="permissions_{{ $dept['id'] }}[]"
                                                    id="{{ $dept['id'] }}_none" value="{{ $dept['id'] }}_none"
                                                    checked>
                                                <label class="text-sm"
                                                    for="{{ $dept['id'] }}_none">None</label>
                                            </div>

                                            <div class="">
                                                <input type="radio" name="permissions_{{ $dept['id'] }}[]"
                                                    value="{{ $dept['id'] }}_all" id="{{ $dept['id'] }}_all">
                                                <label class="text-sm" for="{{ $dept['id'] }}_all">All</label>
                                            </div>

                                            <div class="">
                                                <input type="radio" name="permissions_{{ $dept['id'] }}[]"
                                                    id="{{ $dept['id'] }}_admins"
                                                    value="{{ $dept['id'] }}_admins">
                                                <label class="text-sm"
                                                    for="{{ $dept['id'] }}_admins">Admins</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div id="folder_dept_list"></div>
                @endif
                
            @endhasanyrole

                <div class="relative">
                    <div class="btn white">
                        <span class="black-text">Sélectionner votre fichier (Max: 50MB)</span>
                        {{ Form::file('file') }}
                        @if ($errors->has('file'))
                            <span class="text-red-600 text-xs">{{ $errors->first('file') }}</span>
                        @endif
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>

                <div class="flex">
                    {{ Form::submit('Sauvegarder', ['class' => 'focus:outline-none py-2 px-4 bg-gray-900 text-white bg-opacity-75 ml-auto']) }}
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        const buttonFile = document.getElementById('buttonmodalFile')
        const buttonFileImg = document.getElementById('buttonmodalFileImg')
        const closebuttonFile = document.getElementById('closebuttonFile')
        const modalFile = document.getElementById('modalFile')

        buttonFile.addEventListener('click', () => modalFile.classList.add('scale-100'))
        buttonFileImg.addEventListener('click', () => modalFile.classList.add('scale-100'))
        closebuttonFile.addEventListener('click', () => modalFile.classList.remove('scale-100'))
    </script>

    <script>
        $(function() {

            $(document).on("click", ".getDepartement", function(e) {
                e.preventDefault();
                $('#ajaxShadow').show();
                $('#ajaxloader').show();

                var subs = $(this).data('subs_id');
                var folder = $(this).data('folder_id');

                var url = "{{ URL('departments/getDepartement') }}";
                var url = url + "/subs/" + subs + "/folder/" + folder;

                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        _token: '{{ csrf_token() }}',
                        subs: subs,
                        folder: folder,
                    },
                    success: function(dataResult) {

                        $('#dept_list').empty();
                        var dept_html = '';
                        dept_html +=
                            '<h3 class="text-gray-900 text-md mt-4 mb-4 font-medium title-font uppercase">Departments</h3>';
                        dept_html += '<div class="grid sm:grid-cols-2 lg:grid-cols-3">';

                        $.map(dataResult.data.departments, function(departement) {
                            console.log(departement);

                            dept_html += '<div class="">';

                            dept_html +=
                                '<div class="text-gray-900 mb-2 font-medium title-font">' +
                                departement.dptName + '</div>';

                            dept_html += '<div class="">';
                            dept_html +=
                                `<input type="radio" name="permissions_${departement.id}[]" id="${departement.id}_none" value="${departement.id}_none" ${ departement.permission_for == -1 ? "checked" : "" }> `;
                            dept_html +=
                                `<label class="text-sm" for="${departement.id}_none">None</label>`;
                            dept_html += '</div>';

                            dept_html += '<div class="">';
                            dept_html +=
                                `<input type="radio" name="permissions_${departement.id}[]" value="${departement.id}_all" id="${departement.id}_all" ${ departement.permission_for == 0 ? "checked" : "" }> `;
                            dept_html +=
                                `<label class="text-sm" for="${departement.id}_all">All</label>`;
                            dept_html += '</div>';

                            dept_html += '<div class="">';
                            dept_html +=
                                `<input type="radio" name="permissions_${departement.id}[]" id="${departement.id}_admins" value="${departement.id}_admins" ${ departement.permission_for == 1 ? "checked" : "" }> `;
                            dept_html +=
                                `<label class="text-sm" for="${departement.id}_admins">Admins</label>`;
                            dept_html += '</div>';

                            dept_html += '</div>';

                        });
                        dept_html += '</div>';
                        $('#dept_list').html(dept_html);

                        $('#ajaxShadow').hide();
                        $('#ajaxloader').hide();
                    },
                    error: function(error) {
                        console.log(error);
                        // location.reload(true);
                        $('#ajaxShadow').hide();
                        $('#ajaxloader').hide();
                    }
                });

            });
        });
    </script>

@endsection

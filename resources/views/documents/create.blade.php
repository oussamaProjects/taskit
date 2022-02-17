@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="pt-20 ml-14 mb-10 md:ml-64 border" style=" ">
        <div class="flex flex-col w-full p-4">
            <h1 class="sm:text-2xl text-xl font-medium title-font text-gray-900">Ajouter le document</h1>
        </div>

        <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 gap-4">
            <div class="col-span-2 ml-4 bg-white">
                {!! Form::open(['action' => 'DocumentsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-2 p-4 gap-4']) !!}

                {{ csrf_field() }}

                <div class="">
                    <div class="mb-2 relative">
                        <label for="name" class="text-xs opacity-75 scale-75">Nom
                            du document</label>
                        {{ Form::text('name', '', ['id' => 'name','autocomplete' => 'off','class' =>'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-8 placeholder-transparent text-sm']) }}
                        @if ($errors->has('name'))
                            <span class="text-red-600 text-xs">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="mb-2 relative">
                        <label for="name" class="text-xs opacity-75 scale-75">Description</label>
                        {{ Form::textarea('description', '', ['id' => 'description','class' =>'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-8 placeholder-transparent text-sm']) }}
                        @if ($errors->has('description'))
                            <span class="text-red-600 text-xs">{{ $errors->first('description') }}</span>
                        @endif
                    </div>

                </div>


                <div class="">
                    <div class="mb-2 relative">
                        <label for="ref" class="text-xs opacity-75 scale-75">
                            Réference
                        </label>
                        {{ Form::text('ref', '', ['id' => 'ref','autocomplete' => 'off','class' =>'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-8 placeholder-transparent text-sm']) }}
                        @if ($errors->has('ref'))
                            <span class="text-red-600 text-xs">{{ $errors->first('ref') }}</span>
                        @endif
                    </div>

                    <div class="mb-2 relative">
                        <label for="name" class="text-xs opacity-75 scale-75">
                            Version
                        </label>
                        {{ Form::text('version', '', ['id' => 'version','autocomplete' => 'off','class' =>'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-8 placeholder-transparent text-sm']) }}
                        @if ($errors->has('version'))
                            <span class="text-red-600 text-xs">{{ $errors->first('version') }}</span>
                        @endif
                    </div>
                    <div class="mb-2 relative hidden">
                        {{ Form::checkbox('isExpire', 1, true, ['id' => 'isExpire']) }}
                        <label for="name" class="text-xs opacity-75 scale-75">Does
                            Not Expire</label>
                    </div>
                </div>



                <div class="mb-2 relative">
                    <label class="text-xs opacity-75 scale-75">
                        Catégorie (Optional)
                    </label>
                    {{ Form::select('category_id[]', $categories, null, ['multiple' => 'multiple','id' => 'category','class' =>'form-multiselect peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm block w-full py-2']) }}
                    @if ($errors->has('category'))
                        <span class="text-red-600 text-xs">{{ $errors->first('category') }}</span>
                    @endif
                </div>

                <div class="mb-2 relative">
                    <label class="text-xs opacity-75 scale-75">
                        Folder (Optional)
                    </label>
                    {{ Form::select('folder_id[]', $folders, null, ['multiple' => 'multiple','id' => 'folder','class' =>'form-multiselect peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm block w-full py-2']) }}
                    @if ($errors->has('folder'))
                        <span class="text-red-600 text-xs">{{ $errors->first('folder') }}</span>
                    @endif
                </div>

                @if (count($subs) > 0)


                    <div class="col-span-2">

                        <div class="mb-2 relative">

                            <h3 class="text-xs opacity-75 scale-75 uppercase">Autorisation</h3>
                            <h3 class="text-gray-900 text-md mt-4 mb-4 font-medium title-font uppercase">Filials</h3>
                            <div class="grid sm:grid-cols-2 lg:grid-cols-3">

                                @foreach ($subs as $sub)
                                    <a href="#{{ $sub->id }}" class="mb-2 getDepartement"
                                        data-subs_id="{{ $sub->id }}" data-folder_id="0">{{ $sub->subsName }}</a>
                                @endforeach

                            </div>
                            <div id="dept_list"></div>

                        </div>
                    </div>
                @endif

                <div class="mb-2 relative">
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

                <div class="mb-2 relative">
                    <p class="center">
                        {{ Form::submit('Sauvegarder', ['class' => 'text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-blue-500 text-lg']) }}
                    </p>
                </div>
            </div>


            {!! Form::close() !!}
        </div>
    </div>
    </div>


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

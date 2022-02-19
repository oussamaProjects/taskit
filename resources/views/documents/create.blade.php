@extends('layouts.app')

@section('content')
    @include('inc.sidebar')

    <div class="pt-20 ml-14 mb-10 md:ml-64 border" style=" ">
        <div class="flex flex-col w-full p-4">
            <h1 class="sm:text-2xl text-xl font-medium title-font text-gray-800">Ajouter le document</h1>
        </div>

        <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 gap-4">
            <div class="col-span-2 ml-4 bg-bg-color">
                {!! Form::open(['action' => 'DocumentsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => '']) !!}

                {{ csrf_field() }}

                <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-2 p-4 gap-4">
                    <div class="mb-2 relative">
                        <label for="name" class="text-xs opacity-75 scale-75">Nom
                            du document</label>
                        {{ Form::text('name', '', ['id' => 'name','autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm']) }}
                        @if ($errors->has('name'))
                            <span class="text-amber text-xs">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="mb-2 relative">
                        <label for="name" class="text-xs opacity-75 scale-75">Description</label>
                        {{ Form::textarea('description', '', ['id' => 'description','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-16 text-sm']) }}
                        @if ($errors->has('description'))
                            <span class="text-amber text-xs">{{ $errors->first('description') }}</span>
                        @endif
                    </div>

                </div>


                <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-2 p-4 gap-4">
                    <div class="mb-2 relative">
                        <label for="ref" class="text-xs opacity-75 scale-75">
                            Réference
                        </label>
                        {{ Form::text('ref', '', ['id' => 'ref','autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm']) }}
                        @if ($errors->has('ref'))
                            <span class="text-amber text-xs">{{ $errors->first('ref') }}</span>
                        @endif
                    </div>

                    <div class="mb-2 relative">
                        <label for="name" class="text-xs opacity-75 scale-75">
                            Version
                        </label>
                        {{ Form::text('version', '', ['id' => 'version','autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm']) }}
                        @if ($errors->has('version'))
                            <span class="text-amber text-xs">{{ $errors->first('version') }}</span>
                        @endif
                    </div>
                    <div class="mb-2 relative hidden">
                        {{ Form::checkbox('isExpire', 1, true, ['id' => 'isExpire']) }}
                        <label for="name" class="text-xs opacity-75 scale-75">Does
                            Not Expire</label>
                    </div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-2 p-4 gap-4">

                    <div class="mb-2 relative">
                        <label class="text-xs opacity-75 scale-75">
                            Catégorie (Optional)
                        </label>
                        {{ Form::select('category_id[]', $categories, null, ['multiple' => 'multiple','id' => 'category','class' =>'form-multiselect peer border border-bg-color focus:outline-none rounded focus:border-bg-color0 focus:shadow-sm block w-full py-2']) }}
                        @if ($errors->has('category'))
                            <span class="text-amber text-xs">{{ $errors->first('category') }}</span>
                        @endif
                    </div>

                    <div class="mb-2 relative">
                        <label class="text-xs opacity-75 scale-75">
                            Folder (Optional)
                        </label>
                        {{ Form::select('folder_id[]', $folders, null, ['multiple' => 'multiple','id' => 'folder','class' =>'form-multiselect peer border border-bg-color focus:outline-none rounded focus:border-bg-color0 focus:shadow-sm block w-full py-2']) }}
                        @if ($errors->has('folder'))
                            <span class="text-amber text-xs">{{ $errors->first('folder') }}</span>
                        @endif
                    </div>
                </div>

                @include('inc.autorisation', ['subs' => $subs])

                <div class="mb-2 relative">
                    <div class="btn bg-color">
                        <span class="black-text">Sélectionner votre fichier (Max: 50MB)</span>
                        {{ Form::file('file') }}
                        @if ($errors->has('file'))
                            <span class="text-amber text-xs">{{ $errors->first('file') }}</span>
                        @endif
                    </div>
                </div>

                <div class="flex items-end justify-end">
                    {{ Form::submit('Sauvegarder', ['class' => 'text-bg-color bg-gray-800 border-0 py-2 px-6 focus:outline-none hover:bg-main text-lg']) }}
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
                            '<h3 class="text-gray-800 text-md mt-4 mb-4 font-medium title-font uppercase">Departments</h3>';
                        dept_html += '<div class="grid sm:grid-cols-3 lg:grid-cols-5 gap-4">';

                        $.map(dataResult.data.departments, function(departement) {
                            console.log(departement);

                            dept_html += '<div class="">';

                            dept_html +=
                                '<div class="text-gray-800 mb-2 font-medium title-font">' +
                                departement.dptName + '</div>';

                            dept_html += '<div class="">';
                            dept_html +=
                                `<input type="radio" name="permissions_${departement.id}[]" id="${departement.id}_none" value="${departement.id}_none" ${ departement.permission_for == -1 ? "checked" : "" }> `;
                            dept_html +=
                                `<label class="select-none text-xs font-medium text-main bg-secondary hover:text-bg-color hover:bg-main transition rounded flex flex-col flex-shrink-0 justify-center items-center px-2 py-2 h-full cursor-pointer" for="${departement.id}_none">None</label>`;
                            dept_html += '</div>';

                            dept_html += '<div class="">';
                            dept_html +=
                                `<input type="radio" name="permissions_${departement.id}[]" value="${departement.id}_all" id="${departement.id}_all" ${ departement.permission_for == 0 ? "checked" : "" }> `;
                            dept_html +=
                                `<label class="select-none text-xs font-medium text-main bg-secondary hover:text-bg-color hover:bg-main transition rounded flex flex-col flex-shrink-0 justify-center items-center px-2 py-2 h-full cursor-pointer" for="${departement.id}_all">All</label>`;
                            dept_html += '</div>';

                            dept_html += '<div class="">';
                            dept_html +=
                                `<input type="radio" name="permissions_${departement.id}[]" id="${departement.id}_admins" value="${departement.id}_admins" ${ departement.permission_for == 1 ? "checked" : "" }> `;
                            dept_html +=
                                `<label class="select-none text-xs font-medium text-main bg-secondary hover:text-bg-color hover:bg-main transition rounded flex flex-col flex-shrink-0 justify-center items-center px-2 py-2 h-full cursor-pointer" for="${departement.id}_admins">Admins</label>`;
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

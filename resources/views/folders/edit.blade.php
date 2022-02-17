@extends('layouts.app')

@section('content')

    @include('inc.sidebar')


    <div class="h-full ml-14 mt-14 mb-10 md:ml-64">
        <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-white w-full shadow">
            <div class="rounded-t mb-0 px-0 border-0">
                <div class="flex flex-wrap items-center px-4 py-2">
                    <div class="relative w-full max-w-full flex-grow flex-1">
                        <h3 class="font-semibold text-base text-gray-900 ">
                            Modifier un dossier
                        </h3>
                    </div>

                    <div class="relative w-full max-w-full flex-grow flex-1 text-right">
                        <button id="buttonmodal" data-target="modal1"
                            class="flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-blue-500 rounded ml-auto"
                            type="button">Ajouter un dossiers</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="grid grid-cols-3 sm:grid-cols-3 lg:grid-cols-3 p-4 gap-4">
            <div class="col-span-2">

                <div class="flex items-center p-4 gap-4 bg-white shadow">
                    {!! Form::open(['action' => ['FolderController@update', $folder->id], 'method' => 'PATCH', 'class' => 'w-full']) !!}


                    <div class="mb-2 relative">
                        {{ Form::text('name', $folder->name, ['autocomplete' => 'off','class' =>'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-8 placeholder-transparent text-sm','id' => 'folder']) }}
                        <label for="name" class="text-xs opacity-75 scale-75">
                            Nom de dossier
                        </label>
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

                    {{ Form::submit('Sauvegarder les modifications', ['class' => 'flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-blue-500 rounded']) }}
                    {!! Form::close() !!}
                </div>
            </div>

            <button id="buttonmodalFileImg" class="bg-white h-auto p-4 shadow" type="button">
                <img src="{{ asset('img/undraw_Add_files_re_v09g.svg') }}" alt="">
            </button>
        </div>

        <!-- Modal -->
        <div id="modal"
            class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-blue-500 bg-opacity-50 transform scale-0 transition-transform duration-300">
            <div
                class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border border-gray-300 shadow-xl">
                <div id="closebutton"
                    class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
                    <p class="font-semibold text-gray-800">Ajouter un dossier</p>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </div>
                <div class="flex flex-col px-6 py-5 bg-gray-50">
                    {!! Form::open(['action' => 'FolderController@store', 'method' => 'POST', 'class' => 'w-full']) !!}
                    <div class="mb-2 relative">
                        {{ Form::text('name', '', ['autocomplete' => 'off','class' =>'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-8 placeholder-transparent text-sm','id' => 'category']) }}
                        <label for="email" class="text-xs opacity-75 scale-75">
                            Nom de dossier
                        </label>
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

                    <div class="mb-2 relative">
                        <h3 class="text-gray-900 text-md mt-4 mb-4 font-medium title-font uppercase">Autorisation</h3>
                        <div class="grid sm:grid-cols-2 lg:grid-cols-3">
                            @if (count($depts) > 0)
                                @foreach ($depts as $dept)
                                    <div class="mb-6">
                                        <div class="text-gray-900 mb-2 font-medium title-font">
                                            {{ $dept->dptName }}
                                        </div>

                                        <div class="">
                                            <input type="radio" name="permissions_{{ $dept->id }}[]"
                                                value="{{ $dept->id }}_none" id="{{ $dept->id }}_none"
                                                {{ $dept->permission_for == -1 ? 'checked' : '' }}>
                                            <label for="{{ $dept->id }}_none">None</label>
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

                    {{ Form::submit('Sauvegarder les modifications', ['class' => 'flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-blue-500 rounded']) }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <script>
            const button = document.getElementById('buttonmodal')
            const closebutton = document.getElementById('closebutton')
            const modal = document.getElementById('modal')

            button.addEventListener('click', () => modal.classList.add('scale-100'))
            closebutton.addEventListener('click', () => modal.classList.remove('scale-100'))
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
                                '  <h3 class="text-gray-900 text-md mt-4 mb-4 font-medium title-font uppercase">Departments</h3>';
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

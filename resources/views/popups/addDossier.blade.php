<div id="modalDossier"
    class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-blue-500 bg-opacity-50 transform scale-0 transition-transform duration-300">
    <!-- Modal content -->
    <div class="bg-white w-1/2 p-12 overflow-y-scroll h-2/4">
        <!--Close modal button-->
        <button id="closebuttonDossier" type="button" class="focus:outline-none float-right">
            <!-- Hero icon - close button -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </button>

        <div>

            <h2 class="text-gray-900 text-xl mb-2 font-medium title-font">Ajouter le dossier</h2>

            {!! Form::open(['action' => 'FolderController@store', 'method' => 'POST', 'class' => '']) !!}

            <div class="mb-8 relative">
                <label for="name" class="text-xs opacity-75 scale-75">Nom de dossier</label>
                {{ Form::text('name', '', ['id' => 'name','autocomplete' => 'off','class' =>'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-8 placeholder-transparent text-sm']) }}
            </div>

            <div class="relative mb-4">
                <span class="text-gray-700">Have a parent</span>
                <div class="flex">
                    <div>
                        <label class="inline-flex items-center">
                            {!! Form::radio('parent', 0, true, ['id' => 'parent', 'onclick' => 'checkRadio(value)']) !!}
                            <span class="ml-2">Non</span>
                        </label>
                    </div>
                    <div class="ml-4">
                        <label class="inline-flex items-center">
                            {!! Form::radio('parent', 1, false, ['id' => 'parent', 'onclick' => 'checkRadio(value)']) !!}
                            <span class="ml-2">Oui</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="mb-4 dossier_parent hidden flex items-end" id="dossier_parent">
                <div class="w-full">
                    <div class="relative ">
                        <label for="name" class="text-xs opacity-75 scale-75">Dans
                            le dossier</label>
                        <select name="folder_parent_id" id="folder" onchange="javascript:handleSelect(this)"
                            class="peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-8 placeholder-transparent text-sm placeholder-gray-600 border appearance-none focus:shadow-outline">
                            @foreach ($folders_input as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                            <option value="add_folder"> --- Ajouter un autre dossier</option>
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
                </div>
                <div class="w-6 ml-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        id="add_folder" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>
                </div>
                @if ($errors->has('folder'))
                    <span class="text-red-600 text-xs">{{ $errors->first('folder') }}</span>
                @endif
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
                                                    id="{{ $dept['id'] }}_none" value="{{ $dept['id'] }}_none" checked>
                                                <label class="text-sm" for="{{ $dept['id'] }}_none">None</label>
                                            </div>

                                            <div class="">
                                                <input type="radio" name="permissions_{{ $dept['id'] }}[]"
                                                    value="{{ $dept['id'] }}_all" id="{{ $dept['id'] }}_all">
                                                <label class="text-sm" for="{{ $dept['id'] }}_all">All</label>
                                            </div>

                                            <div class="">
                                                <input type="radio" name="permissions_{{ $dept['id'] }}[]"
                                                    id="{{ $dept['id'] }}_admins" value="{{ $dept['id'] }}_admins">
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

        </div>

        <div class="flex">
            {{ Form::submit('Sauvegarder', ['class' => 'focus:outline-none py-2 px-4 bg-gray-900 text-white bg-opacity-75 ml-auto']) }}
            {!! Form::close() !!}
        </div>

    </div>
</div>

<div id="modal2"
    class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-blue-500 bg-opacity-50 transform scale-0 transition-transform duration-300">
    <!-- Modal content -->
    <div class="bg-white w-1/2 p-12 overflow-y-scroll h-2/4">
        <!--Close modal button-->
        <button id="closebutton2" type="button" class="focus:outline-none float-right">
            <!-- Hero icon - close button -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </button>

        <div>
            <h2 class="text-gray-900 text-xl mb-2 font-medium title-font">Ajouter le dossier</h2>

            {!! Form::open(['action' => 'FolderController@store', 'method' => 'POST', 'class' => '']) !!}

            <div class="mb-2 relative">
                <label for="name" class="text-xs opacity-75 scale-75">Nom
                    de dossier</label>
                {{ Form::text('name', '', ['id' => 'name','autocomplete' => 'off','class' =>'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-8 placeholder-transparent text-sm']) }}
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
                                                <label class="text-sm" for="{{ $dept['id'] }}_none">None</label>
                                            </div>

                                            <div class="">
                                                <input type="radio" name="permissions_{{ $dept['id'] }}[]"
                                                    value="{{ $dept['id'] }}_all" id="{{ $dept['id'] }}_all">
                                                <label class="text-sm" for="{{ $dept['id'] }}_all">All</label>
                                            </div>

                                            <div class="">
                                                <input type="radio" name="permissions_{{ $dept['id'] }}[]"
                                                    id="{{ $dept['id'] }}_admins" value="{{ $dept['id'] }}_admins">
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


        </div>

        <div class="flex">
            {{ Form::submit('Sauvegarder', ['class' => 'focus:outline-none py-2 px-4 bg-gray-900 text-white bg-opacity-75 ml-auto']) }}
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

                    $('#folder_dept_list').empty();
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
                    console.log(dept_html);
                    $('#folder_dept_list').html(dept_html);

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

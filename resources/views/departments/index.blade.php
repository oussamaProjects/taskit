@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    @include('departments.inc.head')

    <!-- Statistics Cards -->
    <div class="grid grid-cols-4 sm:grid-cols-4 lg:grid-cols-4 p-4 gap-4">
        <div class="col-span-3">
            <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 p-4 gap-4 bg-bg-color shadow">
                <div class="flex flex-col text-center w-full">
                    <h1 class="sm:text-xl text-lg font-medium title-font mb-6 text-gray-800 text-center">Départements</h1>
                    <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Tous les départements
                    </p>
                </div>
                <div class="w-full">
                    <table
                        class="table-auto w-full text-left bg-colorspace-no-wrap border">
                        <thead>
                            <tr>

                                <th
                                    class="px-2 py-3 title-font tracking-wider font-medium text-bg-color text-tiny bg-main shadow-md">
                                    Name
                                </th>
                                <th
                                    class="px-2 py-3 title-font tracking-wider font-medium text-bg-color text-tiny bg-main shadow-md">
                                    Filials
                                </th>
                                <th
                                    class="w-40 px-2 py-3 title-font tracking-wider font-medium text-bg-color text-tiny bg-main shadow-md">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (count($departments) > 0)
                                @foreach ($departments as $dept)
                                    <tr class="border-b">
                                        <td class="px-4 py-3 text-sm">{{ $dept->dptName }}</td>
                                        <td class="px-4 py-3 text-sm">
                                            @foreach ($dept->subsidiaries()->get() as $suds)
                                                {{ $suds->subsName }} <br />
                                            @endforeach
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            <!-- DELETE using link -->
                                            {!! Form::open(['action' => ['DepartmentsController@destroy', $dept->id], 'method' => 'DELETE', 'id' => 'form-delete-departments-' . $dept->id, 'class' => 'flex']) !!}
                                            <a href="#" class="left"><i class="material-icons"></i></a>
                                            <a href="/departments/{{ $dept->id }}/edit"
                                                class="center text-xs p-1 text-main bg-green-100 hover:text-bg-color hover:bg-main rounded-lg shadow-md hover:shadow-sm cursor-pointer transition">
                                                Modifier
                                            </a>
                                            <a href=""
                                                class="right data-delete ml-2 text-xs p-1 text-red-800 bg-red-100 hover:text-bg-color hover:bg-amber rounded-lg shadow-md hover:shadow-sm cursor-pointer transition"
                                                data-form="departments-{{ $dept->id }}">
                                                Supprimer
                                            </a>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2">
                                        <h5 class="p-4 text-center">No Department has been added</h5>
                                    </td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <button id="addDeptButtonFileImg" class="bg-bg-color h-auto p-4" type="button">
            <img src="{{ asset('img/undraw_Add_files_re_v09g.svg') }}" alt="">
        </button>
    </div>


    @include('inc.sidebar-footer')

    @include('popups.addDept')
    @include('popups.scripts')

    <div id="modalDS"
        class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-main bg-opacity-50 transform scale-0 transition-transform duration-300">
        <div class="bg-bg-color w-1/2 p-4">
            <button id="closebuttonDS" type="button" class="focus:outline-none float-right">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
            <div>
                <h2 class="text-gray-800 text-xl mb-2 font-medium title-font">Ajouter un département</h2>

                @foreach ($departments as $dept)
                    {!! Form::open(['action' => 'DepartmentsController@linkDS', 'method' => 'POST', 'class' => ' col s12']) !!}
                    <div class="dept grid grid-cols-4 sm:grid-cols-4 lg:grid-cols-4 py-2 gap-4 flex items-center">

                        <div class="p-2">
                            {{ $dept->dptName }}
                        </div>

                        @foreach ($subsidiaries as $suds)
                            <div class="flex items-center">
                                <div class="pr-3 flex items-center">
                                    {!! Form::checkbox('subs_id[]', $suds->id, null, ['id' => 'subs_id', 'class' => 'subs_id']) !!}
                                </div>
                                <label for="status"
                                    class="peer-placeholder-shown:opacity-100 opacity-75 peer-focus:opacity-75 peer-placeholder-shown:scale-100 scale-75 peer-focus:scale-75 peer-placeholder-shown:translate-y-0 peer-focus:-translate-y-3 peer-placeholder-shown:translate-x-0 translate-x-1 peer-focus:translate-x-1 pointer-events-none transform origin-left transition-all duration-100 ease-in-out">
                                    {{ $suds->subsName }} <br />
                                </label>
                            </div>
                        @endforeach

                        <a href="#"
                            class="update_dept flex text-bg-color bg-secondary hover:bg-main border-0 py-2 px-6 text-tiny focus:outline-none transition hover:bg-main ml-2"
                            data-deptid="{{ $dept->id }}">Sauvgarder</a>

                    </div>
                    {!! Form::close() !!}
                @endforeach

            </div>
        </div>
    </div>

    <script>
        $(function() {

            $(document).on("click", ".update_dept", function(e) {
                e.preventDefault();
                $('#ajaxShadow').show();
                $('#ajaxloader').show();
                var id = $(this).data('deptid');
                var subs = [];

                $(this).parents('.dept').find("input:checkbox:checked").each(function() {
                    subs.push($(this).val());
                });

                console.log(subs);

                var url = "{{ URL('departments/linkDtoS') }}";
                var url = url + "/" + id;

                $.ajax({
                    url: url,
                    type: "PATCH",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        subs: subs,
                    },
                    success: function(dataResult) {
                        // dataResult = JSON.parse(dataResult);
                        console.log(dataResult);
                        // if (dataResult.statusCode) {
                        //     location.reload(true);
                        // } else {
                        //     alert("Internal Server Error");
                        // }

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

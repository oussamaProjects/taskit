@extends('layouts.app')

@section('content')

    @include('inc.sidebar')




    <div class="h-full ml-14 mb-4 mt-14 md:ml-64">

            <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-white w-full shadow">
                <div class="rounded-t mb-0 px-0 border-0">
                    <div class="flex flex-wrap items-center px-4 py-4">
                        <div class="relative w-full max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-gray-900 ">
                                Départements
                            </h3>
                        </div>
                        <div class="relative w-full max-w-full flex flex-grow flex-1 text-right">
                            <button id="buttonmodal" data-target="modal1"
                                class="flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-blue-500 rounded ml-auto"
                                type="button">Ajouter un département</button>

                            <button id="buttonDeptSubs" data-target="modal1"
                                class="flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-blue-500 rounded ml-4"
                                type="button">Lie un département</button>
                        </div>
                    </div>
                </div>
            </div>


        <!-- Statistics Cards -->
        <div class="grid grid-cols-4 sm:grid-cols-4 lg:grid-cols-4 p-4 gap-4">
            <div class="col-span-3">
                <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 p-4 gap-4 bg-white shadow">
                    <div class="flex flex-col text-center w-full">
                        <h1 class="sm:text-2xl text-xl font-medium title-font mb-2 text-gray-900">Départements</h1>
                        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Tous les départements
                        </p>
                    </div>
                    <div class="w-full">
                        <table class="table-auto w-full text-left whitespace-no-wrap">
                            <thead>
                                <tr>
                                    <th
                                        class="px-2 py-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-blue-100">
                                        Name
                                    </th>

                                    <th
                                        class="px-2 py-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-blue-100">
                                        Subs
                                    </th>
                                    <th
                                        class="px-2 py-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-blue-100">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @if (count($departments) > 0)
                                    @foreach ($departments as $dept)
                                        <tr>
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
                                                <a href="/departments/{{ $dept->id }}/edit" class="center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                                <a href="" class="right data-delete"
                                                    data-form="departments-{{ $dept->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
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

            <button id="buttonmodalFileImg" class="bg-white h-auto p-4 shadow" type="button">
            <img src="{{ asset('img/undraw_Add_files_re_v09g.svg') }}" alt="">
            </button>
        </div>
    </div>

    <div id="modal"
        class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-blue-500 bg-opacity-50 transform scale-0 transition-transform duration-300">
        <div class="bg-white w-1/2 p-4">
            <button id="closebutton" type="button" class="focus:outline-none float-right">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
            <div>
                <h2 class="text-gray-900 text-xl mb-2 font-medium title-font">Ajouter un département</h2>

                {!! Form::open(['action' => 'DepartmentsController@store', 'method' => 'POST', 'class' => 'col s12']) !!}
                <div class="mb-2 relative">
                    <label for="dptName">Nom du département</label>
                    {{ Form::text('dptName', '', ['id' => 'dptName', 'autocomplete' => 'off','class' => 'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-8 placeholder-transparent text-sm']) }}
                </div>

                <div class="mb-2 relative">
                    <label class="text-xs opacity-75 scale-75">
                        Subsidiaries
                    </label>
                    {{ Form::select('subs_id[]', $subs, null, ['id' => 'subs', 'class' => 'form-select peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm block w-full py-2']) }}
                    @if ($errors->has('subs'))
                        <span class="text-red-600 text-xs">{{ $errors->first('subs') }}</span>
                    @endif
                </div>

                <div class="mb-2 relative">
                    {{ Form::submit('Envoyer', ['class' => 'focus:outline-none py-2 px-4 bg-gray-900 text-white bg-opacity-75 ml-auto']) }}
                </div>
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



    <div id="modalDS"
        class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-blue-500 bg-opacity-50 transform scale-0 transition-transform duration-300">
        <div class="bg-white w-1/2 p-4">
            <button id="closebuttonDS" type="button" class="focus:outline-none float-right">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
            <div>
                <h2 class="text-gray-900 text-xl mb-2 font-medium title-font">Ajouter un département</h2>

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
                            class="update_dept focus:outline-none py-2 px-4 bg-gray-900 text-white bg-opacity-75 ml-auto"
                            data-deptid="{{ $dept->id }}">Sauvgarder</a>

                    </div>
                    {!! Form::close() !!}
                @endforeach

            </div>
        </div>
    </div>


    <script>
        const buttonDeptSubs = document.getElementById('buttonDeptSubs')
        const closebuttonDS = document.getElementById('closebuttonDS')
        const modalDS = document.getElementById('modalDS')

        buttonDeptSubs.addEventListener('click', () => modalDS.classList.add('scale-100'))
        closebuttonDS.addEventListener('click', () => modalDS.classList.remove('scale-100'))
    </script>



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

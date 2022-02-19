@extends('layouts.app')

@section('content')

    @include('inc.sidebar')


    <div class="h-full ml-14 mt-14 mb-10 md:ml-64">
 
            <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-bg-color w-full shadow">
                <div class="rounded-t mb-0 px-0 border-0">
                    <div class="flex flex-wrap items-center px-4 py-2">
                        <div class="relative w-full max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-gray-800 ">
                                Modifier le filiale
                            </h3>
                        </div>
                        <div class="relative w-full max-w-full flex-grow flex-1 text-right">
                            <button id="buttonmodal" data-target="modal1"
                                class="flex text-bg-color bg-secondary hover:bg-main border-0 py-2 px-6 text-tiny focus:outline-none hover:bg-main ml-2 ml-auto"
                                type="button">Ajouter un filiale</button>
                        </div>
                    </div>
                </div>
            </div>

        <div class="grid grid-cols-3 sm:grid-cols-3 lg:grid-cols-3 p-4 gap-4">
            <div class="col-span-2">
                {{-- {{ dd($subs->departments()->get()) }} --}}
                <div class="flex items-center p-4 gap-4 bg-bg-color shadow">
                    {!! Form::open(['action' => ['SubsidiaryController@update', $subs->id], 'method' => 'PATCH', 'class' => 'w-full']) !!}
                    <div class="mb-2 relative">
                        <label for="department" class="text-xs opacity-75 scale-75">Nom
                            du filiale</label>
                        {{ Form::text('subsName', $subs->subsName, ['autocomplete' => 'off','class' => 'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm', 'id' => 'department']) }}
                    </div>
                    {{ Form::submit(' Sauvegarder', ['class' => 'flex text-bg-color bg-secondary hover:bg-main border-0 py-2 px-6 text-tiny focus:outline-none hover:bg-main ml-2']) }}
                    {!! Form::close() !!}

                </div>

                <div class="flex items-center p-4 gap-4 mt-4 bg-bg-color shadow">
                    {!! Form::open(['action' => 'DepartmentsController@store', 'method' => 'POST', 'class' => 'col s12']) !!}
                    <div class="mb-2 relative">
                        <label for="dptName" class="text-xs opacity-75 scale-75">Nom
                            du département</label>
                        {{ Form::text('dptName', '', ['autocomplete' => 'off','class' => 'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm', 'id' => 'dptName']) }}
                    </div>

                    {!! Form::hidden('subs_id', $subs->id) !!}

                    {{ Form::submit('Envoyer', ['class' => 'flex text-bg-color bg-secondary hover:bg-main border-0 py-2 px-6 text-tiny focus:outline-none hover:bg-main ml-2']) }}
                    {!! Form::close() !!}
                </div>


                <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 p-4 gap-4 mt-4 bg-bg-color shadow">
                    <div class="flex flex-col text-center w-full">
                        <h1 class="sm:text-2xl text-xl font-medium title-font mb-2 text-gray-800">Départements</h1>
                        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Tous les départements
                        </p>
                    </div>
                    <div class="w-full">
                        <table class="table-auto w-full text-left bg-colorspace-no-wrap border border-bg-color">
                            <thead>
                                <tr>
                                    <th
                                        class="px-2 py-3 title-font tracking-wider font-medium text-bg-color text-sm bg-main shadow">
                                        Name
                                    </th>

                                    <th
                                        class="px-2 py-3 title-font tracking-wider font-medium text-bg-color text-base bg-main shadow-md">
                                        Filias
                                    </th>
                                    <th
                                        class="px-2 py-3 title-font tracking-wider font-medium text-bg-color text-base bg-main shadow-md">
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 m-1"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                                <a href="" class="right data-delete"
                                                    data-form="departments-{{ $dept->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 m-1"
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

            <button id="buttonmodalFileImg" class="bg-bg-color h-auto p-4 shadow" type="button">
                <img src="{{ asset('img/undraw_Add_files_re_v09g.svg') }}" alt="">
            </button>
        </div>

    </div>


    <!-- Modal -->
    <!-- Modal Structure -->
    <!-- Modal -->
    <div id="modal"
        class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-main bg-opacity-50 transform scale-0 transition-transform duration-300">
        <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border border-bg-color shadow-xl">
            <div id="closebutton"
                class="flex flex-row justify-between p-6 bg-bg-color border-b border-bg-color rounded-tl-lg rounded-tr-lg">
                <p class="font-semibold text-gray-800">Ajouter un filiale</p>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </div>
            <div class="flex flex-col px-6 py-5 bg-bg-color">
                {!! Form::open(['action' => 'SubsidiaryController@store', 'method' => 'POST', 'class' => 'col s12']) !!}
                <div class="mb-2 relative">
                    <label for="subsName" class="text-xs opacity-75 scale-75">Nom
                        du filiale</label>
                    {{ Form::text('subsName', '', ['autocomplete' => 'off','class' => 'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm', 'id' => 'subsName']) }}
                </div>
                {{ Form::submit('Envoyer', ['class' => 'flex text-bg-color bg-secondary hover:bg-main border-0 py-2 px-6 text-tiny focus:outline-none hover:bg-main ml-2']) }}
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


@endsection

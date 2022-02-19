@extends('layouts.app')

@section('content')

    @include('inc.sidebar')




    <div class="h-full ml-14 mb-4 mt-14 md:ml-64">

            <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-bg-color w-full shadow">
                <div class="rounded-t mb-0 px-0 border-0">
                    <div class="flex flex-wrap items-center px-4 py-2">
                        <div class="relative w-full max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-gray-800 ">
                                Subsidiaries
                            </h3>
                        </div>
                        <div class="relative w-full max-w-full flex-grow flex-1 text-right">
                            <button id="buttonmodal" data-target="modal1"
                                class="flex text-bg-color bg-gray-800 border-0 py-2 px-6 focus:outline-none hover:bg-main rounded ml-auto"
                                type="button">Ajouter un susbsidiary</button>
                        </div>
                    </div>
                </div>
            </div>


        <!-- Statistics Cards -->
        <div class="grid grid-cols-4 sm:grid-cols-4 lg:grid-cols-4 p-4 gap-4">
            <div class="col-span-3">
                <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 p-4 gap-4 bg-bg-color shadow">
                    <div class="flex flex-col text-center w-full">
                        <h1 class="sm:text-2xl text-xl font-medium title-font mb-2 text-gray-800">Subsidiaries</h1>
                        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Tous les susbsidiaries
                        </p>
                    </div>
                    <div class="w-full">
                        <table class="table-auto w-full text-left bg-colorspace-no-wrap border border-bg-color">
                            <thead>
                                <tr>
                                    <th
                                        class="px-2 py-3 title-font tracking-wider font-medium text-bg-color text-base bg-main shadow-md">
                                        Name
                                    </th>
                                    <th
                                        class="px-2 py-3 title-font tracking-wider font-medium text-bg-color text-base bg-main shadow-md">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @if (count($subsidiaries) > 0)
                                    @foreach ($subsidiaries as $subs)
                                        <tr>
                                            <td class="px-4 py-3 text-sm">{{ $subs->subsName }}</td>
                                            <td class="px-4 py-3 text-sm">
                                                <!-- DELETE using link -->
                                                {!! Form::open(['action' => ['SubsidiaryController@destroy', $subs->id], 'method' => 'DELETE', 'id' => 'form-delete-subsidiaries-' . $subs->id, 'class' => 'flex']) !!}
                                                <a href="#" class="left"><i class="material-icons"></i></a>
                                                <a href="/subsidiaries/{{ $subs->id }}/edit" class="center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 m-1" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                                <a href="" class="right data-delete"
                                                    data-form="subsidiaries-{{ $subs->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 m-1" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
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
                                            <h5 class="p-4 text-center">No Subsidiary has been added</h5>
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

    <div id="modal"
        class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-main bg-opacity-50 transform scale-0 transition-transform duration-300">
        <div class="bg-bg-color w-1/2 p-4">
            <button id="closebutton" type="button" class="focus:outline-none float-right">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 m-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
            <div>
                <h2 class="text-gray-800 text-xl mb-2 font-medium title-font">Ajouter un susbsidiary</h2>

                {!! Form::open(['action' => 'SubsidiaryController@store', 'method' => 'POST', 'class' => 'col s12']) !!}
                <div class="mb-2 relative">
                    <label for="password-confirm">Nom du susbsidiary</label>
                    {{ Form::text('subsName', '', ['autocomplete' => 'off','id' => 'subsName', 'class' => 'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm']) }}
                </div>
                <div class="mb-2 relative">
                    {{ Form::submit('Envoyer', ['class' => 'flex text-bg-color bg-secondary hover:bg-main border-0 py-2 px-6 text-tiny focus:outline-none hover:bg-main ml-2']) }}
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

@endsection

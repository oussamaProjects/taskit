@extends('layouts.app')

@section('content')

    @include('inc.sidebar')


    <div class="h-full ml-14 mt-14 mb-10 md:ml-64">

            <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-bg-color w-full shadow">
                <div class="rounded-t mb-0 px-0 border-0">
                    <div class="flex flex-wrap items-center px-4 py-2">
                        <div class="relative w-full max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-gray-800 ">
                                Modifier le département
                            </h3>
                        </div>
                        <div class="relative w-full max-w-full flex-grow flex-1 text-right">
                            <button id="buttonmodal" data-target="modal1"
                                class="flex text-bg-color bg-secondary hover:bg-main border-0 py-2 px-6 text-tiny focus:outline-none hover:bg-main ml-2 ml-auto"
                                type="button">Ajouter un département</button>
                        </div>
                    </div>
                </div>
            </div>

        <div class="grid grid-cols-3 sm:grid-cols-3 lg:grid-cols-3 p-4 gap-4">
            <div class="col-span-2">

                <div class="flex items-center p-4 gap-4 bg-bg-color shadow">
                    {!! Form::open(['action' => ['DepartmentsController@update', $dept->id], 'method' => 'PATCH', 'class' => 'w-full']) !!}
                    <div class="mb-2 relative">
                        <label for="department" class="text-xs opacity-75 scale-75">Nom
                            du département</label>
                        {{ Form::text('dptName', $dept->dptName, ['autocomplete' => 'off','class' => 'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm', 'id' => 'department']) }}
                    </div>

                    <div class="dept grid grid-cols-4 sm:grid-cols-4 lg:grid-cols-4 py-2 mb-4 gap-4 flex items-center">

                        @foreach ($subsidiaries as $suds)
                            <div class="flex items-center">
                                <div class="pr-3 flex items-center">
                                    {!! Form::radio('subs_id[]', $suds->id, null, ['id' => 'subs_id', 'class' => 'subs_id']) !!}
                                </div>
                                <label for="status"
                                    class="peer-placeholder-shown:opacity-100 opacity-75 peer-focus:opacity-75 peer-placeholder-shown:scale-100 scale-75 peer-focus:scale-75 peer-placeholder-shown:translate-y-0 peer-focus:-translate-y-3 peer-placeholder-shown:translate-x-0 translate-x-1 peer-focus:translate-x-1 pointer-events-none transform origin-left transition-all duration-100 ease-in-out">
                                    {{ $suds->subsName }} <br />
                                </label>
                            </div>
                        @endforeach

                    </div>

                    {{ Form::submit('Sauvegarder', ['class' => 'flex text-bg-color bg-secondary hover:bg-main border-0 py-2 px-6 text-tiny focus:outline-none hover:bg-main ml-2']) }}
                    {!! Form::close() !!}

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
                <p class="font-semibold text-gray-800">Ajouter un département</p>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </div>
            <div class="flex flex-col px-6 py-5 bg-bg-color">
                {!! Form::open(['action' => 'DepartmentsController@store', 'method' => 'POST', 'class' => 'col s12']) !!}
                <div class="mb-2 relative">
                    <label for="dptName" class="text-xs opacity-75 scale-75">Nom
                        du département</label>
                    {{ Form::text('dptName', '', ['autocomplete' => 'off','class' => 'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm', 'id' => 'dptName']) }}
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

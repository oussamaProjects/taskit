@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="ml-14 mt-14 md:ml-64">
        <!-- Statistics Cards -->
        <div class="flex p-4 gap-4">

            <form action="/search" method="post" id="search-form"
                class="bg-white flex items-center w-full max-w-xl  4 p-2">
                {{ csrf_field() }}
                <button class="outline-none focus:outline-none">
                    <svg class="w-5 text-gray-600 h-5 cursor-pointer" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
                <input type="text" name="search" id="search" placeholder="Search Here ..."
                    class="w-full pl-3 text-sm text-black outline-none focus:outline-none bg-transparent" />
            </form>

            <button id="buttonmodal" class="focus:outline-none py-2 px-4 bg-blue-600 text-white bg-opacity-75 ml-auto">
                Ajouter un nouveau
            </button>

            @can('upload')
            @endcan

        </div>
    </div>

    <div class="ml-14 mt-14 mb-10 md:ml-64">
        <div class="grid grid-cols-1 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-6 p-4 gap-4">
            @if (count($folders) > 0)
                @foreach ($folders as $folder)
                    <div id="tr_{{ $folder->id }}"
                        class="overflow-hidden bg-white shadow-md px-4 py-4 dark:bg-gray-800 relative">
                        <div class="" data-id="{{ $folder->id }}">
                            <a href="/folders/{{ $folder->id }}">
                                <div class="center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto my-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                    </svg>
                                    <h6 class="text-gray-900 text-lg mb-1 font-medium title-font text-center capitalize">
                                        {{ $folder->name }}</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-1 p-4 gap-4">
        <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
            <div class="rounded-t mb-0 px-0 border-0">
                <div class="flex flex-wrap items-center px-4 py-2">
                    <div class="relative w-full max-w-full flex-grow flex-1">
                        <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">
                        </h3>
                        {{-- <button data-url="{{ url('categoriesDeleteMulti') }}"
                            class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                            type="button">Supprimer toutes les sélections</button> --}}
                    </div>
                    <div class="relative w-full max-w-full flex-grow flex-1 text-right">

                    </div>
                </div>
                <div class="block w-full overflow-x-auto">
                    <table class="items-center w-full bg-transparent border-collapse">
                        <thead>
                            <tr>
                                <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                </th>
                                <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    Nom du dossier</th>
                                <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($folders) > 0)
                                @foreach ($folders as $folder)
                                    <tr id="tr_{{ $folder->id }}" class="text-gray-700 dark:text-gray-100">
                                        <th
                                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 whitespace-nowrap p-4 text-left">
                                            <input type="checkbox" id="chk_{{ $folder->id }}" class="sub_chk"
                                                data-id="{{ $folder->id }}">
                                            <label for="chk_{{ $folder->id }}"></label>
                                        </th>
                                        <td
                                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                                            {{ $folder->name }}</td>
                                        <td
                                            class="flex border-t-0 px-4 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">

                                            <!-- DELETE using link -->
                                            {!! Form::open(['action' => ['FolderController@destroy', $folder->id], 'method' => 'DELETE', 'id' => 'form-delete-folders-' . $folder->id, 'class' => 'flex items-center']) !!}
                                            <a href="#" class="left"><i class="material-icons"></i></a>
                                            <a href="/folders/{{ $folder->id }}/edit" class="center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <a href="" class="right data-delete"
                                                data-form="folders-{{ $folder->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
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
                                    <td colspan="3">
                                        <h5 class="teal-text">Aucune catégorie n'a été ajoutée</h5>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div id="modal"
        class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-blue-500 bg-opacity-50 transform scale-0 transition-transform duration-300">
        <!-- Modal content -->
        <div class="bg-white w-1/2 h-1/3 p-12">
            <!--Close modal button-->
            <button id="closebutton" type="button" class="focus:outline-none float-right">
                <!-- Hero icon - close button -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>

            <div>
                <h2 class="text-gray-900 text-xl mb-1 font-medium title-font">Ajouter le dossier</h2>

                {!! Form::open(['action' => 'FolderController@store', 'method' => 'POST', 'class' => '']) !!}

                <div class="mb-5 relative">
                    <label for="name" class="leading-7 text-sm text-gray-600">Nom de dossier</label>
                    {{ Form::text('name', '', ['id' => 'name', 'class' => 'w-full bg-gray-100 bg-opacity-50 border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out']) }}
                </div>

                <div class="mb-5 relative">
                    <label for="name" class="leading-7 text-sm text-gray-600">Folder Parent</label>
                    <div class="relative inline-block w-full text-gray-700">
                        {{ Form::select('folder_parent_id[]', $folders_input, $folders_input, ['id' => 'folder', 'class' => 'w-full bg-gray-100 bg-opacity-50 border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out placeholder-gray-600 border appearance-none focus:shadow-outline']) }}
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                <path
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" fill-rule="evenodd">
                                </path>
                            </svg>
                        </div>
                    </div>
                    @if ($errors->has('folder'))
                        <span class="red-text"><strong>{{ $errors->first('folder') }}</strong></span>
                    @endif
                </div>

            </div>

            <div class="flex">
                {{ Form::submit('submit', ['class' => 'focus:outline-none py-2 px-4 bg-blue-600 text-white bg-opacity-75 ml-auto']) }}
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

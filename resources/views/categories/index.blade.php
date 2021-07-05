@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="h-full ml-14 mt-14 mb-10 md:ml-64">
        <div class="grid grid-cols-1 lg:grid-cols-1 p-4 gap-4">
            <div
                class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-900 w-full shadow-lg rounded">
                <div class="rounded-t mb-0 px-0 border-0">
                    <div class="flex flex-wrap items-center px-4 py-4">
                        <div class="relative w-full max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">
                                Categories
                            </h3>
                        </div>
                        <div class="relative w-full max-w-full flex-grow flex-1 text-right">
                            <button id="buttonmodal" data-target="modal1"
                                class="flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded ml-auto"
                                type="button">Ajouter une categories</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-4 lg:grid-cols-4 p-4 gap-4">
            <div class="col-span-3">
                <div class="grid grid-cols-1 lg:grid-cols-1 p-4 gap-4">
                    <div
                        class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-900 w-full shadow-lg rounded">
                        <div class="rounded-t mb-0 px-0 border-0">
                            <div class="block w-full overflow-x-auto">
                                <table class="items-center w-full bg-transparent border-collapse">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-4 bg-gray-100 dark:bg-gray-900 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            </th>
                                            <th
                                                class="px-4 bg-gray-100 dark:bg-gray-900 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                                Nom de catégorie</th>
                                            <th
                                                class="px-4 bg-gray-100 dark:bg-gray-900 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($categories) > 0)
                                            @foreach ($categories as $category)
                                                <tr id="tr_{{ $category->id }}" class="text-gray-700 dark:text-gray-100">
                                                    <th
                                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 whitespace-nowrap p-4 text-left">
                                                        <input type="checkbox" id="chk_{{ $category->id }}"
                                                            class="sub_chk" data-id="{{ $category->id }}">
                                                        <label for="chk_{{ $category->id }}"></label>
                                                    </th>
                                                    <td
                                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                                                        {{ $category->name }}</td>
                                                    <td
                                                        class="flex border-t-0 px-4 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">

                                                        <!-- DELETE using link -->
                                                        {!! Form::open(['action' => ['CategoriesController@destroy', $category->id], 'method' => 'DELETE', 'id' => 'form-delete-categories-' . $category->id, 'class' => 'flex items-center']) !!}
                                                        <a href="#" class="left"><i class="material-icons"></i></a>
                                                        <a href="/categories/{{ $category->id }}/edit" class="center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                            </svg>
                                                        </a>
                                                        <a href="" class="right data-delete"
                                                            data-form="categories-{{ $category->id }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
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
                                                <td colspan="3">
                                                    <h5 class="teal-text text-center p-4">Aucune catégorie n'a été ajoutée
                                                    </h5>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img src="{{ asset('img/undraw_Filing_system_re_56h6.svg') }}" alt="">
        </div>

    </div>

    <div id="modal"
        class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-blue-500 bg-opacity-50 transform scale-0 transition-transform duration-300">
        <!-- Modal content -->
        <div class="bg-white w-1/2 h-1/4 p-12">
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
                <h2 class="text-gray-900 text-xl mb-1 font-medium title-font">Ajouter une categorie</h2>

                {!! Form::open(['action' => 'CategoriesController@store', 'method' => 'POST', 'class' => '']) !!}

                <div class="mb-5 relative">
                    <label for="name" class="peer-placeholder-shown:opacity-100 opacity-75 peer-focus:opacity-75 peer-placeholder-shown:scale-100 scale-75 peer-focus:scale-75 peer-placeholder-shown:translate-y-0 -translate-y-3 peer-focus:-translate-y-3 peer-placeholder-shown:translate-x-0 translate-x-1 peer-focus:translate-x-1 absolute top-0 left-0 px-3 py-5 h-full pointer-events-none transform origin-left transition-all duration-100 ease-in-out">Nom de dossier</label>
                    {{ Form::text('name', '', ['id' => 'name', 'class' => 'peer pt-8 border border-gray-200 focus:outline-none rounded-md focus:border-gray-500 focus:shadow-sm w-full p-3 h-16 placeholder-transparent']) }}
                </div>

            </div>

            <div class="flex">
                {{ Form::submit('submit', ['class' => 'focus:outline-none py-2 px-4 bg-gray-900 text-white bg-opacity-75 ml-auto']) }}
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

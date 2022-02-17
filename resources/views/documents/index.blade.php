@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="ml-14 mt-14 mb-4 md:ml-64">
        <div class="flex items-center p-4 gap-4 bg-white">

            <form action="/search" method="post" id="search-form"
                class="bg-white rounded flex items-center w-full max-w-sm mr-4 p-2 shadow-sm border border-gray-200 ">
                {{ csrf_field() }}
                <button class="outline-none focus:outline-none">
                    <svg class="w-5 text-gray-600 h-5 cursor-pointer" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
                <input type="text" autocomplete="off" name="search" id="search" placeholder="Recherche"
                    class="w-full pl-3 text-sm text-black outline-none focus:outline-none bg-transparent" />
            </form>

            <form action="/sort" method="post" id="sort-form" class="ml-auto">
                {{ csrf_field() }}
                <div class="input-field col m2 s12">
                    <select name="filetype" id="sort">
                        <option value="" disabled selected>Choisir</option>
                        <option value="image/jpeg" @if ($filetype === 'image/jpeg') selected @endif>Image</option>
                        <option value="video/mp4" @if ($filetype === 'video/mp4') selected @endif>Video</option>
                        <option value="audio/mpeg" @if ($filetype === 'audio/mpeg') selected @endif>Audio</option>
                        <option value="application/pdf" @if ($filetype === 'application/pdf') selected @endif>PDF</option>
                        <option value="text/plain" @if ($filetype === 'text/plain') selected @endif>Document text</option>
                        <option value="application/vnd.openxmlformats-officedocument.wordprocessingml.document">Word
                            Documents</option>
                        <option value="">Others</option>
                    </select>
                </div>
            </form>

            <div class="flex">
                {{-- <button
                    class="flex text-white bg-gray-900 border-0 py-2 px-4 focus:outline-none hover:bg-blue-500 rounded ml-auto mr-4"
                    data-url="{{ url('documentsDeleteMulti') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>

                    <span class="ml-2">Supprimer la selection</span>

                </button> --}}
                &nbsp;
                <a href="\allDocuments"
                    class="flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-blue-500 rounded">Afficher
                    tous les documents</a>
                @can('upload')
                    <button id="buttonmodalFile"
                        class="flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-blue-500 rounded ml-4"
                        type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        <span class="ml-2">Ajouter un document</span>
                    </button>
                @endcan
            </div>
        </div>
    </div>

    <div class="ml-14 mb-14 md:ml-64">

        <div class="grid grid-cols-6 lg:grid-cols-6 p-4 mb-4 mt-2 ml-4 gap-4 bg-white shadow">

            <div class="col-span-1">
                <div class="tree px-2 py-6 h-full text-xs text-gray-500 border">
                    <ul class="pt-1">
                        <li>
                            <a href="\folders">
                                <i class="fa fa-folder-open"></i> <span>Root</span>
                            </a>
                            <ul>
                                @foreach ($folders as $folder)
                                    <li>
                                        <a href="\folders\{{ $folder->id }}">
                                            <div class="flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                                </svg>
                                                <span class="ml-2">{{ $folder->name }}</span>
                                            </div>
                                        </a>
                                        @if (count($folder->children))
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="open-folder h-4 w-4 absolute right-0 top-1 cursor-pointer"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="close-folder h-4 w-4 absolute right-0 top-1 hidden" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                            @include('inc.manageChild',['children' => $folder->children])
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-span-5">
                <div class="grid grid-cols-8 lg:grid-cols-8 p-4 gap-4">
                    @if (!is_null($docs))
                        @foreach ($docs as $doc)
                            @include('inc.doc',['doc' => $doc])
                        @endforeach
                    @else
                        <div class="col-span-6 lg:col-span-8">
                            <h5 class="text-center p-4">Aucun document n'a été téléchargé</h5>
                        </div>
                    @endif
                </div>
            </div>
        </div>


    
        @include('inc.tables.docs')
        
    </div>


    @include('popups.addFolder')
    @include('popups.addCategorie')
    @include('popups.addDossier')
    @include('popups.scripts')

    <script>
        $(function() {

            $(document).on("click", ".update_color", function(e) {
                e.preventDefault();
                var color = $(this).data('color');
                var id = $(this).parents('.colors').data('id');
                console.log($(this));
                console.log(id);
                console.log(color);

                var url = "{{ URL('documents/color') }}";
                var url = url + "/" + id;


                $.ajax({
                    url: url,
                    type: "PATCH",
                    cache: false,
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        color: color,
                    },
                    success: function(dataResult) {
                        dataResult = JSON.parse(dataResult);
                        console.log(dataResult);
                        if (dataResult.statusCode) {
                            location.reload(true);
                        } else {
                            alert("Internal Server Error");
                        }

                    },
                    error: function(error) {
                        console.log(error);
                        location.reload(true);
                    }
                });
            });
        });
    </script>

@endsection

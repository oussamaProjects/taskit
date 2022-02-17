@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="h-full ml-14 mt-14 mb-10 md:ml-64">

        <div class="grid grid-cols-1 lg:grid-cols-1">
            <div class="relative flex flex-col min-w-0 mb-2 break-words bg-white w-full shadow rounded">
                <div class="rounded-t mb-0 px-0 border-0">
                    <div class="flex flex-wrap items-center px-4 py-4">
                        <div class="relative w-full max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-2xl text-gray-900 capitalize">
                                {{ isset($folder) ? $folder->name : 'Root' }}
                            </h3>
                        </div>
                        <div class="flex ml-auto relative text-right">
                            <a href="\allFolders"
                                class="flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-blue-500 rounded">
                                Afficher tous les dossiers
                            </a>
                            <button id="buttonmodalDossier"
                                class="flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-blue-500 rounded ml-4"
                                type="button">
                                Ajouter un dossier
                            </button>
                            @can('upload')
                                <button id="buttonmodalFile"
                                    class="flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-blue-500 rounded ml-4"
                                    type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>
                                    <span class="ml-2">Ajouter un document</span>
                                </button>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-6 lg:grid-cols-6 p-4 mb-4 mt-2 ml-4 gap-4 bg-white shadow">

            <div class="col-span-1 border">
                <div class="tree px-2 py-6 h-full text-xs text-gray-500   border-gray-300">
                    <ul class="pt-1">
                        <li>
                            <a href="\folders">
                                <i class="fa fa-folder-open"></i> <span>Root</span>
                            </a>
                            <ul>
                                @foreach ($folders as $folderTree)
                                    <li>
                                        <a href="/folder/{{ $folderTree->id }}/child">
                                            <div class="flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                                </svg>
                                                <span class="ml-2">{{ $folderTree->name }}</span>
                                            </div>
                                        </a>
                                        @if (count($folderTree->children))
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
                                            @include('inc.manageChild2',['children' => $folderTree->children])
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-span-2 border">
                <div class="text-center mt-2 font-bold"> Dans ce dossier <span
                        class="text-red-400">{{ isset($folder) ? $folder->name : 'Root' }}</span></div>
                <div class="grid grid-cols-2 lg:grid-cols-2 p-4 gap-4">
                    @if (count($folders_table) > 0)
                        @foreach ($folders_table as $fold)
                            @include('inc.folder',['folder' => $fold])
                        @endforeach
                    @else
                        @include('inc.no-records.folders' )
                    @endif
                </div>
            </div>

            <div class="col-span-3 border">
                <div class="text-center mt-2 font-bold">Les documents dans <span
                        class="text-red-400">{{ isset($folder) ? $folder->name : 'Root' }}</span></div>
                <div class="grid grid-cols-4 lg:grid-cols-4 p-2 gap-4">
                    @if (isset($docs) && count($docs) > 0)
                        @foreach ($docs as $doc)
                            @include('inc.doc',['doc' => $doc])
                        @endforeach
                    @else
                        @include('inc.no-records.docs' )
                    @endif
                </div>
            </div>

        </div>
        @if (isset($folder))
        @include('inc.tables.docs',['folder' => $folder])
        @endif

    </div>


    @include('popups.addFolder')
    @include('popups.addDossier')
    @include('popups.addCategorie')
    @include('popups.scripts')
    <script>
        $(function() {

            $(document).on("click", ".update_color_folder", function(e) {
                e.preventDefault();
                var color = $(this).data('color');
                var id = $(this).parents('.colors').data('id');
                console.log($(this));
                console.log(id);
                console.log(color);

                var url = "{{ URL('folder/color') }}";
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

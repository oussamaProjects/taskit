@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    @include('folders.inc.head')

    <div class="flex flex-row flex-wrap my-2 mx-4 gap-4 p-4 bg-bg-color shadow-md">

        <div class="flex-initial border shadow-sm">
            @include('inc.folders.folder-tree', ['currentFolder' => $folder?? null])
        </div>

        <div class="flex-1 border shadow-sm p-2">
            <div class="sm:text-xl text-lg font-medium title-font my-2 text-gray-800 text-center p-2 uppercase"> Dans ce dossier <span
                    class="text-secondary">{{ isset($folder) ? $folder->name : 'Root' }}</span></div>
            <div class="flex flex-row flex-wrap items-start content-start justify-start h-full">
                @if (count($folders_table) > 0)
                    @foreach ($folders_table as $fold)
                        @include('inc.folders.folder',['folder' => $fold])
                    @endforeach
                @else
                    @include('inc.no-records.folders' )
                @endif
            </div>
        </div>

        <div class="flex-1 border shadow-sm p-2">
            <div class="sm:text-xl text-lg font-medium title-font my-2 text-gray-800 text-center p-2 uppercase">Les documents dans <span
                    class="text-secondary">{{ isset($folder) ? $folder->name : 'Root' }}</span></div>
            <div class="flex flex-row flex-wrap gap-4 items-start justify-start h-full">
                @if (isset($docs) && count($docs) > 0)
                    @foreach ($docs as $doc)
                        @include('inc.docs.doc',['doc' => $doc])
                    @endforeach
                @else
                    @include('inc.no-records.docs' )
                @endif
            </div>
        </div>

    </div>
    @include('inc.tables.docs')


    @include('inc.sidebar-footer')

    @include('popups.addFile')
    @include('popups.addFolder')
    @include('popups.addSubFolder')
    @include('popups.addCategorie')
    @include('popups.scripts')

@endsection

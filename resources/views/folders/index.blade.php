@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    @include('folders.inc.head')

    <div class="flex flex-row flex-wrap p-4 mb-4 mt-2 ml-4 gap-4 bg-bg-color shadow">

        <div class="flex-initial border shadow">
            @include('inc.folders.folder-tree')
        </div>

        <div class="flex-1 border shadow p-2">
            <div class="sm:text-xl text-lg font-medium title-font mb-6 text-gray-800 text-center"> Dans ce dossier <span
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

        <div class="flex-1 border shadow p-2">
            <div class="sm:text-xl text-lg font-medium title-font mb-6 text-gray-800 text-center">Les documents dans <span
                    class="text-secondary">{{ isset($folder) ? $folder->name : 'Root' }}</span></div>
            <div class="flex flex-row flex-wrap items-start justify-start h-full">
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
    @include('popups.addCategorie')
    @include('popups.scripts')

@endsection

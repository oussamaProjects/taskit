@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    @include('documents.inc.head')


    <div class="flex gap-4 my-2 mx-4">

        <div class="flex-initial border font-light">
            @include('inc.docs.folders-tree', ['currentFolder' => $folder ?? null])
        </div>

        <div class="flex-1 border bg-bg-color shadow-md">
            <div class="sm:text-xl text-lg font-medium title-font my-2 text-gray-800 text-center p-2 uppercase">
                Les documents dans <span class="text-secondary">{{ isset($folder) ? $folder->name : 'Root' }}</span>
            </div>
            <div class="flex flex-row flex-wrap gap-4 p-4">
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

@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    @include('documents.inc.head')

    <div class="ml-14 mb-14 md:ml-64">

        <div class="flex flex-row flex-wrap p-4 mb-4 mt-2 ml-4 gap-4 bg-bg-color shadow">

            <div class="flex-initial w-52 overflow-x-scroll">
                @include('inc.docs.folders-tree')
            </div>

            <div class="flex-1 border shadow">
                <div class="text-center font-bold text-lg uppercase my-2">
                    Les documents dans <span class="text-main">{{ isset($folder) ? $folder->name : 'Root' }}</span>
                </div>
                <div class="flex flex-row h-full">
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

    </div>


    @include('popups.addFolder')
    @include('popups.addCategorie')
    @include('popups.addFile')
    @include('popups.scripts')

@endsection

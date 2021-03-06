@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    @include('documents.inc.head')


    <div class="flex flex-row flex-wrap mt-2 mb-3 mx-4 gap-4 bg-bg-color">
        @if (!is_null($docs))
            @foreach ($docs as $doc)
                @include('inc.docs.doc',['doc' => $doc])
            @endforeach
        @else
            <div class="col-span-6 lg:col-span-8">
                <h5 class="text-center p-4">Aucun document n'a été téléchargé</h5>
            </div>
        @endif
    </div>


    @include('inc.tables.docs')


    @include('inc.sidebar-footer')


    @include('popups.addFile')
    @include('popups.addFolder')
    @include('popups.addCategorie')
    @include('popups.scripts')

@endsection

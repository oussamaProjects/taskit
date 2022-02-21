@extends('layouts.app')

@section('content')
    @include('inc.sidebar')

    @include('documents.inc.head')

    @include('inc.tables.docs',['docs'=> $shared])

    @include('inc.sidebar-footer')
    @include('popups.addFile')
    @include('popups.scripts')
@endsection

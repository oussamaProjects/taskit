@extends('layouts.app')

@section('content')
    @include('inc.sidebar')

    <div class="grid grid-cols-2 lg:grid-cols-2 px-4 pt-4 pb-3 gap-4">
        {{ $chartPie->container() }}
        {{ $chartBar->container() }}
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-1 px-4 pt-4 pb-3 gap-4">
        {{ $chartLine->container() }}
    </div>

    <script src="{{ $chartBar->cdn() }}"></script>
    <script src="{{ $chartPie->cdn() }}"></script>
    <script src="{{ $chartLine->cdn() }}"></script>
    @include('inc.sidebar-footer')
    {{ $chartPie->script() }}
    {{ $chartBar->script() }}
    {{ $chartLine->script() }}
    @include('popups.scripts')
@endsection

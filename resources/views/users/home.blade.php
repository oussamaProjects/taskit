@extends('layouts.app')

@section('content')
    @include('inc.sidebar')
<div class="container">
   <div class="col-10">
  <center>
    <div class="row">
        <div class="col-4">Total time</div>
        <div class="col-4">Amount</div>
        <div class="col-4">Billable</div>
    </div>
    <div class="row">
       <div> {{ $chartBar->container() }}</div>
    </div>
  </center>
    <div class="row">
        <div class="col-5">{{ $chartPie->container()}}</div>
        <div style="height: 50px" class="col-4">{{ $chartH_bar->container()}}</div>
    </div>
   </div>
</div>
    {{-- <div class="grid grid-cols-2 lg:grid-cols-2 px-4 pt-4 pb-3 gap-4">
       
       
    </div> --}}
    <div class="grid grid-cols-1 lg:grid-cols-1 px-4 pt-4 pb-3 gap-4">
        {{ $chartLine->container() }}
    </div>

    <script src="{{ $chartBar->cdn() }}"></script>
    <script src="{{ $chartPie->cdn() }}"></script>
    <script src="{{ $chartLine->cdn() }}"></script>
    <script src="{{ $chartH_bar->cdn() }}"></script>
    @include('inc.sidebar-footer')
    {{ $chartPie->script() }}
    {{ $chartBar->script() }}
    {{ $chartLine->script() }}
    {{$chartH_bar->script()}}
    @include('popups.scripts')
@endsection

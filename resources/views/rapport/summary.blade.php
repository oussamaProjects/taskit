@extends('rapport.home')

@section('context')
<div class="col-10">
   
      <div class="row">
          <div style="padding: 20px" class="col-4 bg-secondary">Total time <br><span>{{ $time_total}}</span></div>
          <div style="padding: 20px"  class="col-4 bg-secondary">Amount</div>
          <div style="padding: 20px"  class="col-4 bg-secondary">Billable</div>
      </div>
      <div class="row">
         <div> {{ $chartBar->container() }}</div>
      </div>
    
      <div class="row">
          <div class="col-5">{{ $donutChart->container()}}</div>
          <div style="height: 50px" class="col-4">{{ $chartH_bar->container()}}</div>
      </div>
</div>


    <script src="{{ $chartBar->cdn() }}"></script>
    <script src="{{ $donutChart->cdn() }}"></script>
    {{-- <script src="{{ $chartLine->cdn() }}"></script> --}}
    <script src="{{ $chartH_bar->cdn() }}"></script>
  
    {{ $donutChart->script() }}
    {{ $chartBar->script() }}
    {{-- {{ $chartLine->script() }} --}}
    {{$chartH_bar->script()}}
@endsection
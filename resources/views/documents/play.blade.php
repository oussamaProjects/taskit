@extends('layouts.app')

@section('content')

@include('inc.sidebar')
 
 
  <!-- Statistics Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 p-4 ml-4 bg-bg-color shadow">
        <video width="100%" height="500px" controls>
          <source src="{{ Storage::url($doc->file) }}" type="{{ $doc->mimetype }}">
          Your browser does not support the video tag.
        </video>
        <div class="video-container">
          <iframe src="{{ Storage::url($doc->file) }}" frameborder="0" allowfullscreen></iframe>
        </div>  
    </div>
  
    @include('inc.sidebar-footer')
  
@endsection

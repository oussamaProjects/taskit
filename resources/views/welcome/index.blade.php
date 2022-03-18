@extends('layouts.app')
@section('content')

    @include('inc.sidebar')
<div class="container" style="margin-top: 20px">
    <div>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark" aria-label="Third navbar example">
            <div class="container-fluid">
                {!! Form::open(['action'=>'Time_tracker@store' , 'method'=>'POST']) !!}
                <input class="form-control" type="text" name="description" placeholder="description" aria-label="Search">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
          
                <div class="collapse navbar-collapse" id="navbarsExample03">
                  <ul class="navbar-nav me-auto mb-2 mb-sm-0">
                    <li class="nav-item">
                       @if (count($projects)>0)
                            <select name="project" > Project
                                <option value="">un project</option>
                                @foreach ($projects as $project)
                                  <option value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                               
                            </select>
                       @endif
                       
                    </li>
                    <li class="nav-item dropdown">
                        @if (count($categorys)>0)
                            <select name="category" > category
                                <option value=""> un category</option>
                                    @foreach ($categorys as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                            </select>
                        @endif
                    </li>
                    <li class="nav-item">
                      <a class="nav-link disabled"><i class="fa-solid fa-dollar-sign"></i></a>
                    </li>
                        <input type="time" name="start_time" class="mb-3">
                        <input type="time" name="end_time" class="mb-3">
                        <input type="date" name="estimate_time" class="mb-3">
                       {!! Form::submit('Start', ['class'=>'btn btn-primary mb-3']) !!}
                  </ul>
                  {!! Form::close() !!}
                </div>
            </div>
          </nav>
    </div>



</div>
    @include('inc.sidebar-footer')
    @include('popups.scripts')

@endsection
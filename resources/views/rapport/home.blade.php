@extends('layouts.app')

@section('content')
    @include('inc.sidebar')
<div class="container">
    <div class="row align-items-start">
        <div class="col-6">
            <ul class="nav">
                <li class="nav-item">
                  <a aria-current="page" href="#" class="nav-link disabled">Rapport</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('dashboad.summary')}}">Summary</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('dashboad.detailed')}}">Detailed</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('dashboad.weekly')}}">Weekly</a>
                </li>
              </ul>
            </div>
        </div>

        {{-- <div style="margin: 22px">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                <select>
                    @foreach ($groups as $group)
                      <option value="">{{$group->name}}</option>
                    @endforeach
                </select>
                </li>
                <li class="nav-item dropdown">
                  <select>
                    @foreach ($users as $user)
                        <option value="">{{$user->name}}</option>
                    @endforeach
                </select>
                </li>
                <li class="nav-item">
                 <select>
                     @foreach ($projects as $project)
                         <option value="">{{$project->name}}</option>
                     @endforeach
                 </select>
                </li>
                <li class="nav-item">
                  <select >
                      @foreach ($departments as $department)
                          <option value="">{{$department->dptName}}</option>
                      @endforeach
                  </select>
                </li>
              </ul>
        </div> --}}
   @yield('context')
</div>

    {{-- <div class="grid grid-cols-2 lg:grid-cols-2 px-4 pt-4 pb-3 gap-4">
       
       
    </div> --}}
    
    @include('inc.sidebar-footer')
    @include('popups.scripts')
@endsection

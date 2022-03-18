@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="grid grid-cols-1 lg:grid-cols-1 px-4 pt-4 pb-3 gap-4">
        <div class="relative flex flex-col break-words bg-white w-full shadow-sm rounded">
            <div class="rounded-t mb-0 px-0 border">
                <div class="flex flex-wrap items-center px-2 py-3">
                    <div class="relative w-full max-w-full flex-grow flex-1">
                       <div style="text-align: center">
                            <h3 class="font-semibold uppercase text-xl text-gray-800">
                              Project
                            </h3>
                            <h6 class="font-semibold uppercase text-md text-gray-1000" style="margin-left: 26px">
                               Nom Project : {{$project->name}}
                            </h6>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="relative flex flex-col break-words bg-white w-full shadow-sm rounded">
        <div class="rounded-t mb-0 px-0 border">
            <div class="flex flex-wrap items-center px-2 py-3">
                <div class="relative w-full max-w-full flex-grow flex-1">
                   
                      <div class="card text-center">
                        <div class="card-body">
                        <div class="container row">
                            <div class="col-5">

                                @foreach ($project->departments()->get() as $dept)
                                <label class="font-semibold uppercase text-xl text-gray-800"> Nom de Départment : </label>
                                <span class="card-text">
                                        {{$dept->dptName}}
                                </span> <br>
                                @endforeach

                                <label class="font-semibold uppercase text-xl text-gray-800">
                                    Nom de Client :
                                </label>
                                  <span style="margin-left: 26px">
                                    @foreach ($clients as $client)
                                        @if ($client->id==$project->client_id)
                                              {{ $client->name }}                                  
                                        @endif
                                    @endforeach
                                  </span><hr><br>
                             </div>
                                    
                             <div class="col-5">
                                <p class="card-text">
                                    @foreach ($project->tasks()->get() as $task)
                                        
                                            <label class="font-semibold uppercase text-xl text-gray-1000">Nom Task : </label>
                                            <span>
                                                {{$task->name}}
                                            </span><br><br>
                                            @foreach ($task->categorys()->get() as $category)
                                                @if ($category != null)
                                                <label class="font-semibold uppercase text-md text-gray-1000">Nom de Catégory :</label>
                                                  <span>
                                                    {{$category->name}}
                                                  </span><br>
                                                @endif
                                            @endforeach
        
                                            @foreach ($task->users()->get() as $user)
                                                @if ($user != null)
                                                <label class="font-semibold uppercase text-md text-gray-1000">Nom de User :</label>
                                                   <span>
                                                    {{$user->name}}
                                                   </span><br>
                                                @endif
                                            @endforeach
                                            <hr><br>
                                    @endforeach
                                </p>
                             </div>
                        </div>
                          {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
    

    @include('inc.sidebar-footer')

@endsection

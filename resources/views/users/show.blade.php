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
                              User
                            </h3>
                            <h6 class="font-semibold uppercase text-md text-gray-1000" style="margin-left: 26px">
                               Nom User : {{$user->name}}
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
                              @foreach ($user->departments()->get() as $dpt)
                                    @foreach ($dpt->subsidiaries()->get() as $filiale)
                                            <label class="font-semibold uppercase text-xl text-gray-800">Nom de Filiale :</label>
                                            <span>
                                            {{$filiale->subsName}}
                                            </span><br>
                                    @endforeach
                                        <label class="font-semibold uppercase text-xl text-gray-800">Nom Department :</label>
                                        <span>
                                            {{$dpt->dptName}} 
                                        </span><hr><br>
                               @endforeach
                            </div>
                            <div class="col-5">
                                @foreach ($user->tasks()->get() as $task)
                                <label class="font-semibold uppercase text-xl text-gray-1000">Nom task :</label>
                                    <span>
                                        {{$task->name}}
                                    </span><hr><br>

                                @foreach ($task->categorys()->get() as $category)
                                    <label class="font-semibold uppercase text-md text-gray-1000">Nom de catégory :</label>
                                    <span>
                                        {{$category->name}}
                                    </span><br>
                                @endforeach
                                <hr><br>
                               @foreach ($task->projects()->get() as $project)
                                   <label class="font-semibold uppercase text-md text-gray-1000">Nom de project :</label>
                                    <span>
                                        {{$project->name}}
                                    </span><br>
                                   <label class="font-semibold uppercase text-md text-gray-1000">nom de Client :</label>
                                    @foreach ($clients as $client)
                                        @if ($client->id == $project->client_id)
                                            <span>
                                                {{$client->name}}
                                            </span><hr><br>
                                        @endif
                                    @endforeach
                               @endforeach
                            @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>

    @include('inc.sidebar-footer')

@endsection

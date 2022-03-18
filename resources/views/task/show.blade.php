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
                              TASK
                            </h3>
                            <h6 class="font-semibold uppercase text-md text-gray-1000" style="margin-left: 26px">
                               Nom Task : {{$task->name}}
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
                              @foreach ($task->users()->get() as $user)
                              <label class="font-semibold uppercase text-xl text-gray-800">Nom de Department :</label>

                                    <span>
                                        @foreach ($user->departments()->get() as $dept)
                                        {{$dept->dptName}} 
                                        @endforeach
                                    </span><br>

                                  <label class="font-semibold uppercase text-xl text-gray-800">Nom user :</label>
                                 <span>
                                    {{$user->name}}
                                 </span><br>
                                 
                                 <label class="font-semibold uppercase text-xl text-gray-800">Nom de Group :</label>
                                 <span>
                                     @foreach ($user->groups()->get() as $group)
                                     {{$group->name}} 
                                     @endforeach
                                 </span><hr><br>

                              @endforeach
                            </div>
                            <div class="col-5">
                                <label class="font-semibold uppercase text-xl text-gray-1000">task :</label>
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
                                           </span><br>
                                       @endif
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

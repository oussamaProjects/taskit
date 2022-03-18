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
                                Department
                            </h3>
                            <h6 style="margin-left: 26px">
                                @foreach ($project->departments()->get() as $dept)
                                  {{$dept->dptName}}
                                @endforeach
                            
                            </h6>
                       </div>
                    </div>
                    {{-- @can('upload')
                        <button id="addTaskButton"
                            class="flex text-bg-color bg-secondary hover:text-main hover:bg-tertiary border py-2 px-6 text-tiny focus:outline-none transition hover:no-underline ml-2">
                            Ajouter un Task
                        </button>
                    @endcan --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-4 sm:grid-cols-4 lg:grid-cols-4 p-4 gap-4" >
        <div class="col-span-3" >
            <div class="flex flex-col text-center w-full px-2 pb-2 bg-white">
                <h1 class="sm:text-xl text-lg title-font my-2 text-gray-800 text-center p-2 uppercase">Project</h1>
                <div class="w-full">
                    <table class="table-auto w-full text-left bg-colorspace-no-wrap border bg-white px-2">
                        <thead>
                            <tr>
                                <th
                                    class="px-2 py-3 title-font tracking-wider font-medium text-bg-color text-sm bg-main shadow-sm">
                                    PROJECT
                                </th>
                                <th
                                   class="px-2 py-3 title-font tracking-wider font-medium text-bg-color text-sm bg-main shadow-sm">
                                   Name client
                                </th>
                                <th
                                    class="px-2 py-3 title-font tracking-wider font-medium text-bg-color text-sm bg-main shadow-sm">
                                    Name task
                                </th>
                                <th
                                    class="px-2 py-3 title-font tracking-wider font-medium text-bg-color text-sm bg-main shadow-sm">
                                    ASSIGNEES
                                </th>
                               </tr>
                        </thead>
                        <tbody>

                            {{-- @if ($project!=null)
                                @foreach ($project as $project) --}}
                                     <tr>

                                        <td class="px-2 py-3 text-sm">{{ $project->name }}</td>

                                        <td class="px-2 py-3 text-sm">
                                            @if (count($clients)>0)
                                               @foreach ($clients as $client)
                                                   @if ($client->id==$project->client_id)
                                                      {{$client->name}}
                                                   @endif
                                               @endforeach
                                            @endif
                                        </td>
                                        <td class="px-2 py-3 text-sm">
                                            <select>
                                               
                                                    @foreach ($project->tasks()->get() as $task)
                                                      <option>{{$task->name}}</option>
                                                    @endforeach
                                           
                                            </select>
                                        </td>
                                       
                                        <td class="px-2 py-3 text-sm"> 
                                            <!-- DELETE using link -->
                                             {!! Form::open(['action' => ['ProjectController@destroy', $project->id], 'method' => 'DELETE', 'id' => 'form-delete-users-' . $task->id, 'class' => 'flex']) !!}
                                            <a href="{{ route('task.destroy', $project->id) }}" class="left ">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('project.edit', $project->id) }}" class="center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('project.show', $project->id) }}"
                                                class="right data-delete" data-form="users-{{ $task->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </a>
                                            {!! Form::close() !!}
                                        </td>
                                    
                                    </tr> 
                                 
                                {{-- @endforeach
                            @else --}}
                              
                            {{-- @endif --}}

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      
    </div>

    @include('inc.sidebar-footer')

    {{-- @include('popups.addTask')
    @include('popups.scripts') --}}

@endsection

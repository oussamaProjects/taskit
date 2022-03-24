@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="grid grid-cols-1 lg:grid-cols-1 px-4 pt-4 pb-3 gap-4">
        <div class="relative flex flex-col break-words bg-white w-full shadow-sm rounded">
            <div class="rounded-t mb-0 px-0 border">
                <div class="flex flex-wrap items-center px-2 py-3">
                    <div class="relative w-full max-w-full flex-grow flex-1">
                        <h3 class="font-semibold uppercase text-xl text-gray-800">
                            Tasks
                        </h3>
                    </div>
                    @can('upload')
                        <button id="addTaskButton"
                            class="flex text-bg-color bg-secondary hover:bg-main border py-2 px-6 text-tiny focus:outline-none transition hover:no-underline ml-auto">
                            Ajouter un tasks
                        </button>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-row flex-wrap p-4 mb-4 mt-2 w-1/2">
        <div class="bg-white p-3 w-full">
        {!! Form::open(['action' => ['TaskController@update', $task->id], 'method' => 'PATCH', 'enctype' => 'multipart/form-data', 'class' => 'w-full']) !!}

        {{ csrf_field() }}

        <div class="mb-2 relative">
            <label for="name" >
                Current Name
            </label>
            {{ Form::text('name', $task->name, ['autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color','id' => 'name']) }}

        </div>

        <div class="mb-2 relative">
            <label for="name" >
                Current start time
            </label>
            {{ Form::time('start_time', $task->start_time, ['autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color','id' => 'name']) }}

        </div>

        <div class="mb-2 relative">
            <label for="name" >
                Current end time
            </label>
            {{ Form::time('end_time', $task->end_time, ['autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color','id' => 'name']) }}

        </div>

        <div class="mb-2 relative">
            <label for="email" >
                Current estimate time
            </label>
            {{ Form::number('estimate_time', $task->estimate_time, ['class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color','id' => 'address']) }}
        </div>
      
        <div class="mb-2 relative">
            <label > Users : </label>
        <select class="peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color">
           @foreach ($task->users()->get() as $user)
              
                    @if ($user->name!=null)
                       <option value="{{$user->id}}">{{$user->name}} </option>
                     @endif

            @endforeach
        </select><br>
           <label >Current user :</label>

                 @foreach ($users as $user)
                <input type="checkbox" name="user_id[]" value="{{$user->id}} ">
                <label class="text-xs opacity-75 scale-75">{{ $user->name }} </label> 
                 @endforeach
        </div>

        <div class="mb-2 relative">
            <label > Projects : </label>
        <select class="peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color">
           @foreach ($task->projects()->get() as $project)
              
                    @if ($project->name!=null)
                       <option value="{{$project->id}}">{{$project->name}} </option>
                     @endif

            @endforeach
        </select><br>
           <label >Current project :</label>

                 @foreach ($projects as $project)
                <input type="checkbox" name="project_id[]" value="{{$project->id}} ">
                <label class="text-xs opacity-75 scale-75"> {{ $project->name }} </label> 
                 @endforeach
        </div>

        <div class="mb-2 relative">
            <label > Tags : </label>
        <select class="peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color">
           @foreach ($task->categorys()->get() as $category)
              
                    @if ($category->name!=null)
                       <option value="{{$category->id}}"> {{$category->name}} </option>
                     @endif

            @endforeach
        </select><br>
           <label >Current catégory :</label>

                 @foreach ($categorys as $category)
                <input type="checkbox" name="category_id[]" value="{{$category->id}} "> 
                <label class="text-xs opacity-75 scale-75"> {{ $category->name }} </label>
                 @endforeach
        </div>

        <div class="mb-2 relative" class="text-xs opacity-75 scale-75">
            <label for="email" >
                 active
            </label>
            {{ Form::number('active', $task->active, ['class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color','id' => 'address']) }}
        </div>

        <div class="flex items-end justify-end mt-4">
            {{ Form::submit(' Sauvegarder', ['class' =>'flex text-bg-color bg-secondary hover:text-main hover:bg-tertiary border py-2 px-6 text-tiny focus:outline-none transition hover:no-underline ml-2']) }}
        </div>

        {!! Form::close() !!}
        </div>
        @include('inc.sidebar-footer')

        @include('popups.addTask')
        @include('popups.scripts')

      
    </div>
    @endsection

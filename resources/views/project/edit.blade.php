@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="grid grid-cols-1 lg:grid-cols-1 px-4 pt-4 pb-3 gap-4">
        <div class="relative flex flex-col break-words bg-white w-full shadow-sm rounded">
            <div class="rounded-t mb-0 px-0 border">
                <div class="flex flex-wrap items-center px-2 py-3">
                    <div class="relative w-full max-w-full flex-grow flex-1">
                        <h3 class="font-semibold uppercase text-xl text-gray-800">
                            Projects
                        </h3>
                    </div>
                    @can('upload')
                        <button id="addUprojectButton"
                            class="flex text-bg-color bg-secondary hover:bg-main border py-2 px-6 text-tiny focus:outline-none transition hover:no-underline ml-auto">
                            Ajouter un Project
                        </button>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-row flex-wrap p-4 mb-4 mt-2 w-1/2">
        <div class="bg-white p-3 w-full">

        {!! Form::open(['action' => ['ProjectController@update', $project->id], 'method' => 'PATCH', 'enctype' => 'multipart/form-data', 'class' => 'w-full']) !!}

        {{ csrf_field() }}

        <div class="mb-2 relative">
            <label for="name" >
                Name</label>
            {{ Form::text('name', $project->name, ['autocomplete' => 'off','id' => 'name','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color']) }}
        </div>

        <div class="mb-2 relative">
            <label for="description" >
                Description</label>
            {{ Form::text('description', $project->description, ['id' => 'description','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color']) }}
        </div>
        
       <div class="mb-2 relative">
            <label for="estimate_time" >
                Estimate time</label>
            {{ Form::number('estimate_time', $project->estimate_time, ['id' => 'estimate_time','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color']) }}
        </div>

        <div class="mb-2 relative">
            <label for="estimate_value" >
                Estimate value</label>
            {{ Form::number('estimate_value', $project->estimate_value, ['id' => 'estimate_value','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color']) }}
        </div>

        
        <div class="mb-2 relative">
           <label>Client de project : </label>
               
                @if (count($clients) > 0)
                    @foreach ($clients as $client)
                        @if ($client->id == $project->client_id)
                        <label class="text-xs opacity-75 scale-75">{{$client->name}}</label>  <input type="checkbox" value="{{$client->id}}" checked>
                        @endif
                    @endforeach

                    <br><label>Attribuer un client :</label>
                    <select name="client_id" class="peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color">
                        @foreach ($clients as $client)
                            <option value="{{$client->id}}">{{$client->name}}</option>
                        @endforeach
                    </select>
                 @endif
          
        </div>

        <div class="flex items-end justify-end mt-4  ">
            {{ Form::submit('Sauvegarder', ['class' =>'flex text-bg-color bg-secondary hover:text-main hover:bg-tertiary border py-2 px-6 text-tiny focus:outline-none transition hover:no-underline ml-2']) }}
        </div>
        
        {!! Form::close() !!}
    </div>

        @include('inc.sidebar-footer')

        @include('popups.addProject')
        @include('popups.scripts')

    @endsection

@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="grid grid-cols-1 lg:grid-cols-1 px-4 pt-4 pb-3 gap-4">
        <div class="relative flex flex-col break-words bg-white w-full shadow-sm rounded">
            <div class="rounded-t mb-0 px-0 border">
                <div class="flex flex-wrap items-center px-2 py-3">
                    <div class="relative w-full max-w-full flex-grow flex-1">
                        <h3 class="font-semibold uppercase text-xl text-gray-800">
                            Parametre
                        </h3>
                    </div>
                    @can('upload')
                        <button id="addUparametreButton"
                            class="flex text-bg-color bg-secondary hover:bg-main border py-2 px-6 text-tiny focus:outline-none transition hover:no-underline ml-auto">
                            Ajouter un parametre
                        </button>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-row flex-wrap p-4 mb-4 mt-2 w-1/2">
        <div class="bg-white p-3 w-full">

        {!! Form::open(['action' => ['ParametreController@update', $parametre->id], 'method' => 'PATCH', 'enctype' => 'multipart/form-data', 'class' => 'w-full']) !!}

        {{ csrf_field() }}

        <div class="mb-2 relative">
            <label for="name" class="text-xs opacity-75 scale-75">
                Name</label>
            {{ Form::text('name', $parametre->name, ['autocomplete' => 'off','id' => 'name','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color']) }}
        </div>

        <div class="mb-2 relative">
            <label for="value" class="text-xs opacity-75 scale-75">
                Value</label>
            {{ Form::text('value', $parametre->value, ['id' => 'description','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color']) }}
        </div>

        <div class="flex items-end justify-end mt-4  ">
            {{ Form::submit('Sauvegarder', ['class' =>'flex text-bg-color bg-secondary hover:text-main hover:bg-tertiary border py-2 px-6 text-tiny focus:outline-none transition hover:no-underline ml-2']) }}
        </div>
        
        {!! Form::close() !!}
    </div>

        @include('inc.sidebar-footer')

        @include('popups.addParametre')
        @include('popups.scripts')

    @endsection

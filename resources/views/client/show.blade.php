@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="grid grid-cols-1 lg:grid-cols-1 px-4 pt-4 pb-3 gap-4">
        <div class="relative flex flex-col break-words bg-white w-full shadow-sm rounded">
            <div class="rounded-t mb-0 px-0 border">
                <div class="flex flex-wrap items-center px-2 py-3">
                    <div class="relative w-full max-w-full flex-grow flex-1">
                        <h3 class="font-semibold uppercase text-xl text-gray-800">
                            Clients
                        </h3>
                    </div>
                    @can('upload')
                        <button id="addClientButton"
                            class="flex text-bg-color bg-secondary hover:bg-main border py-2 px-6 text-tiny focus:outline-none transition hover:no-underline ml-auto">
                            Ajouter un client
                        </button>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-row flex-wrap p-4 mb-4 mt-2 w-1/2">
        <div class="bg-white p-3 w-full">

        {!! Form::open(['action' => ['ClientController@show', $client->id], 'method' => 'PATCH', 'enctype' => 'multipart/form-data', 'class' => 'w-full']) !!}

        {{ csrf_field() }}

        <div class="mb-2 relative">
            <label for="name" class="text-xs opacity-75 scale-75"> Name</label>
            <p>{{$client->name}}</p>
        </div>

        <div class="mb-2 relative">
            <label for="name" class="text-xs opacity-75 scale-75"> Addresse</label>
            <p>{{$client->address}}</p>
        </div>

        
        {!! Form::close() !!}
    </div>

        @include('inc.sidebar-footer')

        @include('popups.addclient')
        @include('popups.scripts')

    @endsection
    {{-- <select name="user_id" id="role"
    class="peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color">
    <option value="" disabled selected>Attribuer un client</option>
    @if (count($clients) > 0)
        @foreach ($clients as $client)
            <option value="{{ $client->id }}" {{ $client->id == $project->client->id ? 'selected' : '' }}>
                {{ $client->name }}
            </option>
        @endforeach
    @endif
</select> --}}
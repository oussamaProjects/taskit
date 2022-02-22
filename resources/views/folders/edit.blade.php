@extends('layouts.app')

@section('content')
    @include('inc.sidebar')


    <div class="grid grid-cols-1 lg:grid-cols-1 p-4 gap-4">
        <div class="relative flex flex-col break-words bg-bg-color w-full shadow-sm rounded">
            <div class="rounded-t mb-0 px-0 border">
                <div class="flex flex-wrap items-center px-2 py-3">
                    <div class="relative w-full max-w-full flex-grow flex-1">
                        <h3 class="font-semibold uppercase text-xl text-gray-800 capitalize">
                            Mdifier le dossier
                        </h3>
                    </div>
                    @include('folders.inc.action-buttons')
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-3 sm:grid-cols-3 lg:grid-cols-3 p-4 gap-4">
        <div class="col-span-2">
            {!! Form::open(['action' => ['FolderController@update', $folder->id], 'method' => 'PATCH', 'class' => '']) !!}

            <div class="mb-8 relative">
                <label for="name" class="text-xs opacity-75 scale-75">Nom de dossier</label>
                {{ Form::text('name', $folder->name, ['id' => 'name','autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-10 text-sm']) }}
            </div>

            @include('inc.folders.autorisation', ['subs' => $subs])

            <div class="flex items-end justify-end mt-4">
                {{ Form::submit('Sauvegarder', ['class' =>'flex text-bg-color bg-secondary hover:bg-main border py-2 px-6 text-tiny focus:outline-none transition hover:no-underline ml-2']) }}
                {!! Form::close() !!}
            </div>

        </div>
        
        <div class="col-span-1">
            <button id="buttonmodalFolderImg" class="bg-bg-color h-auto p-4" type="button">
                <img src="{{ asset('img/undraw_Add_files_re_v09g.svg') }}" alt="">
            </button>
        </div>
    </div>
    
    @include('inc.sidebar-footer')

    @include('popups.addSubFolder')
    @include('popups.addFile')
    @include('popups.addFolder')
    @include('popups.scripts')
@endsection

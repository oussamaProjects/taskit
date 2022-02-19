@extends('layouts.app')

@section('content')
    @include('inc.sidebar')

    <div class="h-full ml-14 mt-14 mb-10 md:ml-64">

        <div class="grid grid-cols-1 lg:grid-cols-1">
            <div class="relative flex flex-col min-w-0 mb-2 break-words bg-bg-color w-full shadow rounded">
                <div class="rounded-t mb-0 px-0 border-0">
                    <div class="flex flex-wrap items-center px-4 py-4">
                        <div class="relative w-full max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-2xl text-gray-800 capitalize">
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
                    {{ Form::text('name', $folder->name, ['id' => 'name','autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm']) }}
                </div>

                @include('inc.autorisation', ['subs' => $subs])


                <div class="flex items-end justify-end">
                    {{ Form::submit('Sauvegarder', ['class' =>'flex text-bg-color bg-secondary hover:bg-main border-0 py-2 px-6 text-tiny focus:outline-none hover:bg-main ml-2']) }}
                    {!! Form::close() !!}
                </div>

            </div>
            <div class="col-span-1">
                <button id="buttonmodalFolderImg" class="bg-bg-color h-auto p-4 shadow" type="button">
                    <img src="{{ asset('img/undraw_Add_files_re_v09g.svg') }}" alt="">
                </button>
            </div>
        </div>

        @include('popups.addFile')
        @include('popups.addFolder')
        @include('popups.addSubFolder')
        @include('popups.scripts')
    @endsection

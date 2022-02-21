@extends('layouts.app')

@section('content')
    @include('inc.sidebar')

    @include('departments.inc.head')

    <div class="grid grid-cols-3 sm:grid-cols-3 lg:grid-cols-3 p-4 gap-4">
        <div class="col-span-2">

            <div class="flex items-center p-4 gap-4 bg-bg-color shadow">
                {!! Form::open(['action' => ['DepartmentsController@update', $dept->id], 'method' => 'PATCH', 'class' => 'w-full']) !!}
                <div class="mb-2 relative">
                    <label for="department" class="text-xs opacity-75 scale-75">Nom
                        du département</label>
                    {{ Form::text('dptName', $dept->dptName, ['autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm','id' => 'department']) }}
                </div>

                <div class="dept mb-4 flex flex-wrap items-start">

                    @foreach ($subsidiaries as $suds)
                        <div class="flex items-center mr-2 w-28">
                            {!! Form::radio('subs_id[]', $suds->id, null, ['id' => 'subs_' . $suds->id, 'class' => 'subs_id opacity-0 absolute']) !!}
                            <label for="subs_{{ $suds->id }}"
                                class="select-none inline-block text-sm font-medium text-bg-color bg-secondary hover:text-bg-color hover:bg-main transition text-center px-2 py-1 mb-1 rounded-sm w-30 cursor-pointer w-full">
                                {{ $suds->subsName }} <br />
                            </label>
                        </div>
                    @endforeach

                </div>
                <div class="flex items-end justify-end">
                    {{ Form::submit('Sauvegarder', ['class' =>'flex text-bg-color bg-secondary hover:bg-main border-0 py-2 px-6 text-tiny focus:outline-none transition hover:bg-main ml-2']) }}
                </div>
                {!! Form::close() !!}

            </div>
        </div>

        <button id="addDeptButtonFileImg" class="bg-bg-color h-auto p-4" type="button">
            <img src="{{ asset('img/undraw_Add_files_re_v09g.svg') }}" alt="">
        </button>
    </div>

    @include('inc.sidebar-footer')

    @include('popups.addDept')
    @include('popups.scripts')
@endsection

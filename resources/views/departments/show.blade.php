@extends('layouts.app')

@section('content')
    @include('inc.sidebar')

    @include('departments.inc.head')

    <div class="grid grid-cols-3 sm:grid-cols-3 lg:grid-cols-3 p-4 gap-4">
        <div class="col-span-2">

            <div class="flex items-center p-4 gap-4 bg-bg-color shadow-sm">
              
                <div class="mb-2 relative">
                    <label for="department" class="text-xs opacity-75 scale-75">Nom
                        du département</label>
                    {{ Form::text('dptName', $department->dptName, ['autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color','id' => 'department']) }}
                </div>
                {{dd($department->projects()->get())}}
                <div class="mb-2 relative">
                    <label for="department" class="text-xs opacity-75 scale-75">Nom du Project</label>
                 @foreach ($department->projects()->get() as $project)
                        <select name="" class='peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color'>
                            <option value="{{$project->id}}">{{$project->name}}</option>
                        </select>
                  
                 
                </div>
                <div class="mb-2 relative">
              
                    <label for="department" class="text-xs opacity-75 scale-75">Color</label>
                    <select name="" class='peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color'>
                        {{-- @foreach ($project->tasks()->get() as $task) --}}
                         
                             <option value="{{$project->id}}">{{$project->color}}</option>
                       
                        {{-- @endforeach --}}
                    </select>
                </div>

                @endforeach
                {{-- <div class="dept mb-4 flex flex-wrap items-start">

                    @foreach ($subsidiaries as $suds)
                        <div class="flex items-center mr-2 w-28">
                            {!! Form::radio('subs_id[]', $suds->id, null, ['id' => 'subs_' . $suds->id, 'class' => 'subs_id opacity-0 absolute']) !!}
                            <label for="subs_{{ $suds->id }}"
                                class="select-none inline-block text-xs font-light text-bg-color bg-secondary hover:text-main hover:bg-tertiary transition text-center px-2 py-1 rounded-sm w-32 cursor-pointer w-full">
                                {{ $suds->subsName }} <br />
                            </label>
                        </div>
                    @endforeach

                </div> --}}
                <div class="flex items-end justify-end mt-4">
                    {{ Form::submit('Sauvegarder', ['class' =>'flex text-bg-color bg-secondary hover:text-main hover:bg-tertiary border py-2 px-6 text-tiny focus:outline-none transition hover:no-underline ml-2']) }}
                </div>
                {!! Form::close() !!}

            </div>
        </div>

        {{-- <button id="addDeptButtonFileImg" class="bg-white h-auto p-4" type="button">
            <img src="{{ asset('img/undraw_Add_files_re_v09g.svg') }}" alt="">
        </button> --}}
    </div>

    @include('inc.sidebar-footer')

    {{-- @include('popups.addDept') --}}
    @include('popups.scripts')
@endsection

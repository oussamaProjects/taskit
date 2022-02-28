@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    @include('subsidiaries.inc.head')

    <div class="grid grid-cols-3 sm:grid-cols-3 lg:grid-cols-3 p-4 gap-4">
        <div class="col-span-2">
            {{-- {{ dd($subs->departments()->get()) }} --}}
            <div class="flex items-center p-4 gap-4 bg-bg-color shadow-sm">
                {!! Form::open(['action' => ['SubsidiaryController@update', $subs->id], 'method' => 'PATCH', 'class' => 'w-full']) !!}
                <div class="mb-2 relative">
                    <label for="department" class="text-xs opacity-75 scale-75">Nom
                        du filiale</label>
                    {{ Form::text('subsName', $subs->subsName, ['autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color','id' => 'department']) }}
                </div>
                <div class="flex items-end justify-end mt-4">

                    {{ Form::submit(' Sauvegarder', ['class' =>'flex text-bg-color bg-secondary hover:text-main hover:bg-tertiary border py-2 px-6 text-tiny focus:outline-none transition hover:no-underline ml-2']) }}
                </div>
                {!! Form::close() !!}

            </div>

            <div class="flex items-center p-4 gap-4 bg-bg-color shadow-sm">
                {!! Form::open(['action' => 'DepartmentsController@store', 'method' => 'POST', 'class' => 'w-full']) !!}
                <div class="mb-2 relative">
                    <label for="dptName" class="text-xs opacity-75 scale-75">Nom
                        du département</label>
                    {{ Form::text('dptName', '', ['autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color','id' => 'dptName']) }}
                </div>

                {!! Form::hidden('subs_id', $subs->id) !!}
                <div class="flex items-end justify-end mt-4">

                    {{ Form::submit('Sauvegarder', ['class' =>'flex text-bg-color bg-secondary hover:text-main hover:bg-tertiary border py-2 px-6 text-tiny focus:outline-none transition hover:no-underline ml-2']) }}
                </div>
                {!! Form::close() !!}
            </div>


            <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 p-4 gap-4 mt-4 bg-bg-color shadow-sm">
                <div class="flex flex-col text-center w-full px-2 pb-2 bg-white">
                    <h1 class="sm:text-xl text-lg title-font my-2 text-gray-800 text-center p-2 uppercase">Départements</h1>
                    <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Tous les départements
                    </p>
                </div>
                <div class="w-full">
                    <table class="table-auto w-full text-left bg-colorspace-no-wrap border bg-white px-2">
                        <thead>
                            <tr>
                                <th
                                    class="px-2 py-2 title-font tracking-wider font-medium text-bg-color text-base bg-main shadow-sm">
                                    Name
                                </th>

                                <th
                                    class="px-2 py-2 title-font tracking-wider font-medium text-bg-color text-base bg-main shadow-sm">
                                    Filias
                                </th>
                                <th
                                    class="px-2 py-2 title-font tracking-wider font-medium text-bg-color text-base bg-main shadow-sm">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (count($departments) > 0)
                                @foreach ($departments as $dept)
                                    <tr>
                                        <td class="px-2 py-3 text-sm">{{ $dept->dptName }}</td>
                                        <td class="px-2 py-3 text-sm">
                                            @foreach ($dept->subsidiaries()->get() as $suds)
                                                {{ $suds->subsName }} <br />
                                            @endforeach
                                        </td>
                                        <td class="px-2 py-3 text-sm">
                                            <!-- DELETE using link -->
                                            {!! Form::open(['action' => ['DepartmentsController@destroy', $dept->id], 'method' => 'DELETE', 'id' => 'form-delete-departments-' . $dept->id, 'class' => 'flex']) !!}
                                            <a href="#" class="left"><i class="material-icons"></i></a>
                                            <a href="/departments/{{ $dept->id }}/edit" class="center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <a href="" class="right data-delete"
                                                data-form="departments-{{ $dept->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </a>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2">
                                        <h5 class="p-4 text-center">No Department has been added</h5>
                                    </td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <button id="addSubsButtonImg" class="bg-white h-auto p-4" type="button">
            <img src="{{ asset('img/undraw_Add_files_re_v09g.svg') }}" alt="">
        </button>
    </div>

    @include('inc.sidebar-footer')

    @include('popups.addSubs')
    @include('popups.scripts')

@endsection

@extends('layouts.app')

@section('content')

    @include('inc.sidebar')
 
        <div class="grid grid-cols-1 lg:grid-cols-1 p-4 gap-4">
            <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-bg-color w-full shadow-md rounded">
                <div class="rounded-t mb-0 px-0 border-0">
                    <div class="flex flex-wrap items-center px-4 py-2">
                        <div class="relative w-full max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-gray-800 ">
                                Demandes d'enregistrement de compte
                            </h3>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-3 sm:grid-cols-3 lg:grid-cols-3 p-4 gap-4">
            <div class="col-span-2">

                <div class="flex items-center flex-col p-4 gap-4 bg-bg-color">

                    @if (count($users) > 0)
                        @foreach ($users as $user)
                            <div class="grid grid-cols-4 sm:grid-cols-4 lg:grid-cols-4 ml-4 p-4 gap-4 bg-bg-color shadow border-b-2 border-fuchsia-600">

                                <div class="col-span-2">
                                    <p>Hi, I am <b>{{ $user->name }}</b> , my email is <b>{{ $user->email }}</b>.
                                        <br>and I want to be one of the system users who belongs to the department of
                                        @foreach ($user->departments()->get() as $dept)
                                            <b>{{ $dept['dptName'] }}</b>.
                                        @endforeach
                                    </p>
                                </div>

                                <div class="ml-auto">
                                    <p class="text-secondary">{{ $user->created_at->diffForHumans() }}</p>
                                </div>

                                <div class="flex ml-8">
                                    <div class="mr-4">
                                        {!! Form::open(['action' => ['RequestsController@update', $user->id], 'method' => 'PATCH']) !!}
                                        {{ csrf_field() }}
                                        <button type="submit" name="role" value="admin">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1 text-secondary"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span class="text-xs text-secondary">Admin</span>
                                        </button>
                                        <button type="submit" name="role" value="user">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-2 m-1 text-secondary"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            User
                                        </button>
                                        {!! Form::close() !!}
                                    </div>
                                    <div>
                                        {!! Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'DELETE']) !!}
                                        {{ csrf_field() }}
                                        <button type="submit" name="b2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1 text-amber"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                        {!! Form::close() !!}
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @else
                        Aucune inscription n'a été demandée
                    @endif
                </div>
            </div>

            <button id="buttonmodalFileImg" class="bg-bg-color h-auto p-4" type="button">
                <img src="{{ asset('img/undraw_Add_files_re_v09g.svg') }}" alt="">
            </button>
        </div>
        @include('inc.sidebar-footer')


@endsection

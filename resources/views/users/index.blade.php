@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="ml-14 mt-14 md:ml-64">
        <!-- Statistics Cards -->
        <div class="flex p-4 gap-4">

            <form action="/search" method="post" id="search-form"
                class="bg-white   flex items-center w-full max-w-xl  4 p-2">
                {{ csrf_field() }}
                <button class="outline-none focus:outline-none">
                    <svg class="w-5 text-gray-600 h-5 cursor-pointer" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
                <input type="text" name="search" id="search" placeholder="Search Here ..."
                    class="w-full pl-3 text-sm text-black outline-none focus:outline-none bg-transparent" />
            </form>

            <button id="buttonmodal" class="focus:outline-none py-2 px-4 bg-blue-600 text-white bg-opacity-75 ml-auto">
                Add New
            </button>

            @can('upload')
            @endcan

        </div>
    </div>

    <div class="ml-14 mb-4 md:ml-64">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 p-4 gap-4">
            <div class="flex flex-col text-center w-full mb-6">
                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">Users</h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">All users
                </p>
            </div>
            <div class="w-full overflow-auto">
                <table class="table-auto w-full text-left whitespace-no-wrap">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                Name
                            </th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                Role
                            </th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                Department
                            </th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (count($users) > 0)
                            @foreach ($users as $user)
                                @if (!$user->hasRole('Root'))
                                    <tr>
                                        <td class="px-4 py-3">{{ $user->name }}</td>
                                        <td class="px-4 py-3">{{ $user->roles()->pluck('name')->implode(' ') }}</td>
                                        <td class="px-4 py-3">{{ $user->department['dptName'] }}</td>
                                        <td class="px-4 py-3">
                                            <!-- DELETE using link -->
                                            {!! Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'DELETE', 'id' => 'form-delete-users-' . $user->id, 'class' => 'flex']) !!}
                                            <a href="#" class="left">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <a href="/users/{{ $user->id }}/edit" class="center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <a href="" class="right data-delete" data-form="users-{{ $user->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </a>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">
                                    <h5 class="teal-text">No User has been added</h5>
                                </td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div id="modal"
        class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-blue-500 bg-opacity-50 transform scale-0 transition-transform duration-300">
        <div class="bg-white w-1/2 p-12">
            <button id="closebutton" type="button" class="focus:outline-none float-right">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
            <div>
                <h2 class="text-gray-900 text-xl mb-1 font-medium title-font">Add User</h2>


                <div class="mb-5 relative">
                    <label for="name" class="leading-7 text-sm text-gray-600"> Name</label>
                    {{ Form::text('name', '', ['id' => 'name', 'class' => 'w-full bg-gray-100 bg-opacity-50 border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out']) }}

                </div>


                <div class="mb-5 relative">
                    <label for="email" class="leading-7 text-sm text-gray-600"> Name</label>
                    {{ Form::email('email', '', ['id' => 'email', 'class' => 'w-full bg-gray-100 bg-opacity-50 border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out']) }}
                    <label for="email">Email Address</label>
                </div>



                <div class="mb-5 relative">
                    <label for="email" class="leading-7 text-sm text-gray-600">Department</label>
                    <select name="department_id" id="department_id">
                        <option value="" disabled selected>Choose Department</option>
                        @if (count($depts) > 0)
                            @if (Auth::user()->hasRole('Root'))
                                @foreach ($depts as $dept)
                                    <option value="{{ $dept->id }}">{{ $dept->dptName }}</option>
                                @endforeach
                            @elseif(Auth::user()->hasRole('Admin'))
                                <option value="{{ Auth::user()->department_id }}">
                                    {{ Auth::user()->department['dptName'] }}</option>
                            @endif
                        @endif
                    </select>
                </div>

                <div class="mb-5 relative">
                    <label for="email" class="leading-7 text-sm text-gray-600">Role</label>
                    <select name="role" id="role">
                        <option value="" disabled selected>Assign Role</option>
                        @if (count($roles) > 0)
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>


                <div class="mb-5 relative">
                    <label for="password">Password</label>
                    {{ Form::password('password', ['id' => 'password', 'class' => 'w-full bg-gray-100 bg-opacity-50 border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out']) }}
                </div>

                <div class="mb-5 relative">
                    <label for="password-confirm">Confirm Password</label>
                    {{ Form::password('password_confirmation', ['id' => 'password-confirm', 'class' => 'w-full bg-gray-100 bg-opacity-50 border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out']) }}
                </div>

            </div>
        </div>
        <div class="flex">
            {{ Form::submit('submit', ['class' => 'focus:outline-none py-2 px-4 bg-blue-600 text-white bg-opacity-75 ml-auto']) }}
        </div>
        {!! Form::close() !!}
    </div>


    <script>
        const button = document.getElementById('buttonmodal')
        const closebutton = document.getElementById('closebutton')
        const modal = document.getElementById('modal')

        button.addEventListener('click', () => modal.classList.add('scale-100'))
        closebutton.addEventListener('click', () => modal.classList.remove('scale-100'))

    </script>
@endsection

@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="h-full ml-14 mt-14 mb-10 md:ml-64">
        <div class="grid grid-cols-1 lg:grid-cols-1 p-4 gap-4">
            <div
                class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
                <div class="rounded-t mb-0 px-0 border-0">
                    <div class="flex flex-wrap items-center px-4 py-2">
                        <div class="relative w-full max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">
                                Categories
                            </h3>
                        </div>
                        <div class="relative w-full max-w-full flex-grow flex-1 text-right">
                            <button
                                class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase px-3 py-2 rounded-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                type="button">Ajouter un nouveau</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
            <div class="relative py-3 w-11/12 max-w-xl sm:mx-auto">
                <div class="relative p-8 bg-white shadow-sm  ">
                    {!! Form::open(['action' => ['UsersController@update', $user->id], 'method' => 'PATCH', 'enctype' => 'multipart/form-data', 'class' => 'col s12']) !!}

                    {{ csrf_field() }}

                    <div class="mb-5 relative">
                        {{ Form::text('name', $user->name, ['class' => 'peer pt-8 border border-gray-200 focus:outline-none rounded-md focus:border-gray-500 focus:shadow-sm w-full p-3 h-16 placeholder-transparent', 'id' => 'name']) }}
                        <label for="name"
                            class="peer-placeholder-shown:opacity-100 opacity-75 peer-focus:opacity-75 peer-placeholder-shown:scale-100 scale-75 peer-focus:scale-75 peer-placeholder-shown:translate-y-0 -translate-y-3 peer-focus:-translate-y-3 peer-placeholder-shown:translate-x-0 translate-x-1 peer-focus:translate-x-1 absolute top-0 left-0 px-3 py-5 h-full pointer-events-none transform origin-left transition-all duration-100 ease-in-out">
                            Current Name
                        </label>
                    </div>

                    <div class="mb-5 relative">
                        {{ Form::email('email', $user->email, ['class' => 'peer pt-8 border border-gray-200 focus:outline-none rounded-md focus:border-gray-500 focus:shadow-sm w-full p-3 h-16 placeholder-transparent', 'id' => 'email']) }}
                        <label for="email"
                            class="peer-placeholder-shown:opacity-100 opacity-75 peer-focus:opacity-75 peer-placeholder-shown:scale-100 scale-75 peer-focus:scale-75 peer-placeholder-shown:translate-y-0 -translate-y-3 peer-focus:-translate-y-3 peer-placeholder-shown:translate-x-0 translate-x-1 peer-focus:translate-x-1 absolute top-0 left-0 px-3 py-5 h-full pointer-events-none transform origin-left transition-all duration-100 ease-in-out">
                            Current Email Address
                        </label>
                    </div>

                    <div class="mb-5 relative">
                        <select name="department_id" id="department_id">
                            @if (count($depts) > 0)
                                @if (Auth::user()->hasRole('Root'))
                                    @foreach ($depts as $dept)
                                        <option value="{{ $dept->id }}"
                                            {{ $user->department['id'] == $dept->id ? 'selected' : '' }}>
                                            {{ $dept->dptName }}</option>
                                    @endforeach
                                @elseif(Auth::user()->hasRole('Admin'))
                                    <option value="{{ Auth::user()->department_id }}">
                                        {{ Auth::user()->department['dptName'] }}</option>
                                @endif
                            @endif
                        </select>
                        <label for="department_id" class="blue-text">Current Department</label>
                    </div>

                    <div class="mb-5 relative">
                        <select name="role" id="role">
                            <option value="" disabled selected>Assign Role</option>
                            @if (count($roles) > 0)
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}"
                                        {{ $user->roles->pluck('name')->implode(' ') === $role->name ? 'selected' : '' }}>
                                        {{ $role->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <label for="role" class="blue-text">Current Role</label>
                    </div>

                    <!-- Switch -->
                    <div class="mb-5 relative">
                        <h5>Account</h5>
                        <label>
                            @if ($user->status)
                                Disable
                                {{ Form::checkbox('status', '', true) }}
                                <span class="lever"></span>
                                Enabled
                            @else
                                Disabled
                                {{ Form::checkbox('status', '') }}
                                <span class="lever"></span>
                                Enable
                            @endif
                        </label>
                    </div>

                    <div class="mb-5 relative">
                        <p><a href="#modal1" id="buttonmodal" data-target="modal1" class="modal-trigger">Change Password
                                ?</a></p>
                    </div>

                    <div class="mb-5 relative">
                        {{ Form::submit('Save Changes', ['class' => 'w-full bg-indigo-600 text-white p-3 rounded-md']) }}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div id="modal"
        class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-blue-500 bg-opacity-50 transform scale-0 transition-transform duration-300">
        <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border border-gray-300 shadow-xl">
            <div id="closebutton"
                class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
                <p class="font-semibold text-gray-800">Ajouter un dossier</p>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </div>
            <div class="flex flex-col px-6 py-5 bg-gray-50">
                {!! Form::open(['action' => 'ProfileController@changePassword', 'method' => 'PATCH']) !!}
                {{ csrf_field() }}

                <h4>Change Password</h4>

                <div class="mb-5 relative">
                    {{ Form::password('current_password', ['id' => 'current_password', 'class' => 'peer pt-8 border border-gray-200 focus:outline-none rounded-md focus:border-gray-500 focus:shadow-sm w-full p-3 h-16 placeholder-transparent']) }}
                    <label for="current_password"
                        class="peer-placeholder-shown:opacity-100 opacity-75 peer-focus:opacity-75 peer-placeholder-shown:scale-100 scale-75 peer-focus:scale-75 peer-placeholder-shown:translate-y-0 -translate-y-3 peer-focus:-translate-y-3 peer-placeholder-shown:translate-x-0 translate-x-1 peer-focus:translate-x-1 absolute top-0 left-0 px-3 py-5 h-full pointer-events-none transform origin-left transition-all duration-100 ease-in-out">
                        Current Password
                    </label>
                    @if ($errors->has('current_password'))
                        <span class="red-text"><strong>{{ $errors->first('current_password') }}</strong></span>
                    @endif
                </div>
                <div class="mb-5 relative">
                    {{ Form::password('new_password', ['id' => 'new_password', 'class' => 'peer pt-8 border border-gray-200 focus:outline-none rounded-md focus:border-gray-500 focus:shadow-sm w-full p-3 h-16 placeholder-transparent']) }}
                    <label for="new_password"
                        class="peer-placeholder-shown:opacity-100 opacity-75 peer-focus:opacity-75 peer-placeholder-shown:scale-100 scale-75 peer-focus:scale-75 peer-placeholder-shown:translate-y-0 -translate-y-3 peer-focus:-translate-y-3 peer-placeholder-shown:translate-x-0 translate-x-1 peer-focus:translate-x-1 absolute top-0 left-0 px-3 py-5 h-full pointer-events-none transform origin-left transition-all duration-100 ease-in-out">
                        New Password
                    </label>
                    @if ($errors->has('new_password'))
                        <span class="red-text"><strong>{{ $errors->first('new_password') }}</strong></span>
                    @endif
                </div>
                <div class="mb-5 relative">
                    {{ Form::password('new_password_confirmation', ['id' => 'new_password_confirmation', 'class' => 'peer pt-8 border border-gray-200 focus:outline-none rounded-md focus:border-gray-500 focus:shadow-sm w-full p-3 h-16 placeholder-transparent']) }}
                    <label for="name"
                        class="peer-placeholder-shown:opacity-100 opacity-75 peer-focus:opacity-75 peer-placeholder-shown:scale-100 scale-75 peer-focus:scale-75 peer-placeholder-shown:translate-y-0 -translate-y-3 peer-focus:-translate-y-3 peer-placeholder-shown:translate-x-0 translate-x-1 peer-focus:translate-x-1 absolute top-0 left-0 px-3 py-5 h-full pointer-events-none transform origin-left transition-all duration-100 ease-in-out">
                        Nom de dossier
                    </label>
                    @if ($errors->has('new_password_confirmation'))
                        <span class="red-text"><strong>{{ $errors->first('new_password_confirmation') }}</strong></span>
                    @endif
                </div>
                {{ Form::submit('Sauvegarder les modifications', ['class' => 'w-full bg-indigo-600 text-white p-3 rounded-md']) }}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <script>
        const button = document.getElementById('buttonmodal')
        const closebutton = document.getElementById('closebutton')
        const modal = document.getElementById('modal')

        button.addEventListener('click', () => modal.classList.add('scale-100'))
        closebutton.addEventListener('click', () => modal.classList.remove('scale-100'))
    </script>


@endsection

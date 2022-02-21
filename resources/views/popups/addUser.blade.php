<div id="modalUser"
    class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-main bg-opacity-50 transform scale-0 transition-transform duration-300">

    <div class="h-1/2 w-1/2 bg-bg-color overflow-y-scrollborder-1 border-main shadow-md rounded-sm flex flex-col items-stretch justify-center relative">

        <button id="closebuttonUser" type="button" class="focus:outline-none float-right">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 m-1 absolute top-3 right-3" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </button>
        
        <div class="overflow-y-scroll py-4 px-8">
            <h2 class="text-gray-800 text-xl mb-2 font-medium title-font">
                Ajouter un utilisateur
            </h2>

            {!! Form::open(['action' => 'UsersController@store', 'method' => 'POST', 'class' => '']) !!}

            <div class="mb-2 relative">
                <label for="name" class="text-xs opacity-75 scale-75">
                    Nom</label>
                {{ Form::text('name', '', ['autocomplete' => 'off','id' => 'name','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm']) }}
            </div>

            <div class="mb-2 relative">
                <label for="email" class="text-xs opacity-75 scale-75">
                    Adresse e-mail</label>
                {{ Form::email('email', '', ['id' => 'email','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm']) }}
            </div>

            <div class="mb-2 relative">
                <label for="email" class="text-xs opacity-75 scale-75">Department</label>
                <select name="department_id" id="department_id"
                    class="peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm">
                    <option value="" disabled selected>Choisissez le département</option>
                    @if (count($depts) > 0)
                        @if (Auth::user()->hasRole('Root'))
                            @foreach ($depts as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->dptName }}</option>
                            @endforeach
                        @elseif(Auth::user()->hasRole('Admin'))
                            <option value="{{ Auth::user()->department_id }}">
                                {{ Auth::user()->departments()->get() }}
                            </option>
                        @endif
                    @endif
                </select>
            </div>

            <div class="mb-2 relative">
                <label for="email" class="text-xs opacity-75 scale-75">Role</label>
                <select name="role" id="role"
                    class="peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm">
                    <option value="" disabled selected>Attribuer un rôle</option>
                    @if (count($roles) > 0)
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="mb-2 relative">
                <label for="password" class="text-xs opacity-75 scale-75">Password</label>
                {{ Form::password('password', ['id' => 'password','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm']) }}
            </div>

            <div class="mb-2 relative">
                <label for="password-confirm" class="text-xs opacity-75 scale-75">Confirm
                    Mot de passe
                </label>
                {{ Form::password('password_confirmation', ['id' => 'password-confirm','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm']) }}
            </div>

            <div class="flex items-end justify-end  ">
                {{ Form::submit('Sauvegarder', ['class' =>'flex text-bg-color bg-secondary hover:bg-main border-0 py-2 px-6 text-tiny focus:outline-none transition hover:bg-main ml-2']) }}
            </div>

            {!! Form::close() !!}

        </div>
    </div>

</div>

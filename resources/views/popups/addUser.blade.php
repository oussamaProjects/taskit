<div id="modalUser"
    class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-main bg-opacity-50 transform scale-0 transition-transform duration-300">

    <div class="max-h-2/3 w-1/2 bg-bg-color overflow-y-scrollborder-1 border-main shadow-sm rounded-sm flex flex-col items-stretch justify-center relative">

        <button id="closebuttonUser" type="button" class="focus:outline-none float-right">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 m-1 absolute top-3 right-3"  viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M5.72 5.72a.75.75 0 011.06 0L12 10.94l5.22-5.22a.75.75 0 111.06 1.06L13.06 12l5.22 5.22a.75.75 0 11-1.06 1.06L12 13.06l-5.22 5.22a.75.75 0 01-1.06-1.06L10.94 12 5.72 6.78a.75.75 0 010-1.06z"></path></svg>
        </button>
        
        <div class="overflow-y-scroll py-4 px-8">
            <h2 class="text-gray-800 text-xl mb-2 font-medium title-font">
                Ajouter un utilisateur
            </h2>

            {!! Form::open(['action' => 'UsersController@store', 'method' => 'POST', 'class' => '']) !!}

            <div class="mb-2 relative">
                <label for="name" class="text-xs opacity-75 scale-75">
                    Nom</label>
                {{ Form::text('name', '', ['autocomplete' => 'off','id' => 'name','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color']) }}
            </div>

            <div class="mb-2 relative">
                <label for="email" class="text-xs opacity-75 scale-75">
                    Adresse e-mail</label>
                {{ Form::email('email', '', ['id' => 'email','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color']) }}
            </div>

            {{-- <div class="mb-2 relative">
                <label for="email" class="text-xs opacity-75 scale-75">Filiale</label>
                <select name="filiale_id"  class="peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color">
                   @if (count($filiale)>0)
                   <option value="" >Attribuer un filiale</option>
                        @foreach ($filiale as $filial)
                            <option value="{{$filial->id}}" >{{$filial->name}}</option>
                        @endforeach
                   @endif
                </select>
            </div> --}}

            <div class="mb-2 relative">
                <label for="">les departments</label><br>
                @foreach ($depts as $dept)
                  <input type="checkbox" name="department_id[]" value="{{$dept->id}}">
                  <label class="text-xs opacity-75 scale-75">{{$dept->dptName}}</label>
                @endforeach
            </div>

            <div class="mb-2 relative">
                <label for="">les groups</label><br>
                @foreach ($groups as $group)
                  <input type="checkbox" name="group_id[]" value="{{$group->id}}">
                  <label class="text-xs opacity-75 scale-75">{{$group->name}}</label>
                @endforeach
            </div>

            <div class="mb-2 relative">
                <label for="">les tasks</label><br>
                        @foreach ($tasks as $task)
                          <input type="checkbox" name="task_id[]" value="{{$task->id}}">
                          <label class="text-xs opacity-75 scale-75">{{$task->name}}</label>
                        @endforeach
            </div>

            <div class="mb-2 relative">
                <label for="password" class="text-xs opacity-75 scale-75">Password</label>
                {{ Form::password('password', ['id' => 'password','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color']) }}
            </div>

            <div class="mb-2 relative">
                <label for="password-confirm" class="text-xs opacity-75 scale-75">Confirm
                    Mot de passe
                </label>
                {{ Form::password('password_confirmation', ['id' => 'password-confirm','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color']) }}
            </div>

            <div class="flex items-end justify-end mt-4  ">
                {{ Form::submit('Sauvegarder', ['class' =>'flex text-bg-color bg-secondary hover:text-main hover:bg-tertiary border py-2 px-6 text-tiny focus:outline-none transition hover:no-underline ml-2']) }}
            </div>

            {!! Form::close() !!}

        </div>
    </div>

</div>

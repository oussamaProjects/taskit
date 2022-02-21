<div id="modalchangePassword"
    class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-main bg-opacity-50 transform scale-0 transition-transform duration-300">

    <div
        class="h-1/2 w-1/2 bg-bg-color overflow-y-scrollborder-1 border-main shadow-md rounded-sm flex flex-col items-stretch justify-center relative">

        <button id="closebuttonchangePassword" type="button" class="focus:outline-none float-right">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 m-1 absolute top-3 right-3" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </button>

        <div class="overflow-y-scroll py-4 px-8">
            {!! Form::open(['action' => 'ProfileController@changePassword', 'method' => 'PATCH']) !!}
            {{ csrf_field() }}
            <h2 class="text-gray-800 text-xl mb-2 font-medium title-font">Changer le mot de passe</h2>
            <div class="mb-2">
                {{ Form::password('current_password', ['id' => 'current_password','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm']) }}
                <label for="current_password" class="text-xs opacity-75 scale-75">Mot de passe actuel</label>
                @if ($errors->has('current_password'))
                    <span class="text-amber text-xs">{{ $errors->first('current_password') }}</span>
                @endif
            </div>
            <div class="mb-2">
                {{ Form::password('new_password', ['id' => 'new_password','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm']) }}
                <label for="new_password" class="text-xs opacity-75 scale-75">Nouveau mot de passe</label>
                @if ($errors->has('new_password'))
                    <span class="text-amber text-xs">{{ $errors->first('new_password') }}</span>
                @endif
            </div>
            <div class="mb-2">
                {{ Form::password('new_password_confirmation', ['id' => 'new_password_confirmation','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm']) }}
                <label for="new_password_confirmation" class="text-xs opacity-75 scale-75">Confirmez le mot de
                    passe</label>
                @if ($errors->has('new_password_confirmation'))
                    <span class="text-amber text-xs">{{ $errors->first('new_password_confirmation') }}</span>
                @endif
            </div>

        </div>
        <div class="flex items-end justify-end">
            {{ Form::submit(' Sauvegarder', ['class' =>'flex text-bg-color bg-secondary hover:bg-main border-0 py-2 px-6 text-tiny focus:outline-none transition hover:bg-main ml-2 ml-auto']) }}
        </div>
        {!! Form::close() !!}
    </div>
</div>

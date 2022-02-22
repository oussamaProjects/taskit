<div id="modalchangePassword"
    class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-main bg-opacity-50 transform scale-0 transition-transform duration-300">

    <div
        class="max-h-full w-1/2 bg-bg-color overflow-y-scrollborder-1 border-main shadow-sm rounded-sm flex flex-col items-stretch justify-center relative">

        <button id="closebuttonchangePassword" type="button" class="focus:outline-none float-right">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 m-1 absolute top-3 right-3"  viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M5.72 5.72a.75.75 0 011.06 0L12 10.94l5.22-5.22a.75.75 0 111.06 1.06L13.06 12l5.22 5.22a.75.75 0 11-1.06 1.06L12 13.06l-5.22 5.22a.75.75 0 01-1.06-1.06L10.94 12 5.72 6.78a.75.75 0 010-1.06z"></path></svg>
        </button>

        <div class="overflow-y-scroll py-4 px-8">
            {!! Form::open(['action' => 'ProfileController@changePassword', 'method' => 'PATCH']) !!}
            {{ csrf_field() }}
            <h2 class="text-gray-800 text-xl mb-2 font-medium title-font">Changer le mot de passe</h2>
            <div class="mb-2">
                {{ Form::password('current_password', ['id' => 'current_password','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-10 text-sm']) }}
                <label for="current_password" class="text-xs opacity-75 scale-75">Mot de passe actuel</label>
                @if ($errors->has('current_password'))
                    <span class="text-amber text-xs">{{ $errors->first('current_password') }}</span>
                @endif
            </div>
            <div class="mb-2">
                {{ Form::password('new_password', ['id' => 'new_password','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-10 text-sm']) }}
                <label for="new_password" class="text-xs opacity-75 scale-75">Nouveau mot de passe</label>
                @if ($errors->has('new_password'))
                    <span class="text-amber text-xs">{{ $errors->first('new_password') }}</span>
                @endif
            </div>
            <div class="mb-2">
                {{ Form::password('new_password_confirmation', ['id' => 'new_password_confirmation','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-10 text-sm']) }}
                <label for="new_password_confirmation" class="text-xs opacity-75 scale-75">Confirmez le mot de
                    passe</label>
                @if ($errors->has('new_password_confirmation'))
                    <span class="text-amber text-xs">{{ $errors->first('new_password_confirmation') }}</span>
                @endif
            </div>

        </div>
        <div class="flex items-end justify-end mt-4">
            {{ Form::submit(' Sauvegarder', ['class' =>'flex text-bg-color bg-secondary hover:bg-main border py-2 px-6 text-tiny focus:outline-none transition hover:no-underline ml-2 ml-auto']) }}
        </div>
        {!! Form::close() !!}
    </div>
</div>

<div id="modalDept"
    class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-main bg-opacity-50 transform scale-0 transition-transform duration-300">
    <div
        class="h-1/3 w-1/2 bg-bg-color overflow-y-scrollborder-1 border-main shadow-md rounded-sm flex flex-col items-stretch justify-center relative">
        <button id="closebuttonDept" type="button" class="focus:outline-none float-right">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 m-1 absolute top-3 right-3" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </button>
        <div class="overflow-y-scroll py-4 px-8">
            <h2 class="text-gray-800 text-xl mb-2 font-medium title-font">Ajouter un département</h2>

            {!! Form::open(['action' => 'DepartmentsController@store', 'method' => 'POST', 'class' => 'col s12']) !!}
            <div class="mb-2 relative">
                <label class="text-xs opacity-75 scale-75" for="dptName">Nom du département</label>
                {{ Form::text('dptName', '', ['id' => 'dptName','autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm']) }}
            </div>

            <div class="mb-4 relative">
                <label class="text-xs opacity-75 scale-75">
                    Subsidiaries
                </label>
                {{ Form::select('subs_id[]', $subs, null, ['id' => 'subs','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm']) }}
                @if ($errors->has('subs'))
                    <span class="text-amber text-xs">{{ $errors->first('subs') }}</span>
                @endif
            </div>

            <div class="flex items-end justify-end">
                {{ Form::submit('Sauvegarder', ['class' =>'flex text-bg-color bg-secondary hover:bg-main border-0 py-2 px-6 text-tiny focus:outline-none transition hover:bg-main ml-2']) }}
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>

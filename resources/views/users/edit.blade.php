@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="h-full ml-14 mt-14 mb-10 md:ml-64">
        <div class="grid grid-cols-1 lg:grid-cols-1 gap-4">
            <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-white w-full shadow">
                <div class="rounded-t mb-0 px-0 border-0">
                    <div class="flex flex-wrap items-center px-4 py-2">
                        <div class="relative w-full max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-gray-900 ">
                                Utilisateurs
                            </h3>
                        </div>
                        <div class="relative w-full max-w-full flex-grow flex-1 text-right">
                            <button
                                class="flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-blue-500 rounded ml-auto"
                                type="button">Ajouter un utilisateur</button>
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

                    <div class="mb-2 relative">
                        <label for="name" class="text-xs opacity-75 scale-75">
                            Current Name
                        </label>
                        {{ Form::text('name', $user->name, ['autocomplete' => 'off','class' =>'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-8 placeholder-transparent text-sm','id' => 'name']) }}

                    </div>

                    <div class="mb-2 relative">
                        <label for="email" class="text-xs opacity-75 scale-75">
                            Current Adresse e-mail
                        </label>
                        {{ Form::email('email', $user->email, ['class' =>'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-8 placeholder-transparent text-sm','id' => 'email']) }}
                    </div>

                    {{-- <div class="mb-2 relative">
                        <label for="subs_id" class="text-xs opacity-75 scale-75">Subsidiaries</label>
                        @php($subsidiary = $user->department()->first()->subsidiaries()->get())
                        <select name="subs_id" id="subs_id"
                            class="peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-8 placeholder-transparent text-sm">
                            <option value="--">--</option>
                            @if (count($subs) > 0)
                                @if (Auth::user()->hasRole('Root'))
                                    @foreach ($subs as $sub)
                                        <option value="{{ $sub->id }}"
                                            {{ isset($subsidiary[0]->id) && $subsidiary[0]->id == $sub->id ? 'selected' : '' }}>
                                            {{ $sub->subsName }}
                                        </option>
                                    @endforeach
                                @elseif(Auth::user()->hasRole('Admin'))
                                    <option value="{{ Auth::user()->department_id }}">
                                        {{ Auth::user()->department['dptName'] }}
                                    </option>
                                @endif
                            @endif
                        </select>
                    </div> --}}

                    {{-- <div class="mb-2 relative">
                        <label for="department_id" class="text-xs opacity-75 scale-75">Département
                            actuel</label>
                        <select name="department_id" id="department_id"
                            class="peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-8 placeholder-transparent text-sm">
                            <option value="--">--</option>
                            @if (count($depts) > 0)
                                @if (Auth::user()->hasRole('Root'))
                                    @foreach ($depts as $dept)
                                        <option value="{{ $dept->id }}" {{ isset($user->department['id']) && $user->department['id'] == $dept->id ? 'selected' : '' }}>
                                            {{ $dept->dptName }}
                                        </option>
                                    @endforeach
                                @elseif(Auth::user()->hasRole('Admin'))
                                    <option value="{{ Auth::user()->department_id }}">
                                        {{ Auth::user()->department['dptName'] }}
                                    </option>
                                @endif
                            @endif
                        </select>
                    </div> --}}

                    <div class="mb-2 relative">
                        <label for="role" class="text-xs opacity-75 scale-75">Rôle
                            actuel</label>
                        <select name="role" id="role"
                            class="peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-8 placeholder-transparent text-sm">
                            <option value="" disabled selected>Attribuer un rôle</option>
                            @if (count($roles) > 0)
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}"
                                        {{ $user->roles->pluck('name')->implode(' ') === $role->name ? 'selected' : '' }}>
                                        {{ $role->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>


                    
                    @if (count($subsidiaries) > 0)
                    <div class="mb-2 relative">

                        <h3 class="text-gray-900 text-md mt-4 mb-4 font-medium title-font uppercase">
                            Filials
                        </h3>
                        <div class="grid sm:grid-cols-1 lg:grid-cols-1">

                            @foreach ($subsidiaries as $sub)
                                <div class="font-bold mt-2">{{ $sub->subsName }}</div>

                                @foreach ($sub->departments()->get() as $dept)
                                    <label class="text-gray-900 mb-2 font-medium title-font"
                                        for="{{ $dept['id'] }}_dept">
                                        <input type="checkbox" name="dept[]" id="{{ $dept['id'] }}_dept"
                                            value="{{ $dept['id'] }}">
                                        {{ $dept['dptName'] }}
                                    </label>
                                @endforeach
                            @endforeach

                        </div>

                        <div id="folder_dept_list"></div>

                    </div>
                @endif
                
                    <!-- Switch -->
                    <div class="mb-2 relative">
                        <label for="status"
                            class="peer-placeholder-shown:opacity-100 opacity-75 peer-focus:opacity-75 peer-placeholder-shown:scale-100 scale-75 peer-focus:scale-75 peer-placeholder-shown:translate-y-0 -translate-y-3 peer-focus:-translate-y-3 peer-placeholder-shown:translate-x-0 translate-x-1 peer-focus:translate-x-1  px-3 py-5 h-full pointer-events-none transform origin-left transition-all duration-100 ease-in-out">
                            Compte
                        </label>
                        <div class="pt-1 pl-3">
                            <div>
                                Désactiver
                            </div>
                            @if ($user->status)
                                {{ Form::checkbox('status', '', true) }}
                            @else
                                {{ Form::checkbox('status', '') }}
                            @endif
                            Activé
                        </div>
                    </div>

                    <div class="mb-2 relative">
                        <p>
                            <a href="#modal1" id="buttonmodal" data-target="modal1" class="modal-trigger">
                                Changer le mot de passe ?
                            </a>
                        </p>
                    </div>

                    <div class="mb-2 relative">
                        {{ Form::submit(' Sauvegarder', ['class' => 'flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-blue-500 rounded']) }}
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

                <h4>Changer le mot de passe</h4>

                <div class="mb-2 relative">
                    {{ Form::password('current_password', ['id' => 'current_password','class' =>'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-8 placeholder-transparent text-sm']) }}
                    <label for="current_password" class="text-xs opacity-75 scale-75">
                        Mot de passe actuel
                    </label>
                    @if ($errors->has('current_password'))
                        <span class="text-red-600 text-xs">{{ $errors->first('current_password') }}</span>
                    @endif
                </div>
                <div class="mb-2 relative">
                    {{ Form::password('new_password', ['id' => 'new_password','class' =>'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-8 placeholder-transparent text-sm']) }}
                    <label for="new_password" class="text-xs opacity-75 scale-75">
                        Nouveau mot de passe
                    </label>
                    @if ($errors->has('new_password'))
                        <span class="text-red-600 text-xs">{{ $errors->first('new_password') }}</span>
                    @endif
                </div>
                <div class="mb-2 relative">
                    {{ Form::password('new_password_confirmation', ['id' => 'new_password_confirmation','class' =>'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-8 placeholder-transparent text-sm']) }}
                    <label for="name" class="text-xs opacity-75 scale-75">
                        Nom de dossier
                    </label>
                    @if ($errors->has('new_password_confirmation'))
                        <span class="text-red-600 text-xs">{{ $errors->first('new_password_confirmation') }}</span>
                    @endif
                </div>
                {{ Form::submit('Sauvegarder les modifications', ['class' => 'flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-blue-500 rounded']) }}
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



    <script>
        $(function() {

            $(document).on("change", "#subs_id", function(e) {
                e.preventDefault();
                $('#ajaxShadow').show();
                $('#ajaxloader').show();
                var subs = $(this).val();

                console.log(subs);;

                var url = "{{ URL('departments/getDepartement') }}";
                var url = url + "/subs/" + subs + "/folder/" + 0;

                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        _token: '{{ csrf_token() }}',
                        subs: subs,
                        folder: 0,
                    },
                    success: function(dataResult) {

                        $('#department_id').empty();
                        var select_html = `<option value="--">--</option>`;

                        $.map(dataResult.data.departments, function(departement) {
                            select_html +=
                                `<option value="${departement.id}">${departement.dptName}</option>`;
                        });

                        $('#department_id').html(select_html);

                        $('#ajaxShadow').hide();
                        $('#ajaxloader').hide();
                    },
                    error: function(error) {
                        console.log(error);
                        // location.reload(true);
                        $('#ajaxShadow').hide();
                        $('#ajaxloader').hide();
                    }
                });

            });
        });
    </script>

@endsection

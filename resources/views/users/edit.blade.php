@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="grid grid-cols-1 lg:grid-cols-1 px-4 pt-4 pb-3 gap-4">
        <div class="relative flex flex-col break-words bg-white w-full shadow-sm rounded">
            <div class="rounded-t mb-0 px-0 border">
                <div class="flex flex-wrap items-center px-2 py-3">
                    <div class="relative w-full max-w-full flex-grow flex-1">
                        <h3 class="font-semibold uppercase text-xl text-gray-800">
                            Utilisateurs
                        </h3>
                    </div>
                        @can('upload')
                        <button id="addUserButton"
                            class="flex text-bg-color bg-secondary hover:text-main hover:bg-tertiary border py-2 px-6 text-tiny focus:outline-none transition hover:no-underline ml-2">
                            Ajouter un utilisateur
                        </button>
                        @endcan
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-row flex-wrap p-4 mb-4 mt-2 w-1/2">
        <div class="bg-white p-3 w-full">
            {!! Form::open(['action' => ['UsersController@update', $user->id], 'method' => 'PATCH', 'enctype' => 'multipart/form-data', 'class' => 'w-full']) !!}

            {{ csrf_field() }}
    
            <div class="mb-2 relative">
                <label for="name">
                    Current Name
                </label>
                {{ Form::text('name', $user->name, ['autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color','id' => 'name']) }}
    
            </div>
    
            <div class="mb-2 relative">
                <label for="email">
                    Current Adresse e-mail
                </label>
                {{ Form::email('email', $user->email, ['class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color','id' => 'email']) }}
            </div>
    
            {{-- <div class="mb-2 relative">
                            <label for="subs_id" class="text-xs opacity-75 scale-75">Subsidiaries</label>
                            @php($subsidiary = $user->department()->first()->subsidiaries()->get())
                            <select name="subs_id" id="subs_id"
                                class="peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color">
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
                                class="peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color">
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
                <label for="role">Rôle
                    actuel</label>
                <select name="role" id="role"
                    class="peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color">
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
    
            <div class="mb-2 relative">
                <label for="role" >Groups actuel:</label>
                <select class="peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color">
                        @foreach ($user->groups()->get() as $group)
                            @if ($group!=null)
    
                             <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    
                            @endif
                            
                        @endforeach
               </select>
               <br> <label for="role" >Attribuer un group :</label>
            
                    @if (count($groups) > 0)
                        @foreach ($groups as $group)
                        <label class="text-xs opacity-75 scale-75">{{ $group->name }}</label>
                            <input name="group_id[]" type="checkbox" value="{{ $group->id }}">
                        @endforeach
                    @endif
            </div>
    
            <div class="mb-2 relative">
                <label for="role" >Tasks actuel:</label>
                <select  class="peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color">
                        @foreach ($user->tasks()->get() as $task)
                            @if ($task!=null)
    
                             <option value="{{ $task->id }}">{{ $task->name }}</option>
                                    
                            @endif
                            
                        @endforeach
               </select>
               <br> <label for="role" >Attribuer un task :</label>
            
                    @if (count($tasks) > 0)
                        @foreach ($tasks as $task)
                        <label class="text-xs opacity-75 scale-75">{{ $task->name }}</label>
                            <input  name="task_id[]" type="checkbox" value="{{ $task->id }}">
                        @endforeach
                    @endif
               
            </div>
    
    
            @include('inc.depts.depts')
    
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
                        {{ Form::checkbox('status', '1', true) }}
                    @else
                        {{ Form::checkbox('status', '0') }}
                    @endif
                    Activé
                </div>
            </div>
    
            <div class="mb-2 relative">
                <button id="changePasswordButton" type="button">Changer le mot de passe ?</button>
            </div>
    
            <div class="flex items-end justify-end mt-4">
                {{ Form::submit(' Sauvegarder', ['class' =>'flex text-bg-color bg-secondary hover:text-main hover:bg-tertiary border py-2 px-6 text-tiny focus:outline-none transition hover:no-underline ml-2']) }}
            </div>
    
            {!! Form::close() !!}
        </div>
       

        @include('inc.sidebar-footer')

        @include('popups.addUser')
        @include('popups.scripts')
    </div>
    @endsection

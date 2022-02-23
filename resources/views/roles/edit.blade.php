@extends('layouts.app')

@section('content')
    @include('inc.sidebar')
 
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 py-4 ml-4 bg-bg-color shadow-sm">

            <div class="flex mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Roles + Permissions
            </div>


            <div class="rounded-t mb-0 px-0 border">
                <div
                    class="relative flex flex-col break-words bg-bg-color w-full shadow-sm rounded p-4">
                    <div class="rounded-t mb-0 px-0 border">
                        {!! Form::open(['action' => ['RolesController@update', $role->id], 'method' => 'PUT']) !!}

                        <div class="mb-4">
                            <div class="text-semibold text-lg">Attribuer des rôles With Permissions</div>

                            <div class="mb-2 relative">
                                <label for="role" class="text-xs opacity-75 scale-75">Role</label>
                                {{ Form::text('name', $role->name, ['id' => 'role','autocomplete' => 'off', 'class' => 'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color']) }}
                            </div>
                        </div>

                        <div class="mb-2 relative">
                            <div class="text-semibold mb-2">Available Permissions</div>

                            @foreach ($permissions as $permission)
                                <div>
                                    {!! Form::checkbox('permissions[]', $permission->id, $role->permissions, ['class' => 'filled-in', 'id' => $permission->id]) !!}
                                    <label for="{{ $permission->id }}">{{ ucfirst($permission->name) }}</label>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex">
                            {{ Form::submit('Assign', ['class' => 'flex text-bg-color bg-secondary hover:text-main hover:bg-tertiary border py-2 px-6 text-tiny focus:outline-none transition hover:no-underline ml-2']) }}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>



        </div>
        @include('inc.sidebar-footer')

    
@endsection

@extends('layouts.app')

@section('content')
    @include('inc.sidebar')


    <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-bg-color w-full shadow-sm">
        <div class="rounded-t mb-0 px-0 border">
            <div class="flex flex-wrap items-center px-2 py-3">
                <div class="relative w-full max-w-full flex-grow flex-1">
                    <h3 class="font-semibold text-base text-gray-800 ">
                        Profile
                    </h3>
                </div>
                <div class="relative w-full max-w-full flex flex-grow flex-1 text-right">
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-row flex-wrap p-4 mb-4 mt-2 w-1/2">

        {!! Form::open(['action' => ['ProfileController@update', $acc->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
        {{ csrf_field() }}


        <h2 class="text-gray-800 text-xl mb-2 font-medium title-font">Informations d'identification actuelles</h2>
        <div class="mb-4 relative">
            <label class="text-xs opacity-75 scale-75">Nom</label>
            {{ Form::text('name', $acc->name, ['id' => 'Name','autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color']) }}
        </div>

        <div class="mb-4 relative">
            <label class="text-xs opacity-75 scale-75">Email</label>
            {{ Form::email('email', $acc->email, ['id' => 'Email','autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color']) }}
        </div>

        <div class="mb-4 relative">
            {{ Form::submit(' Sauvegarder', ['class' =>'flex text-bg-color bg-secondary hover:text-main hover:bg-tertiary border py-2 px-6 text-tiny focus:outline-none transition hover:no-underline ml-auto']) }}
            <button id="changePasswordButton" type="button">Changer le mot de passe ?</button>
        </div>

        <div class="">
            <h4 class="text-gray-800 text-xl mb-2 font-medium title-font">Roles &amp; Permissions</h4>
            Your current role is
            <div class="text-xs">
                @hasrole('Root')
                    <div class="text-main text-lg">Root.</div> 
                    So, you have all of the privileges relating to documents,
                    users, departments, and etc. Moreover, you can Attribuer des rôles and permssions and
                    can see
                    users' activities.
                @endhasrole
                @hasrole('Admin')
                    <div class="text-main text-lg"> Admin.</div> 
                    So, you can manage users in your department, upload
                    documents and edit/share/remove them. You can see your activity log but cannot clear
                    them.
                @endhasrole
                @hasrole('User')
                    <div class="text-main text-lg"> User. </div>
                    So, you can upload documents and edit/share/remove them. You
                    can see your activity log but cannot clear them.
                @endhasrole
            </div>
        </div>

        {!! Form::close() !!}

    </div>


    @include('inc.sidebar-footer')

    @include('popups.changePassword')
    @include('popups.scripts')
@endsection

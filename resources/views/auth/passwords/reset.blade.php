@extends('layouts.app')

@section('content')

    <section class="absolute w-full h-full">
        <div class="absolute top-0 w-full h-full bg-gray-800"
            style="background-image: url(./assets/img/register_bg_2.png); background-size: 100%; background-repeat: no-repeat;">
        </div>
        <div class="container mx-auto px-4 h-full">
            <div class="flex content-center items-center justify-center h-full">
                <div class="w-full lg:w-4/12 px-4">
                    <div
                        class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-md rounded-lg bg-bg-color border-0">

                        <div class="flex-auto px-4 lg:px-10 py-8 pt-8">
                            <div class="text-bg-color text-center font-bold mb-6">
                                <small>Reset Password</small>
                            </div>

                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                                {{ csrf_field() }}

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-gray-800 text-xs font-bold mb-2" for="email">Adresse
                                        e-mail</label>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                        autofocus
                                        class="peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm"
                                        placeholder="Email" style="transition: all 0.15s ease 0s;">
                                    @if ($errors->has('email'))
                                        <span class="text-amber text-xs">{{ $errors->first('email') }}</span>
                                    @endif

                                </div>

                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-gray-800 text-xs font-bold mb-2" for="password">Mot
                                        de passe</label>
                                    <input id="password" type="password" name="password" required
                                        class="peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm"
                                        placeholder="Mot de passe" style="transition: all 0.15s ease 0s;">
                                    @if ($errors->has('password'))
                                        <span class="text-amber text-xs">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>

                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-gray-800 text-xs font-bold mb-2"
                                        for="password-confirm">Password</label>
                                    <input id="password-confirm" type="password" name="password_confirmation" required
                                        class="peer border border-main focus:outline-none focus:border-secondary shadow focus:shadow-sm w-full py-1 px-2 h-10 text-sm"
                                        placeholder="Mot de passe" style="transition: all 0.15s ease 0s;">
                                    @if ($errors->has('password_confirmation'))
                                        <span
                                            class="text-amber text-xs">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>

                                <div>
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}
                                            class="form-checkbox border-0 rounded text-gray-800 ml-1 w-5 h-5"
                                            style="transition: all 0.15s ease 0s;">
                                        <span class="ml-2 text-sm font-semibold text-gray-800">Souviens-toi de moi</span>
                                    </label>
                                </div>

                                <div class="text-center mt-6">
                                    <button name="login"
                                        class="bg-main text-bg-color active:bg-main text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 w-full"
                                        type="submit" style="transition: all 0.15s ease 0s;">
                                        Réinitialiser le mot de passe
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <footer class="absolute w-full bottom-0 bg-main pb-4">
            <div class="container mx-auto px-4">
                <hr class="mb-4 border-b-1 border-gray-800">
                <div class="flex flex-wrap items-center md:justify-between justify-center">
                    <div class="w-full md:w-4/12 px-4">
                        <div class="text-sm text-bg-color font-semibold py-1">
                            Copyright © 2022
                            <a href="https://www.creative-tim.com"
                                class="text-bg-color hover:text-bg-color text-sm font-semibold py-1"> </a>
                        </div>
                    </div>

                </div>
            </div>
        </footer>
    </section>
@endsection

@extends('layouts.app')

@section('content') 
    <section class="absolute w-full h-full">
        <div class="absolute top-0 w-full h-full bg-gray-800"
            style="background-image: url(./assets/img/register_bg_2.png); background-size: 100%; background-repeat: no-repeat;">
        </div>
        <div class="container mx-auto px-4 h-full">
            <div class="flex content-center items-center justify-center h-full">
                <div class="w-full lg:w-4/12 px-4">
                    <div class="btn-wrapper text-center">
                       @include('logo-login')
                    </div>
                    <div
                        class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-sm bg-bg-color border">
                            
                        <div class="rounded-t mb-0 px-6 py-6 hidden">
                            <div class="text-center mb-3">
                                <h6 class="text-gray-800 text-sm font-bold">
                                    Se connecter avec
                                </h6>
                            </div> 
                            <div class="btn-wrapper text-center">
                                <button
                                    class="bg-bg-color active:bg-bg-color text-gray-800 font-normal px-4 py-2 rounded outline-none focus:outline-none mr-2 mb-1 uppercase shadow-sm hover:shadow-sm inline-flex items-center font-bold text-xs"
                                    type="button" style="transition: all 0.15s ease 0s;">
                                    <img alt="..." class="w-5 mr-1" src="./assets/img/github.svg">Github</button><button
                                    class="bg-bg-color active:bg-bg-color text-gray-800 font-normal px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 uppercase shadow-sm hover:shadow-sm inline-flex items-center font-bold text-xs"
                                    type="button" style="transition: all 0.15s ease 0s;">
                                    <img alt="..." class="w-5 mr-1" src="./assets/img/google.svg">Google
                                </button>
                            </div>
                            <hr class="mt-6 border-b-1 border-main">
                        </div>
                        <div class="flex-auto px-4 lg:px-8 lg:py-4 py-6 pt-6">
                            <div class=" text-center mb-4 font-bold">
                                <small>Connectez-vous avec des informations d'identification</small>
                            </div>

                            <form action="{{ route('login') }}" method="POST">
                                {{ csrf_field() }}

                                <div class="relative w-full mb-3">
                                    {{-- <pre class=" text-red-500 text-xs">{{ var_dump($errors) }}</pre> --}}
                                    <label class="block text-gray-800 text-xs font-bold mb-2" for="email">Adresse
                                        e-mail</label>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                        autofocus
                                        class="peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color"
                                        placeholder="Email" style="transition: all 0.15s ease 0s;">
                                    @if ($errors->has('email'))
                                        <span class=" text-red-500 text-xs">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <div class="relative w-full mb-3">
                                    <label class="block text-gray-800 text-xs font-bold mb-2" for="password">Mot
                                        de passe</label>
                                    <input id="password" type="password" name="password" required
                                        class="peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color"
                                        placeholder="Mot de passe" style="transition: all 0.15s ease 0s;">
                                    @if ($errors->has('password'))
                                        <span class=" text-red-500 text-xs">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div>
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}
                                            class="form-checkbox border rounded text-gray-800 ml-1 w-4 h-4"
                                            style="transition: all 0.15s ease 0s;">
                                        <span class="ml-2 text-sm font-semibold text-gray-800">Rester connecté</span>
                                    </label>
                                </div>
                                <div class="text-center mt-4">
                                    <button name="login"
                                        class="flex text-bg-color bg-secondary hover:text-main hover:bg-tertiary border py-2 px-6 text-tiny focus:outline-none transition hover:no-underline w-full justify-center"
                                        type="submit" style="transition: all 0.15s ease 0s;">
                                        Connexion
                                    </button>
                                </div>
                            </form>


                        </div>
                    </div>
                    <div class="flex flex-wrap mt-6 relative">
                        <div class="w-1/2">
                            <a href="{{ route('password.request') }}" class="text-bg-color"><small>Mot de passe oublié
                                    ?</small></a>
                        </div>
                        <div class="w-1/2 text-right">
                            <a href="{{ route('register') }}" class="text-bg-color"><small>Créer un nouveau
                                    compte</small></a>
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

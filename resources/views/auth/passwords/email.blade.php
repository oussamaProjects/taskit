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
                        class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-sm bg-bg-color border">

                        <div class="flex-auto px-4 lg:px-10 py-8 pt-8">
                            <div class="text-bg-color text-center font-bold mb-6">
                                <small>Réinitialiser le mot de passe</small>
                            </div>

                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif



                            <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                                {{ csrf_field() }}

                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-gray-800 text-xs font-bold mb-2" for="email">Adresse
                                        e-mail</label>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                        autofocus
                                        class="peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color"
                                        placeholder="Email" style="transition: all 0.15s ease 0s;">
                                    @if ($errors->has('email'))
                                        <span class=" text-red-500 text-xs">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <div class="text-center mt-4">
                                    <button name="login"
                                        class="bg-main text-bg-color active:bg-main text-sm font-bold uppercase px-6 py-3 rounded shadow-sm hover:shadow-sm outline-none focus:outline-none mr-1 mb-1 w-full"
                                        type="submit" style="transition: all 0.15s ease 0s;">
                                        Envoyer le lien de réinitialisation du mot de passe
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

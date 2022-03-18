<!-- Header -->
<div class="fixed w-full flex items-center justify-between h-14 text-bg-color z-10">


    @if (!Auth::guest())
        <div class="flex items-center justify-start md:justify-center w-14 md:w-64 h-14 bg-main  border-none">
            <span class="md:block font-bold text-2xl">
               <a href="{{route('welcom.index')}}"> @include('logo')</a>
            </span>
        </div>
    @endif

    <div class="flex justify-between items-center h-14 text-tiny bg-main w-full">

        @if (!Auth::guest())
            <form action="/search" method="post" id="search-form"
                class="flex items-center w-full max-w-xl mr-4 relative">
                {{ csrf_field() }}

                <button class="outline-none focus:outline-none absolute top-2 right-2">
                    <svg class="w-8 text-gray-800 h-6 cursor-pointer" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
                <input type="search" name="search" id="search" placeholder="Recherche ..."
                    class="peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color" />
            </form>
        @endif

        <ul class="flex items-center ml-auto">

            @if (Auth::guest())

                <li>
                    <a href="{{ route('login') }}" class="flex items-center mr-4">
                        <span class="inline-flex mr-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                        </span>
                        Connexion
                    </a>
                </li>

                <li>
                    <a href="{{ route('register') }}" class="flex items-center mr-4">
                        <span class="inline-flex mr-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                        </span>
                        S'inscrire
                    </a>
                </li>

            @else

                <li>
                    <a href="/requests" class="flex items-center mr-4">
                        <span class="inline-flex mr-1 relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                    <path d="M16 14.1C16 10.9 12.4878 10.9 12.4878 6.4C12.4878 4.5 11.4146 2.9 9.7561 2.2C9.7561 2.1 9.7561 2 9.7561 1.8C9.7561 0.799999 8.97561 0 8 0C7.02439 0 6.2439 0.799999 6.2439 1.8C6.2439 1.9 6.2439 2 6.2439 2.2C4.68292 2.9 3.51219 4.5 3.51219 6.4C3.51219 10.9 0 10.9 0 14.1C0 15.5 2.2439 16.7 5.36586 17.1C5.36586 17.2 5.36586 17.2 5.36586 17.3C5.36586 18.8 6.53658 20 8 20C9.46342 20 10.6341 18.8 10.6341 17.3C10.6341 17.2 10.6341 17.2 10.6341 17.1C13.7561 16.7 16 15.5 16 14.1ZM8 0.900002C8.48781 0.900002 8.87804 1.3 8.87804 1.8C8.87804 2.3 8.48781 2.7 8 2.7C7.5122 2.7 7.12196 2.3 7.12196 1.8C7.12196 1.3 7.5122 0.900002 8 0.900002ZM2.24391 11.6C3.21952 10.5 4.4878 9.2 4.4878 6.3C4.4878 4.8 5.36585 3.5 6.7317 2.9C7.02439 3.3 7.5122 3.5 8.09757 3.5C8.68293 3.5 9.07317 3.2 9.46342 2.9C10.7317 3.4 11.7073 4.7 11.7073 6.3C11.7073 9.1 12.9756 10.5 13.9512 11.6C14.1463 11.8 14.3415 12 14.439 12.2C13.561 13 11.122 13.6 8.09757 13.6C5.17074 13.6 2.63415 13 1.7561 12.2C1.85366 12 2.04878 11.8 2.24391 11.6ZM8 19.1C7.02439 19.1 6.2439 18.3 6.2439 17.3V17.2C6.82927 17.3 7.41463 17.3 8 17.3C8.58537 17.3 9.17074 17.3 9.7561 17.2V17.3C9.7561 18.3 8.97561 19.1 8 19.1ZM8 16.4C3.41463 16.4 0.878043 14.9 0.878043 14.1C0.878043 13.6 0.975607 13.2 1.17073 12.9C2.34146 13.9 4.97561 14.6 8 14.6C11.0244 14.6 13.561 13.9 14.8293 12.9C15.0244 13.3 15.122 13.6 15.122 14.1C15.122 14.9 12.5854 16.4 8 16.4Z" fill="#90A4AE"/>
                                    </svg>
                            <span
                                class="absolute w-5 h-5 rounded-full flex items-center justify-center bg-tertiary text-main text-xs -top-2 -right-2 p-2"></span>
                        </span>
                        <span class="ml-2">
                            Demandes d'enregistrement de compte
                        </span>
                    </a>
                </li>

                <li>
                    <div class="block w-px h-6 mx-3 bg-bg-color"></div>
                </li>

                <li>
                    {{-- @if ($trashfull > 0)
                        <a href="/trash" class="flex items-center">
                            <span class="inline-flex mr-1 relative">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1 text-amber" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                <span
                                    class="absolute w-5 h-5 rounded-full flex items-center justify-center bg-tertiary text-main text-xs -top-2 -right-2 p-2">{{ $trashfull }}</span>
                            </span>
                        </a>
                    @else
                        <span class="flex items-center">
                            <span class="inline-flex mr-1 relative">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </span>
                        </span>
                    @endif --}}
                </li>

                <li>
                    <div class="block w-px h-6 mx-3 bg-bg-color"></div>
                </li>

                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="flex items-center mr-4">
                        <span class="inline-flex mr-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                        </span>
                        Se déconnecter
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            @endif
        </ul>
    </div>
</div>
<!-- ./Header -->

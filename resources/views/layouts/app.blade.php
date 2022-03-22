<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EDMS') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Primer/3.0.1/css/primer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/octicons/3.5.0/octicons.min.css">

    {{-- <link rel="stylesheet" href="{{ asset('iconfont/material-icons.css') }}"> --}}
    <!-- Materialize css -->
    {{-- <link rel="stylesheet" href="{{ asset('materialize-css/css/materialize.min.css') }}"> --}}
    <!-- datatables -->
    {{-- <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}"> --}}

    <!-- app css -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/storage/images/favicon.ico">

    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>

    <script src="{{ mix('/vue/app.js') }}" defer></script>

</head>

<body class="my-auto w-full" style="height: min-content;">


    @include('inc.notifications')

    <div>
        <div class="min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased bg-bg-color text-black ">

            @include('inc.spinner')

            @include('inc.navbar')

            @yield('content')

            <!-- Floating Button -->
            @if (Auth::guest())
            @else
                {{-- <div class="fixed-action-btn">
                    <a href="#" class="btn btn-floating btn-large tooltipped" data-position="left" data-delay="50"
                        data-tooltip="Quick Access">
                        <i class="large material-icons">explore</i>
                    </a>
                    <ul>
                        <li>
                            <a href="/documents/create" class="btn-floating btn-large tooltipped" data-position="left"
                                data-delay="50" data-tooltip="File Upload">
                                <i class="large material-icons">file_upload</i>
                            </a>
                        </li>
                        <li class="hide-on-med-and-down">
                            <a href="" class="btn-floating btn-large button-collapse tooltipped"
                                data-activates="slide-out" data-position="left" data-delay="50" data-tooltip="Menu"><i
                                    class="large material-icons">menu</i>
                            </a>
                        </li>
                    </ul>
                </div> --}}
            @endif


            @include('inc.footer')

            <!-- Scripts -->
            @include('inc.scripts')
            <!-- Right click context-menu -->
            {{-- <script src="{{ asset('js/context-menu.js') }}"></script> --}}
            <!-- MESSAGES -->
            @include('inc.messages')

        </div>
    </div>
</body>

</html>
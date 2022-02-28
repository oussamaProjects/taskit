@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

        <div class="grid grid-cols-1 lg:grid-cols-1 px-4 pt-4 pb-3 gap-4 mt-14">

            <!-- Roles -->
            <div class="relative flex flex-col break-words bg-white w-full shadow-sm rounded">
                <div class="rounded-t mb-0 px-0 border">
                    <div class="flex flex-wrap items-center px-4 py-2">
                        <div class="relative w-full max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-gray-800 ">Roles &amp; Permissions</h3>
                        </div>
                        <div class="relative w-full max-w-full flex-grow flex-1 text-right">
                        </div>
                    </div>
                    <div class="block w-full overflow-x-auto">
                        <table class="table-auto w-full text-left whitespace-no-wrap border border-bg-color border border-bg-color">
                            <thead>
                                <tr>
                                    <th
                                        class="px-2 py-3 title-font tracking-wider font-medium text-bg-color text-sm bg-main shadow-sm">
                                        ID.</th>
                                    <th
                                        class="px-2 py-3 title-font tracking-wider font-medium text-bg-color text-sm bg-main shadow-sm">
                                        Permissions</th>
                                    <th
                                        class="px-2 py-3 title-font tracking-wider font-medium text-bg-color text-sm bg-main shadow-sm">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-gray-800 ">
                                    @if (count($roles) > 0)
                                        @foreach ($roles as $r)
                                <tr>
                                    <th
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs bg-colorspace-nowrap p-2 text-left">
                                        {{ $r->name }}</td>
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs bg-colorspace-nowrap p-2">
                                        {{ $r->permissions()->pluck('name')->implode(' ') }}</td>
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs bg-colorspace-nowrap p-2">
                                        <a href="roles/{{ $r->id }}/edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- ./Roles -->
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 p-4 gap-4">

            <!-- Roles -->
            <div class="relative flex flex-col break-words bg-white w-full shadow-sm rounded">
                <div class="rounded-t mb-0 px-0 border">
                    <div class="flex flex-wrap items-center px-4 py-2">
                        <div class="relative w-full max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-gray-800 ">Roles</h3>
                        </div>
                        <div class="relative w-full max-w-full flex-grow flex-1 text-right">
                        </div>
                    </div>
                    <div class="block w-full overflow-x-auto">
                        <table class="table-auto w-full text-left whitespace-no-wrap border border-bg-color border border-bg-color">
                            <thead>
                                <tr>
                                    <th
                                        class="px-2 py-3 title-font tracking-wider font-medium text-bg-color text-sm bg-main shadow-sm">
                                        ID.</th>
                                    <th
                                        class="px-2 py-3 title-font tracking-wider font-medium text-bg-color text-sm bg-main shadow-sm">
                                        Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-gray-800 ">
                                    @if (count($roles) > 0)
                                        @foreach ($roles as $key => $role)
                                <tr>
                                    <th
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs bg-colorspace-nowrap p-2 text-left">
                                        {{ ++$key }}</td>
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs bg-colorspace-nowrap p-2">
                                        {{ $role->name }}</td>
                                </tr>
                                @endforeach
                                @endif
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- ./Roles -->

            <!-- Permissions -->
            <div class="relative flex flex-col break-words bg-white w-full shadow-sm rounded">
                <div class="rounded-t mb-0 px-0 border">
                    <div class="flex flex-wrap items-center px-4 py-2">
                        <div class="relative w-full max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-gray-800 ">Permissions</h3>
                        </div>
                        <div class="relative w-full max-w-full flex-grow flex-1 text-right">
                        </div>
                    </div>
                    <div class="block w-full overflow-x-auto">
                        <table class="table-auto w-full text-left whitespace-no-wrap border border-bg-color border border-bg-color">
                            <thead>
                                <tr>
                                    <th
                                        class="px-2 py-3 title-font tracking-wider font-medium text-bg-color text-sm bg-main shadow-sm">
                                        ID.</th>
                                    <th
                                        class="px-2 py-3 title-font tracking-wider font-medium text-bg-color text-sm bg-main shadow-sm">
                                        Permission</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-gray-800 ">
                                    @if (count($permissions) > 0)
                                        @foreach ($permissions as $key => $permission)
                                <tr>
                                    <th
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs bg-colorspace-nowrap p-2 text-left">
                                        {{ ++$key }}</td>
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs bg-colorspace-nowrap p-2">
                                        {{ $permission }}</td>
                                </tr>
                                @endforeach
                                @endif
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- ./Permissions -->

        </div>
   
    @include('inc.sidebar-footer')
        

@endsection

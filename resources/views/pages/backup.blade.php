@extends('layouts.app')

@section('content')

@include('inc.sidebar')

<div class="ml-14 mt-20 mb-10 md:ml-64 bg-white p-4 ">

    <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 gap-4 mb-4">
        <div class="flex text-center w-full mb-4">
            <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">Backup Manager</h1>
            <a href="/backup/create"
                    class="flex ml-auto waves-effect waves-light btn-large teal darken-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
                <span class="ml-2">Create Backup</span>
            </a>
        </div>
    </div> 

    <table class="table-auto w-full text-left whitespace-no-wrap">
        <thead>
            <tr>
                <th>Location</th>
                <th>Name</th>
                <th>Size</th>
                <th>Last Modified</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @if (count($backups) > 0)
                @foreach ($backups as $b)
                    <tr>
                        <td>{{ $b['file_path'] }}</td>
                        <td>{{ $b['file_name'] }}</td>
                        <td>{{ round((int) $b['file_size'] / 1048576, 2) . ' MB' }}</td>
                        <td>{{ \Carbon\Carbon::createFromTimeStamp($b['last_modified'])->formatLocalized('%d %B %Y, %H:%M') }}
                        </td>
                        <td>
                            <a href="/backup/download?file_name={{ urlencode($b['file_name']) }}"
                                class="btn teal darken-5 waves-effect waves-light"><i
                                    class="material-icons">file_download</i></a>
                            <a href="/backup/delete?file_name={{ urlencode($b['file_name']) }}"
                                class="btn red darken-5 waves-effect waves-light">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
            
        
@endsection

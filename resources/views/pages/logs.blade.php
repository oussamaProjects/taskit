@extends('layouts.app')

@section('content')
    @include('inc.sidebar')
    <div class="ml-14 mt-20 mb-10 md:ml-64 bg-white p-4 ">

        <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 gap-4 mb-4">

            <div class="flex">
                <div class="text-lg text-bold"> Users' Activities</div>
                @can('root')
                    <a href="logsdel" data-position="left" data-delay="50" data-tooltip="Clear All" class="flex ml-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <span class="ml-4 text-bold">Clear all</span>
                    </a>
                @endcan
            </div>
        </div>
        @if (count($logs) > 0)
            @foreach ($logs as $key => $log)
                <div class="mb-4 p-4 shadow-sm bg-blue-100 rounded-sm relative">

                    <div
                        class="h-10 w-10 rounded-full bg-blue-700 text-white text-lg text-bold flex items-center justify-center absolute right-4 top-4 shadow-md">
                        {{ ++$key }}</div>
                    <div class="font-semibold mb-2">{{ $log->created_at->toDayDateTimeString() }}</div>
                    <div class="text-xs">
                        <div class="flex"> <span class="font-semibold">Subject :&nbsp;</span> {{ $log->subject }}</div>
                        <div class="flex"> <span class="font-semibold">User ID :&nbsp;</span> {{ $log->user_id }}</div>
                        <div class="flex"> <span class="font-semibold">URL :&nbsp;</span> {{ $log->url }}</div>
                        <div class="flex"> <span class="font-semibold">Method :&nbsp;</span> {{ $log->method }}</div>
                        <div class="flex"> <span class="font-semibold">IP :&nbsp;</span> {{ $log->ip }}</div>
                        <div class="flex"> <span class="font-semibold">Agent :&nbsp;</span> {{ $log->agent }}</div>
                    </div>

                </div>
            @endforeach
        @else
            <p class="p-4 text-center">
                No Logs have been recorded yet ...
            </p>
        @endif

    </div>
    </div>

@endsection

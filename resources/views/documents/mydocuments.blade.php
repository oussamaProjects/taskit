 

@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    {{-- <table class="bordered centered highlight responsive-table" id="myDataTable">
        <thead>
            <tr>
                <th>File Name</th>
                <th>Type</th>
                <th>Size</th>
                <th>Uploaded At</th>
                <th>Expires At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if (count($docs) > 0)
                @foreach ($docs as $doc)
                    <tr>
                        <td>{{ $doc->name }}</td>
                        <td>{{ $doc->mimetype }}</td>
                        <td>{{ $doc->filesize }}</td>
                        <td>{{ \Carbon\Carbon::createFromTimeStamp($doc->created_at->toDayDateTimeString())->formatLocalized('%d %B %Y, %H:%M') }}</td>
                        <td>
                            @if ($doc->isExpire)
                                {{ $doc->expires_at }}
                            @else
                                No Expiration
                            @endif
                        </td>
                        <td>
                            @can('read')
                                {!! Form::open() !!}
                                <a href="documents/{{ $doc->id }}" class="tooltipped" data-position="left" data-delay="50"
                                    data-tooltip="View Details">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 m-1" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                {!! Form::close() !!}
                                {!! Form::open() !!}
                                <a href="documents/open/{{ $doc->id }}" class="tooltipped" data-position="left"
                                    data-delay="50" data-tooltip="Open"><i class="material-icons">open_with</i></a>
                                {!! Form::close() !!}
                            @endcan
                            {!! Form::open() !!}
                            @can('download')
                                <a href="documents/download/{{ $doc->id }}" class="tooltipped" data-position="left"
                                    data-delay="50" data-tooltip="Download"><i class="material-icons">file_download</i></a>
                            @endcan
                            {!! Form::close() !!}
                            {!! Form::open() !!}
                            @can('shared')
                                <a href="#" class="tooltipped" data-position="left" data-delay="50" data-tooltip="Share"><i
                                        class="material-icons">share</i></a>
                            @endcan
                            {!! Form::close() !!}
                            {!! Form::open() !!}
                            @can('edit')
                                <a href="documents/{{ $doc->id }}/edit" class="tooltipped" data-position="left"
                                    data-delay="50" data-tooltip="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 m-1" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                            @endcan
                            {!! Form::close() !!}
                            <!-- DELETE using link -->
                            {!! Form::open(['action' => ['DocumentsController@destroy', $doc->id], 'method' => 'DELETE', 'id' => 'form-delete-documents-' . $doc->id]) !!}
                            @can('delete')
                                <a href="" class="data-delete tooltipped" data-position="left" data-delay="50"
                                    data-tooltip="Delete" data-form="documents-{{ $doc->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 m-1" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </a>
                            @endcan
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">
                        <h5 class="teal-text">No Document has been uploaded</h5>
                    </td>
                </tr>
            @endif
        </tbody>
    </table> --}}

    @include('documents.inc.head')

    <div class="ml-14 mb-14 md:ml-64">

        @include('inc.tables.docs')

    </div>


    @include('popups.addCategorie')
    @include('popups.addFile')
    @include('popups.scripts')

@endsection

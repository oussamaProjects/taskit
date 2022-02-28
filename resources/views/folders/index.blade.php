@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    @include('folders.inc.head')

    <div class="flex flex-row flex-wrap mt-2 mb-3 mx-4 gap-4 bg-bg-color">

        <div class="flex-initial border font-light shadow-sm bg-white">
            @include('inc.folders.folder-tree', ['currentFolder' => $folder?? null])
        </div>

        <div class="flex-1 border shadow-sm p-2 bg-white">
            <div class="sm:text-xl text-lg title-font my-2 text-gray-800 text-center p-2 uppercase">
                Dans ce dossier <span class="text-tertiary">{{ isset($folder) ? $folder->name : 'Root' }}</span>
                <span class="text-xs"> {{ isset($folder) ? '(' . $folder->foldersize . 'KB)' : '' }} </span>
            </div>
            <div class="flex flex-row flex-wrap items-start content-start justify-start h-full">
                @if (count($folders_table) > 0)
                    @foreach ($folders_table as $fold)
                        @include('inc.folders.folder',['folder' => $fold])
                    @endforeach
                @else
                    @include('inc.no-records.folders' )
                @endif
            </div>
        </div>

        <div class="flex-1 border shadow-sm p-2 bg-white">
            <div class="sm:text-xl text-lg title-font my-2 text-gray-800 text-center p-2 uppercase">Les documents
                dans <span class="text-tertiary">{{ isset($folder) ? $folder->name : 'Root' }}</span></div>
            {{-- <div class="flex flex-row flex-wrap gap-4 items-start justify-start h-full"> --}}
            <div class="flex flex-col flex-wrap gap-1 items-start justify-start h-full">

                <table class="table-auto w-full text-left bg-colorspace-no-wrap">
                    <thead>
                        <tr class="border-b mb-2 pb-2">
                            <td class="px-1 py-1 text-main text-xs"> </td>
                            <td class="px-1 py-1 text-main text-xs">Name</td>
                            <td class="px-1 py-1 text-main text-xs">Version</td>
                            <td class="px-1 py-1 text-main text-xs">File size</td>
                            <td class="px-1 py-1 text-main text-xs">Date Modified</td>
                            <td class="px-1 py-1 text-main text-xs">type mime</td>
                        </tr>

                    </thead>
                    <tbody>
                        @if (isset($docs) && count($docs) > 0)
                            @foreach ($docs as $doc)
                                @include('inc.docs.doc',['doc' => $doc])
                            @endforeach
                        @else
                            @include('inc.no-records.docs' )
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    @include('inc.tables.docs')


    @include('inc.sidebar-footer')

    @include('popups.addFile')
    @include('popups.addFolder')
    @include('popups.addSubFolder')
    @include('popups.addCategorie')
    @include('popups.scripts')

@endsection

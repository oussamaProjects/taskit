@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="h-full ml-14 mt-14 mb-10 md:ml-64">

        @include('folders.inc.head')

        @hasanyrole('Root|Admin')
            @if (count($results) > 0)
                <div class="grid grid-cols-4 lg:grid-cols-4 ml-4 p-4 gap-4 bg-bg-color shadow">
                    <div class="col-span-4">
                        <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words w-full">
                            <div class="rounded-t mb-0 px-0 border-0">

                                <div class="flex flex-col text-center w-full">
                                    <h1 class="sm:text-2xl text-xl font-medium title-font mb-1 text-gray-800">Dossiers</h1>
                                    <p class="lg:w-2/3 mx-auto leading-relaxed text-base mb-2">
                                        <span class="text-main">{{ count($results) }} </span>
                                        Dossiers trouvés
                                    </p>
                                </div>
                                <div class="block w-full overflow-x-auto">
                                    <table
                                        class="table-auto w-full text-left whitespace-no-wrap border border-bg-color border border-bg-color">

                                        @include('inc.tables.head.folders' )
                                        <tbody>
                                            @if (count($results) > 0)
                                                @foreach ($results as $res)
                                                    @foreach ($res as $r)
                                                        @include('inc.tables.body.folders',['current_folder' => $r])
                                                    @endforeach
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="3">
                                                        @include('inc.no-records.folders' )
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endhasanyrole

    </div>

@endsection

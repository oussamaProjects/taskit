@hasanyrole('Root|Admin')
    <div class="grid grid-cols-4 lg:grid-cols-4 ml-4 p-4 gap-4 bg-bg-color shadow">
        <div class="col-span-4">
            <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words w-full">
                <div class="rounded-t mb-0 px-0 border-0">
                    <div class="flex flex-col text-center w-full">
                        <h1 class="sm:text-xl text-lg font-medium title-font mb-6 text-gray-800 text-center">
                            <span class="text-secondary"> Tous les dossiers</span>
                        </h1>
                    </div>
                    <div class="block w-full overflow-x-auto">
                        <table
                            class="table-auto w-full text-left whitespace-no-wrap border border-bg-color border border-bg-color">

                            @include('inc.tables.head.folders' )
                            <tbody>
                                @if (count($current_folders) > 0)
                                    @foreach ($current_folders as $folder)
                                        @include('inc.tables.body.folders',['current_folder' => $folder])
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
@endhasanyrole

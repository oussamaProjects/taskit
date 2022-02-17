@hasanyrole('Root|Admin')
<!-- Statistics Cards -->
<div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 p-4 gap-4 ml-4 bg-white shadow">
    <div class="flex flex-col text-center w-full">
        <h1 class="sm:text-2xl text-xl font-medium title-font mb-2 text-gray-900">Les documents dans <span class="text-red-400">{{ isset($folder) ? $folder->name : 'Root' }}</h1>
    </div>
    <div class="w-full">
        <table class="table-auto w-full text-left whitespace-no-wrap">

            @include('inc.tables.head.docs' )
            <tbody>

                @if (isset($docs) && count($docs) > 0)
                    @foreach ($docs as $doc)
                        @include('inc.tables.body.docs',['doc' => $doc])
                    @endforeach
                @else
                    @include('inc.tables.body.no-records')
                @endif

            </tbody>
        </table>
        @if (isset($docs) && count($docs) > 0)
            {{-- {{ $docs->links() }} --}}
        @endif
    </div>
</div>
@endhasanyrole
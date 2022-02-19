@hasanyrole('Root|Admin')
<!-- Statistics Cards -->
<div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 p-4 gap-4 ml-4 bg-bg-color shadow">
    <div class="flex flex-col text-center w-full">
        <h1 class="text-center font-bold text-lg uppercase my-2">Les documents dans <span class="text-main">{{ isset($folder) ? $folder->name : 'Root' }}</h1>
    </div>
    <div class="w-full">
        <table class="table-auto w-full text-left bg-colorspace-no-wrap border border-bg-color">

            @include('inc.tables.head.docs' )
            <tbody>

                @if (isset($docs) && count($docs) > 0)
                    @foreach ($docs as $doc)
                        @include('inc.tables.body.docs',['current_doc' => $doc])
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


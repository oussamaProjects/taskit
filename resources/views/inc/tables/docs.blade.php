{{-- @hasanyrole('Root|Admin') --}}
<!-- Statistics Cards -->
<div class="grid grid-cols-1 py-4 ml-4 bg-bg-color shadow-sm">
    <div class="flex flex-col text-center w-full">
        <h1 class="sm:text-xl text-lg font-medium title-font my-2 text-gray-800 text-center p-2 uppercase">
            {{-- {{ Route::current()->getName() }} --}}
            @if (Route::current()->getName() === 'shared.index')
                <span class="text-secondary">Documents partagés</span>
            @elseif (Route::current()->getName() === 'mydocuments')
                <span class="text-secondary">Mes documents</span>
            @else
                Les documents dans <span
                    class="text-secondary">{{ isset($folder) ? $folder->name : 'Root' }}</span>
            @endif
        </h1>
    </div>
    <div class="w-full">
        <table class="table-auto w-full text-left bg-colorspace-no-wrap border">

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
{{-- @endhasanyrole --}}

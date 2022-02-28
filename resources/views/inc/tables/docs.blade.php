{{-- @hasanyrole('Root|Admin') --}}
<!-- Statistics Cards -->
<div class="grid grid-cols-1 pb-4 px-3 mx-4 bg-white shadow-sm">
    <div class="flex flex-col text-center w-full px-2 pb-2 bg-white">
        <h1 class="sm:text-xl text-lg title-font my-2 text-gray-800 text-center p-2 uppercase">
            {{-- {{ Route::current()->getName() }} --}}
            @if (Route::current()->getName() === 'shared.index')
                <span class="">Documents partagés</span>
            @elseif (Route::current()->getName() === 'mydocuments')
                <span class="">Mes documents</span>
            @else
                Les documents dans <span
                    class="text-tertiary">{{ isset($folder) ? $folder->name : 'Root' }}</span>
            @endif
        </h1>
    </div>
    <div class="w-full">
        <table class="table-auto w-full text-left bg-colorspace-no-wrap border bg-white px-2">

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

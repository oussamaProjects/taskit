<ul class="nested mt-1 -mb-1">
    @foreach ($children as $child)
        <li>
            <a href="/folder/{{ $child->id }}/child"
                class="{{ isset($folder) && $folder->id == $child->id ? 'active' : '' }}">
                <i class="fa fa-folder"></i>
                {{ $child->name }}
                {{-- <small>- 15kb</small> --}}
            </a>
            @if (count($child->children))
                <div class="open-folder">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        class="opened-folder h-4 w-4 absolute -right-5 top-1 cursor-pointer" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="closed-folder h-4 w-4 absolute -right-5 top-1 hidden"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                @include('inc.folders.manageChild2',['children' => $child->children])
            @endif
        </li>
    @endforeach
</ul>

@php
$level ++;
$active = isset($currentFolder) && ($currentFolder->id == $folderParent->id || $currentFolder->parent_id == $folderParent->id);
@endphp

<ul
    class="nested mt-1 -mb-1 currentFolder-{{ isset($currentFolder) ? $currentFolder->id : 0 }} folderParent-{{ $folderParent->id }} {{ $active ? '' : 'hide' }}">
    >
    @foreach ($folderParent->children as $child)
        <li>
            <a href="/folder/{{ $child->id }}/child"
                class="{{ isset($currentFolder) && $currentFolder->id == $child->id ? 'active' : '' }}">
                <div class="flex flex-row flex-wrap items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="{{ $child->color }}"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                    </svg>
                    <span class="ml-1">{{ $child->name }}</span>
                </div>
            </a>
            @if (count($child->children))
                <div class="open-folder">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="opened-folder h-3 w-3 absolute -right-5 top-1 cursor-pointer {{ $active ? '' : 'hidden' }}"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="closed-folder h-3 w-3 absolute -right-5 top-1 cursor-pointer {{ $active ? 'hidden' : '' }}"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                @include('inc.folders.manageChild2',['folderParent' => $child])
            @endif
        </li>
    @endforeach
</ul>

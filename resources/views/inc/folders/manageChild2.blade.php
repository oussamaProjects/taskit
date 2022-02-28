@php
$level++;
$active = isset($currentFolder) && ($currentFolder->id == $folderParent->id || $currentFolder->parent_id == $folderParent->id);
@endphp

<ul
    class="nested mt-1 -mb-1 currentFolder-{{ isset($currentFolder) ? $currentFolder->id : 0 }} folderParent-{{ $folderParent->id }} {{ $active ? '' : 'hide' }}">
    @foreach ($folderParent->children as $child)
        <li>
            <a href="/folder/{{ $child->id }}/child"
                class="{{ isset($currentFolder) && $currentFolder->id == $child->id ? 'active' : '' }}">
                <div class="flex flex-row flex-wrap items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                        class="w-3 h-3" viewBox="0 0 256 256" xml:space="preserve">
                        <defs>
                        </defs>
                        <g transform="translate(128 128) scale(0.72 0.72)" style="">
                            <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;"
                                transform="translate(-175.05 -175.05000000000004) scale(3.89 3.89)">
                                <path
                                    d="M 3.649 80.444 h 82.703 c 2.015 0 3.649 -1.634 3.649 -3.649 v -56.12 c 0 -2.015 -1.634 -3.649 -3.649 -3.649 H 35.525 c -1.909 0 -3.706 -0.903 -4.846 -2.435 l -2.457 -3.301 c -0.812 -1.092 -2.093 -1.735 -3.454 -1.735 H 3.649 C 1.634 9.556 0 11.19 0 13.205 v 63.591 C 0 78.81 1.634 80.444 3.649 80.444 z"
                                    style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: {{ !isset($folderTree->color) || $folderTree->color == '#FFFFFF' ? '#6CC1ED' : $folderTree->color }}; fill-rule: nonzero; opacity: 1;"
                                    transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                <path
                                    d="M 86.351 80.444 H 3.649 C 1.634 80.444 0 78.81 0 76.795 V 29.11 c 0 -2.015 1.634 -3.649 3.649 -3.649 h 82.703 c 2.015 0 3.649 1.634 3.649 3.649 v 47.685 C 90 78.81 88.366 80.444 86.351 80.444 z"
                                    style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: {{ !isset($folderTree->color) || $folderTree->color == '#FFFFFF' ? '#6CC1ED' : $folderTree->color }}; fill-rule: nonzero; opacity: 1;"
                                    transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                <path
                                    d="M 85.106 76.854 H 4.894 c -0.276 0 -0.5 -0.224 -0.5 -0.5 s 0.224 -0.5 0.5 -0.5 h 80.213 c 0.276 0 0.5 0.224 0.5 0.5 S 85.383 76.854 85.106 76.854 z"
                                    style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: {{ !isset($folderTree->color) || $folderTree->color == '#FFFFFF' ? '#6CC1ED' : $folderTree->color }}; fill-rule: nonzero; opacity: 1;"
                                    transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                <path
                                    d="M 85.106 72.762 H 4.894 c -0.276 0 -0.5 -0.224 -0.5 -0.5 s 0.224 -0.5 0.5 -0.5 h 80.213 c 0.276 0 0.5 0.224 0.5 0.5 S 85.383 72.762 85.106 72.762 z"
                                    style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: {{ !isset($folderTree->color) || $folderTree->color == '#FFFFFF' ? '#6CC1ED' : $folderTree->color }}; fill-rule: nonzero; opacity: 1;"
                                    transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            </g>
                        </g>
                    </svg>
                    <span class="ml-1">{{ $child->name }}</span>
                    {{-- <span class="text-xxs">({{ $child->foldersize ?? 0 }}KB)</span> --}}
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

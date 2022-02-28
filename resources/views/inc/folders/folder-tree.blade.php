<div class="tree px-2 py-6 h-full text-xs text-main border">
    <ul class="pt-1 pr-6">
        <li>
            <a href="\folders">
                <div class="flex flex-row flex-wrap items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 24 24" width="24"
                        height="24">
                        <path fill-rule="evenodd"
                            d="M2.75 2A1.75 1.75 0 001 3.75v3.5C1 8.216 1.784 9 2.75 9h18.5A1.75 1.75 0 0023 7.25v-3.5A1.75 1.75 0 0021.25 2H2.75zm18.5 1.5H2.75a.25.25 0 00-.25.25v3.5c0 .138.112.25.25.25h18.5a.25.25 0 00.25-.25v-3.5a.25.25 0 00-.25-.25z">
                        </path>
                        <path
                            d="M2.75 10a.75.75 0 01.75.75v9.5c0 .138.112.25.25.25h16.5a.25.25 0 00.25-.25v-9.5a.75.75 0 011.5 0v9.5A1.75 1.75 0 0120.25 22H3.75A1.75 1.75 0 012 20.25v-9.5a.75.75 0 01.75-.75z">
                        </path>
                        <path d="M9.75 11.5a.75.75 0 000 1.5h4.5a.75.75 0 000-1.5h-4.5z"></path>
                    </svg>
                    <span>Root</span>
                </div>
            </a>
            @php($level = 1)
            <ul>
                @foreach ($folders as $folderTree)
                    <li>
                        <a href="\folders\{{ $folderTree->id }}"
                            class="{{ isset($currentFolder) && $currentFolder->id == $folderTree->id ? 'active' : '' }}">
                            <div class="flex flex-row flex-wrap items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    version="1.1" class="w-3 h-3" viewBox="0 0 256 256" xml:space="preserve">
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
                                <span class="ml-2">{{ $folderTree->name }}</span>
                                {{-- <span class="text-xxs">({{ $folderTree->foldersize }}KB)</span> --}}
                            </div>
                        </a>
                        @if (count($folderTree->children))
                            <div class="open-folder">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="opened-folder h-3 w-3 absolute -right-5 top-1 cursor-pointer hidden"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 15l7-7 7 7" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="closed-folder h-3 w-3 absolute -right-5 top-1 cursor-pointer" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                            @include('inc.folders.manageChild',['folderParent' => $folderTree])
                        @endif
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>
</div>

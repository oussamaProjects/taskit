<div class="tree px-2 py-4 text-xs text-main border bg-bg-color shadow-md">

    <ul class="pt-1 pr-6">
        <li>
            <a href="\folders">         
                <div class="flex flex-row flex-wrap items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M2.75 2A1.75 1.75 0 001 3.75v3.5C1 8.216 1.784 9 2.75 9h18.5A1.75 1.75 0 0023 7.25v-3.5A1.75 1.75 0 0021.25 2H2.75zm18.5 1.5H2.75a.25.25 0 00-.25.25v3.5c0 .138.112.25.25.25h18.5a.25.25 0 00.25-.25v-3.5a.25.25 0 00-.25-.25z"></path><path d="M2.75 10a.75.75 0 01.75.75v9.5c0 .138.112.25.25.25h16.5a.25.25 0 00.25-.25v-9.5a.75.75 0 011.5 0v9.5A1.75 1.75 0 0120.25 22H3.75A1.75 1.75 0 012 20.25v-9.5a.75.75 0 01.75-.75z"></path><path d="M9.75 11.5a.75.75 0 000 1.5h4.5a.75.75 0 000-1.5h-4.5z"></path></svg>
                    <span>Root</span>
                </div>
            </a>
            @php ($level = 1)
            <ul>
                @foreach ($folders as $folderTree)
                    <li>
                        <a href="\folder\{{ $folderTree->id }}\child"
                            class="{{ isset($currentFolder) && $currentFolder->id == $folderTree->id ? 'active' : '' }}">
                            <div class="flex flex-row flex-wrap items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="{{ $folderTree->color }}"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                </svg>
                                <span class="ml-2">{{ $folderTree->name }}</span>
                            </div>
                        </a>
                        @if (count($folderTree->children))
                            <div class="open-folder">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="opened-folder h-3 w-3 absolute -right-5 top-1 cursor-pointer hidden" height="" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
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
                            @include('inc.folders.manageChild2',['folderParent' => $folderTree])
                        @endif
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>
</div>

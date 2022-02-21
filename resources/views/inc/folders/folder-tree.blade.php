<div class="tree px-2 py-6 h-full text-xs text-main border">
    <ul class="pt-1 pr-6">
        <li>
            <a href="\folders">
                <i class="fa fa-folder-open"></i> <span>Root</span>
            </a>
            <ul>
                @foreach ($folders as $folderTree)
                    <li>
                        <a href="\folders\{{ $folderTree->id }}"
                            class="{{ isset($folder) && $folder->id == $folderTree->id ? 'active' : '' }}">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
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
                                    class="opened-folder h-4 w-4 absolute -right-5 top-1 cursor-pointer" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 15l7-7 7 7" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="closed-folder h-4 w-4 absolute -right-5 top-1 hidden" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                            @include('inc.folders.manageChild',['children' => $folderTree->children])
                        @endif
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>
</div>

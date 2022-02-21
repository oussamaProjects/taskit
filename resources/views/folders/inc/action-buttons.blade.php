<div class="flex ml-auto relative text-right">
    <a href="\allFolders"
        class="flex text-bg-color bg-secondary hover:bg-main border-0 py-2 px-6 text-tiny focus:outline-none transition hover:bg-main ml-2">Afficher
        tous les dossiers</a>
        <button id="buttonmodalFolder"
        class="flex text-bg-color bg-secondary hover:bg-main border-0 py-2 px-6 text-tiny focus:outline-none transition hover:bg-main ml-2"
        type="button">
        Ajouter un dossier
    </button>
    @can('upload')
        <button id="buttonmodalFile"
            class="flex text-bg-color bg-secondary hover:bg-main border-0 py-2 px-6 text-tiny focus:outline-none transition hover:bg-main ml-2"
            type="button">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 m-1" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
            </svg>
            <span class="ml-2">Ajouter un document</span>
        </button>
    @endcan
</div>
@if (count($subsidiaries) > 0)
    <div class="mb-2 relative">
        <h3 class="mb-2 text-xl font-medium uppercase">Autorisation</h3>
        <div class="flex flex-row gap-4 flex-wrap">

            @foreach ($subsidiaries as $sub)
                <div>
                    <div class="mb-2"> <span class="text-main font-medium">{{ $sub->subsName }}</span></div>

                    @foreach ($sub->departments()->get() as $dept)
                        <div class="mb-1">
                            <input type="checkbox" name="dept[]" class="opacity-0 absolute"
                                id="{{ $dept['id'] }}_dept" value="{{ $dept['id'] }}">
                            <label
                                class="select-none inline-block text-xs font-light text-bg-color bg-secondary hover:text-main hover:bg-tertiary transition text-center px-2 py-1 mb-1 rounded-sm w-30 cursor-pointer w-full"
                                for="{{ $dept['id'] }}_dept"> {{ $dept['dptName'] }}</label>
                        </div>
                    @endforeach
                </div>
            @endforeach

        </div>

    </div>
@endif


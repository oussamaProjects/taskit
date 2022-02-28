<tr id="tr_{{ $doc->id }}">

    <td  class="text-xs p-1">
        @include('inc.mime-type-icon', ['doc'=>$doc])
    </td>

    <td  class="text-xs p-1">
        <a href="/documents/{{ $doc->id }}" class="block text-xs font-bold capitalize m-0">
            {{ $doc->name }}
        </a>
    </td>

    <td  class="text-xs p-1">{{ $doc->version }}</td>
    <td  class="text-xs p-1">{{ $doc->filesize }}</td>
    
    <td  class="text-xs p-1">
        {{ \Carbon\Carbon::createFromTimeStamp($doc->updated_at->toDayDateTimeString())->formatLocalized('%d %B %Y, %H:%M') }}
    </td>

    <td  class="text-xs p-1">
       @include('inc.mime-type')
    </td>

</tr>

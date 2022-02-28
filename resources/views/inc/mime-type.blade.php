@if (strpos($doc->mimetype, 'image') !== false)
    Image File
@elseif(strpos($doc->mimetype, 'video') !== false)
    Video
@elseif(strpos($doc->mimetype, 'audio') !== false)
    Audio
@elseif(strpos($doc->mimetype, 'text') !== false)
    Text Document
@elseif(strpos($doc->mimetype, 'application/pdf') !== false)
    PDF
@elseif(strpos($doc->mimetype, 'application/vnd.openxmlformats-officedocument') !== false)
    Document Office
@else
    Not identified
@endif

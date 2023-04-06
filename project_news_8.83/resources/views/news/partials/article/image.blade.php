@php
    $thumb = asset('images/article/' . $items['thumb']);
@endphp

<div class="post_image"><img src="{{ $thumb }}" alt="{{ $thumb }}"class="img-fluid w-100"></div>

<div class=" posts ">
    <div class="col-lg-12">
        <div class="row">

            @foreach ($items as $item)
                @php
                    $name = $item['title'];
                    $link = $item['link'];
                    $created = $item['pubDate'];
                    $thumb = $item['thumb'];
                    $content = $item['description'];
                    
                @endphp
                <div class="col-lg-6">
                    <div class="post_item post_v_small d-flex flex-column align-items-start justify-content-start">
                        <div class="post_image"><img src="{{ $thumb }}"
                                alt="{{ $thumb }}"class="img-fluid w-100">
                        </div>
                        <div class="post_content">
                            <div class="post_title"><a href="{{ $link }}">{{ $name }}</a></div>
                            <div class="post_info d-flex flex-row align-items-center justify-content-start">
                                <div class="post_date"><a href="#">{{ $created }}</a></div>
                            </div>

                            <div class="post_text">
                                {!! $content !!}
                            </div>


                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="row">
            <div class="home_button mx-auto text-center"><a href="the-loai/giao-duc-2.html">Xem
                    thêm</a></div>
        </div>
    </div>
</div>

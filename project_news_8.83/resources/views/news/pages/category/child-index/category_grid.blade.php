
    <div class=" posts ">
        <div class="col-lg-12">
            <div class="row">
                @foreach ($category['article'] as $article)
                    <div class="col-lg-6">
                        <div class="post_item post_v_small d-flex flex-column align-items-start justify-content-start">
                            @include('news.partials.article.image', ['items' => $article])
                            @include('news.partials.article.content', [
                                'items' => $article,
                                'lenghtContent' =>100,
                                'showCategoryName' => false,
                            ])
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

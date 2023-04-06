

    <div class="posts">
            @foreach ($category['article'] as $article)
            <div class="post_item post_h_large">
                <div class="row">
                    <div class="col-lg-5">
                        @include('news.partials.article.image', ['items' => $article])
                    </div>
                    <div class="col-lg-7">
                        @include('news.partials.article.content', ['items' =>$article,'lenghtContent'=>500,'showCategoryName'=>false])
                    </div>
                </div>
            </div>
            @endforeach
       
            
        <div class="row">
            <div class="home_button mx-auto text-center"><a href="the-loai/the-thao-1.html">Xem
                    thêm</a></div>
        </div>
    </div>

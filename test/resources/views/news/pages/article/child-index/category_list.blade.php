

    <div class="posts">
            @foreach ($item as $item)
            <div class="post_item post_h_large">
                <div class="row">
                    <div class="col-lg-5">
                        @include('news.partials.article.image', ['items' => $item])
                    </div>
                    <div class="col-lg-7">
                        @include('news.partials.article.content', ['items' =>$item,'lenghtContent'=>500,'showCategoryName'=>false])
                    </div>
                </div>
            </div>
            @endforeach
       
            
        <div class="row">
            <div class="home_button mx-auto text-center"><a href="the-loai/the-thao-1.html">Xem
                    thêm</a></div>
        </div>
    </div>

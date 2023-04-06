

<div class="featured">
    <div class="featured_title">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title_container d-flex flex-row align-items-start justify-content-start">
                        <div>
                            <div class="section_title">Bài viết nổi bật</div>
                        </div>
                        <div class="section_bar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured Title -->
    <div class="row">
        <div class="col-lg-8">
            <!-- Post -->
            <div class="post_item post_v_large d-flex flex-column align-items-start justify-content-start">
                <div class="post_item post_v_small d-flex flex-column align-items-start justify-content-start">
                    @include('news.partials.article.image', ['items' => $itemFeatured[0]])
                    @include('news.partials.article.content', ['items' => $itemFeatured[0],'lenghtContent'=>500,'showCategoryName'=>true])
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            @php unset($itemFeatured[0]) @endphp
            @foreach ($itemFeatured as $item)
                <div>
                    <div class="post_item post_v_small d-flex flex-column align-items-start justify-content-start">
                        @include('news.partials.article.image', ['items' => $item])
                        @include('news.partials.article.content', ['items' => $item, 'lenghtContent'=>0,'showCategoryName'=>true])
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

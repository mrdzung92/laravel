@extends('news.main')
@section('content')
<div class="section-category">
    @include('news.block.breadcrumb_article',['item'=>$itemArticle])
    <div class="content_container container_category">
        <div class="container">
            <div class="row">
                <!-- Single Post -->
                <div class="col-lg-9">
                    <div class="single_post">
                        @include('news.partials.article.image', ['items' => $itemArticle])
                        @include('news.partials.article.content', ['items' =>$itemArticle,'lenghtContent'=>10000,'showCategoryName'=>true])
                        <div class="section_title_container d-flex flex-row align-items-start justify-content-start zvn-title-category">
                            <div>
                                <div class="section_title">Bài viết liên quan</div>
                            </div>
                            <div class="section_bar"></div>
                        </div>

                        @include('news.pages.article.child-index.category', ['item' =>$itemArticle])

                    </div>
                </div>
                <!-- Sidebar -->
                <div class="col-lg-3">
                    <div class="sidebar">
                        <!-- Latest Posts -->
                        @include('news.block.latest', ['itemsLatest' => $itemLatest])
                        <!-- Advertisement -->
                        <!-- Extra -->
                        @include('news.block.extra', ['itemsExtra' => []])
                        <!-- Most Viewed -->
                        @include('news.block.most_viewed', ['itemsMost_viewed' => []])
                        <!-- Tags -->
                        @include('news.block.tags', ['itemsTags' => []])

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

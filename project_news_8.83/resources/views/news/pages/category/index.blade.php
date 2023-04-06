@extends('news.main')
@section('content')
    <div class="section-category">
            @include('news.block.breadcrumb',['name'=>$itemCategory['name']])
        <div class="content_container container_category">
            <div class="featured_title">
                <div class="container">
                    <div class="row">
                        <!-- Main Content -->
                        <div class="col-lg-9 ">
                            
                            @include('news.pages.category.child-index.category', ['category' =>$itemCategory])
                            
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
    </div>

@endsection

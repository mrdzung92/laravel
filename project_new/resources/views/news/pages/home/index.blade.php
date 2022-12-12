@extends('news.main')
    @section('content')
    
   

<!-- Home -->
@include('news.block.slider')
<!-- Content Container -->
<div class="content_container">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="main_content">
                    <!-- Featured --> 
                    @include('news.block.Featured',['itemFeatured'=>[]])
                    <!-- Category -->
                    @include('news.pages.home.child-index.child_index')
                </div>
            </div>
            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="sidebar">
                    <!-- Latest Posts -->
                    @include('news.block.Latest_Posts',['itemLatest'=>[]])
                    <!-- Advertisement -->
                    @include('news.block.Advertisement',['itemAdvertisement'=>[]])
                    <!-- Most Viewed -->
                    @include('news.block.Most_Viewed',['itemMostViewed'=>[]])
                    <!-- Tags -->
                    @include('news.block.Tags',['itemTags'=>[]])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
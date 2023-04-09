@extends('news.main')
@section('content')
    
    <!-- Content Container -->
    <div class="content_container">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-9">
                    <div class="main_content">
                       <img src="{{asset('images/404.png')}}" alt="">
                       <h1>Liên kết không đúng , ấn vào <a href="{{route('home')}}"> đây</a> để quay về trang chủ</h1>
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

@endsection
@extends('news.main')
@section('content')
    <div class="section-category">
            @include('news.block.breadcrumb',['name'=>$title])
        <div class="content_container container_category">
            <div class="featured_title">
                <div class="container">
                    <div class="row">
                        <!-- Main Content -->
                        <div class="col-lg-8 ">
                            
                            @include('news.pages.rss.child-index.list', ['items' =>$items])

                        </div>
                        <div class="col-lg-4 ">
                            <div id="box-gold" data-url="{{route('rss/get-gold')}}">
                                <h3>Giá Coin</h3>
                                <img src="{{asset('images/loading.gif')}}" alt="">
                            </div>
                            <div id="box-coin" data-url="{{route('rss/get-coin')}}">
                                <h3>Giá Coin</h3>
                                <img src="{{asset('images/loading.gif')}}" alt="">
                            </div>
                            {{-- @include('news.pages.rss.child-index.box-gold')
                            @include('news.pages.rss.child-index.box-coin') --}}

                        </div>
                        <!-- Sidebar -->
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

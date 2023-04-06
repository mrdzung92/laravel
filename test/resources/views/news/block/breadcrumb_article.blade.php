@php
use App\Helpers\Url;
 $linkCategory = Url::linkCategory($item['category_id'], $item['category_name']);
 $categoryName =  $item['category_name'];
 $linkHome  = route('home');
 $articleName = $item['name'];

@endphp
<div class="home">
    <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="{{asset('news/images/footer.jpg')}}" data-speed="0.8"></div>
    <div class="home_content_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="home_content">
                        <div class="home_title">{{$articleName}}</div>
                        <div class="breadcrumbs">
                            <ul class="d-flex flex-row align-items-start justify-content-start">
                                <li><a href="{{$linkHome}}">Trang chủ</a></li>
                                <li><a href="{{$linkCategory}}">
                                    {{$categoryName}}</a>
                                </li>
                                <li>{{$articleName}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
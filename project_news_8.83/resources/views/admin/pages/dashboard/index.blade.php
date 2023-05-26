@extends('admin.main')
@section('content')
    @php
        $arrayBoxFormat = [
            'article' => ['name' => 'Article', 'class' => 'bg-info', 'icon' => 'fa-newspaper', 'route' => route('article')],
            'user' => ['name' => 'User', 'class' => 'bg-success', 'icon' => 'fa-user-plus', 'route' => route('user')],
            'category' => ['name' => 'Category', 'class' => 'bg-warning', 'icon' => 'fa-book-open', 'route' => route('category')],
            'slider' => ['name' => 'Slider', 'class' => 'bg-info', 'icon' => 'fa-sliders', 'route' => route('slider')],
        ];
    @endphp
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Dashboard'])
                <div class="x_content">
                    <div class="row">
                        <div class="row">
                            @foreach ($arrayBoxFormat as $key => $item)
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box {{ $item['class'] }}">
                                        <div class="inner">
                                            <h3>{{ $itemsCount[$key] }}</h3>

                                            <p>{{ $item['name'] }}</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa-solid {{ $item['icon'] }}"></i>
                                        </div>
                                        <a href="{{ $item['route'] }}" class="small-box-footer">Xem chi tiết <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

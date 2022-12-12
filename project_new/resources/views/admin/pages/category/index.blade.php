@extends('admin.main')
@php
    use App\helper\template as template ;
    $xhtmlBtnFilter = template::showBtnFilter($controllerName,$itemsStatusCount,$params['filter']['status'],$params['search']);
    $xhtmlAreaSearch = template::showAreaSearch($controllerName,$params['search']);
@endphp
@section('content')
@include('admin.templates.page_header',['pageIndex'=>true])
 
    @include('admin.templates.notify',['content'=>'status'])

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title',['title'=>'Bộ lọc'])
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-7">{!!$xhtmlBtnFilter!!}</div>
                        <div class="col-md-5">{!!$xhtmlAreaSearch!!}</div>
                
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--box-lists-->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title',['title'=>'Danh sách'])
                @include('admin.pages.category.list')
            </div>
        </div>
    </div>
    <!--end-box-lists-->
    <!--box-pagination-->
    @if (count($items) > 0)
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title',['title'=>'Phân trang'])
                @include('admin.templates.pagination')
            </div>
        </div>
    </div>
    @endif
    
@endsection

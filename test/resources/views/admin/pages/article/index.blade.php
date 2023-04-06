@extends('admin.main')
@php
    use App\Helpers\Template as Template;
    $htmlButtonFilter = Template::showButtonFiter($controllerName,$itemsStatusCount,$params['filter']['status'],$params['search']);
    $htmlAreaSearch = Template::showAreaSearch($controllerName,$params['search']);
@endphp
@section('content')
        @include('admin.templates.page_header',['pageIndex'=>true])

        @include('admin.templates.notify',['content'=>'my_notify'])
   
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Bộ lọc'])
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-7">
                            {!!$htmlButtonFilter!!}
                           
                        </div>
                        <div class="col-md-5">
                            {!!$htmlAreaSearch!!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--box-lists-->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Danh sách'])
                <div class="x_content">
                    <div class="table-responsive">
                        @include('admin.pages.article.list')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end-box-lists-->
    <!--box-pagination-->
    @if (count($items) > 0      )
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    @include('admin.templates.x_title', ['title' => 'Phân trang'])
                    @include('admin.templates.pagination')
                </div>
            </div>
        </div>
    @endif

    <!--end-box-pagination-->
@endsection

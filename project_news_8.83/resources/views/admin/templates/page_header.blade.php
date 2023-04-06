@php
    
    $pageTitle = 'Quản lý ' . ucfirst($controllerName);
    
    $button =
        '<a href="' .
        route($controllerName) .
        '" class="btn btn-info">
        <i class="fa fa-arrow-left"></i> Quay về</a>';
    
    if ($pageIndex == true) {
        $button =
            ' <a href="' .
            route($controllerName . '/form') .
            '" class="btn btn-success">
            <i class="fa fa-plus-circle"></i> Thêm mới</a>';
    }
    
@endphp
<div class="page-header zvn-page-header clearfix">
    <div class="zvn-page-header-title">
        <h3>{{ $pageTitle }}</h3>
    </div>
    <div class="zvn-add-new pull-right">
        {!! $button !!}
    </div>
</div>

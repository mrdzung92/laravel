@extends('admin.main')
@php
    use App\Helpers\FormTemplate as FormTemplate;
    $formAttributes = Config::get('myConfig.template.form');
    $statusValue = [
        'default' => 'Select-Status',
        'active' => Config::get('myConfig.template.status.active.name'),
        'inactive' => Config::get('myConfig.template.status.inactive.name'),
    ];
    $displayValue = [
        'default' => 'Select-Display',
        'list' => Config::get('myConfig.template.display.list.name'),
        'grid' => Config::get('myConfig.template.display.grid.name'),
    ];
    $IsHomeValue = [
        'default' => 'Select-Is-Home',
        'yes' => Config::get('myConfig.template.isHome.yes.name'),
        'no' => Config::get('myConfig.template.isHome.no.name'),
    ];
    $elements = [
        [
            'label' => Form::label('name', 'Name', $formAttributes['label']),
            'element' => Form::text('name', $item['name'] ?? '', $formAttributes['input']),
        ],
        [
            'label' => Form::label('status', 'Status', $formAttributes['label']),
            'element' => Form::select('status', $statusValue, $item['status'] ?? '', $formAttributes['input']),
        ],
        [
            'label' => Form::label('display', 'Display', $formAttributes['label']),
            'element' => Form::select('display', $displayValue, $item['display'] ?? '', $formAttributes['input']),
        ],
        [
            'label' => Form::label('is_home', 'Show is Home', $formAttributes['label']),
            'element' => Form::select('is_home', $IsHomeValue, $item['is_home'] ?? '', $formAttributes['input']),
        ],
        [
            'element' => Form::hidden('id', $item['id'] ?? '')  . Form::submit('Save', ['class' => 'btn btn-success']),
            'type' => 'btn-submit',
        ],
    ];
    
@endphp
@section('content')
    @include('admin.templates.page_header', ['pageIndex' => false])
    @include('admin.templates.error')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Form'])
                <div class="x_content">
                    <div class="row">
                        {!! Form::open([
                            'url' => route($controllerName . '/save'),
                            ' accept-charset' => 'UTF-8',
                            'method' => 'POST',
                            'enctype' => 'multipart/form-data',
                            'class' => 'form-horizontal form-label-left',
                            'id' => 'main-form',
                        ]) !!}
                        {!! FormTemplate::show($elements) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end-box-pagination-->
@endsection

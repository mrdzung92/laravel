@extends('admin.main')
@php
    use App\Helpers\FormTemplate as FormTemplate;
    $formAttributes = Config::get('myConfig.template.form');
    $statusValue = [
        'active' => Config::get('myConfig.template.status.active.name'),
        'inactive' => Config::get('myConfig.template.status.inactive.name'),
    ];
    $typeOpenValue = array_combine(array_keys(Config::get('myConfig.template.type_open')), array_column(Config::get('myConfig.template.type_open'),'name'));
    $typeMenuValue = array_combine(array_keys(Config::get('myConfig.template.type_menu')), array_column(Config::get('myConfig.template.type_menu'),'name'));
    $elements = [
        [
            'label' => Form::label('name', 'Name', $formAttributes['label']),
            'element' => Form::text('name', $item['name'] ?? '', $formAttributes['input']),
        ],
        [
            'label' => Form::label('link', 'Link', $formAttributes['label']),
            'element' => Form::text('link', $item['link'] ?? '', $formAttributes['input']),
        ],
        [
            'label' => Form::label('ordering', 'Ordering', $formAttributes['label']),
            'element' => Form::number('ordering', $item['ordering'] ?? '', $formAttributes['input']),
        ],
        [
            'label' => Form::label('status', 'Status', $formAttributes['label']),
            'element' => Form::select('status', $statusValue, $item['status'] ?? '', $formAttributes['input']),
        ],
        [
            'label' => Form::label('type_open', 'Type Open', $formAttributes['label']),
            'element' => Form::select('type_open', $typeOpenValue, $item['type_open'] ?? '', $formAttributes['input']),
        ],
        [
            'label' => Form::label('type_menu', 'Type Menu', $formAttributes['label']),
            'element' => Form::select('type_menu', $typeMenuValue, $item['type_menu'] ?? '', $formAttributes['input']),
        ],
        [
            'element' => Form::hidden('id', $item['id'] ?? '') . Form::submit('Save', ['class' => 'btn btn-success']),
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

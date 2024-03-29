@extends('admin.main')
@php
    use App\helper\template as Template;
    use App\helper\Form as FormTemplate;
    
    $formAtributes = config('zendvn.template.form');
    $inputHiddenId = Form::hidden('id', $items['id'] ?? '');
    $inputHiddenThumb = Form::hidden('thumb_current', $items['thumb'] ?? '');
    $elements = [
        [
            'label' => Form::label('name', 'Name', ['class' => $formAtributes['label_atributes']]),
            'element' => Form::text('name', $items['name'] ?? '', ['class' => $formAtributes['input_atributes']]),
        ],
    
        [
            'label' => Form::label('description', 'Description', ['class' => $formAtributes['label_atributes']]),
            'element' => Form::text('description', $items['description'] ?? '', ['class' => $formAtributes['input_atributes']]),
        ],
        [
            'label' => Form::label('status', 'Status', ['class' => $formAtributes['label_atributes']]),
            'element' => Form::select('status', ['active' => config('zendvn.template.status.active.name'), 'inactive' => config('zendvn.template.status.inactive.name')], $items['status'] ?? '', ['placeholder' => 'Select Status', 'class' => $formAtributes['input_atributes']]),
        ],
        [
            'label' => Form::label('link', 'Link', ['class' => $formAtributes['label_atributes']]),
            'element' => Form::text('link', $items['link'] ?? '', ['class' => $formAtributes['input_atributes']]),
        ],
        [
            'label' => Form::label('thumb', 'Thumb', ['class' => $formAtributes['label_atributes']]),
            'element' => Form::file('thumb', ['class' => $formAtributes['input_atributes']]),
            'thumb' => !empty($items['id']) ? Template::showItemThumb($controllerName, $items['thumb'], $items['name']) : null,
            'type' => 'thumb',
        ],
    
        [
            'element' => $inputHiddenId . $inputHiddenThumb . Form::submit('Save', ['class' => 'btn btn-success']),
            'type' => 'btn-submit',
        ],
    ];
    
@endphp
@section('content')
    @include('admin.templates.page_header', ['pageIndex' => false])
    @include('admin.templates.validate_error', ['pageIndex' => false])
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Form'])
                <div class="x_content">
                    <div class="row">

                        {!! Form::open([
                            'method' => 'POST',
                            'url' => route("$controllerName/save"),
                            'enctype' => 'multipart/form-data',
                            'class' => 'form-horizontal form-label-left',
                            'id' => 'main-form',
                            'accept-charset' => 'UTF-8',
                        ]) !!}
                        {!! FormTemplate::show($elements) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

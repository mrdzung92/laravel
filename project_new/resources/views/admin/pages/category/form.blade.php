@extends('admin.main')
@php
    use App\helper\template as Template;
    use App\helper\Form as FormTemplate;
    
    $formAtributes = config('zendvn.template.form');
    $inputHiddenId = Form::hidden('id', $items['id'] ?? '');
    $elements = [
        [
            'label' => Form::label('name', 'Name', ['class' => $formAtributes['label_atributes']]),
            'element' => Form::text('name', $items['name'] ?? '', ['class' => $formAtributes['input_atributes']]),
        ],       
        [
            'label' => Form::label('status', 'Status', ['class' => $formAtributes['label_atributes']]),
            'element' => Form::select('status', ['active' => config('zendvn.template.status.active.name'), 'inactive' => config('zendvn.template.status.inactive.name')], $items['status'] ?? '', ['placeholder' => 'Select Status', 'class' => $formAtributes['input_atributes']]),
        ],
        [
            'element' => $inputHiddenId . Form::submit('Save', ['class' => 'btn btn-success']),
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

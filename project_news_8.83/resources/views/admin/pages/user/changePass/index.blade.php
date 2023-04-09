@extends('admin.main')

@section('content')
    @include('admin.templates.page_header', ['pageIndex' => false])
    @include('admin.templates.error')
    @php
        use App\Helpers\FormTemplate as FormTemplate;
        $formAttributes = Config::get('myConfig.template.form');
        
        $elements = [
            [
                'label' => Form::label('old_pass', 'Old PassWord', $formAttributes['label']),
                'element' => Form::password('old_password', $formAttributes['input']),
            ],
            [
                'label' => Form::label('password', 'PassWord', $formAttributes['label']),
                'element' => Form::password('password', $formAttributes['input']),
            ],
            [
                'label' => Form::label('password_confirmation ', 'Password_confirmation ', $formAttributes['label']),
                'element' => Form::password('password_confirmation', $formAttributes['input']),
            ],
            [
                'element' => Form::hidden('changePwd', 'form-task') . Form::hidden('id', $item['id'] ?? '') . Form::submit('Save', ['class' => 'btn btn-success']),
                'type' => 'btn-submit',
            ],
        ];
        
    @endphp


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Form change password'])
                <div class="x_content">
                    <div class="row">
                        {!! Form::open([
                            'url' => route($controllerName . '/change-pwd'),
                            ' accept-charset' => 'UTF-8',
                            'method' => 'POST',
                            'enctype' => 'multipart/form-data',
                            'class' => 'form-horizontal form-label-left',
                            'id' => 'main-form',
                        ]) !!}
                        {!! FormTemplate::show($elements) !!}
                        {{ csrf_field() }}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

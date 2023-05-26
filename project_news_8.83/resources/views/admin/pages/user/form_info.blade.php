@php
    use App\Helpers\FormTemplate as FormTemplate;
    $formAttributes = Config::get('myConfig.template.form');
    $statusValue = [
        'default' => 'Select-Status',
        'active' => Config::get('myConfig.template.status.active.name'),
        'inactive' => Config::get('myConfig.template.status.inactive.name'),
    ];

    $elements = [
        [
            'label' => Form::label('username', 'UserName', $formAttributes['label']),
            'element' => Form::text('username', $item['username'] ?? '', $formAttributes['input']),
        ],
        [
            'label' => Form::label('email', 'Email', $formAttributes['label']),
            'element' => Form::text('email', $item['email'] ?? '', $formAttributes['input']),
        ],
        [
            'label' => Form::label('fullname', 'Fullname', $formAttributes['label']),
            'element' => Form::text('fullname', $item['fullname'] ?? '', $formAttributes['input']),
        ],

        [
            'label' => Form::label('status', 'Status', $formAttributes['label']),
            'element' => Form::select('status', $statusValue, $item['status'] ?? '', $formAttributes['input']),
        ],

        [
            'label' => Form::label('avatar', 'Avatar', $formAttributes['label']),
            'element' => Form::file('avatar', $formAttributes['input']) . (!empty($item['id']) ? FormTemplate::showItemThumb($controllerName, $item['avatar'] ?? '', $item['avatar'] ?? '') : ''),
        ],
        [
            'element' => Form::hidden('edit-info', 'form-task') . Form::hidden('id', $item['id'] ?? '') . Form::hidden('thumb_current', $item['avatar'] ?? '') . Form::submit('Save', ['class' => 'btn btn-success']),
            'type' => 'btn-submit',
        ],
    ];

@endphp


<div class="col-md-6 col-sm-12 col-xs-12">
    <div class="x_panel">
        @include('admin.templates.x_title', ['title' => 'Form Edit Info'])
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
                {{ csrf_field() }}
                {!! FormTemplate::show($elements) !!}


                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<!--end-box-pagination-->

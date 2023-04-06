
@php
    use App\Helpers\FormTemplate as FormTemplate;
    $formAttributes = Config::get('myConfig.template.form');
    $statusValue = [
        'default' => 'Select-Status',
        'active' => Config::get('myConfig.template.status.active.name'),
        'inactive' => Config::get('myConfig.template.status.inactive.name'),
    ];
    $levelValue = [
        'default' => 'Select-Level',
        'admin' => Config::get('myConfig.template.level.admin.name'),
        'member' => Config::get('myConfig.template.level.member.name'),
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
            'label' => Form::label('password', 'PassWord', $formAttributes['label']),
            'element' => Form::password('password', $formAttributes['input']),
        ],
        [
            'label' => Form::label('password_confirmation ', 'Password_confirmation ', $formAttributes['label']),
            'element' => Form::password('password_confirmation', $formAttributes['input']),
        ],
        [
            'label' => Form::label('status', 'Status', $formAttributes['label']),
            'element' => Form::select('status', $statusValue, $item['status'] ?? '', $formAttributes['input']),
        ],
        [
            'label' => Form::label('level', 'Level', $formAttributes['label']),
            'element' => Form::select('level',$levelValue, $item['level'] ?? '', $formAttributes['input']),
        ],
        [
            'label' => Form::label('avatar', 'Avatar', $formAttributes['label']),
            'element' => Form::file('avatar', $formAttributes['input']) . (!empty($item['id']) ? FormTemplate::showItemThumb($controllerName, $item['avatar']??'', $item['avatar']??'') : ''),
        ],
        [
            'element' =>Form::hidden('add', 'form-task'). Form::hidden('id', $item['id'] ?? '') . Form::hidden('thumb_current', $item['avatar'] ?? '') . Form::submit('Save', ['class' => 'btn btn-success']),
            'type' => 'btn-submit',
        ],
    ];
    
@endphp

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Form Add'])
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


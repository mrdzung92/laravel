
@php
    use App\Helpers\FormTemplate as FormTemplate;
    $formAttributes = Config::get('myConfig.template.form');
    $levelValue = [
        'default' => 'Select-Level',
        'admin' => Config::get('myConfig.template.level.admin.name'),
        'member' => Config::get('myConfig.template.level.member.name'),
    ];
    $elements = [
        
        [
            'label' => Form::label('level', 'Level', $formAttributes['label']),
            'element' => Form::select('level',$levelValue, $item['level'] ?? '', $formAttributes['input']),
        ],
    
        [
            'element' =>Form::hidden('changeLevel', 'form-task'). Form::hidden('id', $item['id'] ?? '')  . Form::submit('Save', ['class' => 'btn btn-success']),
            'type' => 'btn-submit',
        ],
    ];
    
@endphp

    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Form Change Level'])
                <div class="x_content">
                    <div class="row">
                        {!! Form::open([
                            'url' => route($controllerName . '/change-level'),
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


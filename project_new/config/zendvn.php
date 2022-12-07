<?php 
return [
    'url'=>[
        'prefix_admin' =>'admin'
    ],
    'format' =>[
        'long_time'=>'H:m:s d/m/Y',
        'short_time'=>'d/m/Y'
    ],
    'template'=>[
        'status'=>[
            'all' => ['name' => 'All', 'class' => 'btn-success'],
            'active' => ['name' => 'Active', 'class' => 'btn-success'],
            'inactive' => ['name' => 'Inctive', 'class' => 'btn-danger'],
            'block' => ['name' => 'block', 'class' => 'btn-info'],
            'default' => ['name' => 'undifined', 'class' => 'btn-danger']
        ]
    ]
    
]
?>
<?php
return [
    'url' => [
        'prefix_admin' => 'admin',
        'prefix_new' => 'news'
    ],
    'format' => [
        'long_time' => 'H:m:s d/m/Y',
        'short_time' => 'd/m/Y'
    ],
    'template' => [
        'form'=>[
            'label_atributes'=> ['class'=>'control-label col-md-3 col-sm-3 col-xs-12'] ,
            'input_atributes'=> ['class'=>"form-control col-md-6 col-xs-12"]
        ],
        'status' => [
            'all' => ['name' => 'All', 'class' => 'btn-success'],
            'active' => ['name' => 'Active', 'class' => 'btn-success'],
            'inactive' => ['name' => 'Inactive', 'class' => 'btn-danger'],
            'block' => ['name' => 'block', 'class' => 'btn-info'],
            'default' => ['name' => 'undifined', 'class' => 'btn-danger']
        ],
        'is_home' => [
           
            '1' => ['name' => 'Show', 'class' => 'btn-success'],
            '0' => ['name' => 'Hide', 'class' => 'btn-danger'],         
            'default' => ['name' => 'undifined', 'class' => 'btn-danger']
        ],
        'display' => [
            'default' => ['name' => 'undifined'],
            'list' => ['name' => 'List'],
            'grid' => ['name' => 'Grid'],         
            
        ],
        'search' => [
            'all' => ['name' => 'Search by All'],
            'id' => ['name' => 'Search by ID'],
            'name' => ['name' => 'Search by Name'],
            'username' => ['name' => 'Search by Username'],
            'fullname' => ['name' => 'Search by Fullname'],
            'email' => ['name' => 'Search by Email'],
            'description' => ['name' => 'Search by Description'],
            'link' => ['name' => 'Search by Link'],
            'content' => ['name' => 'Search by Content'],

        ],
        'actionBtn'=>[
            'edit' => ['class' => 'btn-success', 'title' => 'Edit', 'icon' => 'fa-pencil', 'route-name' => '/form'],
            'delete' => ['class' => 'btn-danger btn-delete', 'title' => 'Delete', 'icon' => 'fa-trash', 'route-name' => '/delete'],
            'info' => ['class' => 'btn-info', 'title' => 'View', 'icon' => 'fa-trash', 'route-name' => '/delete']
        ]
    ],
    'config' => [
        'search' => [
            'slider' => ['all','id','name',  'description', 'link'],
            'default' => ['fullname', 'name'],
            'category' => ['all','id','name'],
        ],
        'actionBtn' => [
            'default' => ['edit', 'delete'],
            'slider' => ['edit', 'delete'],
            'category' => ['edit', 'delete']
        ]

    ]

];

<?php
return [
    'url' => [
        'prefix_admin' => 'admin69',
        'prefix_news' => 'news69',
    ],
    'format' => [
        'long_time' => 'H:m:s d-m-Y',
        'short_time' => 'd-m-Y',
    ],
    'template' => [
        'form' => [
            'input' => [
                'class' => 'form-control col-md-6 col-xs-12" name="name'
            ],
            'label' => [
                'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
            ],
            'form_ckeditor' => [
                'class' => 'control-label col-md-3 col-sm-3 col-xs-12 ckeditor'
            ],
        ],
        'status' => [
            'all' => ['name' => 'Tất cả', 'class' => 'btn-success'],
            'active' => ['name' => 'Kích hoạt', 'class' => 'btn-success'],
            'inactive' => ['name' => 'Chưa kích Hoạt', 'class' => 'btn-danger'],
            'default' => ['name' => 'Chưa xác định', 'class' => 'btn-danger'],
        ],
        'isHome' => [
            'yes' => ['name' => 'Hiển thị', 'class' => 'btn-success'],
            'no' => ['name' => 'Không hiển thị', 'class' => 'btn-info'],
            'default' => ['name' => 'Chưa xác định', 'class' => 'btn-danger'],
        ],
        'display' => [
            'grid' => ['name' => 'Kiểu lưới', 'class' => 'btn-success'],
            'list' => ['name' => 'Danh sách', 'class' => 'btn-info'],
            'default' => ['name' => 'Chưa xác định', 'class' => 'btn-danger'],
        ],
        'type' => [
            'featured' => ['name' => 'Nổi bật', 'class' => 'btn-success'],
            'normal' => ['name' => 'Bình thường', 'class' => 'btn-info'],
            'default' => ['name' => 'Chưa xác định', 'class' => 'btn-danger'],
        ],

        'level' => [
            'admin' => ['name' => 'Quản trị viên', 'class' => 'btn-success'],
            'member' => ['name' => 'Thành viên', 'class' => 'btn-info'],
            'default' => ['name' => 'Chưa xác định', 'class' => 'btn-danger'],
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
        'button' => [
            'edit' => ['class' => 'btn-success', 'title' => 'Edit', 'icon' => 'fa-pencil', 'route-name' => '/form'],
            'delete' => ['class' => 'btn-danger btn-delete', 'title' => 'Delete', 'icon' => 'fa-trash', 'route-name' => '/delete'],
            'info' => ['class' => 'btn-info', 'title' => 'View', 'icon' => 'fa-trash', 'route-name' => '/delete'],
        ],

    ],
    'config' => [
        'search' => [
            'slider' => ['all', 'id', 'name', 'description', 'link'],
            'default' => ['fullname', 'name'],
            'category' => ['all', 'id', 'name'],
            'article' => ['all', 'name', 'content'],
            'user' => ['all','username', 'email', ],
        ],
        'button' => [
            'default' => ['edit', 'delete'],
            'slider' => ['edit', 'delete'],
            'category' => ['edit', 'delete'],
            'article' => ['edit', 'delete'],
            'user' => ['edit'],
        ],
    ],
];

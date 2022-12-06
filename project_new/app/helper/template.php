<?php

namespace App\helper;

use Config;
use Dotenv\Regex\Success;

class Template
{
    public static function showItemHistory($by, $time)
    {
        return sprintf('<p><i class="fa fa-user"></i> %s</p>
        <p><i class="fa fa-clock-o"></i> %s </p>', $by, date(Config::get('zendvn.format.long_time'), strtotime($time)));
    }

    public static function showItemStatus($controlerName, $status, $id)
    {
        $tmpStatus = [
            'active' => ['name' => 'Active', 'class' => 'btn-success'],
            'inactive' => ['name' => 'Inctive', 'class' => 'btn-danger']
        ];
        $currentStatus = $tmpStatus[$status];
        $link  = route($controlerName . '/change-status', ['id' => $id, 'status' => $status]);
        return sprintf('<a href="%s" type="button"
        class="btn btn-round %s">%s</a>', $link, $currentStatus['class'], $currentStatus['name']);
    }

    public static function showItemThumb($controlerName, $thumbName, $thumbAlt)
    {
        return sprintf('<img src="%s" alt="%s" class="zvn-thumb">', asset("image/$controlerName/$thumbName"), $thumbAlt);
    }


    public static function showButtonAction($controllerName, $id)
    {
        $tmpButton = [
            'edit' => ['class' => 'btn-success', 'title' => 'Edit', 'icon' => 'fa-pencil', 'route-name' => $controllerName . '/form'],
            'delete' => ['class' => 'btn-danger', 'title' => 'Delete', 'icon' => 'fa-trash', 'route-name' => $controllerName . '/delete'],
            'info' => ['class' => 'btn-info', 'title' => 'View', 'icon' => 'fa-trash', 'route-name' => $controllerName . '/delete']
        ];
        $btnInArea = [
            'default' => ['edit', 'delete'],
            'slider' => ['edit', 'delete']
        ];

        $controllerName = (array_key_exists($controllerName, $btnInArea)) ? $controllerName : 'default';
        $listButton  = $btnInArea[$controllerName];
        $xhtml = ' <div class="zvn-box-btn-filter">';
        foreach ($listButton as $btn) {
            $currentBtn = $tmpButton[$btn];
            $link = route($currentBtn['route-name'], ['id' => $id]);
            $xhtml .= sprintf('<a href="%s" type="button"
                     class="btn btn-icon %s" data-toggle="tooltip" data-placement="top"
                    data-original-title="%s">
                    <i class="fa %s"></i>
                 </a>', $link, $currentBtn['class'], $currentBtn['title'], $currentBtn['icon']);
        };
        $xhtml .= '</div>';

        return $xhtml;
    }
}

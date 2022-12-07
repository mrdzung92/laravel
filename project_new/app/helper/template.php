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
        $tmpStatus = Config::get('zendvn.template.status');

        $statusValue = array_key_exists($status, $tmpStatus) ? $status : 'default';
  
        $currentTemplateStatus = $tmpStatus[$statusValue];
        $link  = route($controlerName . '/change-status', ['id' => $id, 'status' => $status]);
        return sprintf('<a href="%s" type="button"
        class="btn btn-round %s">%s</a>', $link, $currentTemplateStatus['class'], $currentTemplateStatus['name']);
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


    public static function showBtnFilter($controllerName,$itemsStatusCount,$currentFilterStatus)
    {
        $xhtml = null;
        $tmpStatus = Config::get('zendvn.template.status');
        if (count($itemsStatusCount) > 0) {

            $all['count'] = array_sum(array_column($itemsStatusCount, 'count'));
            $all['status'] = 'all';
            array_unshift($itemsStatusCount, $all);
            foreach ($itemsStatusCount as $item) {
                $statusValue = $item['status'];
                $statusValue = array_key_exists($statusValue, $tmpStatus) ? $statusValue : 'default';
                $currentTemplateStatus = $tmpStatus[$statusValue];
                $link = route($controllerName).'?filter_status='.$statusValue;
                $class = ($currentFilterStatus ==$statusValue)?'btn-success':'btn-primary';

                $xhtml .= sprintf('<a href="%s" type="button" class="btn %s">
                %s <span class="badge bg-white">%s</span>
            </a>',$link, $class, $currentTemplateStatus['name'], $item['count']);
            }
        }


        // <a href="?filter_status=active" type="button" class="btn btn-success">
        //     Active <span class="badge bg-white">2</span>
        // </a><a href="?filter_status=inactive" type="button" class="btn btn-success">
        //     Inactive <span class="badge bg-white">2</span>
        // </a>
        return $xhtml;
    }
}

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
        return sprintf('<img src="%s" alt="%s" class="zvn-thumb">', asset("images/$controlerName/$thumbName"), $thumbAlt);
    }


    public static function showButtonAction($controllerName, $id)
    {
        $tmpButton = Config::get('zendvn.template.actionBtn');
        $btnInArea = Config::get('zendvn.config.actionBtn');

        $controllerName = (array_key_exists($controllerName, $btnInArea)) ? $controllerName : 'default';
        $listButton  = $btnInArea[$controllerName];
        $xhtml = ' <div class="zvn-box-btn-filter">';
        foreach ($listButton as $btn) {
            $currentBtn = $tmpButton[$btn];
            $link = route($controllerName.$currentBtn['route-name'], ['id' => $id]);
            $xhtml .= sprintf('<a href="%s" type="button"
                     class="btn btn-icon %s" data-toggle="tooltip" data-placement="top"
                    data-original-title="%s">
                    <i class="fa %s"></i>
                 </a>', $link, $currentBtn['class'], $currentBtn['title'], $currentBtn['icon']);
        };
        $xhtml .= '</div>';

        return $xhtml;
    }


    public static function showBtnFilter($controllerName, $itemsStatusCount, $currentFilterStatus,$paramSearch)
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
                $link = route($controllerName) . '?filter_status=' . $statusValue;
                if($paramSearch['value']!==""){
                    $link.="&search_field={$paramSearch['field']}&search_value={$paramSearch['value']}" ;
                }
                $class = ($currentFilterStatus == $statusValue) ? 'btn-success' : 'btn-primary';

                $xhtml .= sprintf('<a href="%s" type="button" class="btn %s">
                %s <span class="badge bg-white">%s</span>
            </a>', $link, $class, $currentTemplateStatus['name'], $item['count']);
            }
        }
        return $xhtml;
    }


    public static function showAreaSearch($controllerName,$paramSearch)
    {
        $xhtml = null;
        $tmpField =Config::get('zendvn.template.search');
        $fieldInController = Config::get('zendvn.config.search');

        $controllerName = array_key_exists($controllerName,$fieldInController)?$controllerName:'default';
        $xhtmlField ='';
     foreach($fieldInController[$controllerName] as $field){
        $xhtmlField.=sprintf(' <li><a href="#" class="select-field" data-field="%s">%s</a></li>',$field, $tmpField[$field]['name']);
     }
        $searchValue = $paramSearch['value'];
        $searchField = (in_array($paramSearch['field'],$fieldInController[$controllerName])) ? $paramSearch['field']:'all';
        $xhtml = sprintf('<div class="input-group">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default dropdown-toggle btn-active-field"
                                        data-toggle="dropdown" aria-expanded="false">
                                        %s<span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    %s
                                        
                                    </ul>
                                </div>
                                <input type="hidden" name="search_field" value="%s">
                                <input type="text" class="form-control" name="search_value" value="%s">
                                <span class="input-group-btn">
                                    <button id="btn-clear" type="button" class="btn btn-success"
                                        style="margin-right: 0px">Xóa tìm kiếm</button>
                                    <button id="btn-search" type="button" class="btn btn-primary">Tìm kiếm</button>
                                </span>
                                
                         </div>',$tmpField[$searchField]['name'],$xhtmlField,$searchField, $searchValue);
        return $xhtml;
    }
}

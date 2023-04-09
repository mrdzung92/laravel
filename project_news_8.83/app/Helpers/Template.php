<?php
namespace App\Helpers;

use Config;

class Template
{
    public static function showItemHistory($time, $by)
    {
        return '
                    <p><i class="fa fa-user"></i> ' . $by . '</p>
                    <p><i class="fa fa-clock-o"></i> ' . date(Config::get('myConfig.format.short_time'), strtotime($time)) . '</p>
                ';
    }

    public static function showItemStatus($status, $id, $controllerName)
    {
        $html = null;
        $tmplStatus = Config::get('myConfig.template.status');
        $statusValue = $status;
        $statusValue = array_key_exists($statusValue, $tmplStatus) ? $statusValue : 'default';
        $currentStatus = $tmplStatus[$statusValue];
        $link = route($controllerName . '/status', ['status' => $status, 'id' => $id]);
        // $link = url( $link) . '?' . http_build_query((request()->input()));
        $html = sprintf('<button data-url="%s" type="button"
        class="btn btn-round %s ajax-button">%s</button>', $link, $currentStatus['class'], $currentStatus['name']);
        return $html;
    }

    public static function showItemIsHome($isHome, $id, $controllerName)
    {
        $html = null;
        $isHomeTemp = Config::get('myConfig.template.isHome');
        $isHomeValue = $isHome;
        $isHomeValue = array_key_exists($isHomeValue, $isHomeTemp) ? $isHomeValue : 'default';
        $currentTemplIsHome = $isHomeTemp[$isHomeValue];

        $link = route($controllerName . '/isHome', ['isHome' => $isHomeValue, 'id' => $id]);
        // $link = url( $link) . '?' . http_build_query((request()->input()));

      $html = sprintf('<button data-url="%s" type="button"
        class="btn btn-round ajax-button %s">%s</button>', $link, $currentTemplIsHome['class'], $currentTemplIsHome['name']);
        return $html;
    }

    public static function showItemSelect($value, $id, $controllerName,$fieldName)
    {
        $html = null;
        $selectTempl = Config::get('myConfig.template.'.$fieldName);
        $selectValue = 'default';
        if(array_key_exists($value, $selectTempl)){
             unset($selectTempl['default']); 
             $selectValue = $value;
        }

        $link = route($controllerName . '/'.$fieldName, [$fieldName => 'value_new', 'id' => $id]);
        $link = url( $link) . '?' . http_build_query((request()->input()));
        $html = '<select name="select_change_attr" data-url="'.$link.'" class="form-control">';
        foreach ($selectTempl as $key => $value) {
            $Selected = ($key === $selectValue )?'selected':'';
            $html.=sprintf('<option value="%s" %s>%s</option>',$key,$Selected,$value['name']);
        }
       $html .= '</select>';
        return $html;
    }

    public static function showItemThumb($thumb, $thumbAlt, $controllerName)
    {
        return sprintf('<img src="%s" alt="%s" class="zvn-thumb">', asset('images/' . $controllerName . '/' . $thumb), $thumbAlt);
    }

    public static function showButtonAction($controllerName, $id)
    {
        $tmplButton   = Config::get('myConfig.template.button');
        $buttonInArea = Config::get('myConfig.config.button');
        $html = '<div class="zvn-box-btn-filter">';
        $controllerName = (array_key_exists($controllerName, $buttonInArea)) ? $controllerName : 'default';
        $listButton = $buttonInArea[$controllerName];
        foreach ($listButton as $value) {
            $currentBtn = $tmplButton[$value];
            $link = route($controllerName.$currentBtn['route-name'], ['id' => $id]);
            $class = $currentBtn['class'];
            $title = $currentBtn['title'];
            $icon = $currentBtn['icon'];

            $html .= sprintf('<a href="%s"
                                type="button"
                                class="btn btn-icon %s"
                                data-toggle="tooltip"
                                data-placement="top"
                                data-original-title="%s">
                                <i class="fa %s"></i>
                            </a>', $link, $class, $title, $icon);
        }

        $html .= '</div>';

        return $html;
    }

    public static function showButtonFiter($controllerName, $itemsStatusCount, $currentFilterStatus,$paramSearch)
    {   
        $tmplButton = Config::get('myConfig.template.status');
        array_unshift($itemsStatusCount, [
            'count' => array_sum(array_column($itemsStatusCount, 'count')),
            'status' => 'all',
        ]);

        $html = null;
        if (count($itemsStatusCount) > 0) {
            foreach ($itemsStatusCount as $item) {
                $statusValue = $item['status'];
                $statusValue = array_key_exists($statusValue, $tmplButton) ? $statusValue : 'default';
                $currentStatus = $tmplButton[$statusValue];
                $link = route($controllerName) . '?filter_status=' . $statusValue;
                if($paramSearch['value']!==''){
                    $link .="&search_field=".$paramSearch['field']."&search_value=".$paramSearch['value'];
                }
                $class = ($statusValue === $currentFilterStatus) ? 'btn-info' : 'btn-primary';
                $html .= sprintf('<a
                                href="%s"
                                type="button"
                                class="btn %s">
                                %s
                                <span class="badge bg-white">%s</span>
                             </a>', $link, $class, ucfirst($currentStatus['name']), $item['count']);
            }

        }

        return $html;
    }

    public static function showAreaSearch($controllerName,$paramSearch)
    {

        $tmplField = Config::get('myConfig.template.search');
        $fieldInController = Config::get('myConfig.config.search');
        $controllerName = array_key_exists($controllerName, $fieldInController) ? $controllerName : 'default';
        $html = null;
        $htmlField =null;
       $searchField = in_array($paramSearch['field'], $fieldInController[$controllerName]) ? $paramSearch['field']:'all';
        foreach ($fieldInController[$controllerName]  as $value) {
            $htmlField.=sprintf('<li>
                                     <a href="#" class="select-field" data-field="%s">%s</a>
                                </li>',$value,$tmplField[$value]['name']);
        }

        $html = sprintf('<div class="input-group">
        <div class="input-group-btn">
            <button type="button" class="btn btn-default dropdown-toggle btn-active-field"
                data-toggle="dropdown" aria-expanded="false">
                %s <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                 %s
            </ul>
        </div>
        <input type="text" class="form-control" name="search_value" value="%s">
        <span class="input-group-btn">
            <button id="btn-clear" type="button" class="btn btn-success"
                style="margin-right: 0px">Xóa tìm kiếm</button>
            <button id="btn-search" type="button" class="btn btn-primary">Tìm kiếm</button>
        </span>
        <input type="hidden" name="search_field" value="%s">
    </div>',$tmplField[$searchField]['name'],$htmlField,$paramSearch['value']??'', $searchField);

        return $html;
    }


    public static function showDateTimeFrontend($time)
    {
       return date_format(date_create($time),Config::get('myConfig.format.short_time'));
    }

    public static function showContent($content,$lenght,$prefix='...')
    {
        $prefix= ($lenght===0)?'':$prefix;
        $content = str_replace(['<p>','</p>'],'',$content);
       return preg_replace('/\s+?(\S+)?$/','',substr($content,0,$lenght)).$prefix;
    }
}

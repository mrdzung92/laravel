<?php
namespace App\Helpers;

class FormTemplate
{
    public static function show($elements)
    {
        $html = '';

        foreach ($elements as $element) {
            $html .= FormTemplate::formGroup($element, $option=null);
        }
        return $html;

    }

    public static function formGroup($element, $option=null)
    {
        $html = '';
        $type = isset($element['type']) ? $element['type'] : 'input';
        switch ($type) {
            case 'btn-submit':
                $html = sprintf('  <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            %s
                                        </div>
                                    </div>', $element['element']);
                break;

            default:
                $html = sprintf('<div class="form-group">
                                    %s
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    %s
                                </div>
                            </div>', $element['label'], $element['element']);
                break;
        }

        return $html;

    }

    public static function showItemThumb($controllerName, $thumb,$name)
    {
        $html = sprintf('<p style="margin-top: 50px;"><img
                            src="%s" alt="Ưu đãi học phí"
                            class="zvn-thumb">
                        </p>',asset('images/'.$controllerName.'/'.$thumb));
        return $html;

    }

}

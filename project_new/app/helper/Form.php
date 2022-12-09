<?php

namespace App\helper;

use Config;
use Dotenv\Regex\Success;

class Form
{
    public static function show($elements)
    {
        $xhtml = null;
        foreach ($elements as  $element) {
            $xhtml .= self::formGroup($element);
        }
        return $xhtml;
    }

    public static function formGroup($elements, $param = null)
    {
        $type = $elements['type'] ?? 'input';
        $xhtml = null;
        switch ($type) {
            case 'btn-submit':
                $xhtml .= sprintf(
                    '<div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            %s
                        </div>
                    </div>',
                    $elements['element']
                );
                break;
            case 'input':
                $xhtml .= sprintf(
                    '<div class="form-group">
                            %s
                        <div class="col-md-6 col-sm-6 col-xs-12">
                             %s
                        </div>
                    </div>',
                    $elements['label'],
                    $elements['element']
                );
                break;

                case 'thumb':
                    $xhtml .= sprintf(
                        '<div class="form-group">
                                %s
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                 %s
                                 <p style="margin-top: 50px;">%s</p>  
                            </div>
                        </div>',
                        $elements['label'],
                        $elements['element'],
                        $elements['thumb']
                    );
                    break;
        }

        return $xhtml;
    }
}
// <input name="id" type="hidden" value="3">
// <input name="thumb_current" type="hidden" value="LWi6hINpXz.jpeg">
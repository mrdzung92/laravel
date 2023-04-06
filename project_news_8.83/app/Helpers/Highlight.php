<?php
namespace App\Helpers;



class Highlight
{
    public static function show($input,$paramSearch,$field)
    {

        $result ='';
        if($paramSearch['value']==='') return $input;
        if($paramSearch['field']==='all' || $paramSearch['field']==$field){
            return preg_replace("/".preg_quote($paramSearch['value'],"/")."/i","<mark>$0</mark>",$input);
        } 
        return $input;
        
       
    }

   
}

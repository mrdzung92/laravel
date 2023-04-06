<?php
namespace App\Helpers;
use Illuminate\Support\Str;


class Url
{
    public static function linkCategory($id,$name)
    {

     return  $link = route('category/index',['category_id'=>$id,'category_name'=> Str::slug($name)]);
       
    }

    public static function linkArticle($id,$name)
    {

     return  $link = route('article/index',['article_id'=>$id,'article_name'=> Str::slug($name)]);
       
    }

   
}

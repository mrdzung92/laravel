<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\models\SliderModel;
use App\models\CategoryModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $pathViewController = 'news.pages.home.';
    private $controllerName = 'home';
    private $params =[] ;
    private $model ;

    public function __construct()
    {   

        view()->share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {   $SliderModel = new SliderModel();
        $itemSlider =$SliderModel->listItem(null, ['task'=>'news-list-items']);

        $CategoryModel = new CategoryModel();
        $itemCategory =$CategoryModel->listItem(null, ['task'=>'news-list-items-is-home']);
        return view($this->pathViewController . 'index', [
            'params'=>$this->params,
            'itemSlider'=>$itemSlider,
            'itemCategory'=>$itemCategory
        ]);
       
    }

}


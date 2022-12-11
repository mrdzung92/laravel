<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\models\SliderModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $pathViewController = 'news.pages.home.';
    private $controllerName = 'home';
    private $params =[] ;
    private $model ;

    public function __construct()
    {   $this->model = new SliderModel();
        view()->share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {   
        $itemSlider =$this->model->listItem(null, ['task'=>'news-list-items']);
        return view($this->pathViewController . 'index', [
            'params'=>$this->params,
            'itemSlider'=>$itemSlider
        ]);
       
    }

}

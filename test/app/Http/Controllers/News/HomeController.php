<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\ArticleModel as ArticleModel;
use App\Models\CategoryModel as CategoryModel;
use App\Models\SliderModel as SliderModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $pathViewController = 'news.pages.home.';
    private $controllerName = 'home';
    private $params = [];
    private $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);

    }

    public function index(Request $request)
    {
        $SliderModel = new SliderModel();
        $CategoryModel = new CategoryModel();
        $ArticleModel = new ArticleModel();

        $itemSlider = $SliderModel->listItems(null, ['task' => 'news-list-items']);
        $itemCategory = $CategoryModel->listItems(null, ['task' => 'news-list-items-is-home']);
        $itemFeatured = $ArticleModel->listItems(null, ['task' => 'news-list-items-featured']);
        $itemLatest = $ArticleModel->listItems(null, ['task' => 'news-list-items-latest']);

        foreach($itemCategory as $key =>$category){
            $itemCategory[$key]['article'] =  $ArticleModel->listItems(
                ['category_id'=>$category['id']], ['task' => 'news-list-items-in-category']);
        }
        
    
        return view($this->pathViewController . 'index', [
            'params' => $this->params,
            'itemSlider' => $itemSlider,
            'itemCategory' => $itemCategory,
            'itemFeatured' => $itemFeatured,
            'itemLatest' => $itemLatest,
        ]);
    }

}

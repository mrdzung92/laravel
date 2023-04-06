<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\ArticleModel as ArticleModel;
use App\Models\CategoryModel as CategoryModel;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $pathViewController = 'news.pages.category.';
    private $controllerName = 'category';
    private $params = [];
    private $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);

    }

    public function index(Request $request)
    { 
        $params['id'] = $request->category_id;
  
        $ArticleModel = new ArticleModel();
        $CategoryModel = new CategoryModel();

       

        $itemCategory = $CategoryModel->listItems($params, ['task' => 'news-get-item']);
       
        if(empty($itemCategory)){
            return redirect()->route('home');
        };
        
        
        $itemCategory['article'] =  $ArticleModel->listItems(['category_id'=>$itemCategory['id']], ['task' => 'news-list-items-in-category']);
        $itemLatest = $ArticleModel->listItems(null, ['task' => 'news-list-items-latest']);
        
        return view($this->pathViewController . 'index', [
            'params' => $this->params,
            'itemLatest' => $itemLatest,
            'itemCategory'=> $itemCategory
        ]);
    }

}

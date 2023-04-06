<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\ArticleModel as ArticleModel;

use Illuminate\Http\Request;

class NotifyController extends Controller
{
    private $pathViewController = 'news.pages.notify.';
    private $controllerName = 'notify';
    private $params = [];
    private $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);

    }

    public function noPermission(Request $request)
    { 
        $ArticleModel = new ArticleModel();
           
        $itemLatest = $ArticleModel->listItems(null, ['task' => 'news-list-items-latest']); 
        return view($this->pathViewController . 'index', [
            'params' => $this->params,
            'itemLatest' => $itemLatest,
            
        ]);
    }

}

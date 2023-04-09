<?php

namespace App\Http\Controllers\News;

use App\Models\ArticleModel as ArticleModel;
use Illuminate\Http\Request;

class NotifyController extends NewsMainController
{

    public function __construct()
    {
        $this->pathViewController = 'news.pages.notify.';
        $this->controllerName = 'notify';
        $this->params = [];
        $this->model;
        parent::__construct();

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

    public function pageError(Request $request)
    {
        $ArticleModel = new ArticleModel();

        $itemLatest = $ArticleModel->listItems(null, ['task' => 'news-list-items-latest']);
        return view($this->pathViewController . 'page-not-found', [
            'params' => $this->params,
            'itemLatest' => $itemLatest,

        ]);
    }

}

<?php

namespace App\Http\Controllers\News;
use App\Models\ArticleModel as ArticleModel;
use Illuminate\Http\Request;

class ArticleController extends NewsMainController
{

    public function __construct()
    {
        $this->pathViewController = 'news.pages.article.';
        $this->controllerName = 'article';
        $this->params = [];
        $this->model;
        parent::__construct();
    }

    public function index(Request $request)
    {
        $params['article_id'] = $request->article_id;

        $ArticleModel = new ArticleModel();

        $itemArticle = $ArticleModel->getItem($params, ['task' => 'news-get-item']);
        $params['id'] = $itemArticle['category_id'];
        // $itemCategory = $CategoryModel->listItems($params, ['task' => 'news-get-item']);

        if (empty($itemArticle)) {
            return redirect()->route('home');
        };

        $params['category_id'] = $itemArticle['category_id'];

        $itemArticle['reated_article'] = $ArticleModel->listItems($params, ['task' => 'news-list-items-realated-in-category']);
        $itemLatest = $ArticleModel->listItems(null, ['task' => 'news-list-items-latest']);

        return view($this->pathViewController . 'index', [
            'params' => $this->params,
            'itemLatest' => $itemLatest,
            'itemArticle' => $itemArticle,
        ]);
    }

}

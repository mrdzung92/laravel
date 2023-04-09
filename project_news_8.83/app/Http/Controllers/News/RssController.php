<?php

namespace App\Http\Controllers\News;

use App\Helpers\Feed;
use App\Models\RssModel as RssModel;
use Illuminate\Http\Request;

class RssController extends Controller
{

    public function __construct()
    {
        $this->pathViewController = 'news.pages.rss.';
        $this->controllerName = 'rss';
        $this->params = [];
        $this->model;
        parent::__construct();
    }

    public function index(Request $request)
    {
        view()->share('title', 'Tin tức tổng hợp');
        $rssModel = new RssModel();
        $itemRss = $rssModel->listItems(null, ['task' => 'news-list-items']);

        $data = Feed::read($itemRss);
        $subArray = array_slice($data, 0, 20);

        return view($this->pathViewController . 'index', [
            'items' => $subArray,
        ]);
    }

    public function getGold(Request $request)
    {
        $itemGold = Feed::getGold();
        return view($this->pathViewController . 'child-index.box-gold', [
            'itemsGold' => $itemGold,
        ]);
    }

    public function getCoin(Request $request)
    {
        $itemCoin = Feed::getCoin();
        return view($this->pathViewController . 'child-index.box-coin', [
            'itemCoin' => $itemCoin,
        ]);
    }

}

<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\RssModel as RssModel;
use Illuminate\Http\Request;
use App\Helpers\Feed;

class RssController extends Controller
{
    private $pathViewController = 'news.pages.rss.';
    private $controllerName = 'rss';
    private $params = [];
    private $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);

    }

    public function index(Request $request)
    { 
        view()->share('title', 'Tin tức tổng hợp');
        $rssModel = new RssModel();
        $itemRss = $rssModel->listItems(null, ['task' => 'news-list-items']);
        // $itemGold  = Feed::getGold();
        // $itemCoin  = Feed::getCoin();
        $data  = Feed::read($itemRss);
        $subArray = array_slice($data,0,20);

  
        return view($this->pathViewController . 'index', [
            'items' =>  $subArray,
            // 'itemsGold' =>  $itemGold,
            // 'itemCoin' =>  $itemCoin,
           
        ]);
    }

    public function getGold(Request $request)
    { 
        $itemGold  = Feed::getGold();
        return view($this->pathViewController . 'child-index.box-gold', [          
            'itemsGold' =>  $itemGold,     
        ]);
    }

    public function getCoin(Request $request)
    { 
        $itemCoin  = Feed::getCoin();
        return view($this->pathViewController . 'child-index.box-coin', [          
            'itemCoin' =>  $itemCoin,     
        ]);
    }

}

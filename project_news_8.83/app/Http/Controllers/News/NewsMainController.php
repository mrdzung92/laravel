<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsMainController extends Controller
{
    protected $pathViewController = '';
    protected $controllerName = '';
    protected $params = [];
    protected $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);

    }
}

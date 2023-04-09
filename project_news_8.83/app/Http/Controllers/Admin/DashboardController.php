<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\DashboardModel as MainModel;
class DashboardController extends AdminMainController
{

    public function __construct()
    {
        $this->pathViewController = 'admin.pages.dashboard.';
        $this->controllerName = 'dashboard';
        $this->model = new MainModel();
        parent::__construct();
    }

    public function index(Request $request)
    {
        $params['table'] = ['article','user','category','slider'];      
        $itemsCount =  $this->model-> countItems($params);
        return view($this->pathViewController . 'index',['itemsCount'=>$itemsCount]);
    }
   
}

<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\SliderModel as MainModel;

class SliderController extends Controller
{
    private $pathViewController = 'admin.pages.slider.';
    private $controllerName = 'slider';
    private $params =[] ;
    private $model ;

    public function __construct()
    {
        $this->model = new MainModel();
        $this->params['pagination']['totalItemsPerPage'] =1;
        view()->share('controllerName', $this->controllerName);
    }

    public function index()
    {   
        $items = $this->model->listItem( $this->params, ['task' => 'admin-list-item']);
        return view($this->pathViewController . 'index', [
            'items' => $items
        ]);
       
    }
    public function form($id = null)
    {
        $title = 'slider- controller -form';
        return view($this->pathViewController . 'form', [
            'id' => $id,
            'title' => $title
        ]);
    }
    public function delete()
    {
        return 'slider-controller-delete';
    }

    public function changeStatus(Request $request)
    {
        echo '<pre>';
        print_r($request->id);
        echo '</pre>';
        return redirect()->route('slider');
    }
}

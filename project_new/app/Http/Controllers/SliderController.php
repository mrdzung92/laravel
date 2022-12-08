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
        $this->params['pagination']['totalItemsPerPage'] = 3;
        view()->share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {   
        $this->params['filter']['status'] = $request->input('filter_status','all');
        $this->params['search']['field'] = $request->input('search_field','');
        $this->params['search']['value'] = $request->input('search_value','');
        $items = $this->model->listItem( $this->params, ['task' => 'admin-list-item']);
        $itemsStatusCount = $this->model->countItems( $this->params, ['task' => 'admin-count-item-group-by-status']);
        return view($this->pathViewController . 'index', [
            'params'=>$this->params,
            'items' => $items,
            'itemsStatusCount' => $itemsStatusCount
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
        $params['currentStatus'] =$request->status;
        $params['id'] =$request->id;
        $this->model->saveItem($params,['task'=>'change-status']);
  
        return redirect()->route($this-> controllerName)->with('status', 'Cập nhật trạng thái thành công');
    }
}

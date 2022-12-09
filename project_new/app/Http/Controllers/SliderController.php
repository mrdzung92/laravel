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
    public function form(Request $request)
    {
        $items = null;
        if($request->id !==null){
            $params['id'] =$request->id;
            $items = $this->model->getItems( $params, ['task'=>'get-item']);
        }
        echo '<pre>';
        print_r($items);
        echo '</pre>';

        return view($this->pathViewController . 'form',['items'=>$items]);
    }

    public function save(Request $request)
    {
        echo '<h3>save</h3>';
    
       
    }
    public function delete(Request $request)
    {
        $params['id'] =$request->id;
        $this->model->deleteItem($params,['task'=>'delete-item']);
  
        return redirect()->route($this-> controllerName)->with('status', 'Xoá phần tử thành công');
    }

    public function changeStatus(Request $request)
    {
        $params['currentStatus'] =$request->status;
        $params['id'] =$request->id;
        $this->model->saveItem($params,['task'=>'change-status']);
  
        return redirect()->route($this-> controllerName)->with('status', 'Cập nhật trạng thái thành công');
    }
}

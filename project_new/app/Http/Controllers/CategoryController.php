<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\CategoryModel as MainModel;
use App\Http\Requests\CategoryRequest as MainRequest;

class CategoryController extends Controller
{
    private $pathViewController = 'admin.pages.category.';
    private $controllerName = 'category';
    private $params =[] ;
    private $model ;

    public function __construct()
    {   
        $this->model = new MainModel();
        $this->params['pagination']['totalItemsPerPage'] = 10;
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
        return view($this->pathViewController . 'form',['items'=>$items]);
    }

    public function save(MainRequest $request)
    {
        if(request()->method()=='POST'){
            $params = request()->all();
            $task = 'add-item';
            $notify = 'Thêm phần tử thành công';
            if($params['id']!==null){
                $task = 'edit-item';
                $notify = 'Cập nhật phần tử thành công';
            }

            $this->model->saveItem($params,['task'=> $task]);
            return redirect()->route($this->controllerName)->with('status',$notify);
        }
        
       
    
       
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

    public function isHome(Request $request)
    {
        $params['currentIsHome'] =$request->is_home;
        $params['id'] =$request->id;
        $this->model->saveItem($params,['task'=>'change-is-home']);
  
        return redirect()->route($this-> controllerName)->with('status', 'Cập nhật trạng thái thành công');
    }

    public function display(Request $request)
    {
        $params['currentDisplay'] =$request->display_value;
        $params['id'] =$request->id;
        $this->model->saveItem($params,['task'=>'change-display']);
  
        return redirect()->route($this-> controllerName)->with('status', 'Thay đổi kiểu hiện thị thành công');
    }
}

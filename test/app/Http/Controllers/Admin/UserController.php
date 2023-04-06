<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel as MainModel;
use App\Http\Requests\UserRequest as MainRequest;
class UserController extends Controller
{
    private $pathViewController = 'admin.pages.user.';
    private $controllerName = 'user';
    private $params =[];
    private $model;

    public function __construct()
    {
        $this->model = new MainModel();
        $this->params =[
            'pagination'=>[
                'totalItemPerPage'=>5
            ]
        ];
        view()->share('controllerName', $this->controllerName);
        
    }

    public function index(Request $request)
    {      
        $this->params['filter']['status']      =  $request->input('filter_status','all');
        $this->params['search']['field']      =  $request->input('search_field','');
        $this->params['search']['value']      =  $request->input('search_value','');
       $items               = $this->model->listItems($this->params,['task'=>'admin-list-item']);
       $itemsStatusCount    = $this->model->countItems($this->params,['task'=>'admin-count-item-group-by-status']);
        return view($this->pathViewController . 'index',[
            'params'=>$this->params,
            'items'=>$items,
            'itemsStatusCount'=>$itemsStatusCount
        ]);
    }
    public function form(Request $request)
    {
        $item = null;
        if($request->id !==null){
            $params['id'] = $request->id;
            $item= $this->model->getItem($params,['task'=>'get-item']);
        }
        return view($this->pathViewController . 'form',[
            'item'=>$item
        ]);
    }
    
    public function delete(Request $request)
    {
        $params['id'] = $request->id;
        $this->model->deleteItem( $params,['task'=>'delete-item']);
        return redirect()->route($this->controllerName)->with('my_notify','Xoá phần tử thành công');
    }

    public function status(Request $request)
    {
        $params['currentStatus'] = $request->status;
        $params['id'] = $request->id;
       $this->model->saveItem( $params,['task'=>'changeStatus']);
        return redirect()->route($this->controllerName)->with('my_notify','Cập nhật trạng thái thành công');
    }

    public function changePwd(MainRequest $request)
    {
        if($request->method()=='POST'){
            $params = $request->all();
            $this->model->saveItem( $params,['task'=>'change-password']);
            return redirect()->route($this->controllerName)->with('my_notify','Thay đổi mật khẩu thành công');
        }
    }

    public function level(Request $request)
    {
        $params['currentLevel'] = $request->level;
        $params['id'] = $request->id;

       $this->model->saveItem( $params,['task'=>'changeLevel']);
        return redirect()->route($this->controllerName)->with('my_notify','Cập nhật trạng thái thành công');
    }

    public function formChangeLevel(MainRequest $request)
    {
        $params['currentLevel'] = $request->level;
        $params['id'] = $request->id;
       $this->model->saveItem( $params,['task'=>'changeLevel']);
        return redirect()->route($this->controllerName)->with('my_notify','Cập nhật trạng thái thành công');
    }

    


    public function save(MainRequest $request)
    {
        if($request->method() =='POST'){
            $params= $request->all();
            $task = 'add-item';
            $notify = 'Thêm phần tử thành công';
            if($params['id'] !==null){
                $task = 'edit-item';
                $notify = 'Cập nhật phần tử thành công';  
            }
            $this->model->saveItem($params,['task'=>$task]);
            
            return redirect()->route($this->controllerName)->with('my_notify',$notify);
        }
    }
}

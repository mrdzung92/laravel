<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;

class AdminMainController extends Controller
{
    private $pathViewController = '';
    private $controllerName = '';
    private $params = [];
    private $model;

    public function __construct($controllerName,$modelName)
    {
       
        $this->model = new $modelName();
        $this->controllerName = $controllerName;
        view()->share('controllerName', $this->controllerName);
    }

    public function status(Request $request)
    {
        $params['currentStatus'] = $request->status;
        $params['id'] = $request->id;
        $this->model->saveItem($params, ['task' => 'changeStatus']);
        $newStatus = $request->status === 'active' ? 'inactive' : 'active';
        $arrayConfig = Config::get('myConfig.template.status');
        
        $result = [
            'success' => true,
            'status' => $newStatus,
            'classAdd' => $arrayConfig[$newStatus]['class'],
            'newName' => $arrayConfig[$newStatus]['name'],
            'classRemove' => $arrayConfig[$params['currentStatus']]['class'],   
            'msg' => Config::get('myConfig.notify.status.success'),    
            'url' => route($this->controllerName . '/status', ['status' => $newStatus, 'id' => $params['id']]),
        ];
        return response()->json( $result);
    }


    public function changeSelectBoxAjax(Request $request,$currentValue,$task)
    {
        $params['currentValue'] = $currentValue;
        $params['id'] = $request->id;
        $this->model->saveItem($params, ['task' => $task]);      
        $result = [
            'success' => true,  
            'msg' => Config::get('myConfig.notify.changeSelectBox.success')
        ];
        return response()->json( $result);
    }

    

   
}

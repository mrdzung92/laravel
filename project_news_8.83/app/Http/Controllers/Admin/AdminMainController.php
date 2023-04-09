<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Config;
use Illuminate\Http\Request;

class AdminMainController extends Controller
{
    protected $pathViewController = '';
    protected $controllerName = '';
    protected $params = [];
    protected $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }
    
    public function index(Request $request)
    {
        $this->params['filter']['status'] = $request->input('filter_status', 'all');
        $this->params['search']['field'] = $request->input('search_field', '');
        $this->params['search']['value'] = $request->input('search_value', '');
        $items = $this->model->listItems($this->params, ['task' => 'admin-list-item']);
        $itemsStatusCount = $this->model->countItems($this->params, ['task' => 'admin-count-item-group-by-status']);
        return view($this->pathViewController . 'index', [
            'params' => $this->params,
            'items' => $items,
            'itemsStatusCount' => $itemsStatusCount,
        ]);
    }

    public function form(Request $request)
    {
        $item = null;
        if ($request->id !== null) {
            $params['id'] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        }
        return view($this->pathViewController . 'form', [
            'item' => $item,
        ]);
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
        return response()->json($result);
    }

    public function delete(Request $request)
    {
        $params['id'] = $request->id;
        $this->model->deleteItem($params, ['task' => 'delete-item']);
        return redirect()->route($this->controllerName)->with('my_notify', 'Xoá phần tử thành công');
    }

    public function changeSelectBoxAjax(Request $request, $currentValue, $task)
    {
        $params['currentValue'] = $currentValue;
        $params['id'] = $request->id;
        $this->model->saveItem($params, ['task' => $task]);
        $result = [
            'success' => true,
            'msg' => Config::get('myConfig.notify.changeSelectBox.success'),
        ];
        return response()->json($result);
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest as MainRequest;
use App\Models\CategoryModel as MainModel;
use Config;
use Illuminate\Http\Request;

class CategoryController extends AdminMainController
{
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.category.';
        $this->controllerName = 'category';
        $this->model = new MainModel();
        parent::__construct($this->controllerName, $this->model);
        $this->params = [
            'pagination' => [
                'totalItemPerPage' => 5,
            ],
        ];
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
    public function delete(Request $request)
    {
        $params['id'] = $request->id;
        $this->model->deleteItem($params, ['task' => 'delete-item']);
        return redirect()->route($this->controllerName)->with('my_notify', 'Xoá phần tử thành công');
    }

    public function status(Request $request)
    {
        return parent::status($request);
    }

    public function changeIsHome(Request $request)
    {
        $params['currentIsHome'] = $request->isHome;
        $params['id'] = $request->id;
        $this->model->saveItem($params, ['task' => 'change-is-home']);
        $newIsHome = $request->isHome === 'yes' ? 'no' : 'yes';
        $arrayConfig = Config::get('myConfig.template.isHome');
        $result = [
            'success' => true,
            'classAdd' => $arrayConfig[$newIsHome]['class'],
            'newName' => $arrayConfig[$newIsHome]['name'],
            'classRemove' => $arrayConfig[$params['currentIsHome']]['class'],
            'msg' => Config::get('myConfig.notify.isHome.success'),
            'url' => route($this->controllerName . '/isHome', ['isHome' => $newIsHome, 'id' => $params['id']]),
        ];
        return response()->json($result);
        // return redirect()->route($this->controllerName,request()->input())->with('my_notify','Cập nhật trạng thái thành công');
    }

    public function changeDisplay(Request $request)
    {
       return $this->changeSelectBoxAjax($request,$request->display,'change-display');
        // $params['currentDisplay'] = $request->display;
        // $params['id'] = $request->id;
        // $this->model->saveItem($params, ['task' => 'change-display']);

        // return redirect()->route($this->controllerName,request()->input())->with('my_notify','Cập nhật trạng thái thành công');
    }

    public function save(MainRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();
            $task = 'add-item';
            $notify = 'Thêm phần tử thành công';
            if ($params['id'] !== null) {
                $task = 'edit-item';
                $notify = 'Cập nhật phần tử thành công';
            }
            $this->model->saveItem($params, ['task' => $task]);

            return redirect()->route($this->controllerName)->with('my_notify', $notify);
        }
    }
}

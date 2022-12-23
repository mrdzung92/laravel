<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\ArticleModel as MainModel;
use App\models\CategoryModel;
use App\Http\Requests\ArticleRequest as MainRequest;

class ArticleController extends Controller
{
    private $pathViewController = 'admin.pages.article.';
    private $controllerName = 'article';
    private $params = [];
    private $model;

    public function __construct()
    {
        $this->model = new MainModel();
        $this->params['pagination']['totalItemsPerPage'] = 5;
        view()->share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {
        $this->params['filter']['status'] = $request->input('filter_status', 'all');
        $this->params['search']['field'] = $request->input('search_field', '');
        $this->params['search']['value'] = $request->input('search_value', '');
        $items = $this->model->listItem($this->params, ['task' => 'admin-list-item']);
        $itemsStatusCount = $this->model->countItems($this->params, ['task' => 'admin-count-item-group-by-status']);
        return view($this->pathViewController . 'index', [
            'params' => $this->params,
            'items' => $items,
            'itemsStatusCount' => $itemsStatusCount
        ]);
    }
    public function form(Request $request)
    {
        $items = null;
        if ($request->id !== null) {
            $params['id'] = $request->id;
            $items = $this->model->getItems($params, ['task' => 'get-item']);
        }
        $categoryModel = new CategoryModel();
        $itemsCategory =  $categoryModel->listItem(null, ['task' => 'admin-list-items-in-selectBox']);


        return view($this->pathViewController . 'form', [
            'items' => $items,
            'itemsCategory' => $itemsCategory
        ]);
    }



    public function save(MainRequest $request)
    {
        if (request()->method() == 'POST') {
            $params = request()->all();
            $task = 'add-item';
            $notify = 'Thêm phần tử thành công';
            if ($params['id'] !== null) {
                $task = 'edit-item';
                $notify = 'Cập nhật phần tử thành công';
            }

            $this->model->saveItem($params, ['task' => $task]);
            return redirect()->route($this->controllerName)->with('status', $notify);
        }

        echo '<h3>save</h3>';
    }
    public function delete(Request $request)
    {
        $params['id'] = $request->id;
        $this->model->deleteItem($params, ['task' => 'delete-item']);

        return redirect()->route($this->controllerName)->with('status', 'Xoá phần tử thành công');
    }

    public function changeStatus(Request $request)
    {
        $params['currentStatus'] = $request->status;
        $params['id'] = $request->id;
        $this->model->saveItem($params, ['task' => 'change-status']);

        return redirect()->route($this->controllerName)->with('status', 'Cập nhật trạng thái thành công');
    }
}

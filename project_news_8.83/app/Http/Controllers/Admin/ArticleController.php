<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleRequest as MainRequest;
use App\Models\ArticleModel as MainModel;
use App\Models\CategoryModel as CategoryModel;
use Illuminate\Http\Request;

class ArticleController extends AdminMainController
{
    public function __construct()
    {

        $this->pathViewController = 'admin.pages.article.';
        $this->controllerName = 'article';
        $this->model = new MainModel();
        $this->params = [
            'pagination' => [
                'totalItemPerPage' => 5,
            ],
        ];

        parent::__construct();
    }

    public function form(Request $request)
    {
        $item = null;
        if ($request->id !== null) {
            $params['id'] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        }

        $CategoryModel = new CategoryModel();
        $itemCategory = $CategoryModel->listItems(null, ['task' => 'admin-list-items-in-selectbox']);
        return view($this->pathViewController . 'form', [
            'item' => $item,
            'itemCategory' => $itemCategory,
        ]);
    }

    public function status(Request $request)
    {
        return parent::status($request);
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

    public function type(Request $request)
    {
        return $this->changeSelectBoxAjax($request, $request->type, 'change-type');
        //     $params['currentType'] = $request->type;
        //     $params['id'] = $request->id;
        //    $this->model->saveItem( $params,['task'=>'change-type']);
        //     return redirect()->route($this->controllerName,request()->input())->with('my_notify','Cập nhật trạng thái thành công');
    }
}

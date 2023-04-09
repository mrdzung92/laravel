<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RssRequest as MainRequest;
use App\Models\RssModel as MainModel;
use Illuminate\Http\Request;

class RssController extends AdminMainController
{

    public function __construct()
    {
        $this->pathViewController = 'admin.pages.rss.';
        $this->controllerName = 'rss';
        $this->model = new MainModel();

        $this->params = [
            'pagination' => [
                'totalItemPerPage' => 5,
            ],
        ];
        parent::__construct();
    }

    public function source(Request $request)
    {
        return $this->changeSelectBoxAjax($request, $request->source, 'change-source');

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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest as MainRequest;
use App\Models\MenuModel as MainModel;
use Illuminate\Http\Request;
class MenuController extends AdminMainController
{

    public function __construct()
    {

        $this->pathViewController = 'admin.pages.menu.';
        $this->controllerName = 'menu';
        $this->model = new MainModel();

        $this->params = [
            'pagination' => [
                'totalItemPerPage' => 10,
            ],
        ];
        parent::__construct();

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

            return redirect()->route($this->controllerName);
        }
    }

    public function typeMenu(Request $request)
    {       
        return $this->changeSelectBoxAjax($request, $request->type_menu, 'change-type-menu');

    }
    public function typeOpen(Request $request)
    {
        return $this->changeSelectBoxAjax($request, $request->type_open, 'change-type-open');
    }
}

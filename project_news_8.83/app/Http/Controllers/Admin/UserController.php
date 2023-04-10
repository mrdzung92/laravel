<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest as MainRequest;
use App\Models\UserModel as MainModel;
use Illuminate\Http\Request;

class UserController extends AdminMainController
{

    public function __construct()
    {
        $this->pathViewController = 'admin.pages.user.';
        $this->controllerName = 'user';
        $this->model = new MainModel();

        $this->params = [
            'pagination' => [
                'totalItemPerPage' => 5,
            ],
        ];

        parent::__construct();

    }

    public function delete(Request $request)
    {
        $params['id'] = $request->id;
        $this->model->deleteItem($params, ['task' => 'delete-item']);
        return redirect()->route($this->controllerName)->with('my_notify', 'Xoá phần tử thành công');
    }

    public function changePwd(MainRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();
            $this->model->saveItem($params, ['task' => 'change-password']);
            return redirect()->route($this->controllerName)->with('my_notify', 'Thay đổi mật khẩu thành công');
        }
    }

    public function level(Request $request)
    {
        return $this->changeSelectBoxAjax($request, $request->level, 'changeLevel');

    }

    public function formChangeLevel(MainRequest $request)
    {
        $params['currentLevel'] = $request->level;
        $params['id'] = $request->id;
        $this->model->saveItem($params, ['task' => 'changeLevel']);
        return redirect()->route($this->controllerName)->with('my_notify', 'Cập nhật trạng thái thành công');
    }


    public function changeSelfPwd(MainRequest $request)
    {

        return view($this->pathViewController . 'changePass.index');
        
    }

    public function save(MainRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();
            $task = 'add-item';
            $notify = 'Thêm phần tử thành công';
            if (isset($params['id']) && $params['id'] !== null) {
                $task = 'edit-item';
                $notify = 'Cập nhật phần tử thành công';
            }
            if(isset($params['selfPass'])){
                $task = 'change-self-password';
                $notify = 'Thay đổi mật khẩu thành công';
            }
           
            $this->model->saveItem($params, ['task' => $task]);

            return redirect()->route($this->controllerName)->with('my_notify', $notify);
        }
    }
}

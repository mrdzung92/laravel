<?php

namespace App\Http\Controllers\News;
use Illuminate\Http\Request;

use App\Http\Requests\AuthLoginRequest as MainRequest;
use App\Models\UserModel ;



class AuthController extends NewsMainController
{
   

    public function __construct()
    {
       $this->pathViewController = 'news.pages.auth.';
       $this->controllerName = 'auth';
       $this->params = [];
       $this->model;
        parent::__construct();

    }

    public function login(Request $request)
    { 
        // if($request->session()->has('userInfo')) return redirect()->route('home');
        return view($this->pathViewController . 'login');
    }

    public function postLogin(MainRequest $request)
    {   $params = $request->all();
        if($request->method()=='POST'){
            $userModel = new UserModel();
            $userInfo  = $userModel->getItem($params,['task'=>'auth-login']);
            if(!$userInfo){
                return redirect()->route($this->controllerName.'/login')->with('my_notify','Tài khoản mật khẩu không chính xác');
            }else{
                $request->session()->put('userInfo',$userInfo);
                return redirect()->route('home');
            }
           

        }
    }

    public function logout(Request $request)
    { 
       if($request->session()->has('userInfo')) $request->session()->pull('userInfo');
       return redirect()->route('home');
    }

}

<?php

namespace App\Http\Controllers\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest as MainRequest;
use App\Models\UserModel ;



class AuthController extends Controller
{
    private $pathViewController = 'news.pages.auth.';
    private $controllerName = 'auth';
    private $params = [];
    private $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);

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

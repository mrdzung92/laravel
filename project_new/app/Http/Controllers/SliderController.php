<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    private $pathViewController = 'admin.slider.';
    private $controllerName = 'slider';

    public function __construct()
    {  
        view()->share('controllerName', $this-> controllerName);  
    }
    
    public function index()
    {
        return view($this->pathViewController . 'index');
    }
    public function form($id=null)
    {
        $title = 'slider- controller -form';
        return view($this->pathViewController . 'form', [
            'id' => $id,
            'title' => $title
        ]);
    }
    public function delete()
    {
        return 'slider-controller-delete';
    }

    public function changeStatus(Request $request)
    {
        echo '<pre>';
        print_r($request->id);
        echo '</pre>';
        return redirect()->route('slider');
    }

}

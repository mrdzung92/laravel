<?php
 
namespace App\Http\Controllers;
 

use App\Http\Controllers\Controller;
 
class SliderController extends Controller
{

    public function index(){
        return 'slider-controller-index';
    }
    public function form(){
        return 'slider-controller-form';
    }
    public function delete(){
        return 'slider-controller-delete';
    }
    // public function show($id)
    // {
    //     return view('user.profile', ['user' => User::findOrFail($id)]);
    // }
}
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Routing\RouteGroup;

// $prefixAdmin = config('zendvn.url.prefix_admin');
$prefixAdmin = Config::get('zendvn.url.prefix_admin', 'admin69');
$prefixNews = Config::get('zendvn.url.prefix_new', 'news');

// ===============admin page==============
Route::group(['prefix' => $prefixAdmin], function () {
    Route::get('users', function () {
        // Matches The "/admin/users" URL
        return "/admin/users";
    });

    // ===============dashboard==============
    $prefix         = 'dashboard';
    $controllerName = 'dashboard';
    Route::group(['prefix' => $prefix], function () use ($controllerName) {

        $controller = ucfirst($controllerName) . 'Controller@';
        Route::get('/', [
            'as' => $controllerName,
            'uses' => $controller . 'index'
        ]);
    });


    // ===============slider==============
    $prefix         = 'slider';
    $controllerName = 'slider';
    Route::group(['prefix' => $prefix], function () use ($controllerName) {

        $controller = ucfirst($controllerName) . 'Controller@';
        Route::get('/', [
            'as' => $controllerName,
            'uses' => $controller . 'index'
        ]);
        Route::get('form/{id?}', [
            'as' => $controllerName . '/form',
            'uses' => $controller . 'form'
        ]);
        Route::get('delete/{id}', [
            'as' => $controllerName . '/delete',
            'uses' => $controller . 'delete'
        ]);
        Route::get('change-status/{id}/{status}', [
            'as' => $controllerName . '/change-status',
            'uses' => $controller . 'changeStatus'
        ]);
        Route::post('save', [
            'as' => $controllerName . '/save',
            'uses' => $controller . 'save'
        ]);
    });

    // ===============category==============
    $prefix         = 'category';
    $controllerName = 'category';
    Route::group(['prefix' => $prefix], function () use ($controllerName) {

        $controller = ucfirst($controllerName) . 'Controller@';
        Route::get('/', [
            'as' => $controllerName,
            'uses' => $controller . 'index'
        ]);
        Route::get('form/{id?}', [
            'as' => $controllerName . '/form',
            'uses' => $controller . 'form'
        ]);
        Route::get('delete/{id}', [
            'as' => $controllerName . '/delete',
            'uses' => $controller . 'delete'
        ]);
        Route::get('change-status/{id}/{status}', [
            'as' => $controllerName . '/change-status',
            'uses' => $controller . 'changeStatus'
        ]);
        Route::get('isHome/{id}/{is_home}', [
            'as' => $controllerName . '/isHome',
            'uses' => $controller . 'isHome'
        ]);
        Route::post('save', [
            'as' => $controllerName . '/save',
            'uses' => $controller . 'save'
        ]);
    });
});

// ===============home page==============
Route::group(['prefix' =>  $prefixNews], function () {
    Route::get('users', function () {
        // Matches The "/admin/users" URL
        return "/admin/users";
    });

    // ===============dashboard==============
    $prefix         = '';
    $controllerName = 'home';
    Route::group(['prefix' => $prefix], function () use ($controllerName) {

        $controller = ucfirst($controllerName) . 'Controller@';
        Route::get('/', [
            'as' => $controllerName,
            'uses' => $controller . 'index'
        ]);
    });
});

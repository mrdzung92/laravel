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


Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return 'about';
});

Route::group(['prefix' => $prefixAdmin], function() {
    Route::get('users', function () {
        // Matches The "/admin/users" URL
        return "/admin/users";
    });
    Route::get('category', function () {
        // Matches The "/admin/category" URL
        return "/admin/category";
    });
    $prefix = 'slider';
    Route::group(['prefix' => $prefix], function() use($prefix) {
        $controller = ucfirst( $prefix).'Controller@';
        Route::get('/', $controller.'index');
        Route::get('add', $controller.'form');
        Route::get('edit', $controller.'form');
        Route::get('delete', $controller.'delete');
    });
    
    
});


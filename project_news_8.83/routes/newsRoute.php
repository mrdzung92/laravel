<?php
Route::group(['namespace'=>'News','prefix'=>$prefixNews],function () {
    
    // ===============HOMEPAGE===============
    $prefix = '/';
    $controllerName = 'home';
   
    Route::prefix($prefix)->group( function () use ($controllerName, $prefix) {

        $controller = ucfirst($controllerName) . 'Controller@';

        Route::get('/', [
            'as' => $controllerName,
            'uses' => $controller . 'index',
        ]);

    });

     
    // ===============CATEGORY===============
    $prefix = 'chuyen-muc';
    $controllerName = 'category';
   
    Route::prefix($prefix)->group(function () use ($controllerName, $prefix ) {
        $controller = ucfirst($controllerName) . 'Controller@';
        Route::get('/{category_name}-{category_id}.html', [
            'as' => $controllerName.'/index',
            'uses' => $controller . 'index',
        ])->where('category_name', '[0-9a-zA-Z_-]+')->where('category_id', '[0-9]+');

    });

     // ===============Article===============
     $prefix = 'bai-viet';
     $controllerName = 'article';
    
     Route::prefix($prefix)->group(function () use ($controllerName, $prefix ) {
 
         $controller = ucfirst($controllerName) . 'Controller@';
 
         Route::get('/{article_name}-{article_id}.html', [
             'as' => $controllerName.'/index',
             'uses' => $controller . 'index',
         ])->where('article_name', '[0-9a-zA-Z_-]+')->where('article_id', '[0-9]+');
 
     });

     // ===============LOGIN===============
     $prefix = '';
     $controllerName = 'auth';
    
     Route::prefix($prefix)->group(function () use ($controllerName, $prefix ) {
 
         $controller = ucfirst($controllerName) . 'Controller@';
 
         Route::get('/login', [
             'as' => $controllerName.'/login',
             'uses' => $controller . 'login',
         ])->middleware('checkLogin');
         Route::post('/postLogin', [
            'as' => $controllerName.'/postLogin',
            'uses' => $controller . 'postLogin',
        ]);

        Route::get('/logout', [
            'as' => $controllerName.'/logout',
            'uses' => $controller . 'logout',
        ]);
 
     });

     // ===============Article===============
     $prefix = '';
     $controllerName = 'notify';
    
     Route::prefix($prefix)->group(function () use ($controllerName, $prefix ) {
 
         $controller = ucfirst($controllerName) . 'Controller@';
 
         Route::get('/no-permission', [
             'as' => $controllerName.'/noPermission',
             'uses' => $controller . 'noPermission',
         ]);

         Route::get('/page-not-found', [
            'as' => $controllerName.'/pageError',
            'uses' => $controller . 'pageError',
        ]);
 
     });

     // ===============RSS===============
    $prefix = '';
    $controllerName = 'rss';
    Route::prefix($prefix)->group( function () use ($controllerName, $prefix) {
        $controller = ucfirst($controllerName) . 'Controller@';
        Route::get('/tin-tuc-tong-hop', [
            'as' => $controllerName.'/tin-tuc-tong-hop',
            'uses' => $controller . 'index',
        ]);

        Route::get('/get-gold', [
            'as' => $controllerName.'/get-gold',
            'uses' => $controller . 'getGold',
        ]);

        Route::get('/get-coin', [
            'as' => $controllerName.'/get-coin',
            'uses' => $controller . 'getCoin',
        ]);

    });

   
});
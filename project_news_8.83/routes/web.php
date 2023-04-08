<?php
use Illuminate\Support\Facades\Route;
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

// admin
$prefixAdmin = config('myConfig.url.prefix_admin');
$prefixNews = config('myConfig.url.prefix_news');

 // =============ADMIN=========
Route::group(['namespace'=>'Admin','prefix'=>$prefixAdmin ,'middleware'=>['permissionAdmin']],function () {

    // ===============DASHBOARD===============
    $prefix = 'dashboard';
    $controllerName = 'dashboard';
    Route::prefix($prefix)->group(function () use ($controllerName, $prefix) {

        $controller = ucfirst($controllerName) . 'Controller@';

        Route::get('/', [
            'as' => $controllerName,
            'uses' => $controller . 'index',
        ]);

    });

    // ===============slider===============
    $prefix = 'slider';
    $controllerName = 'slider';
    Route::prefix($prefix)->group(function () use ($controllerName, $prefix) {

        $controller = ucfirst($controllerName) . 'Controller@';

        Route::get('/', [
            'as' => $controllerName,
            'uses' => $controller . 'index',
        ]);

        Route::get('/form/{id?}', [
            'as' => $controllerName . '/form',
            'uses' => $controller . 'form',
        ])->where('id', '[0-9]+');

        Route::post('save', [
            'as' => $controllerName . '/save',
            'uses' => $controller . 'save',
        ]);

        Route::get('/delete/{id}', [
            'as' => $controllerName . '/delete',
            'uses' => $controller . 'delete',
        ])->where('id', '[0-9]+');

        Route::get('/changeStatus-{status}/{id}', [
            'as' => $controllerName . '/status',
            'uses' => $controller . 'status',
        ])->where('id', '[0-9]+');

    });

      // ===============user===============
      $prefix = 'user';
      $controllerName = 'user';
      Route::prefix($prefix)->group(function () use ($controllerName, $prefix) {
  
          $controller = ucfirst($controllerName) . 'Controller@';
  
          Route::get('/', [
              'as' => $controllerName,
              'uses' => $controller . 'index',
          ]);
  
          Route::get('/form/{id?}', [
              'as' => $controllerName . '/form',
              'uses' => $controller . 'form',
          ])->where('id', '[0-9]+');
  
          Route::post('save', [
              'as' => $controllerName . '/save',
              'uses' => $controller . 'save',
          ]);

          Route::post('change-pwd', [
            'as' => $controllerName . '/change-pwd',
            'uses' => $controller . 'changePwd',
        ]);
  
          Route::get('/delete/{id}', [
              'as' => $controllerName . '/delete',
              'uses' => $controller . 'delete',
          ])->where('id', '[0-9]+');
  
          Route::get('/changeStatus-{status}/{id}', [
              'as' => $controllerName . '/status',
              'uses' => $controller . 'status',
          ])->where('id', '[0-9]+');

          Route::get('/level-{level}/{id}', [
            'as' => $controllerName . '/level',
            'uses' => $controller . 'level',
        ])->where('id', '[0-9]+');

        Route::post('/change-level', [
            'as' => $controllerName . '/change-level',
            'uses' => $controller . 'formChangeLevel',
        ])->where('id', '[0-9]+');

       
  
      });

    // ===============category===============
    $prefix = 'category';
    $controllerName = 'category';
    Route::prefix($prefix)->group(function () use ($controllerName, $prefix) {

        $controller = ucfirst($controllerName) . 'Controller@';

        Route::get('/', [
            'as' => $controllerName,
            'uses' => $controller . 'index',
        ]);

        Route::get('/form/{id?}', [
            'as' => $controllerName . '/form',
            'uses' => $controller . 'form',
        ])->where('id', '[0-9]+');

        Route::post('save', [
            'as' => $controllerName . '/save',
            'uses' => $controller . 'save',
        ]);

        Route::get('/delete/{id}', [
            'as' => $controllerName . '/delete',
            'uses' => $controller . 'delete',
        ])->where('id', '[0-9]+');

        Route::get('/changeStatus-{status}/{id}', [
            'as' => $controllerName . '/status',
            'uses' => $controller . 'status',
        ])->where('id', '[0-9]+');

        Route::get('/changeIsHome-{isHome}/{id}', [
            'as' => $controllerName . '/isHome',
            'uses' => $controller . 'changeIsHome',
        ])->where('id', '[0-9]+');

        Route::get('/changeDisplay-{display}/{id}', [
            'as' => $controllerName . '/display',
            'uses' => $controller . 'changeDisplay',
        ])->where('id', '[0-9]+');

    });

    // ===============Article===============
    $prefix = 'article';
    $controllerName = 'article';
    Route::prefix($prefix)->group(function () use ($controllerName, $prefix) {

        $controller = ucfirst($controllerName) . 'Controller@';

        Route::get('/', [
            'as' => $controllerName,
            'uses' => $controller . 'index',
        ]);

        Route::get('/form/{id?}', [
            'as' => $controllerName . '/form',
            'uses' => $controller . 'form',
        ])->where('id', '[0-9]+');

        Route::post('save', [
            'as' => $controllerName . '/save',
            'uses' => $controller . 'save',
        ]);

        Route::get('/delete/{id}', [
            'as' => $controllerName . '/delete',
            'uses' => $controller . 'delete',
        ])->where('id', '[0-9]+');

        Route::get('/changeStatus-{status}/{id}', [
            'as' => $controllerName . '/status',
            'uses' => $controller . 'status',
        ])->where('id', '[0-9]+');

        Route::get('/changeType-{type}/{id}', [
            'as' => $controllerName . '/type',
            'uses' => $controller . 'type',
        ]);

    });

      // ===============rss===============
      $prefix = 'rss';
      $controllerName = 'rss';
      Route::prefix($prefix)->group(function () use ($controllerName, $prefix) {
  
          $controller = ucfirst($controllerName) . 'Controller@';
  
          Route::get('/', [
              'as' => $controllerName,
              'uses' => $controller . 'index',
          ]);
  
          Route::get('/form/{id?}', [
              'as' => $controllerName . '/form',
              'uses' => $controller . 'form',
          ])->where('id', '[0-9]+');
  
          Route::post('save', [
              'as' => $controllerName . '/save',
              'uses' => $controller . 'save',
          ]);
  
          Route::get('/delete/{id}', [
              'as' => $controllerName . '/delete',
              'uses' => $controller . 'delete',
          ])->where('id', '[0-9]+');
  
          Route::get('/changeStatus-{status}/{id}', [
              'as' => $controllerName . '/status',
              'uses' => $controller . 'status',
          ])->where('id', '[0-9]+');

         
          Route::get('/changeSource-{source}/{id}', [
            'as' => $controllerName . '/source',
            'uses' => $controller . 'source',
        ])->where('id', '[0-9]+');
  
      });

});
    // =============FRONTEND=========
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

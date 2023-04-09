<?php
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
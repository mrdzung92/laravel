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


                
//========================== ADMIN===========================
    require(__DIR__ . '/adminRoute.php');
    // =============FRONTEND=========
    require(__DIR__ . '/newsRoute.php');

Route::fallback(function () {
    return redirect()->route('notify/pageError');
});

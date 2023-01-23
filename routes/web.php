<?php

use Illuminate\Http\Client\Request;
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
Route::get('register', function () {
    return 'Disabled';
});
Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});


Route::get('logout', 'AuthController@logout')->name("logout");
Route::get('login', 'AuthController@index')->name("login");


Route::get('password/forget', 'AuthController@forget_password');
Route::post('password/reset', 'AuthController@reset_password');
Route::post('password/change', 'AuthController@changer_password');






Route::middleware('auth:web')->group(function () {

    Route::get('dashboard', 'DashboardController@index');
  
    
    Route::resource('roles', 'RoleController');

    
  // stats page home

    
});

// les route public 

   
Route::get('/{any}', 'ApplicationController')->where('any', '.*');
    



<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::namespace('App\Http\Controllers')->group(function(){
    // Auth Routes
    Route::group([
        // 'middleware' => 'api',
        'prefix' => 'auth'
    ], function ($router) {
        Route::post('/login', 'AuthController@login');
        Route::post('/register', 'AuthController@register');
        Route::post('/logout', 'AuthController@logout');
        Route::post('/refresh', 'AuthController@refresh');
        Route::get('/user-profile', 'AuthController@userProfile');
    });
    // Products Routes
    Route::prefix('products')->group(function () {
        Route::get('/', 'ProductController@index');
        Route::get('view/{id}', 'ProductController@show');
        Route::post('store', 'ProductController@store');
        Route::patch('update/{id}', 'ProductController@update');
        Route::post('delete/{id}', 'ProductController@destroy');
        Route::post('add-category/{id}/', 'ProductController@category_add');
        Route::post('delete-category/{id}', 'ProductController@category_delete');
    });
    // Category Routes
    Route::prefix('category')->group(function () {
        Route::get('/', 'CategoryController@index');
        Route::get('view/{id}', 'CategoryController@show');
        Route::post('store', 'CategoryController@store');
        Route::patch('update/{id}', 'CategoryController@update');
        Route::post('delete/{id}', 'CategoryController@destroy');
    });
});

<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// get config

Route::get('provinces', 'BillController@provinceIndex');

Route::get('categoriesProduct', 'BillController@categoryProductIndex');

Route::get('products', 'BillController@productIndex');

Route::post('bills', 'BillController@store');

Route::get('reports/categoryProduct', 'BillController@reportCategoryByProduct');





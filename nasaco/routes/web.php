<?php
use Illuminate\Http\Request;
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



Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
});

Route::group(['middleware' => 'AuthApi'], function () {
    Route::get('/', function (Request $request) {
	    return view('dashboard');
	});

	Route::get('/import', function (Request $request) {
        $role = $request->auth_user_role;
        if($role > 1) return 'Forbiden';
	    return view('importExcel');
	});
});

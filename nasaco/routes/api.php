<?php

use Illuminate\Http\Request;

Route::group(['middleware' => 'AuthApi'], function () {
    Route::get('/user', function (Request $request) {
    	$user = App\User::where('id',$request->auth_user_id)
					->with('roles')
					->first();
	    return $user;
	});
});

// region -----1. Bill & danh muc
Route::post('bills', 'BillController@store');

Route::get('bills', 'BillController@index');

Route::put('bills/{BillId}', 'BillController@update');

Route::delete('bills/{BillId}', 'BillController@delete');


Route::get('provinces', 'BillController@provinceIndex');

Route::get('danhMucNhomHang', 'BillController@layDanhMucNhomHang');

Route::get('danhMucMatHang', 'BillController@layDanhMucMatHang');

// endregion

// region -----2. Bao cao
Route::get('baoCao/soLuongDatHangTheoTinhThanhTrenTungNhomHang', 'BillController@baoCaoSoLuongDatHangTheoTinhThanhTrenTungNhomHang');

Route::get('baoCao/tongSuatThanhToanTheoNhomHang', 'BillController@baocaoTongSuatThanhToanTheoNhomHang');

Route::get('baoCao/tongSuatTheoF1FA', 'BillController@baoCaoTongSuatTheoF1FA');

Route::get('baoCao/xuatNhapTon', 'BillController@baoCaoXuatNhapTon');

Route::get('baoCao/thongKeTheoTinh', 'BillController@baoCaoThongKeTheoTinh');

Route::get('baoCao/thongKeTheoNhomHang', 'BillController@baoCaoThongKeTheoNhomHang');

Route::get('baoCao/danhSachTinhThanhCoDatHang', 'BillController@baoCaoDanhSachTinhThanhCoDatHang');

// endregion


Route::post('register','UserController@register');
Route::post('login','UserController@login');
Route::post('logout','UserController@logout')->middleware('AuthApi');
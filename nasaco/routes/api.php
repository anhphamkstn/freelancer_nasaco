<?php

use Illuminate\Http\Request;

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






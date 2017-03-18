<?php

use Illuminate\Http\Request;

// region -----1. Bill & danh muc
Route::post('bills', 'BillController@store');

Route::get('provinces', 'BillController@provinceIndex');

Route::get('danhMucNhomHang', 'BillController@layDanhMucNhomHang');

Route::get('danhMucMatHang', 'BillController@layDanhMucMatHang');
// endregion

// region -----2. Bao cao
Route::get('baoCao/soLuongDatHangTheoTinhThanhTrenTungNhomHang', 'BillController@baoCaoSoLuongDatHangTheoTinhThanhTrenTungNhomHang');

Route::get('baoCao/tongSuatThanhToanTheoNhomHang', 'BillController@baocaoTongSuatThanhToanTheoNhomHang');

Route::get('baocao/tongSuatTheoF1FA', 'BillController@baocaoTongSuatTheoF1FA');



Route::get('baocao/xuatNhapTon', 'BillController@baocaoXuatNhapTon');

Route::get('baocao/thongKeTheoTinh', 'BillController@baocaothongKeTheoTinh');

Route::get('baocao/thongKeTheoNhomHang', 'BillController@baocaoThongKeTheoNhomHang');

Route::get('baocao/danhSachTinhThanhCoDatHang', 'BillController@baocaoDanhSachTinhThanhCoDatHang');

Route::get('baocao/danhSachTinhThanhCoXuatHang', 'BillController@baocaoDanhSachTinhThanhCoXuatHang');
// endregion






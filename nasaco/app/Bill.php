<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    //
    protected $table = 'bills';

    protected $fillable = [
        'ngay',
        'thang',
        'nam',
        'ngay_thang_nam',
        'mat_hang',
        'nhom_hang',
        'dien_giai',
        'tinh',
        'ma_buu_chinh',
        'dvt',
        'sl_dat_hang',
        'sl_thuc_xuat',
        'sl_thanh_toan',
        'con_lai',
        'don_gia',
        'thanh_tien_thanh_toan'];
}

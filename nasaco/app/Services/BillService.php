<?php
/**
 * Created by PhpStorm.
 * User: pham
 * Date: 17/03/2017
 * Time: 10:42
 */

namespace App\Services;
use App\Bill;
use Illuminate\Support\Facades\Validator;


class BillService
{
    public function getListProvince(){
        $province = Bill::distinct('tinh','ma_buu_chinh')
            ->select('tinh','ma_buu_chinh')
            ->get();
        return $province;
    }

    public function validateInfo($info, $action = 'insert', $id = 0)
    {
        $rules = [];
        $messages = [
            // add message
        ];

        if ($action === 'insert') {
            $rules = [
                // to do
            ];
        } elseif ($action === 'update' && $id > 0) {
            $rules = [
            ];
        }
        $validator = Validator::make($info, $rules, $messages);
        return $validator;
    }

    public function insert($info)
    {
        $bill = Bill::create($info);
        return $this->transform($bill);
    }

    private function transform($bill){
        if ($bill instanceof Bill) {
            return [
                'id' => $bill->id,
                'ngay'=>$bill->ngay,
                'thang'=>$bill->thang,
                'nam'=>$bill->nam,
                "ngay_thang_nam"=>$bill->ngay_thang_nam,
                'mat_hang' => $bill->mat_hang,
                'nhom_hang' => $bill->nhom_hang,
                'dien_giai'=>$bill->dien_giai,
                'tinh'=>$bill->tinh,
                'ma_buu_chinh'=>$bill->ma_buu_chinh,
                'dvt'=>$bill->dvt,
                'sl_dat_hang'=>$bill->sl_dat_hang,
                'sl_thuc_xuat'=>$bill->sl_thuc_xuat,
                'sl_thanh_toan'=>$bill->sl_thanh_toan,
                'con_lai'=>$bill->con_lai,
                'don_gia'=>$bill->don_gia,
                'thanh_tien_thanh_toan'=>$bill->thanh_tien_thanh_toan,
                'created_at' => $bill->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $bill->updated_at->format('Y-m-d H:i:s')
            ];
        }
        else{
            return null;
        }
    }

}